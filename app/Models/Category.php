<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'photo','slug'
    ];

    protected $hidden = [

    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'categories_id');
    }
}
