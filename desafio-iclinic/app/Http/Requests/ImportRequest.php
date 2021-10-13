<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateCpfRule;

class ImportRequest extends FormRequest
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
            
                
                'email'=>'required|email',
                'dataNascimento'=>'required|date_format:Y-m-d',
                'cpf'=>['required','numeric',new ValidateCpfRule]
            
        ];
    }

    public function messages()
    {
        return [
               
            'email.required'=>'O e-mail deve ser informado',
            'email.email'=>'O e-mail informado é inválido',
            'dataNascimento.required'=>'A datan de Nascimento deve ser informado'

        ];
    }
}
