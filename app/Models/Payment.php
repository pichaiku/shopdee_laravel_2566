<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Payment extends Model
{
    protected $table = 'payment'; // Ignore automatically add "s" into class name to be table name
    public $timestamps = false; // Ignore automatically add create_at and update_at attribute into table
    protected $primaryKey = 'paymentID'; //Ignore automatically query with id as primary key

    protected $fillable = [
        'orderID', 'paymentDate', 'price', 'comment', 'slipFile'
    ];

    public static function index($id){
        $sql = "SELECT * FROM payment 
                WHERE orderID=$id";
        return DB::select($sql);
    } 

    public static function view($id){
        $sql = "SELECT * FROM payment 
                WHERE paymentID=$id";
        $data=DB::select($sql);
        if(count($data)>0)$data=$data[0];
        return $data;
    } 
}
