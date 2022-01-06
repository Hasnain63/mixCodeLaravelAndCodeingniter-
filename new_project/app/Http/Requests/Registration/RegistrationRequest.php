<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'std_1_name' => 'required|string',
            'std_2_name' => 'required|string',
            'std_1_roll_no' => 'required',
            'std_2_roll_no' => 'required',
            'std_1_email' => 'required|string|unique:registrations,std_1_email',
            'std_2_email' => 'required|string|unique:registrations,std_2_email',
            'std_1_session' => 'required',
            'std_2_session' => 'required',
            'department_id' => 'required',
            'std_1_card' => 'required',
            'std_2_card' => 'required',


            
            
        ];


    }
}
