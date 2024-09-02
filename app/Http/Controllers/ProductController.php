<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    //admin view products
    public function getAdminDashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    //admin create product
    public function getCreatePage()
    {
        $categories = Category::all();
        return view('admin.createProduct', compact('categories'));
    }

    public function createProduct(ProductRequest $request)
    {
        $validatedProduct = $request->validated();

        $now = now()->format('Y-m-d_H.i.s');
        $photoName = $now . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('/public/product_images', $photoName);

        $validatedProduct['photo'] = $photoName; 
        Product::create($validatedProduct);

        return  redirect()->route('admin.dashboard')->with('success' , $validatedProduct['name'] . ' created successfully');
    }

    //admin update product
    public function getUpdatePage($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.updateProduct', compact('product', 'categories'));
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        if($product == NULL)
        {
            return redirect()->back()->with('error', 'Product not found');
        }
        $updatedData = $request->validated();

        Storage::delete('/public/product_images/'. $product->photo);
        $now = now()->format('Y-M-D_H.i.s');
        $photoName = $now . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('/public/product_images', $photoName);

        $updatedData['photo'] = $photoName;
        $product->update($updatedData);

        return redirect()->route('admin.dashboard')->with('success' , $updatedData['name'] . ' updated successfully');
    }

    //admin delete product
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        Storage::delete('/public/product_images/'. $product->photo);
        Product::destroy($product->id);

        return redirect()->route('admin.dashboard')->with('success', 'product deleted successfully');

    }
    //user

    public function getUserDashboard(Request $request)
    {
        $filter_id = $request->input('filter_id');

        if($filter_id == NULL)
        {
            $products = Product::all();
        }else
        {
            $products = Product::where('category_id', $filter_id)->get();
        }
        $categories = Category::all();

        return view('user.dashboard', compact('products', 'categories'));
    }
}
