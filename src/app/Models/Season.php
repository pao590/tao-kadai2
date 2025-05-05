<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season');
    }

    // public function getDisplayName()
    // {
    //     return '商品ID' . $this->id . ':' . $this->name;
    // }
    //今後使用するかもしれないため念のために残すもの
}
