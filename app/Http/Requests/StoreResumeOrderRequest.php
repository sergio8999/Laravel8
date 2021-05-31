<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeOrderRequest extends FormRequest
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
            'nameHouse'=>'required',
            'arrivalDay'=>'required',
            'departureDay'=>'required',
            'arrivalTime'=>'required',
            'departureTime'=>'required',
            'subtotal'=>'required',
            'taxes'=>'required',
            'totalPrices'=>'required'
        ];
    }
}
