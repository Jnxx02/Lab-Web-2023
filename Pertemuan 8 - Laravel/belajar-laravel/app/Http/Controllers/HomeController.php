<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function salam() {
        echo "Hai";
    }

    function kuadrat($angka1, $angka2) {
        echo $angka1 ** $angka2;
    }
    function kali($angka1, $angka2) {
        echo $angka1 * $angka2;
    }

    function jualan(){
        $animal = ['Ayam = Rp20.000/pcs', 'Sapi = Rp100.000.000/pcs'];
        return view('index', [
            'animals'=> $animal
        ]);
    }

}
