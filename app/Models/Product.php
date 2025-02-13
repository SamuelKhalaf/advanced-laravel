<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function details()
    {
        return $this->hasOne(ProductDetails::class, 'product_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(ProductReviews::class, 'product_id', 'id');
    }
    public function image(){
        return $this->morphOne("App\Models\Image", "imagable");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
