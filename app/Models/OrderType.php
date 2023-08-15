<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $primaryKey = "orderID";
    public $timestamps = false;

    protected $fillable = ['custID', 'orderDate', 'shipDate', 'receiveDate', 'statusID'];

}
