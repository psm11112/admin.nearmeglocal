<?php

namespace App\Http\Requests;

use App\Models\ListModel;
use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListRequest extends FormRequest
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
            'title' => ['required','string','max:255',
                Rule::unique(ListModel::class,'title')->ignore($this->id)]
            ,
            'title_slug'=>['required'],
            'country_id'=>['required'],
            'state_id'=>['required'],
            'city_id'=>['required'],
            'area_id'=>['required'],
            'post_code'=>['required'],
            'address'=>['required','max:500'],



        ];


    }
}
