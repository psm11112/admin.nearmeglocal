<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','string','max:255',
                Rule::unique(Category::class,'name')->ignore($this->id)],
            'sku'=>'required',
            'photo'=>'bail|nullable|mimes:jpeg,jpg,png,svg|max:2048'
        ];
    }
}
