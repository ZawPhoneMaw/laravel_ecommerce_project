<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use DB;

class HomeController extends Controller
{

    public function redirect()
    {
        $usertype=Auth::user()->usertype;
        if (!empty(Auth::user()) && $usertype == '1')
        {
            return view('admin.adminhome');
        }
        else
        {
            $product=Product::All();
            return view('home.userhome', compact('product'));
        }

    }


    public function index ()
    {
                    $product=Product::All();
            return view('home.userhome', compact('product'));
    }
    public function addtocart(Request $request, $id)
    {
            $user=Auth::user();
            $userid=$user->id;
            $product=product::find($id);
            $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            if($product_exist_id)
            {
                $cart=Cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;
                $quantity_price=$cart->quantity_price;
                $cart->quantity_price= $cart->price * $cart->quantity;
                $cart->save();
              return redirect()->back()->with('message','Added to Cart Successfully');   
            }
            else
            {
            $cart =new Cart;
            $cart->user_name=$user->name;
            $cart->email=$user->email;
            $cart->address=$user->address;
            $cart->phone=$user->phone;
            $cart->product_name=$product->name;
            $cart->price=$product->price;
            $cart->quantity=$request->quantity;
            $cart->image=$product->image;
            $cart->quantity_price= $product->price * $request->quantity;
            $cart->user_id=$user->id;
            $cart->product_id=$product->id;
            $cart->save();

            return redirect()->back()->with('message','Added to Cart Successfully');    
            }
            
    }
    public function cartdetails()
    {

        $id=Auth::user()->id;
        $cart=Cart::where('user_id','=',$id)->get();
        $user=Auth::user();
        return view('home.details_cart', compact('cart', 'user'));
    }
    public function userinfoupdate(Request $request)
    {
        $id=Auth::user()->id;
        $cart=Cart::where('user_id','=',$id)->get()->first();
         $cart->address=$request->address;
        $cart->phone=$request->phone;
        $cart->save();
        $user=user::where('id','=',$id)->get()->first();
        $user->address=$request->address;
        $user->phone=$request->phone;
        $user->save();

        return redirect()->back()->with('message','Updated User Information Successfully');    
    }
    public function cart_delete($id)
    {
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message','Deleted Products from cart Successfully');    

    }
    public function orderconfirm(Request $request)
    {
        $order=new order;
      
        $user=Auth::user();
        
        $order->user_name=$user->name;
        $order->email=$user->email;
        $order->address=$user->address;
        $order->phone=$user->phone;
        $order->total_quantity =$request->totalquantity;
        $order->totall_price=$request->totalprice;
        $order->delivery_status="processing";
        $order->user_id=$user->id;
        $order->save();
        
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        $id=$order->id;
        foreach($data as $data)
        {
        
        $orderitem=new OrderItem;
        $orderitem->product_name=$data->product_name;
        $orderitem->price=$data->price;
        $orderitem->quantity=$data->quantity;
        $orderitem->image=$data->image;
        $orderitem->quantity_price =$data->quantity_price;
        $orderitem->user_id=$data->user_id;
        $orderitem->product_id=$data->product_id;
        $orderitem->order_id=$id;
         $orderitem->save();

         $cart_id=$data->id;
         $cart=cart::find($cart_id);
         $cart->delete();
        }

        return redirect()->back()->with('message','Order Confirm Successfully');
    }
    public function userorders()
    {
        $user=Auth::user();
        $userid=$user->id;
        $order=order::find($userid);
        $orderresult=DB::table('orders')->join('order_items','orders.user_id', '=','order_items.user_id')->select('orders.*', 'order_items.*')
            ->where('order_items.user_id','=',$userid)
            ->get();
        $orderuser=order::where('user_id','=',$userid)->get();
        return view('home.userorderdetails' , compact('orderresult','orderuser'));     
    }
    public function detailstatus($id)
    {
        $details=orderitem::where('order_id','=',$id)->get();
        return view('home.detailsorder', compact('details'));

    }

}
