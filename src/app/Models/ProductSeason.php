<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSeason extends Model
{
    use HasFactory;

    protected $table = 'product_season';
    //中間テーブルは手動でテーブル名を指定する

    protected $primaryKey = null;
    //中間テーブルはidを持たず複合キーだけのためキーがないよと明示するためにnullを指定する

    public $incrementing = false;
    //中間テーブルのためauto_incrementの動作を無効にする

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
    //中間テーブルからproductとseasonテーブルにアクセスするための関数になる
    //この表記にすることで中間テーブルから紐づいている情報を取得できる

}
