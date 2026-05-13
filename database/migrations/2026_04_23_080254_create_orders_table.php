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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('receipt_number')->unique(); // #AG-9928174410
        $table->string('customer_name');
        $table->string('customer_phone');
        $table->text('address_1'); // alamat utama
        $table->string('address_2')->nullable(); // kecamatan
        $table->string('address_3')->nullable(); // kota/kabupaten
        $table->decimal('subtotal', 12, 2);
        $table->decimal('shipping_cost', 12, 2)->default(0);
        $table->decimal('service_fee', 12, 2)->default(0);
        $table->decimal('total_amount', 12, 2);
        $table->string('payment_method'); // transfer_bank, e_wallet, credit_card, cod, virtual_account
        $table->string('payment_detail')->nullable(); // BCA, GoPay, dll
        $table->enum('status', [
            'pending',
            'waiting_confirmation',
            'processing',
            'cooking',
            'shipped',
            'delivered',
            'completed',
            'cancelled'
        ])->default('pending');
        $table->string('notes')->nullable();
        $table->timestamp('order_date')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
