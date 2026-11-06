<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    HALAMAN DASHBOARD SISWA
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