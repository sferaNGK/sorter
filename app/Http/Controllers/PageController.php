<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show_admin_page(){
        return view('admin.index');
    }

    public function show_adminreg_page(){
        return view('admin.enter');
    }

    public function show_categories_page(){
        return view('admin.categories.index');
    }

    public function show_words_page(){
        return view('admin.words.index');
    }
}
