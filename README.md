# Virtual file system

## About 'Virtual file system'

This is a virtual file system written in and for educational purposes.

Based on tech stack:
- [HTML](https://developer.mozilla.org/en-US/docs/Web/HTML),
- [PHP](https://www.php.net),
- [Laravel](https://laravel.com),
- [Jetstream](https://jetstream.laravel.com/introduction.html),
- [Sanctum](https://github.com/laravel/sanctum),
- [Inertia](https://inertiajs.com),
- [MySQL](https://www.mysql.com),
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript),
- [Vue](https://vuejs.org),
- [Pinia](https://pinia.vuejs.org),
- [Axios](https://axios-http.com),
- [CSS](https://developer.mozilla.org/en-US/docs/Web/CSS),
- [TailwindCss](https://tailwindcss.com),
- [Docker](https://www.docker.com),
- [Sail](https://github.com/laravel/sail).

## Getting Started

- Clone the repository:
``` bash
git clone [repository-url]
```

- Change directory to project:
``` bash
cd /path/to/virtual-file-system/
```

- Install php dependencies:
``` bash
composer install
```

- Create .env file:
``` bash
cp .env.example .env
```

- Generate application key:
``` bash
php artisan key:generate
```

- Run Docker Desktop (with wsl - for Windows only)

- Run wsl (for Windows only):
``` bash
wsl
```

- Run Sail:
``` bash
./vendor/bin/sail up
```

- Add new tab in terminal and connect to container:
``` bash
docker exec -it virtual-file-system-laravel.test-1 bash
```

- Install php dependencies (optional, if missing some required php extension in base system):
``` bash
git config --global --add safe.directory /var/www/html
composer install
```

- Run migrations:
``` bash
php artisan migrate
```

- Install node dependencies:
``` bash
npm install
```

- Build project:
``` bash
npm run build
```

- In browser go to welcome page http://localhost/

- Register new user on http://localhost/register (enter your name, email, password)

- Or you can seed database with random users, folders and files:
``` bash
php artisan migrate:fresh --seed
```

- Login on http://localhost/login (next time)

That's it! Thank you!

## License

The 'Virtual file system' is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
