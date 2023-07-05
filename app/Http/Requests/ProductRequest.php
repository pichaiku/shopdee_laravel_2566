<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $productID = $this->route('id');        
        return [            
            'productName' => 'required|max:200|unique:product,productName,'.$productID.',productID',
            'productDetail' => 'max:500',
            'price' => 'required|numeric|max:9999999999',
            'quantity' => 'required|int|max:99999',            
            'typeID' => 'required|int|max:999',
            'imageFile' => 'image|max:1024'
        ];
    }//`productDetail`, `price`, `quantity`, `imageFile`, `typeID`

    public function messages()
    {        
        return [            
            'productName.required' =>'กรุณาระบุชื่อสินค้า',
            'productName.unique' =>'ชื่อสินค้านี้มีอยู่แล้ว',
            'price.required' =>'กรุณาระบุราคาสินค้า',
            'quantity.required' =>'กรุณาระบุจำนวน',            
            'typeID.required' =>'กรุณาระบุประเภทสินค้า',            
        ];        
    }
}
