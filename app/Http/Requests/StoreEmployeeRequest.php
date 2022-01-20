<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

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
        $rule =  [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => ['required', 'string', 'min:6', 'max:12',],            // must be at least 8 characters in length
            'confirm_password' => 'required|same:password|min:6',
            //'phone' => 'required',
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
            'address' => 'required',
            'profile' => 'required | mimes:jpeg,jpg,png | max:1000',
            'role' => 'required',
            'department' => 'required',
            'leave_fine' => 'required',
            'overtime_fee' => 'required',
            'basic_salary' => 'required',
        ];
        Log:
        info($rule);
        return $rule;
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
