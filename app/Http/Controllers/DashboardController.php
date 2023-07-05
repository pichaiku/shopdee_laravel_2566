<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalIncome = $this->getTotalIncome();     
        $productCount = $this->getProductCount();
        $orderCount = $this->getOrderCount();
        $customerCount = count(Customer::all());
        
        ////ยอดการขายรายเดือน
        $_monthlyAmountData1 = $this->getMonthlyAmountProduct("",date("Y"));
        $_monthlyAmountData2 = $this->getMonthlyAmountProduct("",date("Y")-1);
        $monthlyAmountData1 = array_fill(0,12,0);
        $monthlyAmountData2 = array_fill(0,12,0);
        
        foreach($_monthlyAmountData1 as $val){
            $monthlyAmountData1[($val->month*1)-1]=$val->totalAmount;
        }

        foreach($_monthlyAmountData2 as $val){
            $monthlyAmountData2[($val->month*1)-1]=$val->totalAmount;
        }


        //จำนวนสินค้าที่ขายได้รายเดือน        
        $_monthlyQuantityData1 = $this->getMonthlyQuantityProduct("",date("Y"));
        $_monthlyQuantityData2 = $this->getMonthlyQuantityProduct("",date("Y")-1);
        $monthlyQuantityData1 = array_fill(0,12,0);
        $monthlyQuantityData2 = array_fill(0,12,0);
        
        foreach($_monthlyQuantityData1 as $val){
            $monthlyQuantityData1[($val->month*1)-1]=$val->totalQuantity;
        }

        foreach($_monthlyQuantityData2 as $val){
            $monthlyQuantityData2[($val->month*1)-1]=$val->totalQuantity;
        }        


        //5 อันดับสินค้าที่มียอดการซื้อสูงสุด
        $top5AmountProduct = $this->getTop5AmountProduct("",date("Y"));  
        $Top5AmountLabel = array();      
        $Top5AmountData = array();
        
        foreach($top5AmountProduct as $i=>$val){
            $Top5AmountLabel[$i] = $val->productName;
            $Top5AmountData[$i] = $val->totalAmount;
        }

        //$Top5AmountLabel = json_encode($Top5AmountLabel,JSON_UNESCAPED_UNICODE);        
        //print_r($Top5AmountLabel);die();
        //$Top5AmountLabel = response()->json($Top5AmountLabel);
        // echo (json_encode($Top5AmountLabel));
        // echo "</br>";
        // echo (json_encode($Top5AmountData));
        // die();

        //5 อันดับสินค้าที่มีจำนวนการซื้อสูงสุด
        $top5QuantityProduct = $this->getTop5QuantityProduct("",date("Y"));        
        $top5QuantityLabel = array();      
        $top5QuantityData = array();

        foreach($top5QuantityProduct as $i=>$val){
            $top5QuantityLabel[$i] = $val->productName;
            $top5QuantityData[$i] = $val->totalQuantity;
        }
        
        // print_r($top5QuantityLabel);
        // echo "</br>";
        // print_r($top5QuantityData);
        // die();

        return view("admin.dashboard", 
                compact("totalIncome","productCount","orderCount","customerCount",
                        "monthlyAmountData1","monthlyAmountData2",
                        "monthlyQuantityData1","monthlyQuantityData2",
                        "Top5AmountLabel","Top5AmountData",
                        "top5QuantityLabel","top5QuantityData"));
    }

    //ยอดการขายทั้งหมด
    public function getTotalIncome(){
        $sql = "SELECT SUM(orderdetail.quantity*orderdetail.price) AS totalIncome 
                FROM `orders`
                INNER JOIN `orderdetail` ON orderdetail.orderID=`orders`.orderID
                INNER JOIN product ON product.productID=orderdetail.productID
                WHERE `orders`.`statusID`=2"; 
        $result = DB::select($sql)[0];

        return $result->totalIncome;
     }   
     
    //จำนวนสินค้าทั้งหมด
    public function getProductCount()
    {
        $sql = "SELECT SUM(orderdetail.quantity) AS productCount 
                FROM `orders`
                    INNER JOIN `orderdetail` ON `orders`.orderID = orderdetail.orderID
                    INNER JOIN product ON orderdetail.productID = product.productID
                WHERE `orders`.`statusID`=2";
        $result = DB::select($sql)[0];

        return $result->productCount;
    }
   
    //จำนวนรายการสั่งซื้อทั้งหมด
    public function getOrderCount()
    {
        $sql = "SELECT COUNT(*) AS orderCount  
               FROM orders
               WHERE statusID = 2";
        $result = DB::select($sql)[0];

        return $result->orderCount;               
    }


    //ยอดการขายรายเดือน
    public function getMonthlyAmountProduct($id="",$year="")
    {
        $sql = "SELECT SUBSTRING(`orders`.orderDate,6,2) AS month, 
                        SUM(orderdetail.quantity*orderdetail.price) AS totalAmount 
                FROM product 
                    INNER JOIN orderdetail ON product.productID=orderdetail.productID
                    INNER JOIN `orders` ON orderdetail.orderID=`orders`.orderID ";
            
        if($id!="" && $year!=""){
        $sql .="WHERE `orders`.`customerID`=$id AND SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }else if($id!=""){
        $sql .="WHERE `orders`.`customerID`=$id ";
        }else if($year!=""){
        $sql .="WHERE SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }

        $sql .=" GROUP BY SUBSTRING(`orders`.orderDate,6,2)
                ORDER BY SUBSTRING(`orders`.orderDate,6,2) ASC";
        
        $result = DB::select($sql);

        return $result;   
    }

    //จำนวนสินค้าที่ขายได้รายเดือน
    public function getMonthlyQuantityProduct($id="",$year="")
    {
        $sql = "SELECT SUBSTRING(`orders`.orderDate,6,2) AS month, 
                        SUM(orderdetail.quantity) AS totalQuantity 
                FROM product 
                    INNER JOIN orderdetail ON product.productID=orderdetail.productID
                    INNER JOIN `orders` ON orderdetail.orderID=`orders`.orderID ";
                
        if($id!="" && $year!=""){
        $sql .="WHERE `orders`.`customerID`=$id AND SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }else if($id!=""){
        $sql .="WHERE `orders`.`customerID`=$id ";
        }else if($year!=""){
        $sql .="WHERE SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }

        $sql .=" GROUP BY SUBSTRING(`orders`.orderDate,6,2)
                ORDER BY SUBSTRING(`orders`.orderDate,6,2) ASC";
        
        $result = DB::select($sql);

        return $result;   
    }    

    //5 อันดับสินค้าที่มียอดการซื้อสูงสุด
    public function getTop5AmountProduct($id="",$year="")
    {
        $sql = "SELECT product.productID, productName, 
                        SUM(orderdetail.quantity*orderdetail.price) AS totalAmount 
                FROM product 
                    INNER JOIN orderdetail ON product.productID=orderdetail.productID
                    INNER JOIN `orders` ON orderdetail.orderID=`orders`.orderID ";
                
        if($id!="" && $year!=""){
        $sql .="WHERE `orders`.`customerID`=$id AND SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }else if($id!=""){
        $sql .="WHERE `orders`.`customerID`=$id ";
        }else if($year!=""){
        $sql .="WHERE SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }    

        $sql .="GROUP BY product.productID, productName 
                ORDER BY SUM(orderdetail.quantity*orderdetail.price) DESC LIMIT 5";

        $result = DB::select($sql);

        return $result;   
    }    

    //5 อันดับสินค้าที่มีจำนวนการซื้อสูงสุด
    public function getTop5QuantityProduct($id="",$year="")
    {
        $sql = "SELECT product.productID, productName, 
                        SUM(orderdetail.quantity) AS totalQuantity 
                FROM product 
                    INNER JOIN orderdetail ON product.productID=orderdetail.productID
                    INNER JOIN `orders` ON orderdetail.orderID=`orders`.orderID ";

        if($id!="" && $year!=""){
        $sql .="WHERE `orders`.`customerID`=$id AND SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }else if($id!=""){
        $sql .="WHERE `orders`.`customerID`=$id ";
        }else if($year!=""){
        $sql .="WHERE SUBSTRING(`orders`.orderDate,1,4)='$year' ";
        }  

        $sql .="GROUP BY product.productID, productName 
                ORDER BY SUM(orderdetail.quantity) DESC LIMIT 5";

        $result = DB::select($sql);

        return $result;   
      }

}
