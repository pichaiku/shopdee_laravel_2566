<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {              
        // $sql="SELECT * FROM customer";
        // $products=DB::select($sql);  
        $products = Product::all();          

        return view("admin.product.index", compact("products"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producttypes = ProductType::all();    
        return view("admin.product.create", compact("producttypes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validate(['imageFile' => 'required',],
                            ['imageFile.required' =>'กรุณาระบุรูปสินค้า']
                          );

        $productName = $request->get("productName");
        $productDetail = $request->get("productDetail");
        $price = $request->get("price");
        $quantity = $request->get("quantity");
        $typeID  = $request->get("typeID");

        $imageFile  = $request->file("imageFile");
        $fileName = time().$imageFile->getClientOriginalName();   
        $imageFile->move("assets/product", $fileName);

        $product = new Product();
        $product->productName = $productName;
        $product->productDetail = $productDetail;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->imageFile = $fileName;
        $product->typeID = $typeID;    
        $product->save();

        return redirect("/admin/product")->with("success","คุณได้ทำการลงทะเบียนเรียบร้อยแล้ว");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = Product::find($id);
        $sql = "SELECT product.*,producttype.typeName  
                FROM product 
                INNER JOIN producttype ON product.typeID = producttype.typeID 
                WHERE productID=$id";
        $product = DB::select($sql)[0];  
        return view("admin.product.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $producttypes = ProductType::all();

        return view("admin.product.edit", compact("product","producttypes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {        
        $productName = $request->get("productName");
        $productDetail = $request->get("productDetail");
        $price = $request->get("price");
        $quantity = $request->get("quantity");        
        $typeID  = $request->get("typeID");
        $imageFile = $request->file("imageFile");

        $product = Product::find($id);
        $product->productName = $productName;
        $product->productDetail = $productDetail;
        $product->price = $price;
        $product->quantity = $quantity;        
        $product->typeID = $typeID;     
                  
        if(isset($imageFile)){                  
            $imageFile->move("assets/product", $imageFile->getClientOriginalName());
            $product->imageFile = $imageFile->getClientOriginalName();                            
        }      
        
        $product->save();
        
        return redirect("/admin/product")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $product = Product::find($id);
        $product->delete();        
        return redirect("/admin/product")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
