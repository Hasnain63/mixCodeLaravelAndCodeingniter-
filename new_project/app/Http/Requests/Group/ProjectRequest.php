<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'document' => 'required|mimes:doc,docx,pdf',
            'project' => 'required|mimes:zip,rar',
            'supervisor_id' => 'required',

        ];
    }
}
