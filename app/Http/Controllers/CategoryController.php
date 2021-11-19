<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use ArrayObject;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('Categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category_create');
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
        $request->validate([
            'Category' => 'required|unique:categories,Category',
        ]);
        $Category = $request->Category;
        $parent_dir = 'Images/'.$Category;
        mkdir(public_path($parent_dir));
        mkdir(public_path($parent_dir.'/Men'));
        mkdir(public_path($parent_dir.'/Women'));
        mkdir(public_path($parent_dir.'/Kids'));

        Category::create([
            'Category'=> $Category,
            'directory_path' => $parent_dir
        ]);
        return redirect()->route('categories.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $products = $category->products;
            if($products->count() == 0){
                $notify = 'No related products';
                return view('Related_products',compact('notify'));
            }
            else{
                return view('Related_products',compact('products'));
            }

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
        $Category = Category::where('id',$id)->first();
        return view('category_edit',compact('Category'));
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
        $Category = Category::find($id);
        $relative = explode($Category->Category,$Category->directory_path);
        $newRelativeDirectoryPath = $relative[0].$request->Category;
        $dir = public_path($Category->directory_path);
        $Dir = glob($dir);
        $DirectoryPath = explode($Category->Category,$Dir[0]);
        $newDirectoryPath = $DirectoryPath[0]. $request->Category;
        $products = Products::where('category_id',$id)->get();
        foreach($products as $product){
            $path = explode('/',$product->absolute_path);
            $newpath = $path[0].'/'.$request->Category.'/'.$path[2];
            $newrelativepath = 'Images'.'/'.$request->Category.'/'.$path[2];
            $product->update([
                'absolute_path'=>$newpath,
                'relative_path'=>$newrelativepath
            ]);
        }
        rename($Dir[0],$newDirectoryPath);
        $Category->update([
            'Category'=>$request->Category,
           'directory_path'=> $newRelativeDirectoryPath,
        ]);
        return redirect()->route('categories.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::find($id);
        $products = Products::where('category_id',$id)->get();
        // dd($products);
        $Dir= $Category->directory_path;
        $dir = public_path($Dir);
        $files = glob($dir.'/*');
        $kidpics = glob($files[0].'/*');
        $menpics =  glob($files[1].'/*');
        $womenpics = glob($files[2].'/*');
        if(count($menpics) !== 0){
            foreach($menpics as $pic){
                unlink($pic);
            }
        }
        if(count($womenpics) !== 0){
            foreach($womenpics as $pic){
                unlink($pic);
            }
        }
        if(count($kidpics) !== 0){
            foreach($kidpics as $pic){
                unlink($pic);
            }
        }
        foreach($files as $file){
            rmdir($file);
        }
        rmdir($dir);
        foreach($products as $product){
            $product->delete();
        }
        $Category->delete();
        return redirect()->route('categories.view');
    }

}
