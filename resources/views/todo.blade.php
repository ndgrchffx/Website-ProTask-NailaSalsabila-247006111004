<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProTask - Modern Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white shadow-lg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom border-secondary">
                <i class="fas fa-rocket me-2"></i>ProTask
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="/" class="list-group-item list-group-item-action bg-transparent second-text {{ !request('view') ? 'active' : 'text-white-50' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="/?view=projects" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request('view') == 'projects' ? 'active text-white' : 'text-white-50' }}">
                    <i class="fas fa-project-diagram me-2"></i>Projects
                </a>
                <a href="/?view=analytics" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request('view') == 'analytics' ? 'active text-white' : 'text-white-50' }}">
                    <i class="fas fa-chart-line me-2"></i>Analytics
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle" style="cursor: pointer;"></i>
                    <h2 class="fs-2 m-0 fw-bold">Overview</h2>
                </div>
            </nav>

            <div class="row g-4 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="glass-card shadow-lg h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fs-1 fw-bold m-0 text-white">{{ $stats['active'] }}</h3>
                                <p class="text-white-50 m-0 small fw-bold">TUGAS AKTIF</p>
                            </div>
                            <i class="fas fa-tasks fs-2 text-primary opacity-75"></i>
                        </div>
                        <i class="fas fa-tasks faint-icon text-white"></i>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="glass-card shadow-lg h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fs-1 fw-bold m-0 text-danger">{{ $stats['high'] }}</h3>
                                <p class="text-white-50 m-0 small fw-bold">PENTING</p>
                            </div>
                            <i class="fas fa-exclamation-triangle fs-2 text-danger opacity-75"></i>
                        </div>
                        <i class="fas fa-fire faint-icon text-danger"></i>
                    </div>
                </div>

            </div>

            @if($view == 'analytics')
            <div class="row my-4 g-4">
                <div class="col-md-8">
                    <div class="card glass-card border-0 shadow-sm rounded-4 p-4 h-100 position-relative overflow-hidden">
                        <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-chart-pie me-2"></i>Progres Penyelesaian Tugas</h5>
                        @php $percent = $stats['total'] > 0 ? ($stats['completed'] / $stats['total']) * 100 : 0; @endphp
                        <div class="progress mb-3 shadow-sm" style="height: 40px; border-radius: 20px; background: rgba(0,0,0,0.05);">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                style="width: {{ $percent }}%">{{ round($percent) }}%</div>
                        </div>
                        <p class="text-muted mt-2 small">Kamu sudah menyelesaikan <b>{{ $stats['completed'] }}</b> dari <b>{{ $stats['total'] }}</b> total tugas yang ada.</p>
                        <i class="fas fa-chart-area faint-icon"></i>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card glass-card border-0 shadow-sm rounded-4 p-4 mb-3" style="border-left: 5px solid #4f46e5 !important;">
                        <h6 class="fw-bold text-primary"><i class="far fa-lightbulb me-2"></i>Tips Produktivitas</h6>
                        <p class="small text-muted mb-0">"Gunakan teknik 1-3-5: selesaikan 1 tugas besar, 3 tugas sedang, dan 5 tugas kecil setiap hari."</p>
                    </div>
                    <div class="card border-0 shadow-lg rounded-4 p-4 bg-dark text-white position-relative overflow-hidden">
                        <h6 class="small opacity-75 fw-bold mb-2">Quote of the Day</h6>
                        <p class="fst-italic mb-0 small">"The secret of getting ahead is getting started."</p>
                        <i class="fas fa-quote-right position-absolute opacity-25" style="bottom: 10px; right: 15px; font-size: 2rem;"></i>
                    </div>
                </div>
            </div>

            @elseif($view == 'projects')
            <div class="row my-4 g-4">
                <div class="col-md-4">
                    <div class="card glass-card border-0 shadow-sm rounded-4 p-4 border-top border-danger border-5 h-100 position-relative overflow-hidden">
                        <h6 class="text-muted fw-bold small text-uppercase mb-3">Folder Proritas</h6>
                        <h2 class="fw-bold text-danger">{{ $stats['high'] }} <span class="fs-6 text-muted fw-normal">Penting</span></h2>
                        <p class="small text-muted mb-3 mt-2">Daftar tugas krusial yang harus diselesaikan sesegera mungkin.</p>
                        <a href="/?filter=active" class="btn btn-sm btn-danger mt-3 rounded-pill px-4 shadow-sm">Fokus Sekarang</a>
                        <i class="fas fa-fire faint-icon text-danger"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card glass-card border-0 shadow-sm rounded-4 p-4 border-top border-primary border-5 h-100 position-relative overflow-hidden">
                        <h6 class="text-muted fw-bold small text-uppercase mb-3">Daftar Tugas</h6>
                        <h2 class="fw-bold text-primary">{{ $stats['total'] }} <span class="fs-6 text-muted fw-normal">Tasks</span></h2>
                        <p class="small text-muted mb-3 mt-2">Kumpulan seluruh tugas dari semua kategori project Anda.</p>
                        <a href="/" class="btn btn-sm btn-primary mt-3 rounded-pill px-4 shadow-sm">Buka Daftar Tugas</a>
                        <i class="fas fa-layer-group faint-icon text-primary"></i>
                    </div>
                </div>
            </div>

            @else
            <div class="row my-5">
                <div class="col">
                    <div class="card glass-card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold mb-4">Buat Tugas Baru</h5>
                        <form action="/store" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-5">
                                <input type="text" name="tugas" class="form-control custom-input" placeholder="Nama tugas..." required>
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="deadline" class="form-control custom-input">
                            </div>
                            <div class="col-md-2">
                                <select name="priority" class="form-select custom-input">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Tambah Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fs-4 fw-bold m-0">Daftar Tugas</h3>
                <form action="/" method="GET" class="d-flex shadow-sm rounded-3 overflow-hidden">
                    <input type="text" name="search" class="form-control border-0 px-3 custom-input" placeholder="Cari tugas..." value="{{ request('search') }}" style="min-width: 250px;">
                    <button type="submit" class="btn btn-primary border-0 rounded-0 px-3"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-responsive glass-card rounded-4 shadow-sm p-3">
                        <div class="mb-3 d-flex gap-2">
                            <a href="/" class="btn btn-sm {{ !request('filter') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">Semua</a>
                            <a href="/?filter=active" class="btn btn-sm {{ request('filter') == 'active' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">Belum Selesai</a>
                            <a href="/?filter=done" class="btn btn-sm {{ request('filter') == 'done' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">Selesai</a>
                        </div>
                        <table class="table table-hover align-middle">
                            <thead class="bg-white text-dark">
                                <tr>
                                    <th>Status</th>
                                    <th>Nama Tugas</th>
                                    <th>Deadline</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $t)
                                <tr style="{{ ($t->is_completed ?? false) ? 'opacity: 0.5;' : '' }}; border-left: 5px solid {{ $t->priority == 'high' ? '#dc3545' : ($t->priority == 'medium' ? '#ffc107' : '#198754') }};">
                                    <td style="width: 150px;">
                                        <div class="status-indicator {{ ($t->is_completed ?? false) ? 'bg-secondary' : $t->priority }}"></div>
                                        <span class="ms-2 text-capitalize">{{ $t->priority }}</span>
                                    </td>
                                    <td class="{{ ($t->is_completed ?? false) ? 'text-decoration-line-through text-muted' : 'fw-bold' }}">
                                        {{ $t->nama_tugas }}
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold small">
                                                <i class="far fa-clock me-1 text-muted"></i>
                                                {{ $t->deadline ? date('d M, Y', strtotime($t->deadline)) : 'No date' }}
                                            </span>
                                            @if($t->deadline && !$t->is_completed)
                                            @php
                                            $target = \Carbon\Carbon::parse($t->deadline)->startOfDay();
                                            $today = \Carbon\Carbon::now()->startOfDay();
                                            $diff = $today->diffInDays($target, false);
                                            @endphp
                                            @if($diff < 0)
                                                <small class="text-danger fw-bold" style="font-size: 0.7rem;">Lewat {{ abs($diff) }} hari!</small>
                                                @elseif($diff == 0)
                                                <small class="text-warning fw-bold" style="font-size: 0.7rem;">Hari Ini!</small>
                                                @else
                                                <small class="text-success fw-bold" style="font-size: 0.7rem;">{{ $diff }} hari lagi</small>
                                                @endif
                                                @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="/check/{{ $t->id }}" class="btn btn-sm {{ ($t->is_completed ?? false) ? 'btn-success' : 'btn-outline-success' }} border shadow-sm"><i class="fas fa-check"></i></a>
                                            <a href="/edit/{{ $t->id }}" class="btn btn-sm btn-light border text-primary shadow-sm"><i class="fas fa-pen-nib"></i></a>
                                            <a href="/delete/{{ $t->id }}" class="btn btn-sm btn-light border text-danger shadow-sm" onclick="return confirm('Anda Yakin Ingin Menghapus?')"><i class="fas fa-trash-alt"></i></a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">Belum ada tugas.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Logika Alert Sukses (Tambah/Update)
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2500,
            showConfirmButton: false,
            background: 'rgba(15, 23, 42, 0.95)',
            color: '#fff',
            iconColor: '#6366f1',
            backdrop: `rgba(0,0,0,0.5)`
        });
        @endif

        // Logika Alert Konfirmasi Hapus
        function confirmDelete(event, url) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: "Data ini bakal hilang selamanya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: 'rgba(15, 23, 42, 0.95)',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>

</html>