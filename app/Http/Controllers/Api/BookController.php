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
        // [cite: 28, 29]
        $books = Book::paginate(4);
        return response()->json($books);
    }

    /**
     * Membuat buku baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_name' => [ // [cite: 15]
                'required',
                'string',
                'max:150', // [cite: 21]
                Rule::unique('books')->where(function ($query) use ($request) {
                    return $query->where('author', $request->author);
                }), // [cite: 20]
            ],
            'description' => 'nullable|string', // [cite: 16, 22]
            'author' => 'required|string|max:150', // [cite: 17, 21]
            'published_date' => 'required|date', // [cite: 18, 23]
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
            'description' => 'nullable|string', // [cite: 26]
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
        // Jika {book} tidak ditemukan, Laravel akan otomatis merespon dengan 404 Not Found. [cite: 33]
        $book->delete(); // [cite: 32]

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }

    /**
     * Mencari buku berdasarkan judul atau deskripsi. [cite: 34, 35]
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1'
        ]);

        $query = $request->input('query');

        $books = Book::where('book_name', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%")
                     ->paginate(4); // [cite: 36, 37]

        return response()->json($books);
    }
}
