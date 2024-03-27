<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function AddCategory(Request $request){
        $valid = Validator::make($request->all(),[
            'title'=>['required','unique:categories','regex:/^[А-Яа-яA-Za-z\s]+$/u']
        ],[
            'title.required'=>'Поле обязательно для заполнения',
            'title.unique'=>'Поле должно быть уникальным',
            'title.regex'=>'Поле не соответствует правилам',
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
        return redirect()->back();
    }

    public function DeleteCategory(Request $request){
        $category = Category::query()->where('id',$request->id)->first();
        $category->delete();
        return redirect()->back();
    }

    public function gameCategoryGet(){
        $category = Category::all()->random(2);
        $words = [];
        foreach($category as $cat){
            array_push($words,Word::with('Category')->where('category_id',$cat->id)->get());
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
