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
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone')->nullable()->after('email');
        $table->string('avatar')->nullable()->after('phone');
        $table->string('google_id')->nullable()->after('avatar');
        $table->string('facebook_id')->nullable()->after('google_id');
        $table->string('provider')->nullable()->after('facebook_id');
        $table->boolean('is_admin')->default(false)->after('provider');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
