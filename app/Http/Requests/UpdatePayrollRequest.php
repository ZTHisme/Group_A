<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollRequest extends FormRequest
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
            'basic_salary' => $rule,
            'overtime_fee' => $rule,
            'leave_fine' => $rule
        ];
    }
}
