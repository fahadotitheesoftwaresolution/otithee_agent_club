<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AgentClubRankingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agentclubranking = DB::table('agentclubranking')->paginate(10); // Change get() to paginate()
        return view('agent_club_ranking.list',compact('agentclubranking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent_club_ranking.create');
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
        DB::table('agentclubranking')->insert([
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
        return redirect()->route('agent_club_ranking.index')->with('success', 'Agent Club Rank created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent_club_ranking = DB::table('agentclubranking')->where('id', $id)->first();
        return view('agent_club_ranking.show', compact('agent_club_ranking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent_club_ranking = DB::table('agentclubranking')->where('id', $id)->first();
        return view('agent_club_ranking.edit', compact('agent_club_ranking'));
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
        DB::table('agentclubranking')->where('id', $id)->update([
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
        return redirect()->route('agent_club_ranking.index')->with('success', 'Agent Club Rank updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Delete data from the database
            DB::table('agentclubranking')->where('id', $id)->delete();
            return response()->json(['status' => 1, 'message' => __('Agent Club Rank deleted successfully.!') ], 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => __('Failed to delete property: ') . $e->getMessage()], 500);
        }
    }
}
