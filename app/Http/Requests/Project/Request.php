<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Project;

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
        //    'name'        => 'required|string|min:3,max:100|unique:projects,name',  /* if name must by unique */
            'name'        => 'required|string|min:3,max:100', 
            'host_url'    => 'nullable|string|max:100', 
            'description' => 'nullable|string',
            'status'      => [
                            'required',
                            Rule::in(
                                Project::getAvailablesStatuses()
                            )]
        ];
    }
}
