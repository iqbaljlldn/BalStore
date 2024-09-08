<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'users_id',
        'categories_id',
        'price',
        'description',
        'slug'
    ];

    protected $hidden = [

    ];

    public function galleries() {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function category() {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
