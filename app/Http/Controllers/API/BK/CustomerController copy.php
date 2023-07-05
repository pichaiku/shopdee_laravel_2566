<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{   


    public function register(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');

        $sql = "INSERT INTO customer (username, password, firstName, lastName)
                VALUES ('$username', '$password', '$firstName', '$lastName')";

        DB::insert($sql);

        return response()->json(
                array('message'=>'ลงทะเบียนสำเร็จแล้ว',
                    'status'=>'true'));

    }
    

    public function profile($id){

        $sql = "SELECT * FROM customer WHERE custID='$id' ";
        $users=DB::select($sql);

        if($users){
            $user = (array)$users[0];
            $user['message'] = 'success';
            $user['status'] = 'true';
        }else{
            $user = array();
            $user['message'] = 'this user is not found.';
            $user['status'] = 'false';          
            // $user = array('message' => 'this user is not found.',
            //         'status'=>'false');
        }
        return response()->json($user);
        
    }

    public function login(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');

        $sql = "SELECT * FROM customer WHERE username='$username' AND 
                password = '$password' ";
        $users=DB::select($sql);

        if($users){
            $user = (array)$users[0];
            $user['message'] = 'success';
            $user['status'] = 'true';
        }else{
            $user = array();
            $user['message'] = 'this user is not found.';
            $user['status'] = 'false';          
            // $user = array('message' => 'this user is not found.',
            //         'status'=>'false');
        }
        return response()->json($user);
        
    }

    public function delete($id){
        $sql = "DELETE FROM customer 
                WHERE custID=$id";
        DB::delete($sql);

        return response()->json(
                array('message'=>'ลบข้อมูลเรียบร้อยแล้ว',
                    'status'=>'true'));        
    }

    public function profixle($id)
    {
        $sql="SELECT * FROM customer  
            WHERE custID=$id";
        $user=DB::select($sql);         

        if($user){
            $user = (array)$user[0];
            $user['message'] = 'success';
            $user['status'] = 'true';          
        }else{
            $user = array(
                'message' => 'this user is not found', 
                'status' => 'false');
        }
        
        return response()->json($user);
    }


    public function update(Request $request)
    {
        $custID = $request->get('custID');
        $username = $request->get('username');
        $password = $request->get('password');
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $email = $request->get('email');
        $gender = $request->get('gender');    
        $file = $request->file("imageFile");    

        if($password != ""){
            $sql_pass = "password='$password',";
        }else{
            $sql_pass = "";
        }
        
        if($gender != ""){
            $sql_gender = "gender='$gender',";
        }else{
            $sql_gender = "";
        }

        
        if(isset($file)){
            $file->move("assets/customer", $file->getClientOriginalName());
            $imageFile = $file->getClientOriginalName();

            $sql_image = "imageFile='$imageFile',";
        }else{            
            $sql_image = "";
        }


        $sql = "UPDATE customer set username='$username',
                firstName='$firstName',lastName='$lastName',  ";        
        $sql .= $sql_pass." ".$sql_gender." ".$sql_image;
        $sql .= "email='$email' WHERE custID='$custID' ";
        //echo $sql;
        //die();


        DB::update($sql);


        return response()->json(
                array('message'=>'update a user successfully',
                'status'=>'true'));        

    }    

}