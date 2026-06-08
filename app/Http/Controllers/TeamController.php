<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::where('admin_id', auth()->id())
            ->with('members')
            ->latest()
            ->paginate(10);

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team = Team::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'admin_id' => auth()->id(),
        ]);

        return redirect()->route('teams.show', $team)->with('success', 'Team created successfully!');
    }

    public function show(Team $team)
    {
        // Sirf admin hi apni team dekh sake
        if ($team->admin_id !== auth()->id()) {
            abort(403);
        }
        
        $team->load('members', 'tasks');
        // Saare users ki list bheji taaki admin select kar sake
        $users = User::where('id', '!=', auth()->id())->get();
        
        return view('teams.show', compact('team', 'users'));
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team->update($validated);

        return redirect()->route('teams.show', $team)->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }

    public function addMember(Request $request, Team $team)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // check if already member
        if (!$team->members()->where('user_id', $validated['user_id'])->exists()) {
            $team->members()->attach($validated['user_id']);
        }

        return back()->with('success', 'Member added successfully!');
    }

    public function removeMember(Team $team, User $user)
    {
        $team->members()->detach($user->id);
        return back()->with('success', 'Member removed successfully!');
    }
}