<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'image' => 'required',
        'description' => 'required',
        'seasons' => 'required|array',
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getDisplayName()
    {
        return '商品ID' . $this->id . ':' . $this->name;
    }
}
