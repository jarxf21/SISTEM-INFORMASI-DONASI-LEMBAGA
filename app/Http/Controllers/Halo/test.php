<?php

namespace App\Http\Controllers\Halo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class test extends Controller
{
    public function index(){
        $nama = 'fajar';
        $data = ['nama' => $nama];
        return view('coba.halo',$data);
    }
}
