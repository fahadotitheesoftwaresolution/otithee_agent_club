<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FingerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finger_print = DB::table('finger_print')->paginate(10); // Change get() to paginate()
        return view('finger_p.list',compact('finger_print'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('finger_p.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'rank_name' => 'required|string',
            'users' => 'required|string',
            'agents' => 'required|string',
            'properties' => 'required|string',
            'commission' => 'required|string',
            'global' => 'required|string',
            'entry_by' => 'required|string',
            'created_at' => 'required|string',
            'updated_at' => 'required|string',
            // Add more validation rules as necessary
        ]);

        // Insert data into the database
        DB::table('finger_print')->insert([
            'rank_name' => $request->rank_name,
            'users' => $request->users,
            'agents' => $request->agents,
            'properties' => $request->properties,
            'commission' => $request->commission,
            'global' => $request->global,
            'entry_by' => $request->entry_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
            // Add more fields as necessary
        ]);

        // Redirect to index page or wherever appropriate
        return redirect()->route('finger_p.index')->with('success', 'Finger Print created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $finger_p = DB::table('finger_print')->where('id', $id)->first();
        return view('finger_p.show', compact('finger_p'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $finger_p = DB::table('finger_print')->where('id', $id)->first();
        return view('finger_p.edit', compact('finger_p'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'rank_name' => 'required|string',
            'users' => 'required|string',
            'agents' => 'required|string',
            'properties' => 'required|string',
            'commission' => 'required|string',
            'global' => 'required|string',
            'entry_by' => 'required|string',
            'created_at' => 'required|string',
            'updated_at' => 'required|string',
            // Add more validation rules as necessary
        ]);

        // Update data in the database
        DB::table('finger_print')->where('id', $id)->update([
            'rank_name' => $request->rank_name,
            'users' => $request->users,
            'agents' => $request->agents,
            'properties' => $request->properties,
            'commission' => $request->commission,
            'global' => $request->global,
            'entry_by' => $request->entry_by,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
            // Add more fields as necessary
        ]);

        // Redirect to index page or wherever appropriate
        return redirect()->route('finger_p.index')->with('success', 'Finger Print updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Delete data from the database
            DB::table('finger_print')->where('id', $id)->delete();
            return response()->json(['status' => 1, 'message' => __('Finger Print deleted successfully.!') ], 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => __('Failed to delete property: ') . $e->getMessage()], 500);
        }
    }
}
