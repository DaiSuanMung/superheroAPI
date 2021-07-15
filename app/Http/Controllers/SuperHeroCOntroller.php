<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuperHeroCOntroller extends Controller
{
    //


    public function search($search){


   $request =  Http::get("https://superheroapi.com/api/4146822502097622/search/" .$search);
   return $request->json();
    }
}
