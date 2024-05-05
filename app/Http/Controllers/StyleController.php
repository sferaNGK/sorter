<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{
    public function GetStylesGame(Request $request){
        $styles = Game::with('Style')->where('id',$request->id)->get();
        return response()->json($styles);
    }

    public function ChoseGameStyle(Request $request){
        $game = Game::query()->where('id', $request->id)->first();
        $game->style_id = $request->style;
        $game->update();
        return response()->json('Стиль игры применен', 200);
    }

    public function AddGameStyle(Request $request){
        $game = Game::query()->where('id',$request->id)->first();
        $style = new Style();
        $style->title=$request->title;
        if($request->file('css')){
            // New
            $origName = $request->css->getClientOriginalName();
            $path = '/style/';
            $file = $request->css;
            Storage::disk('public')->putFileAs($path,$file, $origName);
            $style->path = '/storage/style/'.$origName;
        }
        $style->save();

        $game->style_id = $style->id;
        $game->update();
        return response()->json("Стиль добавлен", 200);
    }

    public function AddStyle(Request $request){
        $style = new Style();
        $style->title=$request->title;
        if($request->file('css')){
            // New
            $origName = $request->css->getClientOriginalName();
            $path = '/style/';
            $file = $request->css;
            Storage::disk('public')->putFileAs($path,$file, $origName);
            $style->path = '/storage/style/'.$origName;
        }
        $style->save();
        return redirect()->back();
    }

    public function EditStyle(Request $request){
        $style = Style::query()->where('id',$request->id)->first();
        $style->title = $request->title;
        if($request->file('css')){
            $origName = $request->css->getClientOriginalName();
            $path = '/style/';
            $file = $request->css;
            Storage::disk('public')->putFileAs($path,$file, $origName);
            $style->path = '/storage/style/'.$origName;
        }
        $style->update();
        return redirect()->back();
    }

    public function DeleteStyle(Request $request){
        $style = Style::query()->where('id',$request->id)->first();
        $style->delete();
        return redirect()->back();
    }
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
    public function show(Style $style)
    {
        $style = Style::all();
        return response()->json($style);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Style $style)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Style $style)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Style $style)
    {
        //
    }
}
