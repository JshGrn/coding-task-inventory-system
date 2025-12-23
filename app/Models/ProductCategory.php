<?php

namespace App\Models;

use App\Enums\DiscountType;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'discount_type',
        'discount_value',
    ];

    protected $appends = [
        'formatted_discount'
    ];

    protected function casts(): array
    {
        return [
            'discount_type' => DiscountType::class,
        ];
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getFormattedDiscountAttribute()
    {
        return match ($this->discount_type) {
            DiscountType::Percentage => "{$this->discount_value}%",
            DiscountType::FixedValue => Money::ofMinor($this->discount_value, 'GBP')->formatTo('en_GB'),
            default => 'No discount'
        };
    }
}
