
## Installation Steps

1. Clone the repository:
```bash
git clone <repository-url>
cd <project-folder>
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Create symbolic link for storage:
```bash
php artisan storage:link
```

7. Configure your database in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Database Setup

1. Run migrations:
```bash
php artisan migrate
```

2. Run seeders:
```bash
php artisan db:seed
```

## Running the Application

1. Start the development server:
```bash
php artisan serve
```

2. Compile assets:
```bash
npm run dev
```

The application will be available at `http://localhost:8000`