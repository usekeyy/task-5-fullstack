<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //validation request for login
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        //validation request for register
        if(Route::current()->uri() == "api/register"){
            $rules += ['name'   => 'required'];
            $rules['email'] = 'required|email|unique:users';
        }

        return $rules;
    }
    
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
    
}
