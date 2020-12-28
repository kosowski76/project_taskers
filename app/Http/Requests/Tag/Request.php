<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3,max:255|unique:tags,name'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
         //   'name' => strtolower($this->name)
            'name' => mb_strtolower($this->name, 'utf-8')
        ]);
    } 
}
