<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Инструкция развёртывния проекта


- Создать пустую папку для клонирования проекта
- Прописать в терминале в той же папке `git clone https://github.com/Zuev-Yaroslav/lead_service.git` (убедитесь, что на вашем ПК установлен GIT)
- Создать дубликат файла .env.example и переименовать на .env
- В .env можете поменять в DB_CONNECTION название субд (sqlite, mysql).
- Укажите пароль первого созданного пользователя FIRST_USER_PASSWORD. Если хотите зарегистрировать пользователя на клиенте, то можете закомментировать в `DatabaseSeeder.php`
```` php
        User::firstOrCreate(['email' => 'admin@admin.com'], [
            'name' => 'Admin',
            'password' => Hash::make(config('dev.first_user_password')),
        ]);
````
- В качестве SMTP сервиса я использовал ethereal.email. Чтобы настроить в проекте, нужно создать аккаунт на ethereal.email. в MAIL_USERNAME указать логин, в MAIL_PASSWORD - пароль.
- Прописать в терминале:
```` bash
composer update
php artisan key:generate
php artisan migrate --seed
npm install
````
- Запуск сервера:
```` bash
php artisan serv
vite
````
- Все коды отправляет в логи verification-codes
