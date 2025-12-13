<x-layout title="Edit Kontak">

<style>
    .main-container { max-width: 900px; margin: 40px auto; }
    .card-modern { background:white; border-radius:16px; padding:40px; box-shadow:0 3px 14px rgba(0,0,0,0.12); }

    .photo-preview {
        width:130px; height:130px; border-radius:50%;
        object-fit:cover; border:4px solid #e5e7eb;
        margin-bottom:10px;
    }

    .form-label-modern {
        font-weight:600; color:#374151; margin-bottom:4px;
    }

    .form-control-modern {
        border-radius:14px;
        border:2px solid #e5e7eb;
        padding:12px 16px;
        width:100%;
        transition:.25s;
    }
    .form-control-modern:focus {
        border-color:#6366f1; box-shadow:0 0 0 4px rgba(99,102,241,.2);
    }

    .btn-primary-modern {
        padding:12px 28px; border-radius:12px;
        background:linear-gradient(135deg,#667eea,#764ba2);
        border:none; font-weight:600; color:white;
    }

    .btn-secondary-modern {
        padding:12px 28px; border-radius:12px;
        background:#f3f4f6; color:#4b5563; font-weight:600;
        border:none;
    }

    /* MOBILE FIX */
    @media(max-width: 768px) {
        .card-modern { padding:25px; }
        .photo-preview { width:110px; height:110px; }
    }
</style>

<div class="main-container">
    <div class="card-modern">

        <h2 class="fw-bold mb-4">Edit Kontak</h2>

        <form method="POST" action="{{ route('kontak.update', $kontak->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="text-center mb-4">
                <img src="{{ $kontak->foto ? asset('storage/'.$kontak->foto) : 'https://ui-avatars.com/api/?name='.urlencode($kontak->nama).'&size=130' }}"
                     class="photo-preview">
            </div>

            <div class="row g-4">

                {{-- NAMA --}}
                <div class="col-12 col-md-6">
                    <label class="form-label-modern">Nama Kontak</label>
                    <input type="text" name="nama" class="form-control-modern" value="{{ $kontak->nama }}" required>
                </div>

                {{-- EMAIL --}}
                <div class="col-12 col-md-6">
                    <label class="form-label-modern">Email</label>
                    <input type="email" name="email" class="form-control-modern" value="{{ $kontak->email }}" required>
                </div>

                {{-- NOMOR --}}
                <div class="col-12 col-md-6">
                    <label class="form-label-modern">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control-modern" value="{{ $kontak->nomor_telepon }}" required>
                </div>

                {{-- ALAMAT --}}
                <div class="col-12 col-md-6">
                    <label class="form-label-modern">Alamat</label>
                    <input type="text" name="alamat" class="form-control-modern" value="{{ $kontak->alamat }}">
                </div>

                {{-- FOTO --}}
                <div class="col-12">
                    <label class="form-label-modern">Foto Baru (Opsional)</label>
                    <input type="file" name="foto" class="form-control-modern">
                </div>

            </div>

            <div class="d-flex justify-content-between mt-5">
                <a href="{{ route('kontak.index') }}" class="btn btn-secondary-modern">Batal</a>
                <button class="btn btn-primary-modern">Perbarui</button>
            </div>

        </form>

    </div>
</div>

</x-layout>
