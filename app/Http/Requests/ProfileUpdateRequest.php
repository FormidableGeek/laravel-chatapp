<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo'=>'sometimes|mimes:jpg,png,svg',
            'email'=>'nullable|email|unique:users',
            'name'=>'sometimes|max:20|min:5|string',
            'password'=>'sometimes|confirmed'
        ];
    }
}
