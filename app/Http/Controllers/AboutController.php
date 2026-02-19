<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {
        return "Про проєкт: Курсова робота. Тематика: Комерційна бібліотека. Розроблено на базі фреймворку Laravel.";
    }
}