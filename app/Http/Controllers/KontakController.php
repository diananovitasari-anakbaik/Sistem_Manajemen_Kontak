<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    // ========== INDEX (Dengan Search) ==========
    public function index(Request $request)
    {
        $search = $request->search;

        $contacts = Kontak::where('user_id', auth()->id())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('nomor_telepon', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    // ========== CREATE ==========
    public function create()
    {
        return view('contacts.create');
    }

    // ========== STORE ==========
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'email'          => 'nullable|email',
            'alamat'         => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id'        => auth()->id(),
            'nama'           => $request->nama,
            'nomor_telepon'  => $request->nomor_telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        Kontak::create($data);

        return redirect()->route('kontak.index')->with('success', 'Kontak berhasil ditambahkan.');
    }

    // ========== SHOW ==========
    public function show(Kontak $kontak)
    {
        $this->authorizeAccess($kontak);
        return view('contacts.show', compact('kontak'));
    }

    // ========== EDIT ==========
    public function edit(Kontak $kontak)
    {
        $this->authorizeAccess($kontak);
        return view('contacts.edit', compact('kontak'));
    }

    // ========== UPDATE ==========
    public function update(Request $request, Kontak $kontak)
    {
        $this->authorizeAccess($kontak);

        $request->validate([
            'nama'           => 'required|string|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'email'          => 'nullable|email',
            'alamat'         => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama'           => $request->nama,
            'nomor_telepon'  => $request->nomor_telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
        ];

        if ($request->hasFile('foto')) {

            if ($kontak->foto && Storage::disk('public')->exists($kontak->foto)) {
                Storage::disk('public')->delete($kontak->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $kontak->update($data);

        return redirect()->route('kontak.index')->with('success', 'Kontak berhasil diupdate.');
    }

    // ========== DELETE ==========
    public function destroy(Kontak $kontak)
    {
        $this->authorizeAccess($kontak);

        if ($kontak->foto && Storage::disk('public')->exists($kontak->foto)) {
            Storage::disk('public')->delete($kontak->foto);
        }

        $kontak->delete();

        return redirect()->route('kontak.index')->with('success', 'Kontak berhasil dihapus.');
    }

    // ========== VALIDASI PEMILIK DATA ==========
    protected function authorizeAccess(Kontak $kontak)
    {
        if ($kontak->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }
    }

    
}

