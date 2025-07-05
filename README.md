# Collab Task

A concise one-line description:  
> A lightweight, standalone PHP task-management API using Eloquent ORM.
> Dev project.

---

## 🚀 Features
- Role-based access control
- Eloquent-powered models and migrations
- Clean service/controller separation
- Custom exception handling

---

## 🏗️ Architecture & Design
- **Layered Architecture**:  
  - **Controllers** handle HTTP/input concerns  
  - **Services** encapsulate business logic  
  - **Models** represent database tables with Eloquent  
- **Design Patterns**: 
  - **MVC Pattern** 
  - **Repository Pattern** (if you abstract queries)  
  - **Dependency Injection** (services injected into controllers)  
  - **Exception-Driven Flow** with custom exceptions

---

## 🛠️ Tech Stack
- **PHP 8.x**  
- **Eloquent ORM** (illuminate/database)  
- **Composer** for dependency management & PSR-4 autoloading  
- **SQLite/MySQL** (or any PDO-compatible)  
- **PHPUnit** (for future testing)

## Project Structure
app/
├── Controllers/
├── Services/
├── Models/
├── Exceptions/
└── Migrations/
config/
public/
vendor/
composer.json

#Installation process
1. Clone the repository first

git clone https://github.com/ashiz123/collab-task.git
cd collab-task

2. Install the dependencies
composer install

3. Make sure you have following lines in psr-4. 

  "autoload": {
        "psr-4": {
            "App\\": "App/",
            "Database\\": "Database/",
            "core\\": "core/",
            "utils\\" : "utils/",
            "config\\" : "config/"
          }
     },

4. Run composer dump-autoload.

5. Set up your database, As its not laravel, You need to run each migrations for now. Migrate functions is not created. It may comes up later.
you dont need to run modify migrations. Original migrations is updated with modify one.

example: 
php migrations/2025_01_01_create_roles_table.php





