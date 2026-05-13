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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->string('payment_code')->unique(); // kode unik payment
        $table->string('payment_method');
        $table->string('payment_channel')->nullable(); // BCA, GoPay, dll
        $table->decimal('amount', 12, 2);
        $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
        $table->string('transaction_id')->nullable(); // dari midtrans
        $table->json('payment_data')->nullable(); // raw response midtrans
        $table->timestamp('paid_at')->nullable();
        $table->timestamp('expired_at')->nullable();
        $table->string('va_number')->nullable(); // untuk virtual account
        $table->string('qr_code')->nullable(); // untuk e-wallet
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
