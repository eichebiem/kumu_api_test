Development environment: I am using Windows 10 for my development and I used Ubuntu 18 from windows store for me to install Redis. I also used XAMPP for me to run PHP codes.

Technology used:
1. PHP
2. Redis
3. MySQL
4. Laravel framework

Installation:
1. Download and install XAMPP 7.4.13 : https://www.apachefriends.org/download.html
2. Download and install Ubuntu 18 from windows store, once installation and setup is complete, follow instructions on how to download, install and run Redis from https://redislabs.com/blog/redis-on-windows-10/
3. Download and install composer as this will be a manager for Laravel PHP : https://getcomposer.org/
4. Launch and open XAMPP, open web browser and navigate to localhost/phpmyadmin and create database (kumu_api_test)
5. Download and install Node JS from : https://nodejs.org/en/
6. Download project from this repository
7. Open downloaded project using text editor and create a file (.env) and copy contents from (.env.example) to (.env) file
8. Navigate inside the downloaded project using terminal and type the following to install application dependencies
    * composer install
    * php artisan key:generate
    * npm install
    * npm run dev
9. Run migrations to create tables to the database, type (php artisan migrate) on the terminal
10. Type (php artisan serve) to launch application web server

How to use:
1. Navigate application thru browser : localhost:8000
2. Create an account and login to grant access to the application
3. After logging in successfully, you can search up 10 github users and the application will return the details per user alphabetically ordered by name, then application will attempt to communicate first to the Redis server and pull the request from there if it is already been cached if not the application will send an API request to github and fetch user data and save to Redis server for 2 minutes.
