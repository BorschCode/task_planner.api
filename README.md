# Todo List API

[![OpenAPI](https://img.shields.io/badge/OpenAPI-3.0-6BA539?logo=openapi-initiative&logoColor=white)](#)
![Lint Status](https://github.com/BorschCode/task_planner.api/actions/workflows/lint.yml/badge.svg)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/Symfony-6.3-000000?logo=symfony&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)

---

## Description

This API provides the ability to:

* Retrieve a list of your tasks with filters.
* Create your own tasks.
* Edit your tasks.
* Delete your tasks.
* Mark your tasks as completed.

![api docs](docs/index-img.png)

### 📌 Public Static Swagger (GitHub Pages)

A static version of the API documentation is available here:

👉 **[https://borschcode.github.io/task_planner.api/swagger.html](https://borschcode.github.io/task_planner.api/swagger.html)**

Use it to preview the API without running the project locally.

---


![api docs](docs/login-img.png)

---

## How to Run

**Docker-ready project**  
All Docker variables are read from the `.env` file — just run `make build` to create a new instance.

---

### 1. Clone the Symfony Project

```bash
git clone https://github.com/ZhoraKornev/task_planner.api
cp .env.example .env
cd task_planner.api
````

### 2. Prepare Docker Compose Override

Create a file `docker-compose.override.yml` and configure services: PHP, Nginx/Apache, MySQL/MariaDB, etc.

### 3. Build and Start Containers

```bash
docker compose up -d
```

### 4. Enter the PHP Container

```bash
docker compose exec php bash
```

### 5. Install Composer Dependencies

```bash
composer install
```

### 6. Run Symfony Commands

```bash
bin/console cache:clear
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
```

### 7. Access the Application

Open in browser:

```
http://localhost
```

Test credentials from fixtures:

```
Email: test@user.email
Pass: 123
```

### 8. Stop Containers

```bash
docker compose down
```

---

## Helpful Docs

### 📌 Local API Documentation

```
http://localhost/api_documentation
```

![api docs](docs/api_docs.png)

---

## Tech Stack

* Nginx
* PHP 8.2
* MariaDB 10.10.3
* RabbitMQ
* Symfony 6.3
