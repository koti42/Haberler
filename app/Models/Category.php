<?php

namespace App\Models;
use App\News;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function nevs(){
        return $this->hasMany(News::class,'nev_id');
    }
}
