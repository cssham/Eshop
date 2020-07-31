<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::find($request->product_id);
        Cart::add(array(
            'id' => $product->id, // inique row ID
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->product_quantity,
            'attributes' => [
                'product_image' => $product->image,
            ]
        ));
        return redirect()->route('frontend.products_show',$product->category_id);

    }
    public function cartProductRemove($id){
        Cart::remove($id);
        return redirect()->back();
    }
    public function cartProductUpdate(Request $request)
    {
        Cart::update($request->product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->product_quantity
            ),
        ));
        return redirect()->back();
    }
}
