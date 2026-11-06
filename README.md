# Dashboard Siswa

A simple student data dashboard built with CodeIgniter 4 and Bootstrap 5 for CRUD operations. The app lets you add, edit, delete, and search student data from one page.

## Features

- Add new student data using the form
- View all students in a table
- Edit student data by selecting a row
- Delete student data with confirmation
- Search students by name, NIS, or origin
- Automatic `created_at` and `updated_at` timestamps

## Data Model

| Column | Type | Notes |
|---|---|---|
| id | INT | Primary key, auto increment |
| nama | VARCHAR(100) | Student name |
| nis | VARCHAR(100) | Student number |
| tanggal_lahir | DATE | Date of birth in `YYYY-MM-DD` format |
| asal | VARCHAR(100) | Origin / school region |
| created_at | DATETIME | Automatically set |
| updated_at | DATETIME | Automatically updated |

## Tech Stack

- PHP 8.x
- CodeIgniter 4
- MySQL / MariaDB
- Bootstrap 5.3
- Composer

## Prerequisites

- PHP 8.1 or newer
- Composer
- MySQL/MariaDB running locally
- PHP extensions: `intl`, `mbstring`, `mysqli`, `curl`

## Installation

1. Clone or copy the project into your working folder:

   ```bash
   cd dashboard-siswa
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Create the `.env` file from the template:

   ```bash
   copy env .env
   ```

4. Configure the database in `.env`:

   ```env
   CI_ENVIRONMENT = development

   database.default.hostname = localhost
   database.default.database = data_siswa
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

5. Create the database in MySQL/HeidiSQL:

   ```sql
   CREATE DATABASE data_siswa;
   ```

6. Run the migration:

   ```bash
   php spark migrate
   ```

7. Start the app:

   ```bash
   php spark serve
   ```

8. Open the app in the browser:

   ```text
   http://localhost:8080/siswa
   ```

## Project Structure

```text
app/
├── Config/
│   └── Routes.php                # Route definitions
├── Controllers/
│   └── Siswa.php                 # CRUD logic
├── Models/
│   └── SiswaModel.php            # Data access for data_siswa table
├── Database/
│   └── Migrations/
│       └── 2026-11-06-033854_DataSiswa.php
├── Views/
│   └── siswa/
│       └── index.php            # Form, table, and search UI
└── ...
```

## Routes

| Method | URL | Controller Method | Purpose |
|---|---|---|---|
| GET | `/siswa` | `Siswa::index` | Display list, form, and search results |
| POST | `/siswa/create` | `Siswa::create` | Add a new student |
| POST | `/siswa/update/{id}` | `Siswa::update` | Update existing student data |
| GET | `/siswa/delete/{id}` | `Siswa::delete` | Delete a student |

## Search Parameters

The index page supports GET-based search:

| Parameter | Example | Purpose |
|---|---|---|
| `cari` | `/siswa?cari=farrel` | Search keyword |
| `kategori` | `/siswa?kategori=nama&cari=farrel` | Search field: `nama`, `nis`, `asal`, or empty for all |

Example search URLs:

```text
/siswa?cari=farrel
/siswa?kategori=nama&cari=farrel
/siswa?kategori=asal&cari=bandung
```

## How It Works

```text
Browser → Route → Controller → Model → Database
                       ↓
                     View → HTML
```

1. The browser requests `/siswa`.
2. The route calls `Siswa::index()`.
3. The controller reads query parameters and filters the model data if needed.
4. The model queries the `data_siswa` table.
5. The view renders the form and table in HTML.

After create, update, or delete, the application redirects back to `/siswa` using the PRG pattern.

## Troubleshooting

| Problem | Fix |
|---|---|
| `Invalid file: "siswa/index.php"` | Confirm the file exists at `app/Views/siswa/index.php` |
| 404 on save or delete | Check routes in `app/Config/Routes.php` |
| 403 error / CSRF issue | Add `<?= csrf_field() ?>` to the form |
| Database connection error | Check `.env` credentials and MySQL status |
| `php spark` not recognized | Run from the project root and make sure Composer dependencies are installed |

## Notes

- The `.env` file should not be committed to GitHub.
- The project uses a single-page dashboard style with a form above the table and search controls above the data list.
- The actual database table name is `data_siswa`.
