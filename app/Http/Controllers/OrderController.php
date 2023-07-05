<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{

    public function index()
    {
        //$orders = Order::all();    
        $sql = "SELECT `orders`.`orderID`, `orderDate`, `shipDate`, 
        `receiveDate`, `orders`.`custID`, `statusName`,
        customer.firstName,customer.lastName,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice 
        FROM `orders` 
            INNER JOIN customer ON customer.custID=`orders`.custID         
            INNER JOIN orderdetail ON `orders`.`orderID` = orderdetail.orderID 
            INNER JOIN orderstatus ON orders.statusID = orderstatus.statusID
        GROUP BY `orders`.`orderID`, `orderDate`, `shipDate`, 
            `receiveDate`, `orders`.`custID`, `statusName`,
            customer.firstName,customer.lastName     
        ORDER BY `orders`.orderID ASC ";
          
        $orders = DB::select($sql);                 

        return view("admin.order.index", compact("orders"));
    }


    public function show($id)
    {
        //$order = Order::find($id);
        $sql = "SELECT `orders`.`orderID`, `orderDate`, `shipDate`, 
        `receiveDate`, `orders`.`custID`, `statusID`,
        customer.firstName,customer.lastName,customer.address,customer.zipcode,customer.mobilePhone,
        subdistrict.subdistrictName, district.districtName, province.provinceName,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice,
        COUNT(orderdetail.orderID) AS itemCount 
        FROM `orders` 
            INNER JOIN customer ON customer.custID=`orders`.custID         
            INNER JOIN orderdetail ON `orders`.`orderID`=orderdetail.orderID 
            LEFT JOIN subdistrict ON customer.subdistrictID = subdistrict.subdistrictID
            LEFT JOIN district ON subdistrict.districtID = district.districtID
            LEFT JOIN province ON district.provinceID = province.provinceID
        WHERE orders.orderID=$id 
        GROUP BY `orders`.`orderID`, `orderDate`, `shipDate`, 
            `receiveDate`, `orders`.`custID`, `statusID`,
            customer.firstName,customer.lastName,customer.address,customer.zipcode,customer.mobilePhone,
            subdistrict.subdistrictName, district.districtName, province.provinceName";
          
        $order = DB::select($sql)[0];    

        $orderDetail = OrderDetailController::orderdetail($id);

        return view("admin.order.show", compact("order","orderDetail"));
    }


    public function edit($id)
    {
        $order = Order::find($id);
        $ordertypes = OrderType::all();

        return view("admin.order.edit", compact("order","ordertypes"));
    }


    public function update(OrderRequest $request, $id)
    {        
        $orderName = $request->get("orderName");
        $orderDetail = $request->get("orderDetail");
        $price = $request->get("price");
        $quantity = $request->get("quantity");        
        $typeID  = $request->get("typeID");
        $imageFile = $request->file("imageFile");

        $order = Order::find($id);
        $order->orderName = $orderName;
        $order->orderDetail = $orderDetail;
        $order->price = $price;
        $order->quantity = $quantity;        
        $order->typeID = $typeID;     
                  
        if(isset($imageFile)){                  
            $imageFile->move("assets/order", $imageFile->getClientOriginalName());
            $order->imageFile = $imageFile->getClientOriginalName();                            
        }      
        
        $order->save();
        
        return redirect("/admin/order")->with("success","คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว");
    }


    public function destroy($id)
    {        
        $order = Order::find($id);
        $order->delete();        
        return redirect("/admin/order")->with("delete","คุณได้ทำการลบข้อมูลเรียบร้อยแล้ว");
    }
}
