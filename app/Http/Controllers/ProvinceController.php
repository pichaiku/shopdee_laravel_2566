<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\ProvinceRequest;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();        
        return view("admin.province.index", compact("provinces"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.province.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceRequest $request)
    {
        $provinceID = $request->get("provinceID");
        $provinceName = $request->get("provinceName");        

        $province = new Province();
        $province->provinceID = $provinceID;
        $province->provinceName = $provinceName;      
        $province->save();

        return redirect("/admin/province")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::find($id);
        return view("admin.province.show", compact("province"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = Province::find($id);

        return view("admin.province.edit", compact("province"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceRequest $request, $id)
    {   
        $provinceID = $request->get("provinceID");     
        $provinceName = $request->get("provinceName");

        $province = Province::find($id);
        $province->provinceID = $provinceID;
        $province->provinceName = $provinceName;                 
        $province->save();
        
        return redirect("/admin/province")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $province = Province::find($id);
        $province->delete();        
        return redirect("/admin/province")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
