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

                    <button type="submit" class="btn <?= $isEdit ?  'btn-success' :  'btn-primary' ?>">
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
                        <a href="/siswa?id=<?= $s['id'] ?>" class="text-blue"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen preview-icon"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg></a>
                        <a href="/siswa/delete/<?= $s['id'] ?>" class="text-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash preview-icon"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></a>
                    </td>
                </tr>
                <tr class="<?= $isEdit && $editSiswa['id'] == $s['id'] ? 'table-warning' : '' ?>">
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>