<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Products = Products::get();
        $HomeTrends = [];
        $HomeFeatured = [];
        if(count($Products)!==0){
        $Names = Products::select('Product_name')->get();
        $suggestions = [];
        foreach($Names as $name){
        array_push($suggestions,$name->Product_name);
        }
        $CategoryNames = Category::select('Category')->get();
        $CategoryNames = (array) $CategoryNames;
        $CategoryNames = array_values($CategoryNames);
        $CategoryNamesArray = [];
        foreach ($CategoryNames[0] as $Category) {
            array_push($CategoryNamesArray,$Category->Category);
        }
        if(in_array('Trends',$CategoryNamesArray)){
            $TrendsId = Category::select('id')->where('Category','Trends')->first();
            $TrendsObject = Products::where('category_id',$TrendsId->id)->get();
            $TrendsArray = (array) $TrendsObject;
            $TrendsProducts = array_values($TrendsArray);
            $Trends = array_slice($TrendsProducts[0],0,3);
            foreach ($Trends as $Trend) {
                array_push($HomeTrends,$Trend);
            }
        }
        if(in_array('Featured',$CategoryNamesArray)){
            $FeaturedId = Category::select('id')->where('Category','Featured')->first();
            $Men = Products::where('Main_type','Men')->where('category_id',$FeaturedId->id)->get();
            $Men = (array) $Men;
            $Men = array_values($Men);
            $Men = array_slice($Men[0],0,8);
            $Women = Products::where('Main_type','Women')->where('category_id',$FeaturedId->id)->get();
            $Women = (array) $Women;
            $Women = array_values($Women);
            $Women = array_slice($Women[0],0,8);
            $Kids = Products::where('Main_type','Kids')->where('category_id',$FeaturedId->id)->get();
            $Kids = (array) $Kids;
            $Kids = array_values($Kids);
            $Kids = array_slice($Kids[0],0,8);
            if($Kids!==[]){
                foreach($Kids as $product){
                    array_push($HomeFeatured,$product);
              
                }
            }
            if($Men!==[]){
                foreach($Men as $product){
                    array_push($HomeFeatured,$product);
               
                }
            }
            if($Women!==[]){
                foreach($Women as $product){
                    array_push($HomeFeatured,$product);
                    
                }
            }
        }
     
            if(auth()->user()==null){
                return view('Home',compact('HomeTrends','HomeFeatured','suggestions'));
            }
            else{
                $user=auth()->user();
                $number=count($user->carts);
                return view('Home',compact('user','number','HomeTrends','HomeFeatured','suggestions'));
            }
        }
    else{
        if(auth()->user()==null){
            return view('Home');
        }
        else{
            $user=auth()->user();
            return view('Home',compact('user'));
        }
    }
}
public function GetProductNames(){
$Names = Products::select('Product_name')->get();
$response = [];
foreach($Names as $name){
    array_push($response,$name->Product_name);
}
return response()->json([
    'response'=>$response
]);
}

public function Search(Request $request){

    $pattern = $request->Searched;
    $products = Products::where('Product_name', $pattern)
    ->orWhere('Product_name', 'like', '%' . $pattern . '%')->get();
    $Names = Products::select('Product_name')->get();
    $suggestions = [];
    foreach($Names as $name){
    array_push($suggestions,$name->Product_name);
    }
    if(count($products)==0){
        if(auth()->user() == null){
            $Alert = 'Couldnt find any related products';
            return view('Home_search',compact('Alert','pattern','suggestions'));
        }
        else{
            $user=auth()->user();
            $number=count($user->carts);
            return view('Home_search',compact('Alert','pattern','suggestions','user','number'));
        }
    }
    else{
        if(auth()->user() == null){
            return view('Home_search',compact('products','pattern','suggestions'));
        }
        else{
            $user=auth()->user();
            $number=count($user->carts);
            return view('Home_search',compact('products','pattern','suggestions','user','number'));
        }
    }
}

}
