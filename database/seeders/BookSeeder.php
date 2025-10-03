<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Harry Potter dan Batu Bertuah',
                'penulis' => 'J.K. Rowling',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => '2001',
                'deskripsi' => 'Buku pertama dari seri Harry Potter'
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => '2005',
                'deskripsi' => 'Novel tentang perjuangan anak-anak di Belitung'
            ],
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => '1980',
                'deskripsi' => 'Novel sejarah Indonesia di masa kolonial'
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => '2018',
                'deskripsi' => 'Buku tentang filsafat Stoisisme'
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Penguin Random House',
                'tahun_terbit' => '2018',
                'deskripsi' => 'Buku tentang membangun kebiasaan baik'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
