<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use DB;

class AdminController extends Controller
{
    public function add_product(Request $request)
    {
        $product=new Product;
        $product->name=$request->name;
        $product->catagory=$request->catagory;
        $product->price=$request->price;
        $product->description=$request->description;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image=$imagename;
        $product->save();
        return redirect()->back()->with('message','Product Added Successfully');
    }
    public function product_add()
    {
        return view('admin.adminhome');
    }

    public function product_details()
    {
        $product=Product::All();
        return view('admin.productdetails', compact('product'));
    }
    public function product_delete($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }
    public function user_details()
    {
        $user=User::All();
        return view('admin.userdetails', compact('user'));
    }
    public function user_delete($id)
    {
        $user=user::find($id);
        $user->delete();
        return redirect()->back()->with('message','User Deleted Successfully');
    }
    public function product_update($id)
    {
        $product=product::find($id);
        return view('admin.productupdate', compact('product'));
    }
    public function update_product(Request $request, $id)
    {
        $product=product::find($id);
        $product->name=$request->name;
        $product->catagory=$request->catagory;
        $product->price=$request->price;
        $product->description=$request->description;
        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image=$imagename;   
        }
        
        
        $product->save();
         return redirect()->back()->with('message','Product Updated Successfully');
    }
    public function order_details()
    {
        $order=order::All();

        return view('admin.orders_details', compact('order') );
    }
    public function details($id)
    {
        $order=order::find($id);
        $userid=$order->user_id;
        $orderid=$id;
        $orderresult=DB::table('orders')->join('order_items','orders.id', '=','order_items.order_id')->select('orders.*', 'order_items.*')
            ->where('order_items.order_id','=',$orderid)
            ->where('order_items.user_id','=',$userid)
            ->get();
        $orderuser=order::where('user_id','=',$userid)->get()->first();
        return view('admin.orderproductdetails' , compact('orderresult','orderuser'));               
    }
    public function confirmorderstatus($id)
    {
        $orderuser=order::find($id);
        $orderuser->delivery_status='Confirmed';
        $orderuser->save();
        return redirect()->back();
    }
}
