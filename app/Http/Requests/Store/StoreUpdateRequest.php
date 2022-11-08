<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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

    // Regras de validações das requisições
    public function rules() {

        //Pegando o id que veio via GET na requisição
        $id = $this->segment(3);
      
        return [ 
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email|unique:stores,email,'.$id,           
        ];
    }

    // Mensagens de resposta das validações da requisição
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ter no mínimo 3 caracteres',
            'max' => 'O campo :attribute deve ter no máximo 40 caracteres',
            'string' => 'O campo :attribute deve ser do tipo string',
            'email' => 'O campo :attribute deve ser do tipo email',
            'unique' => 'O campo :attribute é já existe',          
        ];
    }
}