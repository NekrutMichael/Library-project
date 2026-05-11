<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'AuthorID';
    protected $table = 'authors';
    public $timestamps = false;
    protected $fillable = ['FirstName', 'LastName'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'authors_books', 'AuthorID', 'BookID');
    }
}
