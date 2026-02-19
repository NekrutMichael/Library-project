<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke(Request $request)
    {
        return "Вітаємо в системі управління бібліотекою! Це головна сторінка.";
    }
} 
