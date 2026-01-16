<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BranchController
{
    // app/Http/Controllers/BranchController.php
    public function index()
    {
        // Returns all codeblocks for the logged-in user
        return response()->json(
            \App\Models\Branch::where('user_id', auth()->id())->get()
        );
    }

    public function show($id)
    {
        // Returns a specific codeblock by ID for the logged-in user
        $branch = \App\Models\Branch::where('user_id', auth()->id())->findOrFail($id);
        return response()->json($branch ->load('revisions'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'intent' => 'nullable|string',
            'description' => 'nullable|string',
            'language' => 'required|string|max:100',
            'code' => 'required|string',
        ]);

        $branch = \App\Models\Branch::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'intent' => $validated['intent'] ?? '',
            'description' => $validated['description'] ?? '',
            'language' => $validated['language'],
            'code' => $validated['code'],
        ]);

        return response()->json($branch, 201);
    }

    public function revisionAdd(Request $request, $branchId)
    {
        $branch = \App\Models\Branch::where('user_id', auth()->id())->findOrFail($branchId);

        $validated = $request->validate([
            'code' => 'required|string',
            'title' => 'nullable|string',
        ]);

        $revision = \App\Models\Revision::create([
            'branch_id' => $branch->id,
            'code' => $validated['code'],
            'title' => $validated['title'] ?? '',
        ]);

        // Optionally, you might want to update the branch's code to the latest revision

        $branch->code = $validated['code'];
        $branch->save();


        return response()->json($revision, 201);
    }

    public function getRevision($branchId)
    {
        // Get the specific revision by the id

        $revision = \App\Models\Revision::whereHas('branch', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($branchId);

        return response()->json($revision);
    }

    public function delete($id)
    {
        $branch = \App\Models\Branch::where('user_id', auth()->id())->findOrFail($id);
        $branch->delete();

        return response()->json(['message' => 'Codeblock deleted successfully']);
    }
}
