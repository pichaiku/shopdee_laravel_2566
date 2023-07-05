<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use DB;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        //payment
        $this->validate($request, [
            'file' => 'image' //works for jpeg, png, bmp, gif, or svg
        ]);

        $file = $request->file('slipFile');        
        if(isset($file)){
            $slipFile = time().$file->getClientOriginalName();
            $file->move('assets/payment', $slipFile);            
        }else{
            $slipFile = "";
        }
        $orderID = $request->get('orderID');
        $paymentDate = date("Y-m-d H:i:s");
        $price = $request->get('price');

        $sql = "INSERT INTO payment(orderID,paymentDate,price,slipFile) 
                VALUES($orderID, '$paymentDate',$price,'$slipFile')";
        DB::insert($sql);

        //update payment status
        $sql = "UPDATE orders SET statusID = 2 WHERE orderID = $orderID ";
        DB::update($sql);        

        return response()->json(array(
            'message' => 'success', 
            'status' => 'true'));
    }

    // public function index(Request $request)
    // {
    //     $orderID = $request->get('orderID');        
    //     $payment = Payment::index($orderID);
    //     return response()->json($payment);
    // }

    // public function view($id)
    // {
    //     $payment = Payment::view($id);
    //     return response()->json($payment);
    // }

    // public function create(Request $request)
    // {
    //     //payment
    //     $this->validate($request, [
    //         'file' => 'image' //works for jpeg, png, bmp, gif, or svg
    //     ]);

    //     $file = $request->file('slipFile');        
    //     if(isset($file)){
    //         $slipFile = time().$file->getClientOriginalName();
    //         $file->move('assets/payment', $slipFile);            
    //     }else{
    //         $slipFile = "";
    //     }
    //     $orderID = $request->get('orderID');
    //     $paymentDate = date("Y-m-d H:i:s");
    //     $price = $request->get('price');

    //     $payment=new Payment();
    //     $payment->orderID=$orderID;
    //     $payment->paymentDate=$paymentDate;
    //     $payment->price=$price;
    //     //$payment->comment='';
    //     if(!empty($slipFile)) $payment->slipFile=$slipFile;

    //     $payment->save();

    //     //update payment status
    //     $order = Order::find($orderID);
    //     $order->statusID = 2;
    //     $order->save();

    //     return response()->json(array(
    //         'message' => 'success', 
    //         'status' => 'true'));
    // }

    // public function update(Request $request, $id)
    // {       
    //     $paymentDate = $request->get('paymentDate');
    //     $price = $request->get('price');
    //     $comment = $request->get('comment');
    //     $slipFile = $request->get('slipFile');
        
    //     $payment = Payment::find($id);
    //     if($paymentDate!="") $payment->paymentDate=$paymentDate;
    //     if($price!="") $payment->price=$price;
    //     if($comment!="") $payment->comment=$comment;
    //     if($slipFile!="") $payment->slipFile=$slipFile;

    //     $payment->save();

    //     return response()->json(array(
    //         'message' => 'success', 
    //         'status' => 'true'));
    // }
}