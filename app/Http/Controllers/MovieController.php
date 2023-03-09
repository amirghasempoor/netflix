<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = User::where('id', Auth::user()->id)->first()->id;
        $movies = Movie::where('user_id', $user_id)->get();
        return response()->json([
            'user' => Auth::user(),
            'movies' => $movies,
        ], 200);
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
        $request->validate([
            'title' => 'required|string|unique:movies',
            'description' => 'required',
            'genre' => 'required',
            'publish_day' => 'required|date',
            'image' => 'required|file',
        ]);
        
        Movie::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'genre' => $request->input('genre'),
            'publish_day' => $request->input('publish_day'),
            'image' => $request->file('image')->store('public/images'),
            'user_id' => Auth::user()->id
        ]);

        return response()->json([
            'message' => 'created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'movie' => Movie::findById($id)
        ], 200);
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
        $request->validate([
            'title' => 'required|string|unique:movies',
            'description' => 'required',
            'genre' => 'required',
            'publish_day' => 'required|date',
            'image' => 'required|file',
        ]);

        Movie::where('id', $id)->update($request->all());

        return response()->json([
            'message' => 'updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Movie::where('id', $id)->delete();

        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }
}
