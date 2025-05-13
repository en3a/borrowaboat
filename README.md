<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/en3a/borrowaboat/actions">
    <img src="https://github.com/en3a/borrowaboat/actions/workflows/build_and_deploy_production.yml/badge.svg" alt="Build Status">
  </a>
</p>

---

# 🚤 Borrow a Boat

**Borrow a Boat** is a modern, scalable web platform built with **Laravel 12** and **React.js**. It allows partners to onboard and list boats while enabling clients to browse and book listings based on their preferences. The platform follows clean architectural principles and is fully containerized, supporting modern deployment pipelines using AWS and Kubernetes.

This project is designed for maintainability, developer productivity, and scalability, with a clear separation between domains, infrastructure, and presentation layers.

---

## 🧰 Tech Stack

- **Backend:** Laravel 12 (PHP 8.3)
- **Frontend:** React.js with Vite and TailwindCSS
- **Database:** MySQL (SQLite for testing)
- **DevOps:** Docker, Docker Compose
- **CI/CD:** GitHub Actions + Amazon ECR + Helm (Kubernetes-ready)
- **Others:** Node.js 22.x, Composer, npm

---

## 🧱 Architecture

The project uses **Domain-Driven Design (DDD)** principles to isolate core business logic from the infrastructure and application layers. This improves code modularity, testability, and long-term maintainability.

### Why Domain-Driven Design?

- Encourages a **clear boundary between domain logic and delivery mechanisms**.
- Makes the system easier to test and scale.
- Promotes separation of concerns and reusability.
- Allows isolated iteration on domains without affecting unrelated areas of the codebase.
- Future-proofs the architecture for features like microservices, API modules, or background jobs.

Example structure:

```
src/
├── Domain/
│   └── Listings/           # Domain logic and aggregates
├── InternalApi/
│   └── Listings/Controllers, Resources, Requests
```

---

## ⚙️ Installation

### 🔧 Manual Setup

#### Backend dependencies
```bash
composer install
```

#### Frontend dependencies
```bash
npm install
npm run build
```

#### Environment and database setup
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

The seeder will generate 5 demo listings and one test user:

```
Email: test@example.com
Password: secret1234
```

---

## 🐳 Local Development with Docker

The app is containerized using Docker and includes a pre-configured **Docker Compose** environment.

To start the environment:

```bash
docker compose up -d
```

This will launch:
- PHP FPM application container
- Nginx webserver with SSL (self-signed)
- MySQL database service

Accessible via: https://localhost:4433
> *If prompted, accept the SSL warning in your browser.*

---

## ✅ Running Tests

The project uses **PHPUnit** for backend tests with an in-memory **SQLite** database. Tests include seeding and run isolated from MySQL:

```bash
php artisan test
```

---

## 🚀 CI/CD Pipeline (GitHub Actions)

The pipeline is fully automated and includes:

- 🔍 **Code review** via **Rector** and **Laravel Pint** for formatting and refactoring
- ✅ **PHPUnit tests** using SQLite in-memory
- 🐳 **Docker build** using a production-ready Dockerfile
- 📦 **Push image** to **Amazon ECR**
- ⛵ **Helm deployment** to a Kubernetes namespace (namespaced as `borrowaboat`)

### Deployment

Deploys are triggered on every push to:

- `master` branch

It uses Helm to deploy to a cluster with domain `borrowaboat.dev` via Ingress.

> The Kubernetes credentials are mocked for now; the deployment step does not fail the pipeline if the cluster is not available (`continue-on-error: true`). This demonstrates deployment readiness without blocking development.

---

## 🗂 Project Structure

- `/src` – Domain & Application layer
- `/resources/js` – React + Vite frontend
- `/routes` – Laravel route definitions
- `/.docker` – Environment-specific configs
- `/helm` – Helm charts for Kubernetes deployment
- `/tests` – PHPUnit tests

---

## 🙌 Contributing

PRs are welcome! Please follow DDD structure, and format code using:

```bash
composer pint
composer rector
```
