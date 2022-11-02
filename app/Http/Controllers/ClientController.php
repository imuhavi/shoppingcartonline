<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ClientController extends Controller
{
    //
    public function home()
    {
        return view('client.home');
    }
    public function shop()

    {
        $categories = Category::all();
        //$products = Product::all();
        $products = Product::where('status', 1)
               ->orderBy('product_name')
               ->take(10)
               ->get();
        return view('client.shop', compact('categories','products'));
    }
    public function cart()
    {
        return view('client.cart');
    }
    public function checkout()
    {
        return view('client.checkout');
    }
    public function login()
    {
        return view('client.login');
    }
    public function activate($id)
    {
        
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->update();
        return redirect()->route('products.index');
    }
    public function deactivate($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->update();
        return redirect()->route('products.index');
    }
}
