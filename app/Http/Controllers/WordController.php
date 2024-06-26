<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCat;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    public function GetWordsGame(Request $request){
        $words = [];
        $gameCat = GameCat::query()->where('game_id', $request->id)->get();
        foreach($gameCat as $cat){
            if(Word::query()->where('category_id', $cat->category_id)->first() != null){
                array_push($words, Word::with('Category')->where('category_id', $cat->category_id)->get());
            }
        }
        $result = [];
       foreach($words as $wo){
        foreach($wo as $w){
            array_push($result, $w);
        }
       }
        return response()->json($result);
    }
    public function AddGameWord(Request $request){
        $word = new Word();
        $word->title=$request->title;
        if($request->file('img')){
            $word->img = '/storage/'.$request->file('img')->store('/public/img');
            $word->img = str_replace('public/',"",$word->img);
        }
        $word->category_id=$request->category;
        $word->save();
        return response()->json("Слово(изображение) добавлено", 200);
    }

    public function AddWord(Request $request){
        $word = new Word();
        $word->title=$request->title;
        if($request->file('img')){
            $word->img = '/storage/'.$request->file('img')->store('/public/img');
            $word->img = str_replace('public/',"",$word->img);
        }
        $word->category_id=$request->category;
        $word->save();
        return redirect()->back();
    }

    public function EditWord(Request $request){
        $word = Word::query()->where('id', $request->id)->first();
        $word->title = $request->title;
        $word->category_id = $request->category;
        if($request->file('img')){
            $word->img = '/storage/'.$request->file('img')->store('/public/img');
            $word->img = str_replace('public/',"",$word->img);
        }
        $word->update();
        return response()->json("Слово(изображение) изменено", 200);
    }

    public function DeleteWord(Request $request){
        $word = Word::query()->where('id',$request->id)->first();
        $word->delete();
        return redirect()->back();
    }

    public function checkGame(Request $request){
        // Request arr
        $request->title1 = explode(',', $request->title1);
        $request->title2 = explode(',', $request->title2);

        // database arr
        $arr1=[];
        $arr2=[];

       $words = Word::with('Category')->where('category_id',$request->id)->get();
       $words1 = Word::with('Category')->where('category_id',$request->id2)->get();
       foreach($words as $word){
            array_push($arr1, $word->title);
        }
       foreach($words1 as $word){
            array_push($arr2, $word->title);
        }

        $right1 = array_intersect($request->title1, $arr1);
        $wrong1 = array_diff($request->title1, $arr1);

        $right2 = array_intersect($request->title2, $arr2);
        $wrong2 = array_diff($request->title2, $arr2);

        $right=array_merge($right1,$right2);

        $wrong= array_merge($wrong1,$wrong2);

        $answ = [];
        array_push($answ,$right,$wrong);

        return response()->json($answ, 200);
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
    public function show(Word $word)
    {
        $word = Word::with('Category')->get();
        return response()->json($word);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        //
    }
}
