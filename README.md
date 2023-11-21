# Student Sponsorship

The website Student Sponsorship is a valuable resource that empowers students in their pursuit of higher education by connecting them with a wide array of sponsorship opportunities. With an intuitive interface and a vast database of scholarships, grants, and financial aid options, Student Sponsorship simplifies the often overwhelming process of seeking funding for academic endeavors.

## Requirements

-   php 7.4
-   composer 2
-   database: Sqlite, MySQL, or PostgreSQL
-   web browser
-   code editor
-   git

## Installation

### Composer and PHP

-   git clone https://github.com/6hislain/point-of-sale-laravel
-   cd point-of-sale-laravel
-   composer install
-   php artisan key:generate
-   rename _.env.example_ to _.env_
-   edit _.env_ to connect with your local database
-   php artisan migrate
-   php artisan serve

### Docker

-   docker build -t student-sponsorship .
-   docker run -d -p 8000:8000 student-sponsorship

## TODO

### Database Tables

-   [x] User
-   [x] Child
-   [x] Sponsor
-   [ ] Sponsor Application
-   [ ] Payment
-   [ ] Update
