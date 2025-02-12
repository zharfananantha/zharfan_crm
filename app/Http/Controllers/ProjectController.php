<?php

namespace App\Http\Controllers;

use App\Services\ProjectServices;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = ProjectServices::get();
        if($projects->status != 200) {
            return back()->withErrors($projects->errors)->withInput();
        }
        $projects = $projects->data;

        return view('projects.projects', compact('projects'));
    }


    public function update(Request $request)
    {
        $response = ProjectServices::update($request->all());

        if($response->status != 200) {
            return back()->withErrors($response->errors)->withInput();
        }

        return redirect()->route('projects.projects')->with('success', $response->message);
    }
}
