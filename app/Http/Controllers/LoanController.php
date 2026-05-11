<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function rentBooks(Request $request)
    {
        $request->validate([
            'books' => 'required|array|min:1'
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'message' => 'Користувача не авторизовано'
            ], 401);
        }

        DB::beginTransaction();

        try {
            foreach ($request->books as $cartItem) {
                $book = Book::find($cartItem['BookID']);
                if (!$book) {
                    throw new \Exception('Книгу не знайдено');
                }
                $quantity = $cartItem['quantity'];
                if ($book->CopiesAvailable < $quantity) {
                    throw new \Exception("Недостатньо копій книги: {$book->Title}");
                }
                for ($i = 0; $i < $quantity; $i++) {
                    BookLoan::create([
                        'LoanDate' => Carbon::now(),
                        'DueDate' => Carbon::now()->addDays(14),
                        'ReturnDate' => null,
                        'TotalPrice' => $book->DailyRentPrice * 14,
                        'BookID' => $book->BookID,
                        'StaffID' => 1,
                        'MemberID' => $user->id
                    ]);
                }
                $book->CopiesAvailable -= $quantity;
                $book->save();
            }
            DB::commit();
            return response()->json([
                'message' => 'Оренду успішно оформлено'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}