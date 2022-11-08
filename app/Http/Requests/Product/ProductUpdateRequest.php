<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'store_id' => 'required|exists:App\Models\Store,id',
            'name' => 'required|string|min:3|max:60',
            'value' => 'required|integer|between:10,999999',
            'active' => 'required|boolean'           
        ];
    }

    // Mensagens de resposta das validações da requisição
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O campo name deve ter no mínimo 3 caracteres',
            // 'value.min' => 'O campo value deve ter no mínimo 2 caracteres',
            'name.max' => 'O campo name deve ter no máximo 60 caracteres',
            // 'value.max' => 'O campo value deve ter no máximo 6 caracteres',
            'between' => 'O campo :attribute deve possuir entre 2 e 6 digitos',
            'string' => 'O campo :attribute deve ser do tipo string',
            'integer' => 'O campo :attribute deve ser do tipo integer',
            'boolean' => 'O campo :attribute deve ser do tipo boolean',
            'email' => 'O campo :attribute deve ser do tipo email',
            'unique' => 'O campo :attribute é obrigatório',
            'exists' => 'O campo :attribute não existe na sua respectiva tabela'        
        ];
    }
}