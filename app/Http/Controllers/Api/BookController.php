<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku dengan paginasi.
     */
    public function index()
    {
        $books = Book::paginate(4);
        return response()->json($books);
    }

    /**
     * Membuat buku baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('books')->where(function ($query) use ($request) {
                    return $query->where('author', $request->author);
                }),
            ],
            'description' => 'nullable|string',
            'author' => 'required|string|max:150',
            'published_date' => 'required|date',
        ]);

        $book = Book::create($validatedData);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Menampilkan detail satu buku.
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Mengupdate buku.
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'description' => 'nullable|string',
        ]);

        $book->update($validatedData);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Menghapus buku.
     */
    public function destroy(Book $book)
    {
        // Validasi keberadaan buku sudah otomatis ditangani oleh Route Model Binding Laravel.
        // Jika {book} tidak ditemukan, Laravel akan otomatis merespon dengan 404 Not Found.
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }

    /**
     * Mencari buku berdasarkan judul atau deskripsi.
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1'
        ]);

        $query = $request->input('query');

        $books = Book::where('book_name', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%")
                     ->paginate(4);

        return response()->json($books);
    }
}
