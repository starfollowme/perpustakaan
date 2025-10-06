<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'user_id',
        'category_id',
    ];

    /**
     * Admin who created the book record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Category assigned to the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
