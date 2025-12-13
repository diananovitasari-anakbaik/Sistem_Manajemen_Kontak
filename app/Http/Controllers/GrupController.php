<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GrupController extends Controller
{
    public function index()
    {
        $grups = Grup::with('kontaks')->where('user_id', auth()->id())->latest()->get();
        return view('grup.index', compact('grups'));
    }

    public function create()
    {
        $kontaks = Kontak::where('user_id', auth()->id())->get();
        return view('grup.create', compact('kontaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:grups,nama',
            'foto' => 'nullable|image|max:2048'
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('grup', 'public');
        }

        $grup = Grup::create([
            'user_id'   => auth()->id(),   // FIX PALING PENTING
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto'      => $foto,
        ]);

        if ($request->has('kontak_ids')) {
            $grup->kontaks()->sync($request->kontak_ids);
        }

        return redirect()->route('grup.show', $grup->id)->with('success', 'Grup berhasil dibuat.');
    }

    public function show($id)
    {
        $grup = Grup::with('kontaks')->findOrFail($id);
        return view('grup.show', compact('grup'));
    }

    public function edit($id)
    {
        $grup = Grup::with('kontaks')->findOrFail($id);
        $kontaks = Kontak::where('user_id', auth()->id())->get();

        return view('grup.edit', compact('grup', 'kontaks'));
    }

    public function update(Request $request, $id)
    {
        $grup = Grup::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($grup->foto) {
                Storage::disk('public')->delete($grup->foto);
            }
            $grup->foto = $request->file('foto')->store('grup', 'public');
        }

        $grup->update([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        $grup->kontaks()->sync($request->kontak_ids ?? []);

        return redirect()->route('grup.show', $grup->id)->with('success', 'Grup berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $grup = Grup::findOrFail($id);

        if ($grup->foto) {
            Storage::disk('public')->delete($grup->foto);
        }

        $grup->kontaks()->detach();
        $grup->delete();

        return redirect()->route('grup.index')->with('success', 'Grup berhasil dihapus.');
    }
}
