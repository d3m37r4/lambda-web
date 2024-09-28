<h1 align="center">Lambda</h1>

<div align="center">

### ![GitHub last commit](https://img.shields.io/github/last-commit/d3m37r4/lambda-web?style=flat-square) ![GitHub Issues or Pull Requests](https://img.shields.io/github/issues-pr/d3m37r4/lambda-web?style=flat-square) ![GitHub Issues or Pull Requests](https://img.shields.io/github/issues/d3m37r4/lambda-web?style=flat-square) ![Static Badge](https://img.shields.io/badge/any_text-MIT-green?style=flat-square&label=license)

</div>

## About Lambda
A system of interaction with game servers based on the GoldSource engine, realizing the following tasks:

- Granting roles and permissions and privileges on the game server.
- Management blocking and punishment of players.
- Keeping game statistics.

The application is based on the following stack:\
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-EB5424?style=flat-square&logo=laravel&logoColor=white)
![Inertia.js](https://img.shields.io/badge/Inertia.js-4FC08D?style=flat-square&logo=inertia&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=flat-square&logo=vuedotjs&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)

## Requirements
To install Lambda you need:

* PHP 8.1 or higher.
* Composer - For dependency management.
* MySQL-enabled server - For the database (MariaDB 10.10+, MySQL 5.7+, PostgreSQL 11.0+).
* Node.js and npm - To work with frontend dependencies (Vue and Tailwind CSS).

## Deployment
<details>
<summary>Detailed instruction on how to deploy the application (click)</summary>

1. **Clone the Repository**\
    Clone the project from GitHub:
      ```bash
      git clone https://github.com/d3m37r4/lambda-web.git
      cd lambda-web
      ```
2. **Install Dependencies**\
   Install dependencies using Composer and npm:
      ```bash
    composer install
    npm install
      ```

3. **Configure Environment**\
   Copy the `.env.example` file to `.env`:
      ```bash
    cp .env.example .env
      ```
   Open the `.env` file and configure database connection settings:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password 
    ```

4. **Generate Application Key**\
   Generate the application key:
    ```bash
    php artisan key:generate
    ```

5. **Create Database**\
   Create the database in MySQL or another supported DBMS.


6. **Run Migrations**\
   Run migrations to create tables in the database:
    ```bash
    php artisan migrate
    ```

7. **Start the Server**\
   Start the built-in server:
    ```bash
    php artisan serve
    ```
   Your application should now be accessible at http://localhost:8000.


8. **Additional Settings**\
   Set permissions for the `storage` and `bootstrap/cache` folders:
      ```bash
      chmod -R 775 storage
      chmod -R 775 bootstrap/cache
      ```
</details>

To send requests from your game server, you must use a package based on AMX Mod X, which can be found here: [Lambda-AMXX](https://github.com/d3m37r4/lambda-amxx/).\
This package is designed to organize the communication between your game server and the Lambda application.\
Be sure to follow the documentation provided in the repository for proper implementation and use.

## Contribution and support
If you have any thoughts or suggestions to improve the product, contact me at one of the following places:\
[Github Issues](https://github.com/d3m37r4/lambda-web/issues/)\
[Github Discussions](https://github.com/d3m37r4/lambda-web/discussions/)\
[Telegram](https://t.me/dmitry_isakow)

## License
The product is open source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
