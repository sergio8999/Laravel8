<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        // devolvemos true cuando queremos que pase al siguiente paso y false si no es ese role
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
            'name'=>'required|max:10',
            'description'=>'required|min:2',
            'price'=>'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del curso'
        ];
    }

    public function messages()
    {
        return[
            'description.required' => 'Debe ingresar una descripción del producto'
        ];
    }
}
