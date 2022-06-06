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
2. install project dependencies: `composer install`
3. Copy `.env.example` and rename to `.env` in the project's root directory
4. Run `php artisan key:generate` to set application's encryption key `APP_KEY` in the `.env` file;
   or `cp .env.example .env && php artisan key:generate`, if you'd rather get 3 & 4 done in one fell swoop
5. Create a database, and configure the application to interact with the created database. Do this within the `.env` file by setting appropriate values for the `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc., environment variables
6. Add `ADMIN_EMAIL` and `ADMIN_PASSWORD` env variables, necessary for setting up default admin in the data seeding process below
7. Run database migrations to create relevant database tables, add seed default data: `php artisan migrate --seed`

## Others
- You can update the `ADMIN_PASSWORD` variable in your `.env` file, or use the provided default
- To see the Slack Logs in action, you'll need to add a webhook url to `.env` at `LOG_SLACK_WEBHOOK_URL` 

## Others
You can run the program with `php artisan import:posts api`
You can also listen for queues with `php artisan queue:listen`

Note: the `api` option provided above runs the API importer aspect of the program. The program is built to potentially allow importing data from other sources, such as; `file`

## Testing
Run test suites: `php artisan test`

## License
This demo application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
