<?php

namespace App\Http\Controllers\Admin;

use App\Models\Satker;
use App\Models\SubSatker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSatkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subSatkers = SubSatker::with('satker')->get(); // Ambil data sub dengan bapaknya
        $satkers = Satker::all(); // Untuk pilihan dropdown di modal
        return view('admin.subsatker.index', compact('subSatkers', 'satkers'));
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
            'satker_id' => 'required|exists:satkers,id',
            'nama_subdis' => 'required|string|max:255',
        ]);

        SubSatker::create($request->all());

        return redirect()->back()->with('success', 'Sub Satker berhasil ditambahkan gess!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubSatker $subSatker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubSatker $subSatker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubSatker $id)
    {
        $request->validate([
            'satker_id'   => 'required|exists:satkers,id',
            'nama_subdis' => 'required|string|max:255',
        ]);

        $subSatker = SubSatker::findOrFail($id);
        $subSatker->update([
            'satker_id'   => $request->satker_id,
            'nama_subdis' => $request->nama_subdis,
        ]);

        return redirect()->back()->with('success', 'Data Sub Satker berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubSatker $id)
    {
        $subSatker = SubSatker::findOrFail($id);
        $subSatker->delete();

        return redirect()->back()->with('success', 'Sub Satker berhasil dihapus secara permanen!');
    }
}
