<?php

namespace App\Models;

use App\Enums\SupplierType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'image',
        'email',
        'phone',
        'address',
        'shop_name',
        'type',
        'account_number',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'type' => SupplierType::class
    ];


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('email', 'like', "%{$value}%")
            ->orWhere('phone', 'like', "%{$value}%")
            ->orWhere('shop_name', 'like', "%{$value}%")
            ->orWhere('type', 'like', "%{$value}%");
    }
}
