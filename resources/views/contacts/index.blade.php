<x-layout title="Kontak">

{{-- ========== DATA TABLE CSS ========== --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>

    /* WRAPPER CARD */
    .card-modern {
        background: white;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        border: none;
    }

    /* HEADER BUTTON */
    .btn-primary-modern {
        background: linear-gradient(135deg,#667eea,#764ba2);
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        color: white !important;
        text-decoration: none !important;
        transition: .2s;
    }
    .btn-primary-modern:hover {
        filter: brightness(1.1);
        transform: translateY(-2px);
    }

    /* TABLE HEADER */
    table.dataTable thead th {
        text-align: center;
        background: #eef2ff;
        font-weight: 700;
        padding: 14px 10px !important;
        font-size: 15px;
    }

    table.dataTable tbody td {
        vertical-align: middle;
        text-align: center;
        font-size: 14.5px;
    }

    .table-photo {
        width: 45px; 
        height: 45px; 
        border-radius: 50%; 
        object-fit: cover;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    /* ACTION BUTTONS */
    .btn-action {
        padding: 6px 10px;
        border-radius: 10px;
        font-size: 13px;
        border: none;
        transition: .15s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        opacity: .9;
    }

    .btn-soft-delete {
        background: #fee2e2;
        color: #dc2626;
    }
    .btn-soft-delete:hover {
        background: #fecaca;
    }

    /* MOBILE RESPONSIVE */
    @media(max-width: 768px){
        .btn-primary-modern { width: 100%; margin-top: 10px; }
        .table-responsive-wrapper { overflow-x: auto; }
        table.dataTable thead th, table.dataTable td { white-space: nowrap; }
    }

    /* CUSTOM DELETE MODAL */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.35);
        backdrop-filter: blur(4px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-box {
        background: white;
        width: 420px;
        max-width: 90%;
        padding: 34px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.18);
        animation: fadeUp .25s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(25px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #1f2937;
    }

    .modal-text {
        margin-top: 6px;
        font-size: 15px;
        color: #6b7280;
    }

    .modal-actions {
        margin-top: 22px;
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .btn-cancel {
        background: #f3f4f6;
        border: none;
        padding: 10px 22px;
        border-radius: 12px;
        font-weight: 600;
    }
    .btn-cancel:hover { background:#e5e7eb; }

    .btn-delete {
        background:#e74c3c;
        border: none;
        padding: 10px 22px;
        color:white;
        border-radius: 12px;
        font-weight: 600;
    }
    .btn-delete:hover { background:#c0392b; }

</style>

<div class="container mt-4">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <h3 class="fw-bold m-0 d-flex align-items-center gap-2">
            <i class="bi bi-people-fill text-primary"></i>
            Manajemen Kontak
        </h3>

        <a href="{{ route('kontak.create') }}" class="btn-primary-modern">
            + Tambah Kontak
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="card-modern">

        <div class="table-responsive-wrapper">

            <table id="kontakTable" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($contacts as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <img src="{{ $c->foto ? asset('storage/'.$c->foto) : 'https://ui-avatars.com/api/?name='.$c->nama.'&rounded=true&size=50' }}"
                                 class="table-photo">
                        </td>

                        <td>{{ $c->nama }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->nomor_telepon }}</td>
                        <td>{{ $c->alamat }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                {{-- SHOW --}}
                                <a href="{{ route('kontak.show',$c->id) }}" 
                                   class="btn btn-info text-white btn-action">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('kontak.edit',$c->id) }}" 
                                   class="btn btn-warning btn-action">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- DELETE --}}
                                <button class="btn-soft-delete btn-action"
                                        onclick="openDeleteModal({{ $c->id }}, '{{ $c->nama }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
</div>


{{-- DELETE MODAL --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">

        <div class="modal-title">Hapus Kontak?</div>
        <p class="modal-text">Apakah Anda yakin ingin menghapus <b id="deleteName"></b>?</p>

        <form id="deleteForm" method="POST">
            @csrf @method("DELETE")

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="submit" class="btn-delete">Hapus</button>
            </div>
        </form>

    </div>
</div>



{{-- DATATABLE JS --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>

    $('#kontakTable').DataTable({
        pageLength: 10,
        responsive: true,
        autoWidth: false,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ kontak",
            zeroRecords: "Tidak ditemukan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ kontak",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(disaring dari _MAX_ total)"
        }
    });

    function openDeleteModal(id, name){
        document.getElementById("deleteModal").style.display = "flex";
        document.getElementById("deleteName").innerText = name;
        document.getElementById("deleteForm").action = `/kontak/${id}`;
    }

    function closeDeleteModal(){
        document.getElementById("deleteModal").style.display = "none";
    }

</script>

</x-layout>
