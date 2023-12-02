<?php

namespace App\Http\Requests;

use App\Models\Cities;
use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CitiesRequest extends FormRequest
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
            'state'=>['required'],
            'name' => ['required','string','max:255',
                Rule::unique(Cities::class,'city_name')->ignore($this->id)],

            'slug'=>['required'],
        ];
    }
}
