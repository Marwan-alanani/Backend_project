<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


class SendCategory extends Controller
{
    //
    public function send(Request $request){
        $Category=$_COOKIE['Category'];
        $Main_type =$_COOKIE['Main_type'];
        return response()->json([
        "Category" => $Category,
        "Main_type" => $Main_type]);
    }
}
