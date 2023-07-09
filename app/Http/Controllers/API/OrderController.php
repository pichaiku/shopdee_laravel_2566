<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class OrderController extends Controller
{    
    //เพิ่มสินค้าเข้าตะกร้า
    public function makeorder(Request $request)
    {
        $custID = $request->get("custID");
        $productID = $request->get("productID");
        $quantity = $request->get("quantity");
        $price = $request->get("price");

        //check existing order
        $sql="SELECT orderID FROM orders WHERE custID=$custID AND statusID=0";
        $order=DB::select($sql);

        if(count($order)==0)//no-existing order
        {
            $order = new Order();
            $order->custID = $custID;
            $order->statusID = 0;
            $order->save();
            
            $sql = "INSERT INTO orderdetail VALUeS($order->orderID, $productID,$quantity,$price)";
            DB::insert($sql);

        }else{//existing order

            $orderID = $order[0]->orderID;
            $sql="SELECT COUNT(*) AS orderdetailcount 
                  FROM orderdetail 
                  WHERE orderID = $orderID AND productID = $productID";
            $orderdetail = DB::select($sql);

            if($orderdetail[0]->orderdetailcount == 0)//no-existing order detail
            {
                $sql = "INSERT INTO orderdetail VALUeS($orderID, $productID,$quantity,$price)";
                DB::insert($sql);

            }else{
                $sql = "UPDATE orderdetail 
                        SET quantity = quantity + $quantity 
                        WHERE orderID = $orderID AND productID = $productID";
                DB::update($sql);

            }
            
        }

        return response()->json(
            array('message' => 'success','status' => 'true')
        );

    }

    //ยืนยันการสั่งซื้อ
    public function confirmorder(Request $request){
        $orderDate = date("y-m-d H:i:s");
        
        $sql = "UPDATE orders 
                SET orderDate = '$orderDate', statusID = 1 
                WHERE orderID = ".$request->get("orderID");
        DB::update($sql);

        return response()->json(
            array('message' => 'success','status' => 'true')
        );        
    }

    //แสดงข้อมูลการสั่งซื้อที่อยู่ในตะกร้า
    public function cart($id){        
        $sql = "SELECT `orders`.`orderID`, `orderDate`, `shipDate`, 
        `receiveDate`, `orders`.`custID`, `statusID`,
        customer.firstName,customer.lastName,customer.address,customer.mobilePhone,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice,
        COUNT(orderdetail.orderID) AS itemCount 
        FROM `orders` 
            INNER JOIN customer ON customer.custID=`orders`.custID         
            INNER JOIN orderdetail ON `orders`.`orderID`=orderdetail.orderID 
        WHERE orders.custID=$id  AND orders.statusID=0 
        GROUP BY `orders`.`orderID`, `orderDate`, `shipDate`, 
            `receiveDate`, `orders`.`custID`, `statusID`,
            customer.firstName,customer.lastName,customer.address,customer.mobilePhone";
          
        return DB::select($sql);        
    }

    //แสดงรายการประวัติการสั่งซื้อ
    public function history($id){        
        $sql = "SELECT `orders`.`orderID`, `orderDate`, `shipDate`, 
        `receiveDate`, `orders`.`custID`, `statusID`,
        customer.firstName,customer.lastName,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice 
        FROM `orders` 
            INNER JOIN customer ON customer.custID=`orders`.custID         
            INNER JOIN orderdetail ON `orders`.`orderID`=orderdetail.orderID 
        WHERE orders.custID=$id and orders.statusID <> 0 
        GROUP BY `orders`.`orderID`, `orderDate`, `shipDate`, 
            `receiveDate`, `orders`.`custID`, `statusID`,
            customer.firstName,customer.lastName     
        ORDER BY `orders`.orderID DESC ";
          
        return DB::select($sql);        
    }

    //แสดงข้อมูลการสั่งซื้อ ของรายการที่เลือก
    public function orderinfo($id){        
        $sql = "SELECT `orders`.`orderID`, `orderDate`, `shipDate`, 
        `receiveDate`, `orders`.`custID`, `statusID`,
        customer.firstName,customer.lastName,customer.address,customer.mobilePhone,
        SUM(orderdetail.quantity) AS totalQuantity,
        SUM(orderdetail.quantity*orderdetail.price) AS totalPrice 
        FROM `orders` 
            INNER JOIN customer ON customer.custID=`orders`.custID         
            INNER JOIN orderdetail ON `orders`.`orderID`=orderdetail.orderID 
        WHERE orders.orderID=$id 
        GROUP BY `orders`.`orderID`, `orderDate`, `shipDate`, 
            `receiveDate`, `orders`.`custID`, `statusID`,
            customer.firstName,customer.lastName,customer.address,customer.mobilePhone      
         ";
          
        return DB::select($sql);        
    }

}