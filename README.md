# 📝 Laravel & Vue Todo Application

A modern, full-stack **To-Do** application built to showcase a clean architecture using **Laravel** for the backend and **Vue.js with Inertia.js** for a seamless, single-page application experience.

---

## 🌐 Live Demo
👉 [View Deployed App](https://todoapp.amhyou.com)

---

## ✨ Features

- 🔐 **User Authentication:** Secure registration and login system.  
- 📁 **Project Management:** Create, update, and delete your own projects.  
- ✅ **Task Management:** Full CRUD functionality for tasks within each project, including completion status and due dates.  
- ⚡ **Modern SPA Experience:** Fast, responsive interface powered by **Vue 3** and **Inertia.js** — no page reloads.

---

## 🛠️ Technologies Used

| Layer | Technology |
|-------|-------------|
| **Backend** | Laravel 12 |
| **Frontend** | Vue 3 (Composition API) |
| **Hybrid Framework** | Inertia.js |
| **Database** | SQLite (included in the repository) |
| **Styling** | Tailwind CSS |
| **Authentication** | Laravel Breeze |

---

## 🚀 Getting Started

This project is pre-configured to use the included **SQLite database** — no setup or migrations needed.

You can run the app in **two ways**:

1. 🐳 **Using Docker (Recommended — simplest way)**
2. 💻 **Running Locally with PHP & Node**

---

### 🐳 1. Run with Docker (Recommended)

If you prefer not to install PHP, Composer, or Node.js, you can quickly start the app using the prebuilt Docker image:

```bash
docker run -d -p 8000:8000 amhyou/laravel-todo:latest
```

Once the container is running, open your browser and visit:

👉 **http://localhost:8000**

That’s it — the application will be running instantly inside Docker!  
No local environment setup required.

---

### 💻 2. Run Locally

#### ✅ Prerequisites

Make sure you have the following installed:

- PHP 8.2+
- Composer
- Node.js 20+

---

#### 1. Clone the Repository

```bash
git clone https://github.com/amhyou/Laravel-To-Do.git
cd Laravel-To-Do
```

---

#### 2. Install Dependencies

```bash
composer install
npm install
```

---

#### 3. Configure the Environment

```bash
# Copy the environment file
cp .env.example .env

# Generate the application key
php artisan key:generate
```

---

#### 4. Run the Application

You’ll need **two terminals** running simultaneously:

##### Terminal 1 – Start Vite (Frontend)
```bash
npm run dev
```

##### Terminal 2 – Start Laravel (Backend)
```bash
php artisan serve
```

---

### 🌍 Access the App

Once both servers (or the Docker container) are running, open your browser and visit:

👉 **http://localhost:8000**

You can now **register a new user**, create **projects**, and manage **tasks** right away!

---
