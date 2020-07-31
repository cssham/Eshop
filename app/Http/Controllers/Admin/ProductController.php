<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $softDeleteProducts = Product::onlyTrashed()->get();
        return view('admin.product.index',compact('products', 'softDeleteProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'price'=>'required',
            'image'=>'mimes:jpeg,jpg,png,gif',
        ]);
        $image = $request->file('image');
        $slug=Str::slug($request->name);
        if(isset($image)){
            $currentDate=Carbon::now()->toDateString();
            $imageName=$slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('public/storage/product/')){
                mkdir('public/storage/product/',0777,true);
            }
            $productImage = Image::make($image)->resize(300,300);
            $productImage->save('public/storage/product/'.$imageName);
        }
        else{
            $imageName ='default.png';
        }
        $product = new Product();
        $product->name= $request->name;
        $product->category_id= $request->category;
        $product->short_description =$request->short_description;
        $product->long_description=$request->long_description;
        $product->price=$request->price;
        $product->image=$imageName;
        if (isset($request->status)) {
            $product->status = true;
        } else {
            $product->status = false;
        }
        $product->save();
        Toastr::success('Product added successfully','Success');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.product.edit', compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/storage/product/')) {
                mkdir('public/storage/product/', 0777, true);
            }
            if (file_exists('public/storage/product/' . $product
            ->image)) {
                unlink('public/storage/product/' . $product
                ->image);
            }
            $productImage = Image::make($image)->resize(200, 200);
            $productImage->save('public/storage/product/' . $imageName);
        } else {
            $imageName = $product->image;
        }
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;
        $product->image = $imageName;
        if (isset($request->status)) {
            $product->status = true;
        } else {
            $product->status = false;
        }
        $product->save();
        Toastr::success('Product updated successfully', 'Success');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
     /*     if(file_exists('public/storage/product/' . $product
            ->image)){
        unlink('public/storage/product/'.$product
        ->image);
            } */
        $product->delete();
        Toastr::success('Product deleted successfully!', 'Success');
        return redirect()->back();
    }
    public function publish($id)
    {
        $product = Product::find($id);
        $product->status = true;
        $product->save();
        Toastr::success('Product published successfully', 'Success');
        return redirect()->back();
    }
    public function unpublish($id)
    {
        $product = Product::find($id);
        $product->status = false;
        $product->save();
        Toastr::success('Product unpublished successfully', 'Success');
        return redirect()->back();
    }
    public function restore($id){
        Product::withTrashed()->where('id',$id)->restore();
        Toastr::success('Product restored successfully', 'Success');
        return redirect()->back();
    }
    public function forceDelete($id){

         $product = Product::onlyTrashed()->find($id);
          if (file_exists('public/storage/product/' . $product
            ->image)) {
            unlink('public/storage/product/' . $product
            ->image);
            }
        $product->forceDelete();
        Toastr::success('Product permanently deleted successfully', 'Success');
        return redirect()->back();
    }
}
