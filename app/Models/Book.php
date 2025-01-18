<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable =[
        'title', 'description', 'author_id'
    ];

    public function authors()
    {
        return $this->belongsTo('App\Models\Author');
    }

}
