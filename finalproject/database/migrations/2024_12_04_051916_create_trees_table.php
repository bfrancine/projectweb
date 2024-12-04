<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->decimal('size', 8, 2);
            $table->foreignId('species_id')->constrained()->onDelete('cascade');
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('location');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->decimal('price', 10, 2);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};
