<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return $request->user()->movies;
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
        $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'release_year' => 'nullable|integer',
        'genre' => 'nullable|string|max:255',
        'rating' => 'nullable|numeric|min:0|max:10',
        'director' => 'nullable|string|max:255',
        'duration' => 'nullable|integer'
    ]);

    $movie = $request->user()->movies()->create($data);

    return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request , string $id)
    {
        $movie = $request->user()->movies()->findOrFail($id);

        return response()->json($movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = $request->user()->movies()->findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer',
            'description' => 'nullable|string'
        ]);

        $movie->update($data);

        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
{
    $movie = $request->user()->movies()->findOrFail($id);
    $this->authorize('delete', $movie);

    $movie->delete();

    return response()->json([
        'message' => 'Movie deleted successfully'
    ]);
}
}
