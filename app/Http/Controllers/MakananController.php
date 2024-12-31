<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index()
    {
        $makanans = Makanan::all();
        return view('makanan.index', compact('makanans'));
    }

    public function operator_makanan()
    {
        $makanans = Makanan::all();
        return view('operator.makanan.index', compact('makanans'));
    }

    public function create()
    {
        return view('makanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url',
        ]);

        Makanan::create($request->all());
        return redirect()->route('makanan.index');
    }

    public function edit(Makanan $makanan)
    {
        return view('makanan.edit', compact('makanan'));
    }

    public function update(Request $request, Makanan $makanan)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url',
        ]);

        $makanan->update($request->all());
        return redirect()->route('makanan.index');
    }

    public function destroy(Makanan $makanan)
    {
        $makanan->delete();
        return redirect()->route('makanan.index');
    }
}
