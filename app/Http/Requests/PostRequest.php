<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PostRequest extends FormRequest
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
        //validation request for create post
        $rules = [
            'title'         => 'required',
            'content'       => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id'   => 'required'
        ];
        //validation request for update post
        if ($this->method() == "PUT") {
            $rules = [
                'title'         => 'required',
                'content'       => 'required',
                'category_id'   => 'required'
            ];
            //condition image is update
            if($this->request->get('image')){
                $rules += [
                    'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ];
            };
        };

        return $rules;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
}
