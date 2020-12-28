<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Task;

class StaffTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'    => 'required|string|min:3|max:100',
            'content'  => 'nullable|string|max:255',
            'status'   => [
                'required',
                Rule::in(
                    Task::getAvailablesStatuses()
                ),
            ]
        ];
    }

    public function attributes()
    {
        return [
                'title' => 'tytuł zadania'
        ];
    }  
}
