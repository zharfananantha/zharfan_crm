<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = ProductServices::get();
        if($product->status != 200) {
            return back()->withErrors($product->errors)->withInput();
        }
        $product = $product->data;

        return view('products.product', compact('product'));
    }

    public function create(Request $request, $id = null)
    {
        $product = null;
        if(!$id) {
            return view('products.create', compact('product'));
        }

        $product = Product::find($id);
        return view('products.create', compact('product'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $response = ProductServices::store($request->all());
        if($response->status != 200) {
            return back()->withErrors($response->errors)->withInput();
        }

        return redirect()->route('products.products')->with('success', $response->message);
    }
}
