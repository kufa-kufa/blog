# Blog using Laravel

A simple blog for demonstration purpose. Based on Laravel 7.10.3

## Requirements

- Laravel 7.10.3
- PHP >= 7.2.5
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension


## Installation

```
git clone https://github.com/kufa-kufa/blog.git
cd blog
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

If you want dummy data, then run this-

```
php artisan db:seed --class=DummyDataSeeder
```

## Author

- [Kufliddin Makmazaiitov ] (megakufa@gmail.com)

Feel free to email me, if you have any question.
