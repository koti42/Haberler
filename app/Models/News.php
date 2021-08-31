<?php

namespace App\Models;
use App\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function Category(){
        return $this->belongsTo(Category::class,'category_id');
    }

}
