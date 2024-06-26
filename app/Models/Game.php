<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    public function GameCats(){
        return $this->hasMany(GameCat::class);
    }
    public function Style(){
        return $this->belongsTo(Style::class);
    }
}
