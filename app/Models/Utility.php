<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Utility extends Model
{
    public static function getShortMonth()
    {
        $months = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.",
                        "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    }

    public static function getLongMonth()
    {
        $months = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤศภาคม","มิถุนายน",
                        "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    }
    
}
