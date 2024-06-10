<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::all();
        return response()->json($data);
    }

    public function create()
    {
        return redirect('http://localhost/frontend/admin/create.html');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_inves' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Data::create([
            'nama_inves' => $request->nama_inves,
            'harga' => $request->harga,
        ]);

        return response()->json(['success' => 'Data berhasil ditambahkan']);
    }

    public function show($id)
    {
        $data = Data::findOrFail($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        $data = Data::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_inves' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $data = Data::findOrFail($id);

        $data->harga_sebelumnya = $data->harga;

        $data->update([
            'nama_inves' => $request->nama_inves,
            'harga' => $request->harga,
        ]);

        return response()->json(['success' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
