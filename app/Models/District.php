<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //protected $primaryKey = null;
    //protected $primaryKey = ['user_id', 'stock_id']
    protected $table = 'district'; // Ignore automatically add "s" into table name
    public $incrementing = false; // Ignore incremental primary key
    public $timestamps = false; // Ignore automatically add create_at and update_at attribute into table
    protected $primaryKey = 'districtID'; //Ignore automatically query with id as primary key


    protected $fillable = [
        'districtID', 'districtName',
    ];

}
