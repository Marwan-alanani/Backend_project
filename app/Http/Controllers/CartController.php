<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function AddToCart(){      
            $id = $_POST['id'];
            $Product=Products::find($id);
            Cart::create([
                'user_id'=>auth()->user()->id,
                'Product_id'=>$Product->id
            ]);
            $Carts = Cart::where('user_id',auth()->user()->id)->get();
            $Number = count($Carts);
            return response()->json([
                'response'=>$Number
            ]);
    }
    public function ViewCart(){
        $Cart = Cart::where('user_id',auth()->user()->id)->get();
        $Total = 0;
        foreach($Cart as $item){
            $Total += $item->product->Price;
        }
        return view('Cart',compact('Cart','Total'));
    }
    public function delete($id){
        $Cart = Cart::find($id);
        $Cart->delete();
        return redirect()->route('ViewCart');
    }
}