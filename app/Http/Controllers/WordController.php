<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    public function AddWord(Request $request){
        $valid = Validator::make($request->all(),[
            'title'=>['required','unique:words','regex:/^[А-Яа-яA-Za-z\s]+$/u']
        ],[
            'title.required'=>'Поле обязательно для заполнения',
            'title.unique'=>'Поле должно быть уникальным',
            'title.regex'=>'Поле не соответствует правилам',
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $word = new Word();
        $word->title=$request->title;
        $word->category_id=$request->category;
        $word->save();
        return redirect()->back();
    }

    public function EditWord(Request $request){
        $word = Word::query()->where('id', $request->id)->first();
        $word->title = $request->title;
        $word->category_id = $request->category;
        $word->update();
        return redirect()->back();
    }

    public function DeleteWord(Request $request){
        $word = Word::query()->where('id',$request->id)->first();
        $word->delete();
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
