<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Inscription extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /*
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom'=>['required'], 
            'email'=>['required', 'email'],
            'pswd'=>['required', 'min:8'], 
            'cpswd'=>['same:pswd']
        ];
    }

    public function messsage(){
        return [
            'nom.required' => 'naame is required',
            'email.required' => 'email is required',
            'pswd.required' => 'password is required to validate the form',
            'pswd.min:8' => 'password must be at least 8 characters',
            'cpswd.same:pswd' => 'password must be the same as the password above',
        ];
    }
}
