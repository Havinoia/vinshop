<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    // Sub kategori
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Parent kategori
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Produk dalam kategori ini
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}