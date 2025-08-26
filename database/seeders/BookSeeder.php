<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book; // Import model Book
use Illuminate\Support\Facades\DB; // Import DB Facade

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        DB::table('books')->truncate();

        // Masukkan data baru
        Book::create([
            'book_name' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'description' => 'Kisah inspiratif tentang perjuangan anak-anak Belitung.',
            'published_date' => '2005-09-01',
        ]);

        Book::create([
            'book_name' => 'Bumi Manusia',
            'author' => 'Pramoedya Ananta Toer',
            'description' => 'Sebuah novel sejarah yang berlatar belakang era kolonial.',
            'published_date' => '1980-08-25',
        ]);

        Book::create([
            'book_name' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'description' => 'A Handbook of Agile Software Craftsmanship.',
            'published_date' => '2008-08-01',
        ]);

        Book::create([
            'book_name' => 'The Pragmatic Programmer',
            'author' => 'Andrew Hunt and David Thomas',
            'description' => 'Your Journey to Mastery, 20th Anniversary Edition.',
            'published_date' => '2019-09-13',
        ]);

        Book::create([
            'book_name' => 'Design Patterns',
            'author' => 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides',
            'description' => 'Elements of Reusable Object-Oriented Software.',
            'published_date' => '1994-10-31',
        ]);

        Book::create([
            'book_name' => 'The Pragmatic Programmer',
            'author' => 'David Thomas, Andrew Hunt',
            'description' => 'From journeyman to master, this book covers a wide range of topics for software developers.',
            'published_date' => '1999-10-20',
        ]);

        Book::create([
            'book_name' => 'Atomic Habits',
            'author' => 'James Clear',
            'description' => 'An easy & proven way to build good habits & break bad ones.',
            'published_date' => '2018-10-16',
        ]);

        Book::create([
            'book_name' => 'Filosofi Teras',
            'author' => 'Henry Manampiring',
            'description' => 'Sebuah buku pengantar filsafat Stoisisme agar bisa hidup lebih tentram.',
            'published_date' => '2018-11-26',
        ]);

        Book::create([
            'book_name' => 'Sapiens: A Brief History of Humankind',
            'author' => 'Yuval Noah Harari',
            'description' => 'A sweeping tour of the history of our species.',
            'published_date' => '2011-01-01',
        ]);

        Book::create([
            'book_name' => 'Gadis Kretek',
            'author' => 'Ratih Kumala',
            'description' => 'Kisah pencarian seorang perempuan misterius berlatar industri rokok kretek di Indonesia.',
            'published_date' => '2012-01-01',
        ]);
    }
}
