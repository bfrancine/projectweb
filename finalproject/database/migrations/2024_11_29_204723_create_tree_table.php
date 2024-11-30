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
        Schema::create('tree', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->foreignId('species_id')->constrained('species');
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->string('photo_path')->nullable();
            $table->foreignId('state_tree_id')->constrained('state_tree');
            $table->date('last_update_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tree');
    }
};
