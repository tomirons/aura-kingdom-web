<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function index( $language )
    {
        // Save as users language
        if ( Auth::user() )
        {
            Auth::user()->language = $language;
            Auth::user()->save();

            App::setLocale( Auth::user()->language );
        }
        else
        {
            App::setLocale( $language );
        }
        return back();
    }
}
