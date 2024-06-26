<?php

namespace App\Http\Controllers;

use App\Models\GameCat;
use App\Models\Word;
use Illuminate\Http\Request;

class GameCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GameCat $gameCat)
    {
        $gameCat = GameCat::with('Category','Game')->get();
        return response()->json($gameCat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameCat $gameCat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameCat $gameCat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameCat $gameCat)
    {
        //
    }
}
