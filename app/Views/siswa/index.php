<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>HALAMAN DASHBOARD SISWA</h1>

    <form action="/siswa/create" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal</label>
            <input type="text" class="form-control" id="asal" name="asal" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Siswa</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Asal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarSiswa as $i => $s): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($s['nis']) ?></td>
                    <td><?= esc($s['nama']) ?></td>
                    <td> <?= $s['tanggal_lahir']
                                ? \CodeIgniter\I18n\Time::parse($s['tanggal_lahir'], 'Asia/Jakarta', 'id')->toLocalizedString('d MMMM yyyy')
                                : '-' ?></td>
                    <td><?= esc($s['asal']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>