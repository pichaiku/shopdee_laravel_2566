<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $empID = $this->route('id');        
        return [
            'username' => 'required|string|min:3|max:100|unique:employee,username,'.$empID.',empID',
            'password' => 'required|string|min:2|max:100',
            'firstName' => 'required|string|min:2|max:100',
            'lastName' => 'required|string|min:2|max:100'            
        ];
    }

    public function messages()
    {        
        return [
            'username.required' =>'กรุณาระบุชื่อผู้ใช้',
            'password.required' =>'กรุณาระบุรหัผ่าน',
            'firstName.required' =>'กรุณาระบุชื่อ',
            'lastName.required' =>'กรุณาระบุนามสกุล',
            'username.unique' =>'ชื่อผู้ใช้นี้มีอยู่แล้ว',
        ];        
    }
}
