<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Log;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data (all fields are optional)
        $validated = $request->validate([
            'ip_address' => 'nullable|string|max:45',
            'city' => 'nullable|string|max:100',
            'device' => 'nullable|string|max:255',
        ]);

        // Create visit record with validated data
        $visit = Visit::create($validated);

        return response()->json([
            'message' => 'Visit recorded successfully',
            'visit' => $visit,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
