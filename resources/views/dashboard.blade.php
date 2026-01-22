<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Inventori Lab</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .quote-box {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: white;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">Inventori Alat Laboratorium</span>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">

        @if(isset($quote))
            <div class="card mb-4 shadow" style="background:#0d6efd;color:white;">
                <div class="card-body text-center">
                    <h5 class="mb-3">📌 Quote Hari Ini</h5>
                    <blockquote class="blockquote mb-0">
                        <p>"{{ $quote['text'] }}"</p>
                        <footer class="blockquote-footer text-white mt-2">
                            {{ $quote['author'] ?? 'Anonim' }}
                        </footer>
                    </blockquote>
                </div>
            </div>
        @endif

        <div class="mb-3">
            <a href="/form-data" class="btn btn-success">
                + Tambah Inventori
            </a>
        </div>

        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                Data Inventori Alat Lab
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
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
                    <tbody id="inventori-body">
                        @php $no = 1; @endphp
                        @if(!empty($data))
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item['nama_alat'] ?? '-' }}</td>
                                    <td>{{ $item['kode_alat'] ?? '-' }}</td>
                                    <td>{{ $item['stok'] ?? '-' }}</td>
                                    <td>{{ $item['lokasi'] ?? '-' }}</td>
                                    <td>{{ $item['kondisi'] ?? '-'}}</td>
                                    <td>{{ $item['petugas'] ?? '-'}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- <script>
        fetch('https://quotes.liupurnomo.com/api/quotes/random')
            .then(res => res.json())
            .then(data => {
                document.getElementById('quote-text').innerText = `"${data.quote}"`;
                document.getElementById('quote-author').innerText = data.author ?? 'Anonim';
            })
            .catch(err => {
                console.error(err);
                document.getElementById('quote-text').innerText = 'Gagal memuat quote.';
            });
    </script> -->

</body>

</html>