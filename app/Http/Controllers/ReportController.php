<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan
     */
    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();

        $booksByPublisher = Book::select('penerbit', DB::raw('count(*) as total'))
            ->groupBy('penerbit')
            ->orderByDesc('total')
            ->get();

        $usersByRole = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get();

        $booksByAdmin = User::withCount('books')
            ->whereHas('books')
            ->orderByDesc('books_count')
            ->get();

        $booksByCategory = Category::withCount('books')
            ->orderByDesc('books_count')
            ->get();

        return view('reports.index', compact(
            'totalBooks',
            'totalUsers',
            'booksByPublisher',
            'usersByRole',
            'booksByAdmin',
            'booksByCategory'
        ));
    }
}
