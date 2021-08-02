# CodeIgniter 4 Categories Assesment Test

## What is Categories App?

CodeIgniter Application that shows multi-level categories using only one table.

## Installation & updates
1. Clone this repo `git clone https://github.com/corecave/ci4-categories`.

2. Execute `composer install` or `composer update` to install application libraries.

3. create test database (e.g. `ci_categories`).

4. Copy `env` to `.env` and edit your `.env` file with your datebase credentials and your application URL `app.baseURL`.

5. execute command `php spark migrate && php spark db:seed CategorySeeder`

6. open your brower to test application 

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
