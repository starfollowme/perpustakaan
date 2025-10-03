<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
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
    // books table doesn't have a 'category' column; group by 'penerbit' (publisher)
    // and alias it to 'category' so the existing view continues to work.
    $booksByCategory = Book::select('penerbit as category', DB::raw('count(*) as total'))
                ->groupBy('penerbit')
                ->get();
        $usersByRole = User::select('role', DB::raw('count(*) as total'))
                        ->groupBy('role')
                        ->get();

        return view('reports.index', compact('totalBooks', 'totalUsers', 'booksByCategory', 'usersByRole'));
    }
}
