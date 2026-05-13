<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'short_description',
        'price', 'min_pax', 'max_pax', 'menu_type', 'image', 'gallery',
        'rating', 'review_count', 'is_bestseller', 'is_active', 'badge'
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_bestseller' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function items() {
        return $this->hasMany(PackageItem::class)->orderBy('sort_order');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedPriceAttribute(): string {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute(): string {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image ? asset('storage/' . $this->image) : asset('images/placeholder.jpg');
    }
}
