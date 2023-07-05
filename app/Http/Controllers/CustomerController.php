<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();        
        return view("admin.customer.index", compact("customers"));
    }

    public function showToken(){
        echo csrf_token(); 
  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.customer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        // $this->validate($request, [
        //     'file' => 'image' 
        // ]);

        $username = $request->get("username");
        $password = $request->get("password");
        $firstName = $request->get("firstName");
        $lastName = $request->get("lastName");

        // $sql = "INSERT INTO customer(username, password,firstName,lastName)
        //         VALUES($username, $password,$firstName,$lastName)";
        // $DB->insert();

        $customer = new Customer();
        $customer->username = $username;
        $customer->password = $password;
        $customer->firstName = $firstName;
        $customer->lastName = $lastName;
        $customer->save();

        return redirect("/admin/customer")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view("admin.customer.show", compact("customer"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view("admin.customer.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {        

        $username = $request->get("username");
        $password = $request->get("password");
        $firstName = $request->get("firstName");
        $lastName = $request->get("lastName");

        $customer = Customer::find($id);
        $customer->username = $username;
        $customer->password = $password;
        $customer->firstName = $firstName;
        $customer->lastName = $lastName;
        $customer->save();
        
        return redirect("/admin/customer")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $customer = Customer::find($id);
        $customer->delete();        
        return redirect("/admin/customer")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
