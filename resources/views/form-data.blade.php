<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventori Alat Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Form Inventori Alat Laboratorium</h5>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/simpan-data">
                @csrf

                <div class="mb-3">
                    <label>Nama Alat</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kode Alat</label>
                    <input type="text" name="kode" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kondisi</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Petugas</label>
                    <input type="text" name="petugas" class="form-control" required>
                </div>

                <button class="btn btn-success">Simpan Data</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
