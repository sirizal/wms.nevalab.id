<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only apply when using PostgreSQL
        if (Schema::getConnection()->getDriverName() === 'pgsql') {
            // Convert text/json column to jsonb using PostgreSQL cast
            DB::statement("ALTER TABLE notifications ALTER COLUMN data TYPE jsonb USING (data::jsonb)");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'pgsql') {
            // Convert back to text
            DB::statement("ALTER TABLE notifications ALTER COLUMN data TYPE text USING (data::text)");
        }
    }
};
