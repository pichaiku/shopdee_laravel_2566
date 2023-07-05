<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Requests\DistrictRequest;
use DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$districts = District::all();        
        $sql = "SELECT district.*, province.provinceName 
                FROM district 
                INNER JOIN province ON district.provinceID = province.provinceID";
        $districts = DB::select($sql);
        return view("admin.district.index", compact("districts"));
    }

    public function district($id){
        $sql = "SELECT districtID, districtName 
        FROM district 
        WHERE provinceID='$id'";
        return DB::select($sql);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.district.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $districtID = $request->get("districtID");
        $districtName = $request->get("districtName");        
        $provinceID = $request->get("provinceID");      

        $district = new District();
        $district->districtID = $districtID;
        $district->districtName = $districtName;      
        $district->provinceID = $provinceID;   
        $district->save();

        return redirect("/admin/district")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $district = District::find($id);
        return view("admin.district.show", compact("district"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::find($id);

        return view("admin.district.edit", compact("district"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, $id)
    {   
        $districtID = $request->get("districtID");     
        $districtName = $request->get("districtName");
        $provinceID = $request->get("provinceID");      

        $district = District::find($id);
        $district->districtID = $districtID;
        $district->districtName = $districtName;                 
        $district->provinceID = $provinceID; 
        $district->save();
        
        return redirect("/admin/district")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $district = District::find($id);
        $district->delete();        
        return redirect("/admin/district")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
