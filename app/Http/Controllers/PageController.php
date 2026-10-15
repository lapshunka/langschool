<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about', [
            'fio' => 'Сулейменов Камал',
            'group' => '3ПОВТ-24Б'            
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'address' => 'г. Костанай, ул. Байтурсынова, 47',
            'phone' => '+7 (7142) 55-00-00',
            'email' => 'info@langschool.kz'
        ]);
    }

    public function rules()
    {
        return view('rules');
    }
}