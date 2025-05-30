<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Page d'accueil
    public function home()
    {
        return view('home');
    }

    // Page à propos
    public function about()
    {
        return view('about');
    }

    // Page services (peut être la même que about si tu les fusionnes)
    public function services()
    {
        return view('services');
    }

    // Page contact
    public function contact()
    {
        return view('contact');
    }
}