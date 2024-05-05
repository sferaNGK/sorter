<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GameCat;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function AddGameCategory(Request $request){
        $valid = Validator::make($request->all(),[
            'title'=>['required']
        ],[
            'title.required'=>'Поле обязательно для заполнения',
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $category = new Category();
        $category->title=$request->title;
        $category->save();

        $gameCat = new GameCat();
        $gameCat->game_id = $request->id;
        $gameCat->category_id = $category->id;
        $gameCat->save();
        return response()->json("Категория: '" . $request->title . "' добавлена", 200);
    }

    public function GetCategoriesGame(Request $request){
        $gameCat = GameCat::with('Game','Category')->where('game_id',$request->id)->get();
        return response()->json($gameCat);
    }

    public function AddCategory(Request $request){
        $valid = Validator::make($request->all(),[
            'title'=>['required']
        ],[
            'title.required'=>'Поле обязательно для заполнения',
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $category = new Category();
        $category->title=$request->title;
        $category->save();
        return redirect()->back();
    }

    public function EditCategory(Request $request){
        $category = Category::query()->where('id', $request->id)->first();
        $category->title = $request->title;
        $category->update();
        return response()->json('Категория изменена', 200);
    }

    public function DeleteCategory(Request $request){
        $category = Category::query()->where('id',$request->id)->first();
        $category->delete();
        return redirect()->back();
    }


    public function gameCategories(Request $request){
        $words = [];
        foreach($request->all() as $id){
            array_push($words, Word::query('Category')->where('category_id',$id->id)->get());
        }
        return response()->json($words);
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
    public function show(Category $category)
    {
        $category = Category::all();
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
