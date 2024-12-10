<?php

namespace App\Http\Controllers;

use App\Models\makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index()
    {
        $makanans = Makanan::all();
        return view('makanan.index', compact('makanans'));
    }
}
