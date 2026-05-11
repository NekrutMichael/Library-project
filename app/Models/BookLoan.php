<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class BookLoan extends Model
{
    protected $table = 'bookloans';
    protected $primaryKey = 'LoanID';
    public $timestamps = false;
    protected $fillable = [
        'LoanDate','DueDate','ReturnDate','TotalPrice','BookID','StaffID','MemberID'
    ];
    public function book(){
    return $this->belongsTo(Book::class, 'BookID', 'BookID');
    }
}