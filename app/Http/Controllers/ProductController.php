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
    public function getProducts($userid)
    {

        $data = Product::with('category')->get();

        $userProducts = User::find($userid)->products()->get();
        return $data;
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->cid = $request->cid;
        $product->save();
        return ["success" => true, "message" => "Product Created"];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);
        return $data;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
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