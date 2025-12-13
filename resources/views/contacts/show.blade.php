<x-layout title="Detail Kontak">

<style>
    .contact-card {
        background: white;
        padding: 40px 28px;
        border-radius: 22px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        max-width: 650px;
        margin: 40px auto;
    }

    .contact-photo {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .name {
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .info-line {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 15px;
        color: #4b5563;
    }

    /* Tombol aksi */
    .action-btn {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        transition: .25s;
        border: 2px solid transparent;
    }

    .action-call {
        border-color: #2563eb;
        color: #2563eb;
    }
    .action-call:hover { background:#2563eb; color:white; }

    .action-wa {
        border-color: #16a34a;
        color: #16a34a;
    }
    .action-wa:hover { background:#16a34a; color:white; }

    .action-mail {
        border-color: #4b5563;
        color: #4b5563;
    }
    .action-mail:hover { background:#4b5563; color:white; }

    .section-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 6px;
        color: #374151;
    }

    .address-box {
        background: #f9fafb;
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid #e5e7eb;
        font-size: 15px;
        color: #374151;
    }

</style>


<div class="contact-card">

    {{-- Kembali --}}
    <a href="{{ route('kontak.index') }}" class="text-muted d-flex align-items-center mb-3"
       style="text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>

    {{-- Foto --}}
    <div class="text-center">
        <img src="{{ $kontak->foto ? asset('storage/'.$kontak->foto) : 'https://ui-avatars.com/api/?name='.urlencode($kontak->nama).'&rounded=true&size=100' }}"
             class="contact-photo mb-3">
    </div>

    {{-- Nama --}}
    <div class="text-center name">{{ $kontak->nama }}</div>

    {{-- Telepon --}}
    @if($kontak->nomor_telepon)
    <div class="info-line mt-2">
        <i class="bi bi-telephone"></i>
        {{ $kontak->nomor_telepon }}
    </div>
    @endif

    {{-- Email --}}
    @if($kontak->email)
    <div class="info-line mt-1">
        <i class="bi bi-envelope"></i>
        {{ $kontak->email }}
    </div>
    @endif

    {{-- Tombol aksi --}}
    <div class="d-flex justify-content-center gap-3 mt-4 mb-4">
        <a href="tel:{{ $kontak->nomor_telepon }}" class="action-btn action-call">
            <i class="bi bi-telephone-fill"></i>
        </a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$kontak->nomor_telepon) }}"
           target="_blank" class="action-btn action-wa">
            <i class="bi bi-whatsapp"></i>
        </a>
        <a href="mailto:{{ $kontak->email }}" class="action-btn action-mail">
            <i class="bi bi-envelope-fill"></i>
        </a>
    </div>

    <hr>

    {{-- Alamat --}}
    @if($kontak->alamat)
    <div class="mt-4">
        <div class="section-title">Alamat</div>
        <div class="address-box">{{ $kontak->alamat }}</div>
    </div>
    @endif

</div>

</x-layout>
