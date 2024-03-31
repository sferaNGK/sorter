<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameCat extends Model
{
    use HasFactory;

    public function Game(){
        return $this->belongsTo(Game::class);
    }
    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
