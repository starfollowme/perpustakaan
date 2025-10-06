<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(20) DEFAULT 'admin'");

        DB::table('users')
            ->whereNull('role')
            ->orWhereNotIn('role', ['admin', 'user'])
            ->update(['role' => 'user']);

        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','user') DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin') DEFAULT 'admin'");
    }
};
