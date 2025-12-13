<x-layout title="Edit Grup">

<style>
/* PAGE TITLE */
.page-title{
    font-size:28px;
    font-weight:800;
    color:#1f2937;
    display:flex;
    align-items:center;
    gap:10px;
}

/* CARD & FORM */
.card-modern{
    background:white;
    border-radius:18px;
    padding:26px;
    box-shadow:0 4px 14px rgba(0,0,0,0.08);
}
.form-control-modern{
    border-radius:12px;
    border:2px solid #e5e7eb;
    padding:12px 16px;
    transition:.2s;
}
.form-control-modern:focus{
    border-color:#6366f1;
    box-shadow:0 0 0 4px rgba(99,102,241,0.15);
}
.photo-preview{
    width:70px;
    height:70px;
    border-radius:18px;
    object-fit:cover;
    border:3px solid #e5e7eb;
}

/* MEMBER SECTION */
.members-section{
    background:#f8f9fa;
    border-radius:14px;
    padding:18px;
    margin-bottom:20px;
}
.section-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:16px;
    padding-bottom:12px;
    border-bottom:2px solid #e5e7eb;
}
.section-title{
    font-size:16px;
    font-weight:700;
    color:#1f2937;
    display:flex;
    align-items:center;
    gap:8px;
}
.counter-badge{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    padding:4px 12px;
    font-size:13px;
    border-radius:16px;
    font-weight:600;
}

/* MEMBERS GRID */
.members-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));
    gap:12px;
    margin-top:12px;
}
.member-card{
    background:white;
    border-radius:12px;
    padding:14px;
    display:flex;
    align-items:center;
    gap:12px;
    box-shadow:0 2px 8px rgba(0,0,0,0.06);
    transition:.2s;
    position:relative;
}
.member-card:hover{
    box-shadow:0 4px 12px rgba(0,0,0,0.12);
    transform:translateY(-2px);
}
.member-avatar{
    width:45px;
    height:45px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #f3f4f6;
}
.member-info{
    flex:1;
    min-width:0;
}
.member-name{
    font-weight:600;
    color:#1f2937;
    font-size:14px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}
.member-phone{
    font-size:12px;
    color:#6b7280;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}
.remove-btn{
    background:#fee2e2;
    color:#dc2626;
    border:none;
    border-radius:50%;
    width:28px;
    height:28px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.2s;
    font-size:18px;
    font-weight:600;
    flex-shrink:0;
}
.remove-btn:hover{
    background:#fecaca;
    transform:scale(1.1);
}
.empty-state{
    text-align:center;
    padding:30px;
    color:#9ca3af;
    grid-column: 1 / -1;
    justify-self: center;
    max-width:250px;
}
.empty-state i{
    font-size:48px;
    margin-bottom:12px;
    opacity:0.5;
}

/* SEARCH BOX */
.add-member-box{
    background:white;
    border-radius:12px;
    padding:16px;
    margin-top:16px;
    border:2px solid #e5e7eb;
}
.search-label{
    font-size:14px;
    font-weight:600;
    color:#374151;
    margin-bottom:8px;
    display:flex;
    align-items:center;
    gap:6px;
}
.search-box{
    padding:12px 16px;
    border-radius:10px;
    border:2px solid #e5e7eb;
    width:100%;
    transition:.2s;
}
.search-box:focus{
    border-color:#6366f1;
    box-shadow:0 0 0 4px rgba(99,102,241,0.15);
}
.dropdown-list{
    display:none;
    position:absolute;
    width:100%;
    background:white;
    border-radius:12px;
    box-shadow:0 8px 22px rgba(0,0,0,0.15);
    max-height:300px;
    overflow-y:auto;
    margin-top:6px;
    z-index:50;
    padding:6px 0;
}
.dropdown-item-custom{
    padding:12px 14px;
    display:flex;
    gap:14px;
    align-items:center;
    cursor:pointer;
    transition:.15s;
}
.dropdown-item-custom:hover{
    background:#eef2ff;
}

/* BUTTONS */
.btn-primary-modern{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white !important;
    padding:10px 22px;
    border-radius:12px;
    font-weight:600;
    border:none;
}
.btn-secondary-modern{
    background:#f3f4f6;
    color:#374151 !important;
    padding:10px 22px;
    border-radius:12px;
    font-weight:600;
}
</style>

<div class="container mt-4">
    <a href="{{ route('grup.index') }}" class="text-muted text-decoration-none d-inline-block mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <h1 class="page-title">Edit Grup — {{ $grup->nama }}</h1>

    <div class="card-modern mt-3">

        <form method="POST" action="{{ route('grup.update', $grup->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <label class="fw-semibold mb-1">Nama Grup</label>
            <input name="nama" class="form-control form-control-modern mb-3" value="{{ $grup->nama }}" required>

            <!-- DESKRIPSI -->
            <label class="fw-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="form-control form-control-modern mb-3">{{ $grup->deskripsi }}</textarea>

            <!-- FOTO -->
            <label class="fw-semibold mb-1">Foto Grup</label>
            <div class="d-flex align-items-center gap-3 mb-4">
                <img id="previewFoto" src="{{ $grup->foto ? asset('storage/'.$grup->foto) : 'https://cdn-icons-png.flaticon.com/512/456/456212.png' }}" class="photo-preview">
                <input type="file" name="foto" class="form-control form-control-modern" accept="image/*" onchange="previewImage(event)">
            </div>

            <hr>

            <!-- ANGGOTA SECTION -->
            <div class="members-section">

                <div class="section-header mb-3">
                    <div class="section-title">
                        <i class="bi bi-people-fill"></i>
                        Anggota Grup
                    </div>
                    <span id="memberCounter" class="counter-badge">{{ $grup->kontaks->count() }} anggota</span>
                </div>

                <!-- MEMBER GRID -->
                <div id="selectedMembers" class="members-grid"></div>
                <div id="hiddenInputs"></div>

                <!-- ADD MEMBER -->
                <div class="add-member-box mt-4">
                    <div class="search-label">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambahkan anggota baru ke grup
                    </div>
                    <div class="position-relative">
                        <input id="searchInput" type="text" class="search-box" placeholder="Cari kontak...">
                        <div id="dropdownList" class="dropdown-list"></div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('grup.index') }}" class="btn-secondary-modern">Batal</a>
                <button class="btn-primary-modern">Simpan</button>
            </div>

        </form>
    </div>
