<?php

namespace App\Controllers;

class FontGroupController {

    public function index() 
    {
      return view('pages/font_group/index');  
    }


    public function create() 
    {
      return view('pages/font_group/create');  
    }
}
