<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_variant_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_variant_id')->constrained('item_variants')->onDelete('cascade');
            $table->foreignId('item_option_value_id')->constrained('item_option_values')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['item_variant_id', 'item_option_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_variant_option_values');
    }
};
