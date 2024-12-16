<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Тестовое задание (Laravel 11.31)


## Описание проекта
Этот проект реализует функционал корзины интернет-магазина
В проекте уже настроены миграции и сидеры для создания тестовых данных, а также добавлены два пользователя для входа в систему.

---

## Требования
- **PHP** >= 8.2
- **Composer**
- **Laravel** >= 11.31
- **База данных MySQL** (или другая поддерживаемая база данных)

---

## Установка

1. **Склонируйте репозиторий:**
   ```bash
   git clone https://github.com/lreqr/laravel-cart.git
   cd laravel-cart

2. **Установите зависимости:**
   ```bash
   composer install
   ```

3. **Скопируйте файл конфигурации и настройте подключение к базе данных:**
   ```bash
   cp .env.example .env
   ```
   В файле `.env` настройте параметры базы данных:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

4. **Сгенерируйте ключ приложения:**
   ```bash
   php artisan key:generate
   ```

5. **Создайте таблицы в базе данных и заполните тестовыми данными:**

    - **Выполните миграции:**
      ```bash
      php artisan migrate
      ```

    - **Заполните базу данных тестовыми данными с помощью сидеров:**
      ```bash
      php artisan migrate --seed
      ```

6. **Запустите сервер разработки:**
   ```bash
   php artisan serve
   ```
