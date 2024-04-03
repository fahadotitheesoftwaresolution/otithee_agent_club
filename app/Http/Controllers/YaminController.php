<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class YaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
	 
    public function index()
    {
	   $user=users::find('YAMIN');
       return view('fornt-end.index', ['user'=> $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(yamin $yamin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(yamin $yamin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, yamin $yamin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(yamin $yamin)
    {
        //
    }
}
