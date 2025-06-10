<?php

namespace App\Http\Controllers\Backend\Geolocalizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeolocalizacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('backend.admin.geolocalizacion.index');
    }
}
