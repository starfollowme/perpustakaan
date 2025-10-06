<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama' => 'Fiksi', 'deskripsi' => 'Koleksi buku fiksi dan novel.'],
            ['nama' => 'Non Fiksi', 'deskripsi' => 'Buku non fiksi dan referensi umum.'],
            ['nama' => 'Pengembangan Diri', 'deskripsi' => 'Buku motivasi dan pengembangan diri.'],
            ['nama' => 'Sejarah', 'deskripsi' => 'Buku bertema sejarah dan biografi.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['nama' => $category['nama']],
                ['deskripsi' => $category['deskripsi']]
            );
        }
    }
}
