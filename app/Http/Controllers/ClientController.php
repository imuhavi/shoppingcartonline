<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Cart;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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
    // public function cart()
    // {
    //     return view('client.cart');
    // }
    public function checkout()
    {   
        

        if (Auth::check()) {
            // The user is logged in...
            return view('client.checkout');
        }
        
             return view('auth.login');
        
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
    public function filter($id){
        $categories = Category::all();
        $products = Product::where('category_id', $id)
                ->where('status', 1)
               ->orderBy('product_name')
               ->take(20)
               ->get();
        return view('client.shop', compact('categories','products'));
    }
    public function addtocart($id){
        $product = DB::table('products')
                    ->where('id', $id)
                    ->first();

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

         //dd(Session::get('cart'));
        return back();
    }
    public function update_quantity(Request $request, $id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();
    }
    public function remove_item_from_cart($id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return back();
    }
    public function cart(Request $request){
        // $data = $request->session()->all();
        // dd($data);
        if ($request->session()->exists('users')) {
            //

            dd('true');
        }
        if(!Session::has('cart')){
            return view('client.cart');
        }
        
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products'=>$cart->items]);
    }
    public function customer_orders(Request $request){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $order = new Order();
        $order->name = $request->name;
        $order->address = $request->address;
        $order->cart = serialize($cart);
        $order->save();
        Session::forget('cart');
    }
}
