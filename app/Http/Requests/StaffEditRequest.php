<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffEditRequest extends FormRequest
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
            'email'    => ['required', 'email', 'max:255', Rule::unique('staff')->ignore($this->id)],
            'username' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:4', 'max:20', 'confirmed'],
            'locale'   => ['required', 'in:ja,en'],
        ];
    }
}
