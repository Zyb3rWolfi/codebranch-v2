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
}
