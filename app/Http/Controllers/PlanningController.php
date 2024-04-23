<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PlanningController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planning = DB::table('planning')->paginate(1); // Change get() to paginate()
        return view('plannings.list',compact('planning'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plannings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'id' => 'required|string',
            'title' => 'required|string',
            'plan' => 'required|string',
            'schedule' => 'required|string',
            'status' => 'required|string',
            // Add more validation rules as necessary
        ]);

        // Insert data into the database
        DB::table('planning')->insert([
            'id' => $request->id,
            'title' => $request->title,
            'plan' => $request->plan,
            'schedule' => $request->schedule,
            'status' => $request->status,
            // Add more fields as necessary
        ]);

        // Redirect to index page or wherever appropriate
        return redirect()->route('plannings.index')->with('success', 'Planning & Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plannings = DB::table('planning')->where('id', $id)->first();
        return view('plannings.show', compact('plannings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plannings = DB::table('planning')->where('id', $id)->first();
        return view('plannings.edit', compact('plannings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'id' => 'required|string',
            'title' => 'required|string',
            'plan' => 'required|string',
            'schedule' => 'required|string',
            'status' => 'required|string',
            // Add more validation rules as necessary
        ]);

        // Update data in the database
        DB::table('planning')->where('id', $id)->update([
            'id' => $request->id,
            'title' => $request->title,
            'plan' => $request->plan,
            'schedule' => $request->schedule,
            'status' => $request->status,
            // Add more fields as necessary
        ]);

        // Redirect to index page or wherever appropriate
        return redirect()->route('plannings.index')->with('success', 'Planning & Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Delete data from the database
            DB::table('planning')->where('id', $id)->delete();
            return response()->json(['status' => 1, 'message' => __('Planning & Schedule deleted successfully.!') ], 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => __('Failed to delete property: ') . $e->getMessage()], 500);
        }
    }
}
