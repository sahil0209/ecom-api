<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProductController extends Controller
{


    public function userProducts($id){
        $data = User::find($id)->products()->get();
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userProduct = new UserProduct;
        $userProduct->user_id = $request->user_id;
        $userProduct->product_id = $request->product_id;
        $userProduct->amount = $request->amount;
        $userProduct->save();

        return ["success"=>true,"message"=>"Added to Cart"];
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = UserProduct::find($id);
        $item->quantity = $request->quantity;
        $item->amount = $request->amount;
        $item->save();
        return ["success"=>true,"message"=>"Updated Cart"];
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = UserProduct::find($id);
        $product->delete();
        return ["success"=>true,"message"=>"Deleted Cart"];
    }
}
