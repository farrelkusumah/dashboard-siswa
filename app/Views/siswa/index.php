<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f7fb;
        }

        .page-header {
            background: linear-gradient(135deg, #0d6efd, #4f8dfd);
        }
    </style>
</head>

<body>
    <header class="page-header text-white py-4 py-md-5">
        <div class="container">
            <h1 class="h2 fw-bold mb-1">Data Siswa</h1>
        </div>
    </header>
    <?php $isEdit = !empty($editSiswa); ?>
    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3"><?= $isEdit ? 'Edit Siswa' : 'Tambah Siswa' ?></h2>
                <form action="<?= $isEdit ? '/siswa/update/' . $editSiswa['id'] : '/siswa/create' ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="<?= esc($editSiswa['nama'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis"
                            value="<?= esc($editSiswa['nis'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                            value="<?= esc($editSiswa['tanggal_lahir'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="asal" class="form-label">Asal</label>
                        <input type="text" class="form-control" id="asal" name="asal"
                            value="<?= esc($editSiswa['asal'] ?? '') ?>" required>
                    </div>

                    <button type="submit" class="btn <?= $isEdit ? 'btn-warning' : 'btn-primary' ?>">
                        <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Siswa' ?>
                    </button>
                    <?php if ($isEdit): ?>
                        <a href="/siswa" class="btn btn-secondary">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Asal</th>
                <th>Aksi</th>
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
                    <td>
                        <a href="/siswa?id=<?= $s['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                <tr class="<?= $isEdit && $editSiswa['id'] == $s['id'] ? 'table-warning' : '' ?>">
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>