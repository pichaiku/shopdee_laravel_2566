<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subdistrict;

class SubdistrictController extends Controller
{
    public function index()
    {
        $subdistrict = Subdistrict::all(); 
        return response()->json($subdistrict);
    }
}