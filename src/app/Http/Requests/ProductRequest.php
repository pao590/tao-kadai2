<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'price' => 'required|integer|min:0|max:10000',
            'image' => 'required|image|mimes:jpeg,png',
            'description' => 'required|string|max120',
            'seasons' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpg」形式でアップロードしてください',
            'seasons.required' => '季節を選択してください',
            'seasons.array' => '季節を選択してください',
        ];
    }
}
