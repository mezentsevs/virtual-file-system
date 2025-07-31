# Virtual file system

## About 'Virtual file system'

This is a virtual file system, written in and for educational and demonstrational purposes.

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

- Or you can seed database with random users (name, email: random - look in database, password: password), folders and files:
``` bash
php artisan migrate:fresh --seed
```

- Login on http://localhost/login

That's it! Thank you!

## Screenshots

<img width="1920" height="1200" alt="2025-07-31_17-45-21" src="https://github.com/user-attachments/assets/f3d88145-e982-4a16-861d-8a2346105c8c" />
<img width="1920" height="1200" alt="2025-07-31_17-47-30" src="https://github.com/user-attachments/assets/b411df31-5d97-4c13-b915-676207140123" />
<img width="1920" height="1200" alt="2025-07-31_17-57-52" src="https://github.com/user-attachments/assets/a85aec15-c337-42c3-b387-1b00db333388" />
<img width="1920" height="1200" alt="2025-07-31_17-58-34" src="https://github.com/user-attachments/assets/99233dc2-2a84-403b-9028-77967a93ec31" />
<img width="1920" height="1200" alt="2025-07-31_18-01-56" src="https://github.com/user-attachments/assets/1068aa4d-cb2b-47ba-b74b-880f1eb13c93" />
<img width="1920" height="1200" alt="2025-07-31_18-02-37" src="https://github.com/user-attachments/assets/a0920098-e7b1-458d-bd20-1ede1ae33f2d" />
<img width="1920" height="1200" alt="2025-07-31_18-04-45" src="https://github.com/user-attachments/assets/bff07870-6611-48f5-9a96-65286f6ca248" />
<img width="1920" height="1200" alt="2025-07-31_18-05-27" src="https://github.com/user-attachments/assets/bb612db9-451b-4ba9-97a6-ee107f7eebd8" />
<img width="1920" height="1200" alt="2025-07-31_18-32-46" src="https://github.com/user-attachments/assets/538ae68d-5508-49db-84eb-e8e8cfd35669" />
<img width="1920" height="1200" alt="2025-07-31_18-33-30" src="https://github.com/user-attachments/assets/e69202fa-3ab0-49d5-891d-7a1641955a0f" />
<img width="1920" height="1200" alt="2025-07-31_18-35-03" src="https://github.com/user-attachments/assets/cb794271-90ca-408b-a878-ac7923039388" />
<img width="1920" height="1200" alt="2025-07-31_18-36-07" src="https://github.com/user-attachments/assets/629b0b80-c222-4ed7-a767-44f6e113c9ed" />
<img width="1920" height="1200" alt="2025-07-31_18-37-19" src="https://github.com/user-attachments/assets/0861e86c-b8e5-4cb0-965b-6d85d3efdf74" />
<img width="1920" height="1200" alt="2025-07-31_18-37-50" src="https://github.com/user-attachments/assets/728c567a-220b-4083-bfcb-4a5360e43a70" />

## License

The 'Virtual file system' is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
