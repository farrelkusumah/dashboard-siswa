<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi sederhana untuk mengelola data siswa.">
    <title>Beranda | Data Siswa</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f5f7fb;
        }

        .welcome-card {
            background: linear-gradient(135deg, #0d6efd, #4f8dfd);
        }
    </style>
</head>

<body class="min-vh-100 d-flex align-items-center py-5">wait
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">
                <section class="welcome-card text-white rounded-4 shadow p-4 p-md-5">
                    <span class="badge rounded-pill bg-white bg-opacity-25 text-white mb-4">Aplikasi sekolah</span>
                    <h1 class="display-5 fw-bold mb-3">Selamat datang!</h1>
                    <p class="lead text-white-50 mb-4">
                        Kelola data siswa dengan mudah dalam satu tempat.
                    </p>
                    <a href="/siswa" class="btn btn-light btn-lg text-primary fw-semibold">
                        Lihat data siswa
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </section>
                <p class="text-center text-secondary small mt-4 mb-0">
                    Aplikasi CRUD sederhana dengan CodeIgniter 4
                </p>
            </div>
        </div>
    </main>
</body>

</html>
