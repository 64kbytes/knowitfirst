<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {

    	# fail miserably
    	throw new \Exception("Ths wasn't supposed to happen like this...");

    	return View('welcome');
    }
}
