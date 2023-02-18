<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return $data;
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Category::find($id);
        return $data;
    }

}
