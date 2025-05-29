<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'birthday',
    ];

    const GENDERS = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];

    public function getGendeLabelAttribute()
    {
        return self::GENDERS[$this->gender] ?? '未設定';
    }
}
