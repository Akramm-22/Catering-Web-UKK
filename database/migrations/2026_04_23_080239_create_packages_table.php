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
    Schema::create('packages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description');
        $table->text('short_description')->nullable();
        $table->decimal('price', 12, 2);
        $table->integer('min_pax');
        $table->integer('max_pax')->nullable();
        $table->string('menu_type'); // prasmanan, kotak, tumpeng, dll
        $table->string('image')->nullable();
        $table->json('gallery')->nullable();
        $table->decimal('rating', 3, 2)->default(0);
        $table->integer('review_count')->default(0);
        $table->boolean('is_bestseller')->default(false);
        $table->boolean('is_active')->default(true);
        $table->string('badge')->nullable(); // "TERLARIS", "BOX CATERING", dll
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
