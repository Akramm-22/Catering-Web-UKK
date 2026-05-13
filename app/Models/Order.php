<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'receipt_number', 'customer_name', 'customer_phone',
        'address_1', 'address_2', 'address_3', 'subtotal', 'shipping_cost',
        'service_fee', 'total_amount', 'payment_method', 'payment_detail',
        'status', 'notes', 'order_date'
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public static function generateReceiptNumber(): string {
        return '#AG-' . strtoupper(uniqid());
    }

    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function payment() { return $this->hasOne(Payment::class); }
    public function trackings() {
        return $this->hasMany(OrderTracking::class)->orderBy('happened_at', 'desc');
    }

    public function getStatusLabelAttribute(): string {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'waiting_confirmation' => 'Menunggu Konfirmasi',
            'processing' => 'Sedang Diproses',
            'cooking' => 'Mulai Memasak',
            'shipped' => 'Dalam Perjalanan',
            'delivered' => 'Tiba di Tujuan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown',
        };
    }

    public function getStatusColorAttribute(): string {
        return match($this->status) {
            'pending', 'waiting_confirmation' => 'amber',
            'processing', 'cooking' => 'blue',
            'shipped' => 'purple',
            'delivered', 'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }
}
