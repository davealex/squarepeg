# Squarepeg

A demo web blogging platform application.

The application is implemented on [Laravel 9.15.0](https://github.com/laravel/laravel/tree/v9.1.0) framework. The official documentation can be found on the [Laravel website](https://laravel.com/docs/9.x).

## Server Requirements
- PHP 8.1

## Installation
You can install the application either by cloning the repository from GitHub:

## Clone repository
Clone this project with:

`git clone git@github.com:davealex/squarepeg.git`
or
`git clone https://github.com/davealex/squarepeg.git`

Ensure you're on the `main` branch.

## Setup
1. cd into project root directory: `cd squarepeg`
2. install project dependencies: `php artisan install`
3. Copy `.env.example` and rename to `.env` in the project's root directory
4. Run `php artisan key:generate` to set application's encryption key `APP_KEY` in the `.env` file;
   or `cp .env.example .env && php artisan key:generate`, if you'd rather get 3 & 4 done in one fell swoop
5. Create a database, and configure the application to interact with the created database. Do this within the `.env` file by setting appropriate values for the `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc., environment variables
6. Run database migrations to create relevant database tables, add seed default data: `php artisan migrate --seed`

## Testing
Run test suites: `php artisan test`

## License
This demo application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
