<x-layout>

    <style>
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .icon-purple { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .icon-green { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }

        .action-btn {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #1f2937;
            font-weight: 600;
        }

        .action-btn:hover {
            border-color: #667eea;
            background: #f8f9ff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .icon-blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .icon-orange { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
    </style>



    {{-- QUICK STATS FIXED --}}
    <div class="quick-stats">

        {{-- Total Kontak --}}
        <div class="stat-card">
            <div class="stat-icon icon-purple text-white">
                👤
            </div>
            <h3 class="fw-bold mb-1" style="font-size: 2rem;">
                {{ $totalKontak ?? 0 }}
            </h3>
            <p class="text-muted mb-0">Total Kontak</p>
        </div>

        {{-- Total Grup --}}
        <div class="stat-card">
            <div class="stat-icon icon-green text-white">
                👥
            </div>
            <h3 class="fw-bold mb-1" style="font-size: 2rem;">
                {{ $totalGrup ?? 0 }}
            </h3>
            <p class="text-muted mb-0">Total Grup</p>
        </div>

    </div>



    {{-- ACTION BUTTONS --}}
    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4" style="color: #1f2937;">⚡ Aksi Cepat</h4>

            <div class="row g-3">
                <div class="col-md-6">
                    <a href="{{ route('kontak.create') }}" class="action-btn w-100">
                        <div class="action-icon icon-purple text-white">
                            ➕
                        </div>
                        <div>
                            <div class="fw-bold">Tambah Kontak</div>
                            <small class="text-muted">Buat kontak baru</small>
                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="{{ route('grup.create') }}" class="action-btn w-100">
                        <div class="action-icon icon-green text-white">
                            📁
                        </div>
                        <div>
                            <div class="fw-bold">Tambah Grup</div>
                            <small class="text-muted">Organisir kontak dalam grup</small>
                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="{{ route('kontak.index') }}" class="action-btn w-100">
                        <div class="action-icon icon-blue text-white">
                            📋
                        </div>
                        <div>
                            <div class="fw-bold">Lihat Kontak</div>
                            <small class="text-muted">Daftar semua kontak</small>
                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="{{ route('grup.index') }}" class="action-btn w-100">
                        <div class="action-icon icon-orange text-white">
                            🗂️
                        </div>
                        <div>
                            <div class="fw-bold">Lihat Grup</div>
                            <small class="text-muted">Kelola grup kontak</small>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

</x-layout>
