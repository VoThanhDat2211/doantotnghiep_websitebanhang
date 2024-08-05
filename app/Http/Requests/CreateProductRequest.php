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
            "description" => "bail|required|max:255",
            "discount" => "bail|required|between:0,99.99",
            "image" => "bail|mimes:jpg,png,jpeg|max:5048"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Không được để trống !",
            "name.max" => "Không vượt quá 255 ký tự !",
            "category_id.required" => "Không được để trống !",
            "category_id.max" => "Không vượt quá 255 ký tự !",
            "discount.max" => "Không vượt quá 255 ký tự !",
            "discount.between" => "Dữ liệu không hợp lệ (0 - 99.99) !",
            "image.mimes" => "Định dạng file không hợp lệ(jpg, png, jpeg)",
        ];
    }
}
