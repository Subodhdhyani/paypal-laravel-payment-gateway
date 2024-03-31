<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class displaycontroller extends Controller
{
    function display(){
        $data = Payment::all();
        return view('display',['data'=>$data]);

    }
}
