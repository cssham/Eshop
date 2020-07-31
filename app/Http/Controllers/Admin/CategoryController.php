<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name'=>'required|unique:categories,name',
            'description'=>'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        if (isset($request->status)) {
            $category->status = true;
        } else {
            $category->status = false;
        }
        $category->save();
        Toastr::success('Category added successfully!','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'description' => 'required',
        ]);
        $category->name = $request->name;
        $category->description = $request->description;
        if (isset($request->status)) {
            $category->status = true;
        } else {
            $category->status = false;
        }
        $category->save();
        Toastr::success('Category updated successfully!', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Toastr::success('Category deleted successfully','Success');
        return redirect()->back();
    }
    public function publish($id)
    {
        $category = Category::find($id);
        $category->status =true;
        $category->save();
        Toastr::success('Category published successfully', 'Success');
        return redirect()->back();
    }
    public function unpublish($id)
    {
        $category = Category::find($id);
        $category->status = false;
        $category->save();
        Toastr::success('Category unpublished successfully', 'Success');
        return redirect()->back();
    }
}
