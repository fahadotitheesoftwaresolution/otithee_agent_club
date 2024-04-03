<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AgentProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->paginate(10); // Change get() to paginate()
        return view('agent_profile.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent_profile.create');
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
        DB::table('users')->insert([
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
        return redirect()->route('agent_profile.index')->with('success', 'Agent Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent_profile = DB::table('users')->where('id', $id)->first();
        return view('agent_profile.show', compact('agent_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent_profile = DB::table('users')->where('id', $id)->first();
        return view('agent_profile.edit', compact('agent_profile'));
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
        DB::table('users')->where('id', $id)->update([
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
        return redirect()->route('agent_profile.index')->with('success', 'Agent Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Delete data from the database
            DB::table('users')->where('id', $id)->delete();
            return response()->json(['status' => 1, 'message' => __('Agent Profile deleted successfully.!') ], 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => __('Failed to delete property: ') . $e->getMessage()], 500);
        }
    }
}
