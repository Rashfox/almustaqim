@extends('dashboard/master')
@section('title', 'Manajemen User - Majelis Al-Mustaqim')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }
    .section-list-user {
        min-height: 85vh;
        background-color: #f4f6f9;
        padding: 40px 15px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    .card-tabel-kotak {
        background-color: #ffffff;
        border: 1px solid #e3e8ee;
        border-top: 4px solid #198754;
        border-radius: 0px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 35px;
        width: 100%;
        max-width: 1100px;
    }
    .tabel-kotak {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    .tabel-kotak th {
        background-color: #f8fafc;
        color: #2d3748;
        font-weight: 700;
        text-uppercase: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border: 1px solid #e2e8f0;
        padding: 14px;
        text-align: left;
    }
    .tabel-kotak td {
        border: 1px solid #e2e8f0;
        padding: 12px 14px;
        font-size: 0.95rem;
        color: #4a5568;
        vertical-align: middle;
    }
    .tabel-kotak tbody tr:hover {
        background-color: #f8fafc;
    }
    .table-responsive {
        width: 100%;
        margin-bottom: 20px;
    }
    .btn-aksi-wrapper {
        display: flex;
        gap: 8px;
    }
    .btn-kotak-aksi {
        border-radius: 0px !important;
        padding: 8px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
    }
    .btn-aksi-tambah {
        background-color: #198754;
        color: white;
        padding: 12px 20px;
        font-weight: bold;
        text-uppercase: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        border-radius: 0px !important;
    }
    .btn-aksi-tambah:hover { background-color: #146c43; color: white; }
    .btn-aksi-edit { background-color: #ffc107; color: #212529; border: 1px solid #ffc107; }
    .btn-aksi-edit:hover { background-color: #ffca2c; color: #212529; }
    .btn-aksi-hapus { background-color: #dc3545; color: white; border: 1px solid #dc3545; }
    .btn-aksi-hapus:hover { background-color: #bb2d3b; color: white; }

    .custom-overlay-hapus {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        z-index: 99999;
    }

    .custom-overlay-hapus.aktif {
        display: block;
    }

    .box-confirm-hapus {
        max-width: 320px;
        width: 85%;
        margin: 15% auto;
        background: #ffffff;
        padding: 30px 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .overlay-icon-warning {
        width: 50px;
        height: 50px;
        border: 2px solid #facea8;
        color: #f8bb86;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        margin: 0 auto 15px auto;
    }

    .box-confirm-hapus h4 {
        font-size: 18px;
        font-weight: 500;
        color: #595959;
        margin-bottom: 5px;
    }

    .btn-confirm-ya {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-confirm-batal {
        background-color: #3085d6;
        color: white;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 4px;
        cursor: pointer;
    }

    .user-avatar-circle { display: none; }
    .mobile-card-list { display: none; }
    .pagination-custom-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 25px;
        width: 100%;
    }
    .pagination-custom-wrapper nav { display: inline-flex; gap: 6px; }
    .pagination-custom-wrapper nav a, .pagination-custom-wrapper nav span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        text-uppercase: uppercase;
        color: #2d3748;
        background-color: #ffffff;
        border: 1px solid #cbd5e0;
        text-decoration: none;
        transition: all 0.2s;
    }
    .pagination-custom-wrapper nav a:hover { background-color: #f8fafc; color: #198754; border-color: #198754; }
    .pagination-custom-wrapper nav .page-info { background-color: #f8fafc; color: #718096; cursor: default; }
    .pagination-custom-wrapper nav .disabled { color: #a0aec0; background-color: #f1f5f9; border-color: #e2e8f0; cursor: not-allowed; }

    @media (max-width: 991px) { 
        .section-list-user { padding: 20px 10px; }
        .card-tabel-kotak { padding: 25px 20px; }   
        .d-flex.justify-content-between.align-items-center { flex-direction: column; align-items: flex-start !important; gap: 15px; }
        .btn-aksi-tambah { width: 100%; justify-content: center; margin-bottom: 10px; }
        .pagination-custom-wrapper nav a, .pagination-custom-wrapper nav span { padding: 8px 12px; font-size: 0.75rem; }
    }

    @media (min-width: 577px) and (max-width: 991px) {
        .table-responsive { display: block; width: 100%; overflow-x: auto; border: 1px solid #e2e8f0; }
        .tabel-kotak { margin-top: 0; }
        .mobile-card-list { display: none; }
        .btn-aksi-tambah { width: auto !important; margin-bottom: 0; }
        .d-flex.justify-content-between.align-items-center { flex-direction: row; align-items: center !important; }
    }

    @media (max-width: 576px) {
        .table-responsive { display: none; }
        .mobile-card-list { display: flex; flex-direction: column; gap: 15px; margin-bottom: 20px; width: 100%; }
        .mobile-user-card { background-color: #ffffff; border: 1px solid #e2e8f0; padding: 15px; display: flex; flex-direction: column; gap: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .mobile-user-header { display: flex; align-items: center; gap: 12px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }
        .mobile-user-info { display: flex; flex-direction: column; gap: 4px; }
        .mobile-user-name { font-size: 1rem; font-weight: 700; color: #2d3748; }
        .mobile-user-detail { font-size: 0.85rem; color: #4a5568; }
        .mobile-card-actions { display: flex; gap: 10px; margin-top: 5px; }
        .mobile-card-actions .btn-kotak-aksi { flex: 1; justify-content: center; padding: 10px; }
        .btn-aksi-tambah { width: 100% !important; }
    }
</style>

<div class="section-list-user">
    <div class="card-tabel-kotak">
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h4 class="fw-bold text-dark mb-0 text-uppercase" style="letter-spacing: 0.5px; font-size: 1.1rem;">
                <i class="bx bx-user align-middle me-1"></i> Manajemen User
            </h4>
            <a href="/dashboard/user/tambah" class="btn-aksi-tambah shadow-sm">
                <i class="bx bx-user-plus align-middle fs-5 me-1"></i> Tambah User
            </a>
        </div>

        <div class="table-responsive">
            <table class="tabel-kotak">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Lengkap</th>
                        <th style="width: 20%;">Username</th>
                        <th style="width: 25%;">Email</th>
                        <th style="width: 25%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($users) > 0)
                        @php $no = ($users->currentPage() - 1) * $users->perPage() + 1; @endphp
                        @foreach($users as $u)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td class="fw-semibold text-dark">{{ $u->nama }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td style="text-align: center;">
                                <div class="btn-aksi-wrapper justify-content-center">
                                    <a href="/dashboard/user/edit/{{ $u->id }}" class="btn-kotak-aksi btn-aksi-edit" title="Edit User">
                                        <i class="bx bx-edit fs-6 me-1"></i> Edit
                                    </a>
                                    <button type="button" class="btn-kotak-aksi btn-aksi-hapus btnTriggerHapus" 
                                            data-id="{{ $u->id }}" 
                                            data-nama="{{ $u->nama }}" 
                                            title="Hapus User" style="border: none;">
                                        <i class="bx bx-trash fs-6 me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;" class="text-muted">
                                <i class="bx bx-folder-open fs-3 d-block mb-2"></i> Belum ada data user tersedia.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- CARD VIEW (MOBILE) --}}
        <div class="mobile-card-list">
            @if(count($users) > 0)
                @foreach($users as $u)
                    <div class="mobile-user-card">
                        <div class="mobile-user-header">
                            <div class="mobile-user-info">
                                <span class="mobile-user-name">{{ $u->nama }}</span>
                                <span class="text-muted" style="font-size: 0.8rem;">@ {{ $u->username }}</span>
                            </div>
                        </div>
                        
                        <div class="mobile-user-detail">
                            <i class="bx bx-envelope align-middle me-1 text-muted"></i> {{ $u->email }}
                        </div>
                        
                        <div class="mobile-card-actions">
                            <a href="/dashboard/user/edit/{{ $u->id }}" class="btn-kotak-aksi btn-aksi-edit">
                                <i class="bx bx-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn-kotak-aksi btn-aksi-hapus btnTriggerHapus" 
                                    data-id="{{ $u->id }}" 
                                    data-nama="{{ $u->nama }}" 
                                    style="border: none;">
                                <i class="bx bx-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-muted" style="padding: 20px 0;">
                    <i class="bx bx-folder-open fs-3 d-block mb-2"></i> Belum ada data user tersedia.
                </div>
            @endif
        </div>

        {{-- PAGINATION --}}
        <div class="pagination-custom-wrapper">
            <nav>
                @if ($users->onFirstPage())
                    <span class="disabled">« Previous</span>
                @else
                    <a href="{{ $users->previousPageUrl() }}&per_page={{ request()->cookie('per_page', 5) }}">« Previous</a>
                @endif

                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    @if ($page == $users->currentPage())
                        <span class="page-info" style="background-color: #198754; color: white; border-color: #198754;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}&per_page={{ request()->cookie('per_page', 5) }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}&per_page={{ request()->cookie('per_page', 5) }}">Next »</a>
                @else
                    <span class="disabled">Next »</span>
                @endif
            </nav>
        </div>

    </div>
</div>

<div id="customOverlayHapus" class="custom-overlay-hapus">
    <div class="box-confirm-hapus">
        <div class="overlay-icon-warning">!</div>
        <h4>Yakin hapus data?</h4>
        <p id="overlayNamaUser" class="text-muted small mb-4" style="font-size: 14px; margin-top: 5px;"></p>
        
        <div class="d-flex gap-2 justify-content-center">
            <button type="button" id="btnYesHapus" class="btn-confirm-ya">Ya</button>
            <button type="button" id="btnCancelHapus" class="btn-confirm-batal">Batal</button>
        </div>
    </div>
</div>

<script>
    (function() {
        const targetPerPage = window.innerWidth < 768 ? 3 : 5;
        const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
            const [name, value] = cookie.split('=');
            acc[name] = value;
            return acc;
        }, {});

        if (cookies['per_page'] !== String(targetPerPage)) {
            document.cookie = "per_page=" + targetPerPage + "; path=/; max-age=" + (30 * 24 * 60 * 60);
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('page')) {
                urlParams.set('page', 1);
            }
            urlParams.set('per_page', targetPerPage);
            window.location.search = urlParams.toString();
        }

        const overlay = document.getElementById('customOverlayHapus');
        const overlayNama = document.getElementById('overlayNamaUser');
        const btnCancel = document.getElementById('btnCancelHapus');
        const btnYes = document.getElementById('btnYesHapus');
        let targetIdHapus = null;

        document.querySelectorAll('.btnTriggerHapus').forEach(button => {
            button.addEventListener('click', function() {
                targetIdHapus = this.getAttribute('data-id');
                const namaUser = this.getAttribute('data-nama');

                overlayNama.textContent = `User: ${namaUser}`;
                overlay.classList.add('aktif');
            });
        });

        // Tutup saat klik Batal
        btnCancel.addEventListener('click', function() {
            overlay.classList.remove('aktif');
        });

        // Tutup saat klik area hitam di luar box
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('aktif');
            }
        });

        // Eksekusi "Ya" dengan Form Virtual Method DELETE Laravel
        btnYes.addEventListener('click', function() {
            if (targetIdHapus) {
                overlay.classList.remove('aktif');

                const form = document.createElement('form');
                form.method = 'POST';
                // Diarahkan ke routing delete user milikmu
                form.action = `/dashboard/user/delete/${targetIdHapus}`;
                form.style.display = 'none';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                
                form.submit();
            }
        });
    })();
</script>
@endsection