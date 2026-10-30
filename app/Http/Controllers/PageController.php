<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        $data = [
            'page' => 'home',
            'title' => 'POS Command Center',
            'subtitle' => 'Simple account management for a smarter point of sale.',
        ];
        return function_exists('view') ? view('pages.home', $data) : $data;
    }

    public function about()
    {
        $data = [
            'page' => 'about',
            'title' => 'About POS Command Center',
            'subtitle' => 'A Laravel foundations activity built around clean MVC responsibilities.',
        ];
        return function_exists('view') ? view('pages.about', $data) : $data;
    }
}
