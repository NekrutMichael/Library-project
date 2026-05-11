<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'BookID';
    public $timestamps = false; 
    protected $fillable = [
        'Title', 'Description', 'Cover', 'PublicationYear', 'CopiesAvailable', 'CollateralValue', 'DailyRentPrice', 'GenreID'
    ];
    public function genre()
    {
    return $this->belongsTo(Genre::class, 'GenreID', 'GenreID');
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class,'authors_books','BookID','AuthorID');
    }
}
