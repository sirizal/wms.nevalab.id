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
        Schema::create('uoms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('symbol');
            $table->foreignId('uom_type_id')->constrained('uom_types')->onDelete('cascade');
            $table->double('conversion_factor')->default(1);
            $table->unsignedBigInteger('base_uom_id')->nullable();
            $table->timestamps();

            $table->foreign('base_uom_id')
                ->references('id')
                ->on('uoms')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uoms');
    }
};
