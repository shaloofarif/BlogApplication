# Blog Application (Laravel)

This is a Blog Application built using the **Laravel** PHP framework. It includes features like admin login, blog post creation and management, AJAX CRUD operations,blog view for users and more. The project follows MVC architecture, and aims to provide a functional blogging platform with search and filter capabilities.

## Features

- Admin login with database seeding
- Blog post creation and management using a WYSIWYG editor
- Search and filters for blog posts
- Client-side and server-side validation
- AJAX-based CRUD operations for blog posts
- Resource controllers
- Blog listing on the frontend
- Clean and organized codebase

## Prerequisites

Before you can run the project, make sure you have the following installed on your local system:

- **PHP** (version 8.x or above)
- **Composer** (for managing PHP dependencies)
- **Laravel** (installed globally via Composer)
- **MySQL** 
- **Git** (for version control)
- **Laragon** (optional, for an easy local development environment)

## Installation

Follow these steps to set up the project on your local machine:

### 1. Clone the Repository

Clone the project repository to your local machine using Git:

```bash
git clone https://github.com/yourusername/blog-application.git
```

### 2. Navigate to the Project Folder

```bash
cd blog-application
```

### 3. Install PHP Dependencies

Run Composer to install the required PHP dependencies:

```bash
composer install
```

### 4. Set Up Environment File

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

### 5. Configure Database Connection

Open the `.env` file and set the following database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=
```

Replace `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` with your local MySQL database details.

### 6. Generate Application Key

Run the following Artisan command to generate a unique application key:

```bash
php artisan key:generate
```

### 7. Set Up the Database

Run the migrations and seed the database:

```bash
php artisan migrate --seed
```

This will create the necessary tables and seed the database with initial data.

### 8. Install Front-End Dependencies

<!-- Run the following commands to install front-end dependencies and build assets:

```bash
npm install
npm run dev -->
```

### 9. Run the Development Server

Start the Laravel development server:

```bash
php artisan serve
```

This will run the application at `http://localhost:8000`.

## Usage

Once the project is running, you can:

- The default index page is the blogs page, which the user can view the blogs listed.
- Filter and search blog posts on the frontend (user View).
- After clicking Admin user can access the admin page.
- Log in as an admin (credentials are seeded into the database) to manage blog posts.
- Create, edit, and delete blog posts using the CK editor.
- Use AJAX to update blog posts without page reloads.

## Testing

To run tests, you can use the following command:

```bash
php artisan test
```

## Contributing

Feel free to fork the repository and submit pull requests for improvements or bug fixes. Please make sure to follow the coding standards and write tests for new features.