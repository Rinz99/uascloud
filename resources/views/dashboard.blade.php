<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Inventori Lab</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
        }

        .quote-card {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            border-radius: 16px;
        }

        .quote-card h5 {
            font-weight: 600;
            letter-spacing: .3px;
        }

        .card {
            border-radius: 16px;
            border: none;
        }

        .btn-rounded {
            border-radius: 30px;
            padding: 8px 20px;
        }

        table thead {
            background-color: #1f2933;
            color: #fff;
        }

        table tbody tr:hover {
            background-color: #f1f5f9;
            transition: .2s;
        }

        .badge-kondisi {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: .85rem;
        }

        .badge-baik {
            background: #dcfce7;
            color: #166534;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand fw-semibold">
                <i class="bi bi-box-seam"></i> Inventori Alat Laboratorium
            </span>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-light btn-sm btn-rounded">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container my-4">

        <!-- QUOTE -->
        @if(isset($quote))
            <div class="card quote-card mb-4 shadow-sm">
                <div class="card-body text-center py-4">
                    <h5 class="mb-3">
                        <i class="bi bi-quote"></i> Quote Hari Ini
                    </h5>
                    <p class="fs-5 fst-italic mb-2">
                        “{{ $quote['text'] }}”
                    </p>
                    <small class="opacity-75">
                        — {{ $quote['author'] ?? 'Anonim' }}
                    </small>
                </div>
            </div>
        @endif

        <!-- ACTION -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">📋 Data Inventori</h5>
            <a href="/form-data" class="btn btn-success btn-rounded shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Inventori
            </a>
        </div>

        <!-- TABLE -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Stok</th>
                                <th>Lokasi</th>
                                <th>Kondisi</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if(!empty($data))
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item['nama_alat'] ?? '-' }}</td>
                                        <td>{{ $item['kode_alat'] ?? '-' }}</td>
                                        <td>{{ $item['stok'] ?? '-' }}</td>
                                        <td>{{ $item['lokasi'] ?? '-' }}</td>
                                        <td>
                                            <span class="badge-kondisi badge-baik">
                                                {{ $item['kondisi'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $item['petugas'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        Belum ada data inventori
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
