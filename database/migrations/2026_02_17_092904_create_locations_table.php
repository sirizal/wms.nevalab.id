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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->foreignId('location_type_id')->constrained()->onDelete('restrict');
            $table->string('code');
            $table->string('name')->nullable();
            $table->integer('level')->default(0);
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('max_weight', 12, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_picking_area')->default(false);
            $table->boolean('is_receiving_area')->default(false);
            $table->boolean('is_dispatch_area')->default(false);
            $table->string('temperature_zone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
