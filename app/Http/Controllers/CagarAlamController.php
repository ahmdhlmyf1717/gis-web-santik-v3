<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\CagarAlam;
use Illuminate\Http\Request;

class CagarAlamController extends Controller
{
    public function index()
    {
        $cagarAlam = CagarAlam::paginate(10);

        return view('cagar-alam.index', compact('cagarAlam'));
    }

    public function create()
    {
        return view('cagar-alam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('cagar-alam', 'public');
        }

        CagarAlam::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('cagar-alam.index')->with('success', 'Data Cagar Alam berhasil ditambahkan.');
    }

    public function show($id)
    {
        return response()->json(CagarAlam::findOrFail($id));
    }
    public function edit($id)
    {
        $cagarAlam = CagarAlam::findOrFail($id);
        return view('cagar-alam.edit', compact('cagarAlam'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $cagarAlam = CagarAlam::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($cagarAlam->foto) {
                Storage::disk('public')->delete($cagarAlam->foto);
            }
            $fotoPath = $request->file('foto')->store('cagar-alam', 'public');
            $cagarAlam->foto = $fotoPath;
        }

        $cagarAlam->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('cagar-alam.index')->with('success', 'Data Cagar Alam berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $cagarAlam = CagarAlam::findOrFail($id);

        // Hapus foto dari storage jika ada
        if ($cagarAlam->foto) {
            Storage::disk('public')->delete($cagarAlam->foto);
        }

        $cagarAlam->delete();

        return redirect()->route('cagar-alam.index')->with('success', 'Data Cagar Alam berhasil dihapus.');
    }
    public function getByNama($nama)
    {
        $cagarAlam = CagarAlam::where('nama', $nama)->first();

        if (!$cagarAlam) {
            return response()->json(['message' => 'Cagar Alam tidak ditemukan'], 404);
        }

        return response()->json($cagarAlam);
    }
}
