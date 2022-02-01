<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreEmployeeRequest extends FormRequest
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
        $rule = [
            'required',
            function ($attribute, $value, $fail) {
                if ($value < 1000) {
                    $fail('The ' . $attribute . ' should be at least 1000.');
                }
            },
            function ($attribute, $value, $fail) {
                if ($value > 99999999) {
                    $fail('The ' . $attribute . ' should be at max 99999999.');
                }
            },
        ];

        return [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed|min:6',
            'phone' => [
                'required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15', 'ends_with:0,1,2,3,4,5,6,7,8,9',
                function ($attribute, $value, $fail) {
                    if (Str::substrCount($value, '-',) > 1) {
                        $fail('The ' . $attribute . ' number must contain only one special character');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (Str::substrCount($value, '+',) > 1) {
                        $fail('The ' . $attribute . ' number must contain only one special character');
                    }
                },
            ],
            'address' => 'required|max:255',
            'profile' => 'required|mimes:png,jpg,jpeg,svg',
            'role_id' => 'required',
            'department_id' => 'required',
            'leave_fine' => $rule,
            'overtime_fee' => $rule,
            'basic_salary' => $rule,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.regex' => 'Please enter real phone number',
            'name.required' => 'The name field is required'
        ];
    }
}
