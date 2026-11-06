<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary: #0d6efd;
            --border: rgba(13, 110, 253, 0.1);
        }

        body {
            background: linear-gradient(180deg, #f4f7ff 0%, #eef4ff 100%);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .page-header {
            background: linear-gradient(135deg, #0d6efd 0%, #3b82f6 100%);
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
            padding-bottom: 4rem;
        }

        .content {
            max-width: 1000px;
            margin-top: -2.5rem;
        }

        .card-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.06);
        }

        .form-label {
            font-size: .85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .35rem;
        }

        .form-control,
        .form-select,
        .btn {
            border-radius: .6rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, 0.12);
        }

        .search-wrap {
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: .75rem;
            width: 100%;
        }

        .search-select {
            flex: 0 0 160px;
        }

        .search-input {
            flex: 1 1 240px;
        }

        .search-form .btn {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8faff;
            color: #4b5563;
            font-size: .8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            border-bottom: 1px solid var(--border);
            padding: 1rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: .9rem 1rem;
            border-color: #f1f4fb;
        }

        .table tbody tr:hover {
            background-color: #f8fbff;
        }

        .table tbody tr.row-edit,
        .table tbody tr.row-edit:hover {
            background-color: #fff7dd;
        }

        .btn-action {
            min-width: 64px;
            font-size: .8rem;
            padding: .3rem .75rem;
        }
    </style>
</head>

<body>
    <?php
    $isEdit         = ! empty($editSiswa);
    $searchQuery    = $searchQuery ?? '';
    $searchCategory = $searchCategory ?? '';
    $isSearching    = $searchQuery !== '' || $searchCategory !== '';
    $filter         = array_filter(['kategori' => $searchCategory, 'cari' => $searchQuery]);
    ?>

    <header class="page-header text-white pt-4 pt-md-5">
        <div class="container content" style="margin-top:0">
            <p class="mb-1 text-white-50 text-uppercase small fw-semibold">Dashboard</p>
            <h1 class="h2 fw-bold mb-0">Data Siswa</h1>
        </div>
    </header>

    <main class="container content pb-5">

        <section class="card-box p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h5 fw-bold mb-0"><?= $isEdit ? 'Edit Siswa' : 'Tambah Siswa' ?></h2>
                <?php if ($isEdit): ?>
                    <span class="badge text-bg-warning">Mode edit</span>
                <?php endif; ?>
            </div>

            <form action="<?= $isEdit ? '/siswa/update/' . $editSiswa['id'] : '/siswa/create' ?>" method="post" class="row g-3">
                <?= csrf_field() ?>

                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="<?= esc($editSiswa['nama'] ?? '') ?>" placeholder="Masukkan nama siswa" required>
                </div>

                <div class="col-md-6">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis"
                        value="<?= esc($editSiswa['nis'] ?? '') ?>" placeholder="Masukkan NIS" required>
                </div>

                <div class="col-md-4">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                        value="<?= esc($editSiswa['tanggal_lahir'] ?? '') ?>" required>
                </div>

                <div class="col-md-8">
                    <label for="asal" class="form-label">Asal</label>
                    <input type="text" class="form-control" id="asal" name="asal"
                        value="<?= esc($editSiswa['asal'] ?? '') ?>" placeholder="Masukkan asal sekolah atau daerah" required>
                </div>

                <div class="col-12 d-flex gap-2 pt-1">
                    <button type="submit" class="btn <?= $isEdit ? 'btn-success' : 'btn-primary' ?> px-4 fw-semibold">
                        <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Siswa' ?>
                    </button>
                    <?php if ($isEdit): ?>
                        <a href="/siswa<?= $filter ? '?' . http_build_query($filter) : '' ?>" class="btn btn-outline-secondary px-4">Batal</a>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <div class="card-box search-wrap">
            <form method="get" action="/siswa" role="search" class="search-form">
                <label for="cari-siswa" class="visually-hidden">Cari siswa</label>

                <select class="form-select search-select" name="kategori" id="kategori-siswa" aria-label="Kategori pencarian">
                    <option value="">Semua</option>
                    <option value="nama" <?= $searchCategory === 'nama' ? 'selected' : '' ?>>Nama</option>
                    <option value="nis" <?= $searchCategory === 'nis' ? 'selected' : '' ?>>NIS</option>
                    <option value="asal" <?= $searchCategory === 'asal' ? 'selected' : '' ?>>Asal</option>
                </select>

                <input type="search" class="form-control search-input" id="cari-siswa" name="cari"
                    placeholder="Cari nama, NIS, atau asal..." value="<?= esc($searchQuery) ?>">

                <button type="submit" class="btn btn-primary">Cari</button>

                <?php if ($isSearching): ?>
                    <a href="/siswa" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <section class="card-box overflow-hidden">
            <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom" style="border-color:var(--border)!important">
                <h2 class="h6 fw-bold mb-0">Daftar Siswa</h2>
                <span class="badge rounded-pill text-bg-primary"><?= count($daftarSiswa) ?> siswa</span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th class="text-center" style="width:130px">NIS</th>
                            <th>Nama</th>
                            <th class="text-center" style="width:170px">Tanggal Lahir</th>
                            <th class="text-center">Asal</th>
                            <th class="text-center" style="width:170px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarSiswa)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-5">Belum ada data siswa.</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($daftarSiswa as $i => $s): ?>
                            <?php
                            $isSelected = $isEdit && $editSiswa['id'] == $s['id'];
                            $editLink   = '/siswa?' . http_build_query(array_merge(['id' => $s['id']], $filter));
                            ?>
                            <tr class="<?= $isSelected ? 'row-edit' : '' ?>">
                                <td class="text-secondary"><?= $i + 1 ?></td>
                                <td class="text-center"><?= esc($s['nis']) ?></td>
                                <td class="fw-semibold"><?= esc($s['nama']) ?></td>
                                <td class="text-center">
                                    <?= $s['tanggal_lahir']
                                        ? \CodeIgniter\I18n\Time::parse($s['tanggal_lahir'], 'Asia/Jakarta', 'id')->toLocalizedString('d MMMM yyyy')
                                        : '-' ?>
                                </td>
                                <td class="text-center"><?= esc($s['asal']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= esc($editLink) ?>" class="btn btn-outline-primary btn-action">Edit</a>
                                        <form action="/siswa/delete/<?= $s['id'] ?>" method="post"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-danger btn-action">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</body>

</html>