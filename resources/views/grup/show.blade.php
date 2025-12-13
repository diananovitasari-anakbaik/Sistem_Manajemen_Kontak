<x-layout title="Detail Grup">

    <style>
        /* ====== WRAPPER ====== */
        .group-header {
            background: white;
            border-radius: 22px;
            padding: 32px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
            margin-bottom: 28px;
        }

        .group-photo-big {
            width: 120px;
            height: 120px;
            border-radius: 24px;
            object-fit: cover;
            border: 4px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        /* ====== TEXT ====== */
        .group-title {
            font-size: 30px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .group-desc {
            font-size: 15px;
            color: #6b7280;
            max-width: 600px;
        }

        .group-info {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 14px;
            color: #6b7280;
        }

        .group-stats {
            background: #f9fafb;
            padding: 14px 20px;
            border-radius: 14px;
            font-weight: 600;
            color: #374151;
            margin-top: 16px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        /* ====== BUTTON RESET ====== */
        .btn-clean {
            text-decoration: none !important;
            color: inherit;
        }

        /* ====== CUSTOM BUTTONS ====== */
        .btn-edit, .btn-delete, .btn-share {
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
            width: 100%;
            justify-content: center;
            border: none;
            cursor: pointer;
            text-decoration: none !important;
        }

        .btn-edit { background:#6366f1; color:white !important; }
        .btn-delete { background:#ef4444; color:white !important; }
        .btn-share { background:#3b82f6; color:white !important; }

        .btn-edit:hover,
        .btn-delete:hover,
        .btn-share:hover {
            filter: brightness(1.08);
        }

        @media(min-width: 768px){
            .btn-edit, .btn-delete, .btn-share {
                width: auto;
            }
        }

        /* ====== SEARCH BAR ====== */
        .search-box {
            width: 100%;
            padding: 14px 18px;
            border-radius: 14px;
            border: 2px solid #e5e7eb;
            font-size: 15px;
            margin-bottom: 26px;
            transition: .2s;
        }

        .search-box:focus {
            border-color:#6366f1;
            box-shadow:0 0 0 4px rgba(99,102,241,0.15);
        }

        /* ====== MEMBER GRID ====== */
        .member-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px,1fr));
            gap: 22px;
        }

        .member-card {
            background:white;
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 3px 14px rgba(0,0,0,0.07);
            transition: .2s;
        }

        .member-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        }

        .member-photo {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            object-fit: cover;
            border: 3px solid #e5e7eb;
        }

        .modal-content {
            border-radius: 20px !important;
            padding: 25px;
        }
    </style>

    <div class="container mt-4">

        <!-- BACK -->
        <a href="{{ route('grup.index') }}" class="text-muted mb-3 d-inline-block btn-clean">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="group-header">
            <div class="row g-4 align-items-start">

                <!-- FOTO -->
                <div class="col-md-3 text-center text-md-start">
                    <img src="{{ $grup->foto ? asset('storage/'.$grup->foto) : 'https://cdn-icons-png.flaticon.com/512/456/456212.png' }}"
                         class="group-photo-big">
                </div>

                <!-- INFO -->
                <div class="col-md-6">
                    <div class="group-title">{{ $grup->nama }}</div>

                    @if($grup->deskripsi)
                        <div class="group-desc">{{ $grup->deskripsi }}</div>
                    @endif

                    <div class="group-info">
                        <span><i class="bi bi-people"></i> {{ $grup->kontaks->count() }} anggota</span>
                        <span><i class="bi bi-calendar"></i> {{ $grup->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="group-stats mt-3">
                        <i class="bi bi-person-lines-fill text-indigo-600"></i>
                        Total Anggota: <span id="totalAnggota">{{ $grup->kontaks->count() }}</span>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="col-md-3 text-center text-md-end">

                    <a href="{{ route('grup.edit', $grup->id) }}" class="btn-edit btn-clean">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                    <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#hapusModal">
                        <i class="bi bi-trash"></i> Hapus
                    </button>

                    <button class="btn-share" onclick="shareGrup()">
                        <i class="bi bi-share-fill"></i> Share Grup
                    </button>

                </div>
            </div>
        </div>

        <!-- SEARCH -->
        <input type="text" id="searchAnggota" class="search-box"
               placeholder="Cari anggota berdasarkan nama, nomor, atau email...">

        <!-- ANGGOTA -->
        <h4 class="fw-bold mb-3">👥 Daftar Anggota</h4>

        <div class="member-grid" id="anggotaList">

            @foreach($grup->kontaks as $k)
                <div class="member-card anggota-item"
                     data-nama="{{ strtolower($k->nama) }}"
                     data-nomor="{{ strtolower($k->nomor_telepon) }}"
                     data-email="{{ strtolower($k->email) }}">

                    <div class="d-flex align-items-center gap-3">

                        <img src="{{ $k->foto ? asset('storage/'.$k->foto) : 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                             class="member-photo">

                        <div>
                            <div class="fw-bold">{{ $k->nama }}</div>

                            @if($k->nomor_telepon)
                                <div class="text-muted"><i class="bi bi-telephone"></i> {{ $k->nomor_telepon }}</div>
                            @endif

                            @if($k->email)
                                <div class="text-muted"><i class="bi bi-envelope"></i> {{ $k->email }}</div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- MODAL DELETE -->
    <div class="modal fade" id="hapusModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">

                <h3 class="fw-bold mb-2">Hapus Grup?</h3>
                <p class="text-muted">Apakah Anda yakin ingin menghapus <b>{{ $grup->nama }}</b>?</p>

                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>

                    <form method="POST" action="{{ route('grup.destroy', $grup->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger px-4">Hapus</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- SHARE + SEARCH SCRIPT -->
    <script>
        function shareGrup() {
            const shareData = {
                title: "Grup {{ $grup->nama }}",
                text: "Lihat detail grup {{ $grup->nama }}.",
                url: "{{ url('/grup/'.$grup->id) }}",
            };

            if (navigator.share) {
                navigator.share(shareData).catch(()=>{});
            } else {
                navigator.clipboard.writeText(shareData.url).then(() => {
                    let notif = document.createElement("div");
                    notif.innerText = "🔗 Link berhasil disalin!";
                    notif.style = `
                        position:fixed; bottom:20px; right:20px;
                        background:#4f46e5; color:white;
                        padding:10px 18px; border-radius:8px;
                        box-shadow:0 4px 12px rgba(0,0,0,0.2);
                        font-weight:600; z-index:9999;
                    `;
                    document.body.appendChild(notif);
                    setTimeout(()=>notif.remove(),2000);
                });
            }
        }

        // === SEARCH FILTER ===
        document.getElementById('searchAnggota').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const items = document.querySelectorAll('.anggota-item');
            let visible = 0;

            items.forEach(item => {
                const nama = item.dataset.nama;
                const nomor = item.dataset.nomor;
                const email = item.dataset.email;

                if (nama.includes(keyword) || nomor.includes(keyword) || email.includes(keyword)) {
                    item.style.display = "block";
                    visible++;
                } else {
                    item.style.display = "none";
                }
            });

            document.getElementById('totalAnggota').innerText = visible;
        });
    </script>

</x-layout>
