<?php

namespace App\Http\Controllers;

use App\Models\Machinery;
use Illuminate\Http\Request;

class MachineryController extends Controller
{
    public function index()
    {
        //
        $data = Machinery::all();
        return $data;

    }
}
