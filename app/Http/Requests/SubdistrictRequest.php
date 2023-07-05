<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubdistrictRequest extends FormRequest
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
        $subdistrictID = $this->route('id');        
        return [
            'subdistrictID' => 'required|min:6|max:6|unique:subdistrict,subdistrictID,'.$subdistrictID.',subdistrictID',
            'subdistrictName' => 'required|max:200',
            'districtID' => 'required|min:4|max:4',
        ];
    }

    public function messages()
    {        
        return [
            'subdistrictID.required' =>'กรุณาระบุรหัสตำบล',
            'subdistrictName.required' =>'กรุณาระบุชื่อตำบล',
            'subdistrictID.unique' =>'รหัสตำบลนี้มีอยู่แล้ว',
            'districtID.required' =>'กรุณาระบุอำเภอ',
        ];        
    }
}
