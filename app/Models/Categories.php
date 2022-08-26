<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id'
    ];

    //Eloquent relationship 
    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
