<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "bail|required|max:255",
            "category_id" => "bail|required|max:255",
            "discount" => "bail|numeric|min:0|max:99.99",
            "images.*" => "bail|mimes:jpg,png,jpeg|max:5048"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Không được để trống !",
            "name.max" => "Không vượt quá 255 ký tự !",
            "category_id.required" => "Không được để trống !",
            "category_id.max" => "Không vượt quá 255 ký tự !",
            "discount.numeric" => "Dữ liệu phải ở dạng số",
            "discount.min" => "Dữ liệu không hợp lệ!",
            "discount.max" => "Dữ liệu không hợp lệ!",
            'images.*.mimes' => 'Định dạng file không hợp lệ(jpg, png, jpeg) !',
            'images.*.max' => 'Mỗi file nhỏ hơn 5MB !',
        ];
    }
}