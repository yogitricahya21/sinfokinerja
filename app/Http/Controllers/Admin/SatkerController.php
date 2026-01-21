<?php

namespace App\Http\Controllers\Admin;

use App\Models\Satker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SatkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satkers = Satker::all();
        return view('admin.satker.index', compact('satkers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_satker' => 'required|string|max:255',
            'kode_satker' => 'required|string|unique:satkers,kode_satker',
        ]);

        Satker::create($request->all());

        return redirect()->back()->with('success', 'Satker berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_satker' => 'required',
            'kode_satker' => 'required|unique:satkers,kode_satker,' . $id,
        ]);

        $satker = Satker::findOrFail($id);
        $satker->update([
            'nama_satker' => $request->nama_satker,
            'kode_satker' => $request->kode_satker,
        ]);

        return redirect()->back()->with('success', 'Data Satker berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $satker = Satker::findOrFail($id);
    $satker->delete();

    return redirect()->back()->with('success', 'Satker berhasil dihapus!');
    }
}
