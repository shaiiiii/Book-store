<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title', 'author', 'price', 'stock','image'];


    use HasFactory;


    public function issuances()
    {
        return $this->hasMany(BookIssuance::class);
    }
}
