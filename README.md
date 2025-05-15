# CodeIgniter 4 Application Starter

## Setup

Install the dependencies using Composer:

```bash
composer install
```

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

Run migrations to set up the database by running this following command:

```bash
php spark migrate --all
```

You can also run the seeder to populate the database with some sample data:

```bash
php spark db:seed DatabaseSeeder
```

## Running the Application

You can run the application using the built-in PHP server. From the root of your project, run:

```bash
php spark serve
```

This will start the server at `http://localhost:8080`.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
>
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
