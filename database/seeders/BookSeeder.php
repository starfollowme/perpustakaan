<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if ($admin) {
            Book::whereNull('user_id')->update(['user_id' => $admin->id]);
        }

        $books = [
            [
                'judul' => 'Harry Potter dan Batu Bertuah',
                'penulis' => 'J.K. Rowling',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => '2001',
                'deskripsi' => 'Buku pertama dari seri Harry Potter',
                'category' => 'Fiksi',
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => '2005',
                'deskripsi' => 'Novel tentang perjuangan anak-anak di Belitung',
                'category' => 'Fiksi',
            ],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => '1980',
                'deskripsi' => 'Novel sejarah Indonesia di masa kolonial',
                'category' => 'Sejarah',
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => '2018',
                'deskripsi' => 'Buku tentang filsafat Stoisisme',
                'category' => 'Pengembangan Diri',
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Penguin Random House',
                'tahun_terbit' => '2018',
                'deskripsi' => 'Buku tentang membangun kebiasaan baik',
                'category' => 'Pengembangan Diri',
            ],
        ];

        foreach ($books as $book) {
            $category = Category::where('nama', $book['category'])->first();

            $payload = [
                'penulis' => $book['penulis'],
                'penerbit' => $book['penerbit'],
                'tahun_terbit' => $book['tahun_terbit'],
                'deskripsi' => $book['deskripsi'],
                'category_id' => $category?->id,
            ];

            if ($admin) {
                $payload['user_id'] = $admin->id;
            }

            Book::updateOrCreate(
                ['judul' => $book['judul']],
                $payload
            );
        }
    }
}
