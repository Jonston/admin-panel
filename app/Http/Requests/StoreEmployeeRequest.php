<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'first_name'    => ['required', 'max:255'],
            'last_name'     => ['required', 'max:255'],
            'phone'         => ['max:255'],
            'email'         => ['nullable', 'email', 'max:255'],
            'company_id'    => ['exists:companies,id']
        ];
    }
}
