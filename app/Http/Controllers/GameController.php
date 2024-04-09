<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function AddGame(Request $request){
        $valid = Validator::make($request->all(),[
            'title'=>['required','unique:games','regex:/^[А-Яа-яA-Za-z\s]+$/u']
        ],[
            'title.required'=>'Поле обязательно для заполнения',
            'title.unique'=>'Поле должно быть уникальным',
            'title.regex'=>'Поле не соответствует правилам',
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $game = new Game();
        $game->title=$request->title;
        $game->save();

        foreach($request->games as $gamed){
            $gameCat = new GameCat();
            $gameCat->game_id = $game->id;
            $gameCat->category_id = $gamed;
            $gameCat->save();
        }
        return redirect()->back();
    }

    public function EditGame(Request $request){
        $game = Game::query()->where('id',$request->id)->first();
        $game->title = $request->title;
        $game->update();

        return redirect()->back();
    }

    public function DeleteGame(Request $request){
        $game = Game::query()->where('id',$request->id)->first();
        $game->delete();
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
    public function show(Game $game)
    {
        $game = Game::all();
        return response()->json($game);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
