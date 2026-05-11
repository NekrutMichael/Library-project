<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookLoan;

class ProfileController extends Controller
{
    public function loans(Request $request)
    {
        $user = auth()->user();

        $loans = BookLoan::with('book')
            ->where('MemberID', $user->id)
            ->orderBy('LoanDate', 'desc')
            ->get();

        return response()->json($loans);
    }
}