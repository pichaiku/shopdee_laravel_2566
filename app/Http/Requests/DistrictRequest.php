<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
            'districtID' => 'required|min:4|max:4|unique:district,districtID,'.$districtID.',districtID',
            'districtName' => 'required|max:200',
            'provinceID' => 'required|min:2|max:2',
        ];
    }

    public function messages()
    {        
        return [
            'districtID.required' =>'กรุณาระบุรหัสอำเภอ',
            'districtName.required' =>'กรุณาระบุชื่ออำเภอ',            
            'districtID.unique' =>'รหัสอำเภอนี้มีอยู่แล้ว',
            'provinceID.required' =>'กรุณาระบุจังหวัด',
        ];        
    }
}
