<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\LeadServices;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{

    public function index(Request $request)
    {
        $leads = LeadServices::get();
        if($leads->status != 200) {
            return back()->withErrors($leads->errors)->withInput();
        }
        $leads = $leads->data;

        return view('leads.lead', compact('leads'));
    }

    public function create(Request $request, $id = null)
    {
        $products = ProductServices::get();
        $products = $products->data ?? [];
        $lead = null;
        if(!$id) {
            return view('leads.create', compact('lead', 'products'));
        }

        $lead = Lead::find($id);
        return view('leads.create', compact('lead', 'products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
        ]);

        if(isset($request->id)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:leads,email',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $response = LeadServices::store($request->all());
        if($response->status != 200) {
            return back()->withErrors($response->errors)->withInput();
        }

        return redirect()->route('leads.leads')->with('success', $response->message);
    }

    public function delete(Request $request)
    {
        
        $response = LeadServices::delete($request->id);

        if ($response->status === 200) {
            return redirect()->route('leads.leads')->with('success', $response->message);
        }
    
        return redirect()->route('leads.leads')->withErrors(['error' => $response->message]);
    }
}
