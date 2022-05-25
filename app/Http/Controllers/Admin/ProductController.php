<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5)->withQueryString();
        return view('admin.product.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        //upload image
        if( $request->hasFile('image')) {
            $title = hexdec(uniqid());
            $file = $request->file('image');
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $title.'.'.$img_ext;
            $up_location = 'image/product';
            $image_path = $up_location.'/'.$img_name;
            $file->move($up_location,$img_name);
        }

        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $image_path,
            'status' => '1'
        ]);

        return redirect()->route('products.index')->with('success','Product Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //delete existing iamge and upload new image
        if( $request->hasFile('image')) {
            $product->image ? unlink($product->image) : '';
            $title = hexdec(uniqid());
            $file = $request->file('image');
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $title.'.'.$img_ext;
            $up_location = 'image/product';
            $image_path = $up_location.'/'.$img_name;
            $file->move($up_location,$img_name);
        }else{
            $image_path = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $image_path,
            'status' => '1'
        ]);

        return redirect()->route('products.index')->with('success','Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->image ? unlink($product->image) : '';
        $product->delete();
        return redirect()->route('products.index')->with('success','Product Deleted Successfully.');
    }
}
