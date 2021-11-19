<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

function CategorySender($category){
    return $category;
};
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Role = auth()->user()->Role;
        $products = Products::get();
        return view('product',compact('products','Role'));
    }
    public function indexType($Main_type){
        $products = Products::where('Main_type',$Main_type)->get();
        $Role = auth()->user()->Role;
        return view('product',compact('products','Role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        return view('product_create',compact('categories'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->file('image_path') == null){
            $categories=Category::get();
            $Error = "Must enter Image";
          return view('product_create',compact('Error','categories'));
        }
        else{
        $FullType = $request->file('image_path')->getMimeType();
        $Type = explode('/',$FullType);
        if($Type[0]!=='image'){
            $categories=Category::get();
            $Error = "Only images can be uploaded";
            return view('product_create',compact('Error','categories'));
        };
    };

        $request->validate([
            'Product_name' => 'required',
            'Price' => 'required|integer',
            'category' => 'required',
            'image_path' => 'required|mimes:jpg,png,jpeg',
            'Main_type' => 'required'
        ]);
        //
        $originalpath = realpath($_FILES["image_path"]["tmp_name"]);
        $path = ' ';
        $extension = $request->file('image_path')->getClientOriginalExtension();
        $Category=$request->category;
        $Dir=Category::select('directory_path')->where('Category','=',$Category)->first()->directory_path;
        $dir = public_path($Dir);
        $files = glob($dir.'/*');
        $Main_type=$request->Main_type;
        $Name = time().'-'.$request->Product_name.'.'.$extension;
        $name = addslashes("'$Name");
        $Array = explode("'",$name);
        $Name = $Array[0] . $Array[1];
        if($Main_type == "Men"){
                $path =  $files[1] . $Name;
        }
        if($Main_type == "Women"){
            $path =  $files[2] . $Name;
        };
        if($Main_type == "Kids"){
            $path =  $files[0] . $Name;
        };
        copy($originalpath, $path);
        $Array = explode("Images",$path);
        $relativePath = str_replace('\\', '/', $Array[1]);
        $relative_path = 'Images' .  $relativePath;

        $category_id= Category::select('id')->where('Category','=',$Category)->first();
        Products::create([
            'Product_name' => $request->Product_name,
            'absolute_path' =>$path,
            'relative_path' => $relative_path,
            'Price' => $request->Price,
            'Main_type' => $Main_type,
            'category_id' => $category_id->id
        ]);
        return redirect()->route('products.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        return view('product_view',compact('product'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $categories=Category::get();
        return view('product_edit',compact('categories','product'));
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Product_name' => 'required',
            'Price' => 'required|integer',
            'category' => 'required',
            'Main_type' => 'required'
        ]);
        if($request->file('image_path')==null){
        $product = Products::find($id);
        $category=$request->category;
        $Category= Category::where('Category','=',$category)->first();
        if($product->category->Category !== $category){
            if($request->Main_type == $product->Main_type){
                $Array = explode($request->Main_type,$product->absolute_path,2);
                $Name = str_replace('\\', '/', $Array[1]);
                $newpath = public_path($Category->directory_path.'/'.$request->Main_type.$Name);
                rename($product->absolute_path,$newpath);
                $product->update([
                    "Product_name" => $request->Product_name,
                    "Price" => $request->Price,
                    "relative_path" =>$product->relative_path,
                    "absolute_path" =>$newpath,
                    "Main_type" => $request->Main_type,
                    "category_id" => $Category->id
                ]);
                return redirect()->route('products.view');
            }
            else{

                $Array = explode('/',$product->absolute_path,3);
                $newpath = public_path($Category->directory_path.'/'.$Array[2]);
                rename($product->absolute_path,$newpath);
                $product->update([
                    "Product_name" => $request->Product_name,
                    "Price" => $request->Price,
                    "relative_path" =>$product->relative_path,
                    "absolute_path" =>$newpath,
                    "Main_type" => $request->Main_type,
                    "category_id" => $Category->id
                ]);
                return redirect()->route('products.view');
            }
        };
    }
        else{
        $FullType = $request->file('image_path')->getMimeType();
        $Type = explode('/',$FullType);
        if($Type[0]!=='image'){
            $product = Products::find($id);
            $categories=Category::get();
            $Error = "Only images can be uploaded";
            return view('product_edit',compact('Error','product','categories'));
        };
        if($Type[0]=='image'){
            $request->validate([
                'image_path' => 'required|mimes:png,jpg,jpeg'
            ]);
            $product = Products::find($id);
            $deleted = $product->absolute_path;
            $originalpath = realpath($_FILES["image_path"]["tmp_name"]);
            $path = ' ';
            $extension = $request->file('image_path')->getClientOriginalExtension();
            $Category=$request->category;
            $Dir=Category::select('directory_path')->where('Category','=',$Category)->first()->directory_path;
            $dir = public_path($Dir);
            $files = glob($dir.'/*');
            $Main_type=$request->Main_type;
            $Name = time().'-'.$request->Product_name.'.'.$extension;
            $name = addslashes("'$Name");
            $Array = explode("'",$name);
            $Name = $Array[0] . $Array[1];
            if($Main_type == "Men"){
                $path =  $files[1] . $Name;
            };
            if($Main_type == "Women"){
            $path =  $files[2] . $Name;
            };
            if($Main_type == "Kids"){
            $path =  $files[0] . $Name;
            };
        copy($originalpath, $path);
        unlink($deleted);
        $Array = explode("Images",$path);
        $relativePath = str_replace('\\', '/', $Array[1]);
        $relative_path = 'Images' .  $relativePath;
        $category_id= Category::select('id')->where('Category','=',$Category)->first();
         $product->update([
            'Product_name' => $request->Product_name,
            'absolute_path' =>$path,
            'relative_path' =>$relative_path,
            'Price' => $request->Price,
            'Main_type' => $Main_type,
            'category_id' => $category_id->id
         ]);
         return redirect()->route('products.view');
        }
        // end of update
    }

}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
    {
        $product=Products::find($id);
        $deleted = $product->absolute_path;
        unlink($deleted);
        $product->delete();
        return redirect(route('products.view'));
        //
    }
}
