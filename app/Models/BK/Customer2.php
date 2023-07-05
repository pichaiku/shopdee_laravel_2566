<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{

    protected $table = 'customer'; 
    protected $primaryKey = 'customerID'; 
    public $timestamps = false; 


    protected $fillable = [
        'firstName', 'lastName', 'address', 'subdistrictID', 'zipcode', 'mobilePhone', 'homePhone', 'birthdate', 'gender', 'email', 'username', 'password', 'imagefile', 'isActive'
    ];

    public static function index($query="")
    {
        if($query==""){
            $sql="SELECT * FROM customer 
                  INNER JOIN subdistrict ON customer.subdistrictID=subdistrict.subdistrictID 
                  INNER JOIN district ON subdistrict.districtID=district.districtID 
                  INNER JOIN province ON district.provinceID=province.provinceID 
                  ORDER BY customer.customerID ASC ";
         }else{
            $sql="SELECT * FROM customer 
                  INNER JOIN subdistrict ON customer.subdistrictID=subdistrict.subdistrictID 
                  INNER JOIN district ON subdistrict.districtID=district.districtID 
                  INNER JOIN province ON district.provinceID=province.provinceID 
                  WHERE customer.firstName LIKE '%$query%' OR 
                        customer.lastName LIKE '%$query%' OR 
                        province.provinceName LIKE '%$query%' OR 
                        district.districtName LIKE '%$query%' OR 
                        subdistrict.subdistrictName LIKE '%$query%' 
                  ORDER BY customer.customerID ASC ";
         }
        return DB::select($sql);
    }

    public function count($query="")
    {
       $sql="SELECT COUNT(*) AS count FROM customer 
             INNER JOIN subdistrict ON customer.subdistrictID=subdistrict.subdistrictID 
             INNER JOIN district ON subdistrict.districtID=district.districtID 
             INNER JOIN province ON district.provinceID=province.provinceID ";

       if($query!=""){
          $sql.="WHERE customer.firstName LIKE '%$query%' OR 
                         customer.lastName LIKE '%$query%' OR 
                         province.provinceName LIKE '%$query%' OR 
                         district.districtName LIKE '%$query%' OR 
                         subdistrict.subdistrictName LIKE '%$query%' ";
       }
       
       return DB::select($sql)[0]->count;
    }

    public static function view($id)
    {
        $sql="SELECT * FROM customer 
               INNER JOIN subdistrict ON customer.subdistrictID=subdistrict.subdistrictID 
               INNER JOIN district ON subdistrict.districtID=district.districtID 
               INNER JOIN province ON district.provinceID=province.provinceID 
               WHERE customer.customerID=$id";
         $data=DB::select($sql);
         if(count($data)>0)$data=$data[0];
         return $data;
    }

    
    public static function validateUser($username,$password)
    {
        return DB::table('customer')
                ->select('*')
                ->where('username', $username)
                ->Where('password', $password)
                ->first();
    }
    
}
