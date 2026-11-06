# Student Data (CodeIgniter 4 CRUD)

A simple CRUD application for managing student records, built as a learning project for CodeIgniter 4 and the MVC pattern. Everything lives on a single page: a form on top and a table below.

## Features

- **Create**: add a student through the form
- **Read**: list students in a table, newest first
- **Update**: edit a student (the form is pre-filled via `?edit=ID`)
- **Delete**: remove a student with a confirmation prompt
- **Search**: search by name, origin, or both (matches from the start of the text)
- `created_at` and `updated_at` are filled automatically

## Data Model

| Column | Type | Notes |
|---|---|---|
| id | INT | Primary key, auto increment |
| nama | VARCHAR(100) | Full name |
| tanggal_lahir | DATE | Date of birth, format `YYYY-MM-DD` |
| asal | VARCHAR(100) | City/region of origin |
| created_at | DATETIME | Filled automatically |
| updated_at | DATETIME | Filled automatically |

## Tech Stack

- PHP 8.3
- CodeIgniter 4
- MySQL (via Laragon)
- Bootstrap 5.3 (CDN)
- HeidiSQL for database management

## Prerequisites

- PHP 8.1 or newer
- Composer
- A running MySQL/MariaDB server (e.g. Laragon)
- Enabled PHP extensions: `intl`, `mbstring`, `mysqli`, `curl`

## Installation

1. **Clone or copy the project**, then enter its folder:

   ```bash
   cd your-project-folder
   ```

2. **Install dependencies** (if there is no `vendor` folder yet):

   ```bash
   composer install
   ```

3. **Create the `.env` file** from the template:

   ```bash
   copy env .env
   ```

4. **Configure the environment and database** in `.env`:

   ```
   CI_ENVIRONMENT = development

   database.default.hostname = localhost
   database.default.database = basic_crud
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

5. **Create the database** `basic_crud` in HeidiSQL (collation `utf8mb4_general_ci`).

6. **Run the migration** to create the table:

   ```bash
   php spark migrate
   ```

7. **Start the server**:

   ```bash
   php spark serve
   ```

8. Open **http://localhost:8080/siswa**

## Project Structure

```
app/
├── Config/Routes.php                 # Route definitions
├── Controllers/Siswa.php             # Flow logic (index, store, update, delete)
├── Models/SiswaModel.php             # Access to the siswa table
├── Database/Migrations/              # Migration that creates the siswa table
└── Views/siswa/index.php             # UI (form + table + search)
```

## Routes

| Method | URL | Controller Method | Purpose |
|---|---|---|---|
| GET | `/siswa` | `Siswa::index` | Show the list, form, and search results |
| POST | `/siswa/simpan` | `Siswa::store` | Save a new student |
| POST | `/siswa/perbarui/{id}` | `Siswa::update` | Update a student |
| POST | `/siswa/hapus/{id}` | `Siswa::delete` | Delete a student |

### URL Parameters (GET)

| Parameter | Example | Purpose |
|---|---|---|
| `edit` | `/siswa?edit=5` | Fill the form with student #5's data |
| `cari` | `/siswa?cari=ban` | Search keyword |
| `kolom` | `/siswa?kolom=asal&cari=ban` | Limit the search: `nama`, `asal`, or empty (both) |

## How It Works (MVC)

```
Browser → Routes → Controller → Model → Database
                       ↓
                     View → HTML → Browser
```

1. **Routes** match the URL to a controller method.
2. **Controller** receives the request and asks the model for data.
3. **Model** is the only layer that talks to the database.
4. **View** renders the data as HTML.

After create, update, or delete, the controller **redirects** to `/siswa` so that refreshing the page does not resubmit the form (Post/Redirect/Get pattern).

## Troubleshooting

| Problem | Fix |
|---|---|
| `Invalid file: "siswa/index.php"` | Make sure the view is at `app/Views/siswa/index.php` |
| 404 when clicking Save/Delete | Check the POST routes in `app/Config/Routes.php` |
| 403 "action not allowed" | Make sure the form includes `<?= csrf_field() ?>` |
| Database connection error | Check `.env`, the database name, and that MySQL is running |
| Warning `Unable to load dynamic library 'json'` | Comment out `extension=json` in `php.ini` with a leading `;` |
| Port 8080 already in use | Run `php spark serve --port 8081` |

## Roadmap

- [ ] Form validation (name required, minimum 3 characters)
- [ ] Success messages with flashdata
- [ ] Pagination
- [ ] Modal UI with a three-dot action menu
- [ ] JSON API version for consuming from Next.js

## Notes

The `.env` file contains database configuration and must not be uploaded to GitHub (it is already in CodeIgniter's default `.gitignore`).