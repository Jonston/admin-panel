<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name'      => ['required', 'max:255'],
            'email'     => ['email', 'max:255'],
            'website'   => ['max:255'],
            'logo'      => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:10240',
                'dimensions:min_width=100,min_height=100'
            ]
        ];
    }
}
