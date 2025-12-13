<x-layout title="Daftar Grup">

<style>
    .page-title{
        font-size:30px;
        font-weight:800;
        color:#1f2937;
        display:flex;
        align-items:center;
        gap:10px;
    }

    .btn-create{
        padding:10px 22px;
        border-radius:12px;
        background:linear-gradient(135deg,#667eea,#764ba2);
        color:white !important;
        text-decoration:none !important;
        font-weight:600;
        display:flex;
        align-items:center;
        gap:8px;
        transition:.2s;
    }
    .btn-create:hover{ filter:brightness(1.1); }

    .group-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
        gap:22px;
        margin-top:24px;
    }

    .group-card{
        background:white;
        padding:18px;
        border-radius:16px;
        display:flex;
        gap:14px;
        align-items:center;
        box-shadow:0 3px 12px rgba(0,0,0,0.07);
        text-decoration:none !important;
        color:inherit;
        transition:.2s;
    }
    .group-card:hover{
        transform:translateY(-3px);
        box-shadow:0 6px 18px rgba(0,0,0,0.14);
    }

    .group-photo{
        width:70px;
        height:70px;
        border-radius:18px;
        object-fit:cover;
        background:#f3f4f6;
    }

    .group-name{
        font-size:18px;
        font-weight:700;
        margin-bottom:4px;
        color:#111827;
    }

    .member-badge{
        background:#eef2ff;
        padding:5px 10px;
        border-radius:12px;
        color:#4f46e5;
        font-size:13px;
        display:inline-flex;
        align-items:center;
        gap:6px;
        font-weight:600;
    }

    .date-info{
        font-size:13px;
        color:#6b7280;
        margin-top:4px;
        display:flex;
        align-items:center;
        gap:6px;
    }
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="page-title"><i class="bi bi-collection"></i> Daftar Grup</h1>

        <a href="{{ route('grup.create') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i> Buat Grup Baru
        </a>
    </div>

    <div class="group-grid">
        @foreach ($grups as $g)

        @php
            $foto = $g->foto ? asset('storage/'.$g->foto)
                             : 'https://cdn-icons-png.flaticon.com/512/456/456212.png';
        @endphp

        <a href="{{ route('grup.show', $g->id) }}" class="group-card">

            <img src="{{ $foto }}" class="group-photo">

            <div class="flex-grow-1">
                <div class="group-name">{{ $g->nama }}</div>

                <div class="member-badge">
                    <i class="bi bi-people"></i>
                    {{ $g->kontaks->count() }} anggota
                </div>

                <div class="date-info">
                    <i class="bi bi-calendar"></i>
                    {{ $g->created_at->format('d M Y') }}
                </div>
            </div>

        </a>
        @endforeach
    </div>

</div>

</x-layout>
