<?php

namespace App\Http\Controllers;

use App\Services\CustomerServices;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = CustomerServices::get();
        if($customers->status != 200) {
            return back()->withErrors($customers->errors)->withInput();
        }
        $customers = $customers->data;

        return view('customers.customer', compact('customers'));
    }
}
