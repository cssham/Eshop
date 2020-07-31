<?php

namespace App\Http\Controllers;

use App\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailToCustomer;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;
class CheckoutController extends Controller
{
    public function checkout(){
        return view('frontend.checkout.checkout_form');
    }
    public function customerSign(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'email' =>'required|email|unique:customers,email',
            'phone' => 'required',
            'password' =>'required',
            'address' => 'required',
        ]);
        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->save();
        //Mail::to($customer->email)->send(new SendMailToCustomer($customer));
        Session::put(['customer_id'=>$customer->id]);
        Session::put(['customer_full_name' => $customer->first_name.' '.$customer->last_name]);
        Toastr::success('Customer sign up done successfully !','Success');
        return redirect()->route('product.shipping');
    }
    public function productShipping(){
        $customer = Customer::find(Session::get('customer_id'));
        return view('frontend.checkout.shipping_form',compact('customer'));
    }
    public function saveShipping(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=> 'required',
        ]);
        $shipping = new Shipping();
        $shipping->name =$request->name;
        $shipping->email =$request->email;
        $shipping->phone =$request->phone;
        $shipping->address =$request->address;
        $shipping->save();
        Session::put(['shipping_id' => $shipping->id]);
        Toastr::success('Shipping request saved successfully,Now make payment for your product','Success');
        return redirect()->route('checkout.payment');
    }
    public function checkoutPayment(){
        return view('frontend.checkout.payment_form');
    }
    public function orderSave( Request $request){
        if($request->payment_type == 'Cash'){
            $order = new Order();
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = Session::get('shipping_id');
            $order->total_price = Session::get('totalPrice');
            $order->payment_type = $request->payment_type;
            $order->save();

             $cartContents = Cart::getContent();

            foreach ($cartContents as $key => $cartContent) {
             $orderDetails = new OrderDetails();
             $orderDetails->order_id = $order->id;
             $orderDetails->product_id= $cartContent->id;
             $orderDetails->product_name= $cartContent->name;
             $orderDetails->product_image= $cartContent->attributes->product_image;
             $orderDetails->product_price= $cartContent->price;
             $orderDetails->product_quantity= $cartContent->quantity;
             $orderDetails->save();
            }
            Cart::clear();
            return redirect()->route('frontend.index');
        }
        elseif($request->payment_type == 'Rocket'){

        }
        elseif($request->payment_type == 'Bkash'){

        }
    }
    public function customerLogin(Request $request){
        $customer = Customer::where('email', $request->email)->first();
        if(Customer::where('email',$request->email)->first()){

            if(password_verify($request->password,$customer->password)){
                Session::put(['customer_id' => $customer->id]);
                Session::put(['customer_full_name' => $customer->first_name . ' ' . $customer->last_name]);
                return redirect()->route('product.shipping');
            }
            else{
                return redirect()->back()->with('wrong_info', 'Your Password is Invalid!');
            }
        }
        else{
            return redirect()->back()->with('wrong_info','Your Email Address is Invalid!');
        }
    }
    public function customerLogout(){
        session()->forget(['customer_id', 'customer_full_name', 'shipping_id']);
        return redirect()->route('frontend.index');
    }
}
