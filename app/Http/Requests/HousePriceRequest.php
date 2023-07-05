<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HousePriceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'age' => 'required|integer|min:0|max:100',
            'distance' => 'required|integer|min:0|max:100',
            'minimart' => 'required|integer|min:0|max:100',
        ];
    }

    public function messages()
    {        
        return [
            'age.required' =>'กรุณาระบุอายุบ้าน',
            'distance.required' =>'กรุณาระบุระยะทางจากบ้านไปยังรถไฟฟ้า',
            'minimart.required' =>'กรุณาระบุจำนวนร้านสะดวกซื้อ',            
        ];        
    }
}
