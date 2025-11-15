<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Drink;
use App\Models\Orders;
use App\Models\Orderss;
use App\Models\BookTable;
class AdminController extends Controller
{
    public function addFood(){
        return view('admin.addfood');
    }

    public function addDrink(){
        return view('admin.adddrink');
    }

    public function postAddfood(Request $request){
        $food = new Food();

        $food->food_name = $request->food_name;

        $food->food_details = $request->food_details;

        $food->food_image = $request->food_image;

        if($image=$request->food_image){
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $food->food_image = $imagename;
        }

        $food->food_price = $request->food_price;

        $food->save();

        if($image=$request->food_image && $food->save()){
            $request->food_image->move('food_img',$imagename);
        }

        return redirect()->back()->with('success','Food Item Added Successfully!');
        
    }

    public function postAdddrink(Request $request){
        $drink = new Drink();

        $drink->drink_name = $request->drink_name;

        $drink->drink_details = $request->drink_details;

        $drink->drink_image = $request->drink_image;

        if($image=$request->drink_image){
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $drink->drink_image = $imagename;
        }

        $drink->drink_price = $request->drink_price;

        $drink->save();

        if($image=$request->drink_image && $drink->save()){
            $request->drink_image->move('drink_img',$imagename);
        }

        return redirect()->back()->with('success','Drink Item Added Successfully!');
        
    }

    public function showFood(){
        $foods=Food::all();
        return view('admin.showfood',compact('foods' ));
    } 

    public function showDrink(){
        $drinks=Drink::all();
        return view('admin.showdrink',compact('drinks' ));
    }

    public function deleteFood($id){
        $food=Food::findOrFail($id);
        $food->delete();
        return redirect()->back()->with('danger','Food Item Deleted Successfully!');
    }

    public function deleteDrink($id){
        $drink=Drink::findOrFail($id);
        $drink->delete();
        return redirect()->back()->with('danger','Drink Item Deleted Successfully!');
    }

    public function updateFood($id){
        $food=Food::findOrFail($id);
        return view('admin.updatefood',compact('food'));
    }

    public function updateDrink($id){
        $drink=Drink::findOrFail($id);
        return view('admin.updatedrink',compact('drink'));
    }

    public function postUpdatefood(Request $request, $id){
        $food=Food::findOrFail($id);

        $food->food_name = $request->food_name;

        $food->food_details = $request->food_details;

        $food->food_image = $request->food_image;

        if($image=$request->food_image){
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $food->food_image = $imagename;
        }

        $food->food_price = $request->food_price;

        $food->save();

        if($image=$request->food_image && $food->save()){
            $request->food_image->move('food_img',$imagename);
        }

        return redirect()->back()->with('update','Food Item Updated Successfully!');
    }

    public function postUpdatedrink(Request $request, $id){
        $drink=Drink::findOrFail($id);

        $drink->drink_name = $request->drink_name;

        $drink->drink_details = $request->drink_details;

        $drink->drink_image = $request->drink_image;

        if($image=$request->drink_image){
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $drink->drink_image = $imagename;
        }

        $drink->drink_price = $request->drink_price;

        $drink->save();

        if($image=$request->drink_image && $drink->save()){
            $request->drink_image->move('drink_img',$imagename);
        }

        return redirect()->back()->with('update','drink Item Updated Successfully!');
    }

    public function viewOrders(){

        $orders=Orders::all();
        return view('admin.vieworders',compact('orders'));
    }

    public function viewOrderss(){

        $orderss=Orderss::all();
        return view('admin.vieworderss',compact('orderss'));
    }

    public function foodStatusDelivered($id){
        $order=Orders::findOrFail($id);

        $order->order_status="Confirm";
        $order->save();
        return redirect()->back();
    }

    public function drinkStatusDelivered($id){
        $order=Orderss::findOrFail($id);

        $order->order_status="Confirm";
        $order->save();
        return redirect()->back();
    }

    public function foodStatusCancel($id){
        $order=Orders::findOrFail($id);

        $order->order_status="Cancel";
        $order->save();
        return redirect()->back();
    }

    public function drinkStatusCancel($id){
        $order=Orderss::findOrFail($id);

        $order->order_status="Cancel";
        $order->save();
        return redirect()->back();
    }

    public function viewBookedTable(){
        $booked_tables=BookTable::all();
        return view ('admin.showbookedtable',compact('booked_tables'));
    }

}