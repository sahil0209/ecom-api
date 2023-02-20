<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $products = Product::with('category')->get();

        return $products;
    }

    public function allProducts($userid)
    {
        $products = Product::with('category')->get();

        $userProducts = User::find($userid)->products()->get();

        return ["products" => $products, "cart" => $userProducts];
    }


    public function store(Request $request)
    {
        $product = new Product;
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'description' => 'required',
            'cid' => 'required'
        ]);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->cid = $request->cid;

        $product->save();

        return ["success" => true, "message" => "Product Created"];

    }


    public function show(string $id)
    {
        $data = Product::find($id);
        return $data;
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'description' => 'required',
            'cid' => 'required'
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->cid = $request->cid;

        $product->save();

        return ["success" => true, "message" => "Product Updated"];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return ["success" => true, "message" => "Product Deleted"];
    }
}