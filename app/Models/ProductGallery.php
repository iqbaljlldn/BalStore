<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'photos',
    ];

    protected $hidden = [

    ];

    public function product() {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
