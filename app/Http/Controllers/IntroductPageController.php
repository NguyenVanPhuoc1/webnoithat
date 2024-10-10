<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroductPageController extends Controller
{
    //
    public function viewIntroducePage(){
        return view('frontend.gioithieu');
    }

    // view page lien he
    public function viewContact(){
        return view('frontend.lienhe');
    }
}
