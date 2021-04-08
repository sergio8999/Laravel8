<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservation extends FormRequest
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
            'arrivalDay'=>'required',
            'deapertureDay'=>'required',
            'arrivalTime' =>'required',
            'departureTime' =>'required',
            'taxes'=>'required|numeric',
            'subtotal'=>'required|numeric',
            'total'=>'required|numeric',
            'house_id'=>'required|numeric'
        ];
    }
}
