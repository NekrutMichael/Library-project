<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $primaryKey = 'BookID';
    public $timestamps = false; 
    protected $fillable = [
        'Title', 'PublicationYear', 'CopiesAvailable', 'CollateralValue', 'DailyRentPrice', 'GenreID'
    ];
    public function genre()
    {
    return $this->belongsTo(Genre::class, 'GenreID', 'GenreID');
    }
}
