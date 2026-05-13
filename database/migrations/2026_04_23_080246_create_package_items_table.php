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
    Schema::create('package_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('package_id')->constrained()->onDelete('cascade');
        $table->string('category'); // main course, protein, side dish, vegetable, condiment
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_items');
    }
};
