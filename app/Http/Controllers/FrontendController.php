<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $latestProducts = Product::where('status',1)->latest()->take(8)->get();
        $allProducts = Product::where('status',1)->latest()->get();
        $categories = Category::where('status',1)->get();
        return view('frontend.index',compact('latestProducts','allProducts','categories'));
    }
    public function productDetails($id){
        $product = Product::find($id);
        $relatedProducts = Product::where('category_id',$product->category_id)->where('status',1)->where('id','!=',$id)->get();
        return view('frontend.product_details',compact('product','relatedProducts'));
    }
    public function shop(){
        $categories = Category::where('status',1)->get();
        $allProducts = Product::where('status',1)->latest()->paginate(12);
        return view('frontend.shop',compact('allProducts','categories'));
    }
    public function showProductsByCategory($id){
        $categories = Category::where('status', 1)->get();
        $allProducts = Product::where('status', 1)->where('category_id',$id)->paginate(12);
        return view('frontend.shop', compact('allProducts', 'categories'));
    }
}
