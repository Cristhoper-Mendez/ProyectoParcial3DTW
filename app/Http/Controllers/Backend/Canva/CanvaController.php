<?php

namespace App\Http\Controllers\Backend\Canva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CanvaController extends Controller
{
     public function vistaCanva()
   { 
       return view('backend.admin.canva.canvas');
   }   
}
