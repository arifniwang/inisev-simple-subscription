# Inisev - Simple Subscription
Create a simple subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

## System Requirement
- PHP 7.3.*
- Laravel 8.*.
- MySQL
<hr>


## Feature
- Bestpractice Laravel (Migraiton, Model, Seeder, Mail, Queue, Job, Cache).
- Registration Websites Domain.
- Subscribe & Unsubscribe to Websites.
- Blast Posts to Subscriber Emails.
- Send Email with Queue and Job.
<hr>


## Installation
1. Clone or download the projects.
```php
$ git clone https://github.com/arifniwang/inisev-simple-subscription.git
```

2. Install Source Vendor.
```php
$ composer install
```

3. Running Migration.
```php
$ php artisan migrate
```

4. If you want to get dummy data, you can run seeder.
```php
$ php artisan db:seed
```

5. Now you can run 2 services artisan for serve and listening queue
```php
$ php artisan serve
$ php artisan queue:listen
```

6. Setup Complete and you can read Postman Documentation and run it to get the feature.
- Postman Collection : [https://documenter.getpostman.com/view/3117606/UVyrVcFj
<hr>


## License

The code is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
