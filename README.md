# Laravel Todo App

A modern todo application built with Laravel 12, Vue 3, Inertia.js, and Tailwind CSS. Users can register, create projects, and manage tasks within each project.

## Features

- 🔐 User Authentication (Register/Login)
- 📁 Project Management (Create, Edit, Delete)
- ✅ Task Management (Create, Edit, Delete, Complete)
- 📅 Due Dates for Tasks
- 🎨 Modern UI with Tailwind CSS
- ⚡ SPA-like Experience with Inertia.js

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 20.19+ or 22.12+ (for Vite 7)
- SQLite extension enabled in PHP

## Installation

### 1. Clone the Repository

```bash
git clone <your-repo-url>
cd todo-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

If you encounter dependency issues, try:
```bash
npm install --legacy-peer-deps
```

### 4. Configure Environment

Copy the example environment file:
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

### 5. Configure Database

The app uses SQLite by default. Make sure your `.env` file has:

```env
DB_CONNECTION=sqlite
```

Create the database file:

**Windows PowerShell:**
```bash
New-Item database/database.sqlite
```

**Mac/Linux:**
```bash
touch database/database.sqlite
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Enable PHP Extensions

Make sure these extensions are enabled in your `php.ini`:

```ini
extension=fileinfo
extension=pdo_sqlite
extension=sqlite3
```

Find your `php.ini` location:
```bash
php --ini
```

## Running the Application

You need **two terminal windows** running simultaneously:

### Terminal 1: Start Vite Dev Server (for assets)

```bash
npm run dev
```

Keep this running!

### Terminal 2: Start Laravel Server

```bash
php artisan serve
```

### Access the Application

Open your browser and visit: **http://localhost:8000**

## Usage

1. **Register** a new account or **Login**
2. Click **"Dashboard"** to view your projects
3. **Create a Project** by clicking "+ New Project"
4. **View a Project** and **Add Tasks** to it
5. **Mark tasks as complete** by clicking the checkbox
6. **Edit or Delete** projects and tasks as needed

## Project Structure

```
app/
├── Http/Controllers/
│   ├── ProjectController.php    # Handles project CRUD
│   └── TaskController.php        # Handles task CRUD
├── Models/
│   ├── User.php                  # User model with projects relationship
│   ├── Project.php               # Project model with tasks relationship
│   └── Task.php                  # Task model
└── Policies/
    └── ProjectPolicy.php         # Authorization for projects

resources/js/Pages/
├── Projects/
│   ├── Index.vue                 # List all projects
│   ├── Create.vue                # Create project form
│   ├── Edit.vue                  # Edit project form
│   └── Show.vue                  # View project with tasks
└── Dashboard.vue                 # Dashboard (redirects to projects)

routes/
└── web.php                       # Application routes
```

## Database Schema

### Users Table
- id
- name
- email
- password
- timestamps

### Projects Table
- id
- user_id (foreign key)
- name
- description (nullable)
- timestamps

### Tasks Table
- id
- project_id (foreign key, cascade delete)
- title
- description (nullable)
- is_completed (boolean, default: false)
- due_date (date, nullable)
- timestamps

## Technologies Used

- **Backend:** Laravel 12
- **Frontend:** Vue 3 (Composition API)
- **Routing:** Inertia.js
- **Styling:** Tailwind CSS
- **Build Tool:** Vite
- **Database:** SQLite
- **Authentication:** Laravel Breeze

## Troubleshooting

### "could not find driver" Error
Enable SQLite extensions in your `php.ini`:
```ini
extension=pdo_sqlite
extension=sqlite3
```

### Node.js Version Error
Upgrade to Node.js 20.19+ or 22.12+:
- Download from: https://nodejs.org/

### npm Dependency Conflicts
Run with legacy peer deps:
```bash
npm install --legacy-peer-deps
```

### Assets Not Loading
Make sure both `npm run dev` and `php artisan serve` are running simultaneously.

## Building for Production

### Compile Assets

```bash
npm run build
```

### Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Deploy

For production, use MySQL/PostgreSQL instead of SQLite. Update your `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run migrations on the production server:
```bash
php artisan migrate --force
```

## License

This project is open-sourced software licensed under the MIT license.

## Support

For issues or questions, please open an issue on GitHub.