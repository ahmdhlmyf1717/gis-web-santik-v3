<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function create()
    {
        return view('dataset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'dokter_asn' => 'required|integer|min:0',
            'dokter_non_asn' => 'required|integer|min:0',
            'perawat_asn' => 'required|integer|min:0',
            'perawat_non_asn' => 'required|integer|min:0',
            'bidan_asn' => 'required|integer|min:0',
            'bidan_non_asn' => 'required|integer|min:0',
            'sanitarian_asn' => 'required|integer|min:0',
            'sanitarian_non_asn' => 'required|integer|min:0',
            'ahli_gizi_asn' => 'required|integer|min:0',
            'ahli_gizi_non_asn' => 'required|integer|min:0',
            'tenaga_asn' => 'required|integer|min:0',
            'tenaga_non_asn' => 'required|integer|min:0',
            'non_tenaga_asn' => 'required|integer|min:0',
            'non_tenaga_non_asn' => 'required|integer|min:0',
        ]);

        // Simpan data
        Dataset::create($request->all());

        return redirect()->route('dataset.index')->with('success', 'Data berhasil ditambahkan')->withInput();
    }

    public function index()
    {
        $datasets = Dataset::paginate(7);
        return view('dataset.index', compact('datasets'));
    }
    public function edit($id)
    {
        $dataset = Dataset::findOrFail($id);
        return view('dataset.edit', compact('dataset'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'dokter_asn' => 'required|integer|min:0',
            'dokter_non_asn' => 'required|integer|min:0',
            'perawat_asn' => 'required|integer|min:0',
            'perawat_non_asn' => 'required|integer|min:0',
            'bidan_asn' => 'required|integer|min:0',
            'bidan_non_asn' => 'required|integer|min:0',
            'sanitarian_asn' => 'required|integer|min:0',
            'sanitarian_non_asn' => 'required|integer|min:0',
            'ahli_gizi_asn' => 'required|integer|min:0',
            'ahli_gizi_non_asn' => 'required|integer|min:0',
            'tenaga_asn' => 'required|integer|min:0',
            'tenaga_non_asn' => 'required|integer|min:0',
            'non_tenaga_asn' => 'required|integer|min:0',
            'non_tenaga_non_asn' => 'required|integer|min:0',
        ]);

        $dataset = Dataset::findOrFail($id);
        $dataset->update($request->all());

        return redirect()->route('dataset.index')->with('success', 'Dataset berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dataset = Dataset::findOrFail($id);
        $dataset->delete();

        return redirect()->route('dataset.index')->with('success', 'Dataset berhasil dihapus!');
    }
}
