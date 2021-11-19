<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function View() {
        $categories = Category::get();
        $products = Products::get();
        $users = User::get();
        $NoProducts = count($products);
        $NoCategories = count($categories);
        $NoUsers = count($users);
        return view('Dashboard',compact('NoProducts','NoCategories','NoUsers'));
    }
}
