<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();        
        return view("admin.employee.index", compact("employees"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.employee.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // $this->validate($request, [
        //     'file' => 'image' 
        // ]);

        $username = $request->get("username");
        $password = $request->get("password");
        $firstName = $request->get("firstName");
        $lastName = $request->get("lastName");

        // $sql = "INSERT INTO employee(username, password,firstName,lastName)
        //         VALUES($username, $password,$firstName,$lastName)";
        // $DB->insert();

        $employee = new Employee();
        $employee->username = $username;
        $employee->password = $password;
        $employee->firstName = $firstName;
        $employee->lastName = $lastName;
        $employee->save();

        return redirect("/admin/employee")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view("admin.employee.show", compact("employee"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view("admin.employee.edit", compact("employee"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {        

        $username = $request->get("username");
        $password = $request->get("password");
        $firstName = $request->get("firstName");
        $lastName = $request->get("lastName");

        $employee = Employee::find($id);
        $employee->username = $username;
        $employee->password = $password;
        $employee->firstName = $firstName;
        $employee->lastName = $lastName;
        $employee->save();
        
        return redirect("/admin/employee")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $employee = Employee::find($id);
        $employee->delete();        
        return redirect("/admin/employee")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
