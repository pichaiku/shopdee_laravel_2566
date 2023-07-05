<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
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
        $typeID = $this->route('id');      

        return [
            'typeName' => 'required|string|max:200|unique:producttype,typeName,'.$typeID.',typeID',
        ];
    }

    public function messages()
    {        
        return [
            'typeName.required' =>'กรุณาระบุประเภทสินค้า',            
            'typeName.unique' =>'ประเภทสินค้านี้มีอยู่แล้ว',
        ];        
    }
}
