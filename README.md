# Virtual file system

## About 'Virtual file system'

This is a virtual file system, written in and for educational and demonstrational purposes.

A full-stack SPA implementing a virtual file system with a hierarchical tree structure. It supports full CRUD operations, validation, and sorting, providing an intuitive interface for managing files and folders directly in the browser.

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
- [Sail](https://github.com/laravel/sail),
- [Scribe](https://github.com/knuckleswtf/scribe).

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

<img width="1920" height="1200" alt="2025-12-16_16-40-20" src="https://github.com/user-attachments/assets/e846de2a-6333-42d7-8bd2-cf95f327c03f" />
<img width="1920" height="1200" alt="2025-12-16_16-41-21" src="https://github.com/user-attachments/assets/8429fb83-ee7c-4a5a-8fd2-05f5fbb8df04" />
<img width="1920" height="1200" alt="2025-12-16_16-42-56" src="https://github.com/user-attachments/assets/c31b0fa2-1ca4-4a9a-83ad-887c192f0171" />
<img width="1920" height="1200" alt="2025-12-16_16-43-50" src="https://github.com/user-attachments/assets/a1582b13-c865-4e13-afce-9a437f89dd40" />
<img width="1920" height="1200" alt="2025-12-16_16-48-37" src="https://github.com/user-attachments/assets/f041a06f-1137-41c1-813c-45c6d88c682b" />
<img width="1920" height="1200" alt="2025-12-16_16-49-29" src="https://github.com/user-attachments/assets/a1224329-1172-4378-b20d-8478575981d6" />
<img width="1920" height="1200" alt="2025-12-16_16-51-35" src="https://github.com/user-attachments/assets/0e772e2e-3153-4d94-a085-4eb53f737f5b" />
<img width="1920" height="1200" alt="2025-12-16_16-52-29" src="https://github.com/user-attachments/assets/67095620-597c-4bfa-b67f-4ee637135029" />
<img width="1920" height="1200" alt="2025-12-16_16-57-59" src="https://github.com/user-attachments/assets/ee1bb2cc-a246-44fd-9442-8854432838a8" />
<img width="1920" height="1200" alt="2025-12-16_16-59-21" src="https://github.com/user-attachments/assets/3f452778-afff-4a4b-8499-7a6745bec282" />
<img width="1920" height="1200" alt="2025-12-16_17-03-36" src="https://github.com/user-attachments/assets/a1e61bee-ef1a-4090-8253-927ea84e6841" />
<img width="1920" height="1200" alt="2025-12-16_17-05-07" src="https://github.com/user-attachments/assets/69f34f31-2864-4bf2-823b-a6434bbeefab" />
<img width="1920" height="1200" alt="2025-12-16_17-10-25" src="https://github.com/user-attachments/assets/62e573d9-b941-4134-9dbe-3626dc6595a3" />
<img width="1920" height="1200" alt="2025-12-16_17-11-38" src="https://github.com/user-attachments/assets/046ec252-d7f5-42a5-ae41-e2f262e4b81c" />
<img width="1920" height="1200" alt="2025-12-16_17-14-24" src="https://github.com/user-attachments/assets/e68633bb-efe5-4fdc-b0a1-fe041ffbbbfe" />
<img width="1920" height="1200" alt="2025-12-16_17-15-07" src="https://github.com/user-attachments/assets/204d256b-3eb3-4ff2-8e02-e808365049aa" />
<img width="1920" height="1200" alt="2025-12-16_17-20-40" src="https://github.com/user-attachments/assets/90a3195f-1f6f-4987-80ad-f3a977552ed8" />
<img width="1920" height="1200" alt="2025-12-16_17-22-03" src="https://github.com/user-attachments/assets/9acbfab8-df9f-4597-bc3c-d210d13d8dab" />
<img width="1920" height="1200" alt="2025-12-16_17-23-35" src="https://github.com/user-attachments/assets/6cde0ad8-9724-469e-a966-83661d34125d" />
<img width="1920" height="1200" alt="2025-12-16_17-24-56" src="https://github.com/user-attachments/assets/29f181f7-35c1-486e-996b-932a1889aa69" />

## License

The 'Virtual file system' is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Third-Party Licenses
This project uses third-party software components. Their respective licenses can be found in the LICENSE-3rd-party.md file.
