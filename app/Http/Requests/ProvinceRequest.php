<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
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
        $provinceID = $this->route('id');        
        return [
            'provinceID' => 'required|min:2|max:2|unique:province,provinceID,'.$provinceID.',provinceID',
            'provinceName' => 'required|max:200',
        ];
    }

    public function messages()
    {        
        return [
            'provinceID.required' =>'กรุณาระบุรหัสจังหวัด',
            'provinceName.required' =>'กรุณาระบุชื่อจังหวัด',
            'provinceID.unique' =>'รหัสจังหวัดนี้มีอยู่แล้ว',
        ];        
    }
}
