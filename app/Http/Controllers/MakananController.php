<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    public function index()
    {
        $makanans = Makanan::where('availability', true)->get();
        return view('makanan.index', compact('makanans'));
    }

    public function operator_makanan()
    {
        $makanans = Makanan::simplePaginate(6);
        return view('operator.makanan.index', compact('makanans'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('images', 'public');

        // Create new Makanan
        Makanan::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'availability' => $request->has('availability') // Menyimpan status checkbox
        ]);

        return redirect()->back()->with('success', 'Makanan berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:makanans,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'availability' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $makanan = Makanan::find($request->id);
        $makanan->name = $request->name;
        $makanan->price = $request->price;
        $makanan->availability = $request->has('availability') ? 1 : 0; // Konversi checkbox menjadi boolean

        // Jika ada gambar yang diupload, ganti gambar lama
        if ($request->hasFile('image')) {
            if ($makanan->image) {
                Storage::disk('public')->delete($makanan->image); // Hapus gambar lama
            }
            $makanan->image = $request->file('image')->store('images', 'public');
        }

        $makanan->save();

        return redirect()->back()->with('success', 'Makanan updated successfully.');
    }

    public function destroy($id)
    {
        // Cari makanan berdasarkan ID
        $makanan = Makanan::find($id);

        // Jika makanan tidak ditemukan, kembalikan respons error
        if (!$makanan) {
            return response()->json(['message' => 'Food item not found.'], 404);
        }

        // Hapus file gambar jika ada
        if ($makanan->image && Storage::disk('public')->exists($makanan->image)) {
            Storage::disk('public')->delete($makanan->image);
        }

        // Hapus data makanan dari database
        $makanan->delete();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Food item deleted successfully.'], 200);
    }
}
