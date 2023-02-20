<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use PHPUnit\Framework\TestStatus\Success;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function userProducts($id)
    {
        $data = User::find($id)->products()->get();
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userProduct = new UserProduct;

        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required | numeric'
        ]);

        $userProduct->user_id = $request->user_id;
        $userProduct->product_id = $request->product_id;
        $userProduct->amount = $request->amount;
        $userProduct->save();

        $cart = $this->userProducts($request->user_id);

        return ["success" => true, "message" => "Added To Cart", "cart" => $cart];

    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = UserProduct::find($id);

        $request->validate([
            'quantity' => 'required | numeric',
            'amount' => 'required | numeric'
        ]);

        $item->quantity = $request->quantity;
        $item->amount = $request->amount;

        $item->save();

        return ["succes" => true, "message" => "Updated The Cart"];
    }


    public function removeFromCart($userid, $productid)
    {
        $item = UserProduct::where(["user_id" => $userid, "product_id" => $productid]);
        $item->delete();

        $cart = $this->userProducts($userid);

        return ["success" => true, "message" => "Removed From Cart", "cart" => $cart];


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = UserProduct::find($id);
        $item->delete();


        return ["succes" => true, "message" => "removed The Cart"];

    }
}