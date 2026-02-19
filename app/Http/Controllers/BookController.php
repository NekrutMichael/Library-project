<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
public function index()
    {
        $books = [
            1 => 'Розум вбивці',
            2 => 'Кафе на краю світу',
            3 => 'Том Соєр',
            4 => 'Наталка Полтавка',
            5 => 'Кобзар',
        ];
        return "Список книг у бібліотеці:<br><br>" . implode('<br>', $books);
    }
public function show($id)
    {
        $books = [
            1 => 'Розум вбивці',
            2 => 'Кафе на краю світу',
            3 => 'Том Соєр',
            4 => 'Наталка Полтавка',
            5 => 'Кобзар',
        ];
        if (array_key_exists($id, $books)) {
            return "Детальна інформація про книгу: <br><b>" . $books[$id] . "</b>";
        } else {
            return "Книгу з ідентифікатором " . $id . " не знайдено в бібліотеці.";
        }
    }
}