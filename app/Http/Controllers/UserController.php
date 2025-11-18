<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Drink;
use App\Models\FoodCart;
use App\Models\DrinkCart;
use App\Models\Orders;
use App\Models\Orderss;
use App\Models\BookTable;

class UserController extends Controller
{
    public function index(){
        $foods = Food::all();
        $drinks = Drink::all();
        return view('home', compact('foods', 'drinks'));
    }

    public function addToCart(Request $request){
        if(Auth::check()){
            $food = Food::findOrFail($request->food_id);

            $cart = new FoodCart();
            $cart->userID = Auth::id();
            $cart->food_id = $food->id;
            $cart->food_name = $food->food_name;
            $cart->food_details = $food->food_details;
            $cart->food_image = $food->food_image;
            $cart->food_quantity = $request->quantity;
            $price = $cart->food_quantity * $food->food_price;
            $cart->food_price = $price;
            $cart->status = 'active';

            $cart->save();
            return redirect()->back()->with('cart_message', 'Food added to cart successfully');
        } else {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }
    }

    public function addToCart1(Request $request){
        if(Auth::check()){
            $drink = Drink::findOrFail($request->drink_id);

            $cart = new DrinkCart();
            $cart->userID = Auth::id();
            $cart->drink_id = $drink->id;
            $cart->drink_name = $drink->drink_name;
            $cart->drink_details = $drink->drink_details;
            $cart->drink_image = $drink->drink_image;
            $cart->drink_quantity = $request->quantity;
            $price = $cart->drink_quantity * $drink->drink_price;
            $cart->drink_price = $price;
            $cart->status = 'active';

            $cart->save();
            return redirect()->back()->with('cart_message', 'Drink added to cart successfully');
        } else {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }
    }

    public function foodCart(){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart');
        }
        
        $current_auth = Auth::id();
        $cart_food_info = FoodCart::where('userID', '=', $current_auth)->get();
        return view('show_cart', compact('cart_food_info'));   
    }

    public function drinkCart(){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart');
        }
        
        $current_auth = Auth::id();
        $cart_drink_info = DrinkCart::where('userID', '=', $current_auth)->get();
        return view('show_cart1', compact('cart_drink_info'));   
    }

    public function removeCart($id){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to manage your cart');
        }
        
        $remove_food = FoodCart::findOrFail($id);
        
        // Check if the item belongs to the current user
        if($remove_food->userID != Auth::id()) {
            return redirect()->back()->with('danger', 'Unauthorized action');
        }
        
        if($remove_food->status == 'active') {
            $remove_food->delete();
            return redirect()->back()->with('success', 'Item removed from cart successfully');
        } else {
            return redirect()->back()->with('danger', 'Cannot remove confirmed order');
        }
    }

    public function removeCart1($id){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to manage your cart');
        }
        
        $remove_drink = DrinkCart::findOrFail($id);
        
        // Check if the item belongs to the current user
        if($remove_drink->userID != Auth::id()) {
            return redirect()->back()->with('danger', 'Unauthorized action');
        }
        
        if($remove_drink->status == 'active') {
            $remove_drink->delete();
            return redirect()->back()->with('success', 'Item removed from cart successfully');
        } else {
            return redirect()->back()->with('danger', 'Cannot remove confirmed order');
        }
    }

    public function confirmOrderCart(Request $request){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to confirm orders');
        }
        
        $current_user = Auth::id();
        $cart_food = FoodCart::where('userID', '=', $current_user)
                            ->where('status', 'active')
                            ->get();
        
        if($cart_food->count() == 0) {
            return redirect()->back()->with('danger', 'No active items to confirm');
        }

        foreach($cart_food as $cart_foods){
            $single_order = new Orders();
            $single_order->customer_id = Auth::user()->id;
            $single_order->customer_name = Auth::user()->name;
            $single_order->customer_email = Auth::user()->email;
            $single_order->customer_Address = Auth::user()->address;
            $single_order->customer_phone = Auth::user()->phone;
            $single_order->food_name = $cart_foods->food_name;
            $single_order->food_image = $cart_foods->food_image;
            $single_order->food_quantity = $cart_foods->food_quantity; 
            $single_order->food_price = $cart_foods->food_price;
            $single_order->save();

            $cart_foods->status = 'confirmed';
            $cart_foods->save();
        }
        return redirect()->back()->with('confirm_order', 'Food Order Confirmed Successfully!');
    }

    public function confirmOrderCart1(Request $request){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to confirm orders');
        }
        
        $current_user = Auth::id();
        $cart_drink = DrinkCart::where('userID', '=', $current_user)
                              ->where('status', 'active')
                              ->get();
        
        if($cart_drink->count() == 0) {
            return redirect()->back()->with('danger', 'No active items to confirm');
        }

        foreach($cart_drink as $cart_drinks){
            $single_order = new Orderss();
            $single_order->customer_id = Auth::user()->id;
            $single_order->customer_name = Auth::user()->name;
            $single_order->customer_email = Auth::user()->email;
            $single_order->customer_Address = Auth::user()->address;
            $single_order->customer_phone = Auth::user()->phone;
            $single_order->drink_name = $cart_drinks->drink_name;
            $single_order->drink_image = $cart_drinks->drink_image;
            $single_order->drink_quantity = $cart_drinks->drink_quantity; 
            $single_order->drink_price = $cart_drinks->drink_price;
            $single_order->save();

            $cart_drinks->status = 'confirmed';
            $cart_drinks->save();
        }
        return redirect()->back()->with('confirm_order', 'Drink Order Confirmed Successfully!');
    }

    public function gofile(){
        return view('admin.adminfile');
    }

    public function home(){
        if(Auth::id() && Auth::user()->usertype == 'admin'){
            return view('admin.dashboard');
        } else if(Auth::id() && Auth::user()->usertype == 'user'){
            return view('dashboard');     
        } else {
            return redirect()->route('login');
        }
    }

    public function findATable(Request $request){
        $book = new BookTable();
        $book->Email = $request->email;
        $book->number_of_guests = $request->number_of_guests;
        $book->time = $request->time;
        $book->date = $request->date;
        $book->save();
        return redirect()->back()->with('booktable', 'Book table request sent successfully');
    }

    public function orderStatus(){
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view order status');
        }
        
        $current_auth = Auth::id(); 
        $my_order = Orders::where('customer_id', '=', $current_auth)->get(); 
        return view('order_status', compact('my_order'));  
    }

    public function orderStatus1(){ 
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view order status');
        }
        
        $current_auth = Auth::id(); 
        $my_orders = Orderss::where('customer_id', '=', $current_auth)->get(); 
        return view('order_status1', compact('my_orders'));  
    }
}