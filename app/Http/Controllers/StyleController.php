<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{

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
            // $style->path = '/storage/'.$request->css->getClientOriginalName()->store('/public/style');
            // dd($style->path);
            // $request->css->move(public_path('uploads'), $style->path);

            // OLD
            // $style->path = '/storage/'.$request->file('css')->store('/public/style');
            // $style->path = str_replace('.txt',".css",$style->path);
            // $style->path = str_replace('public/',"",$style->path);
        }
        $style->save();
        return redirect()->back();
    }

    public function EditStyle(Request $request){
        $style = Style::query()->where('id',$request->id)->first();
        $style->title = $request->title;
        if($request->file('css')){
            $style->path = '/storage/'.$request->file('css')->store('/public/style');
            $style->path = str_replace('public/',"",$style->path);
            $style->path = str_replace('.txt',".css",$style->path);
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
