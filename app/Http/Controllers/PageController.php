<?php

namespace App\Http\Controllers;

use App\Models\GameCat;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Style;
use App\Models\Word;

class PageController extends Controller
{
    public function show_page_game(Request $request){
        $game = Game::query()->where('id',$request->id)->first();
        return redirect()->route('show_page_game_id',['game'=>$game]);
    }
    public function show_page_game_id(Game $game){
        return view('admin.games.create',['game'=>$game]);
    }


    public function show_admin_page(){
        return view('admin.index');
    }

    public function show_adminreg_page(){
        return view('admin.enter');
    }

    public function show_styles_page(){
        return view('admin.styles.index');
    }

    public function show_categories_page(){
        return view('admin.categories.index');
    }

    public function show_words_page(){
        return view('admin.words.index');
    }

    public function show_games_page(){
        return view('admin.games.index');
    }

    public function show_adminregFir_page(){
        return view('admin.register');
    }

    public function show_game_page(Request $request){
        $game = Game::query()->where('id',$request->id)->first();
        return redirect()->route('show_game',['game'=>$game]);
    }

    public function show_game(Game $game){
        return view('game.game',['game'=>$game]);
    }

    public function game_page_show(Request $request){
        $game = GameCat::with('Category','Game')->where('game_id',$request->id)->get();
        foreach($game as $gm){
            $gm->category_id = Word::query()->where('category_id',$gm->category->id)->get();
        }
        return response()->json($game);
    }
    public function game_page_show1(Request $request){
      $game = Game::with('Style')->where('id', $request->id)->first();
      return response()->json($game);
    }
}
