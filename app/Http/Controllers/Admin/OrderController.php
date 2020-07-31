<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use App\Shipping;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.index',compact('orders'));
    }
    public function details($id)
    {
        $order = Order::find($id);
        $shipping = Shipping::find($order->shipping_id);
        $orderProducts =OrderDetails::where('order_id',$id)->get();
        return view('admin.order.details',compact('order','shipping','orderProducts'));
    }
    public function invoice($id){

        $order = Order::find($id);
        $shipping = Shipping::find($order->shipping_id);
        $orderProducts = OrderDetails::where('order_id', $id)->get();
        return view('admin.order.invoice', compact('order', 'shipping', 'orderProducts'));
    }
    public function invoiceDownload($id)
    {
        $order = Order::find($id);
        $shipping = Shipping::find($order->shipping_id);
        $orderProducts = OrderDetails::where('order_id', $id)->get();
        $pdf = PDF::loadView('admin.order.invoice_download',compact('order', 'shipping', 'orderProducts'));
        return $pdf->download($order->customer->first_name . ' ' . $order->customer->last_name.'-'.$order->id);
    }
}