</div>

<script>
const allKontak = @json($kontaks);
let selected = @json($grup->kontaks);

const selectedContainer = document.getElementById('selectedMembers');
const dropdown = document.getElementById('dropdownList');
const search = document.getElementById('searchInput');
const hiddenInputs = document.getElementById('hiddenInputs');
const counter = document.getElementById('memberCounter');

render();

function render(){
    selectedContainer.innerHTML = "";
    hiddenInputs.innerHTML = "";

    if(selected.length === 0){
        selectedContainer.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <div>Belum ada anggota dalam grup ini</div>
                <small style="color:#9ca3af;">Gunakan pencarian di bawah untuk menambah anggota</small>
            </div>
        `;
        counter.textContent = "0 anggota";
        return;
    }

    selected.forEach(k=>{
        const foto = k.foto ? "/storage/"+k.foto : "https://cdn-icons-png.flaticon.com/512/847/847969.png";

        selectedContainer.innerHTML += `
            <div class="member-card">
                <img src="${foto}" class="member-avatar">
                <div class="member-info">
                    <div class="member-name">${k.nama}</div>
                    <div class="member-phone">${k.nomor_telepon ?? "No telepon"}</div>
                </div>
                <button type="button" class="remove-btn" onclick="removeKontak(${k.id})" title="Hapus dari grup">×</button>
            </div>
        `;

        hiddenInputs.innerHTML += `<input type="hidden" name="kontak_ids[]" value="${k.id}">`;
    });

    counter.textContent = selected.length + " anggota";
}

function showDropdown(keyword=""){
    keyword = keyword.toLowerCase();
    dropdown.innerHTML = "";
    dropdown.style.display = "block";

    const filtered = allKontak.filter(k =>
        !selected.some(s => s.id === k.id) &&
        (
            (k.nama && k.nama.toLowerCase().includes(keyword)) ||
            (k.nomor_telepon && k.nomor_telepon.toLowerCase().includes(keyword))
        )
    );

    if(filtered.length === 0){
        dropdown.innerHTML = `<div class="p-3 text-center text-muted">Tidak ada hasil</div>`;
        return;
    }

    filtered.forEach(k=>{
        const foto = k.foto ? "/storage/"+k.foto : "https://cdn-icons-png.flaticon.com/512/847/847969.png";

        dropdown.innerHTML += `
            <div class="dropdown-item-custom" onclick="addKontak(${k.id})">
                <img src="${foto}" width="38" height="38" style="border-radius:50%; object-fit:cover;">
                <div>
                    <div class="fw-semibold">${k.nama}</div>
                    <div class="text-muted small">${k.nomor_telepon ?? "-"}</div>
                </div>
            </div>
        `;
    });
}

function addKontak(id){
    const k = allKontak.find(x => x.id === id);
    if(!k) return;
    selected.push(k);
    dropdown.style.display = "none";
    search.value = "";
    render();
}

function removeKontak(id){
    selected = selected.filter(k => k.id !== id);
    render();
}

search.addEventListener('focus', ()=> showDropdown(""));
search.addEventListener('input', ()=> showDropdown(search.value));

document.addEventListener('click', function(e){
    if(!search.contains(e.target) && !dropdown.contains(e.target)){
        dropdown.style.display = "none";
    }
});

function previewImage(e){
    const file = e.target.files[0];
    if(!file) return;
    const reader = new FileReader();
    reader.onload = ev => document.getElementById('previewFoto').src = ev.target.result;
    reader.readAsDataURL(file);
}
</script>

</x-layout>
