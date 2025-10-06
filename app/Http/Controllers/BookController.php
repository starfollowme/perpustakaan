<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $books = Book::with(['user', 'category'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%")
                      ->orWhere('penerbit', 'like', "%{$search}%")
                      ->orWhere('tahun_terbit', 'like', "%{$search}%")
                      ->orWhereHas('category', function ($categoryQuery) use ($search) {
                          $categoryQuery->where('nama', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->get();

        return view('books.index', compact('books', 'search'));
    }

    /**
     * Display a public catalog for authenticated users.
     */
    public function catalog(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $books = Book::with(['category', 'user'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%")
                      ->orWhere('penerbit', 'like', "%{$search}%")
                      ->orWhere('tahun_terbit', 'like', "%{$search}%")
                      ->orWhereHas('category', function ($categoryQuery) use ($search) {
                          $categoryQuery->where('nama', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('user.books', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('nama')->get();

        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'deskripsi' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = new Book($validated);
        $book->user()->associate($request->user());
        $book->save();

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['user', 'category'])->findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::orderBy('nama')->get();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'deskripsi' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
