<p align="center">Laravel Passport Multiple Guard Auth App</p>

## Laravel Passport?

Laravel already makes it easy to perform authentication via traditional login forms, but what about APIs? APIs typically use tokens to authenticate users and do not maintain session state between requests. Laravel makes API authentication a breeze using Laravel Passport, which provides a full OAuth2 server implementation for your Laravel application in a matter of minutes. Passport is built on top of the League OAuth2 server that is maintained by Andy Millington and Simon Hamp.
&nbsp;


## How to setup this application?

1) After cloning the application, you need to install it's dependencies,
- cd laravel-passport-auth
- composer install
  &nbsp;
  &nbsp;
2) Then rename .env.example as .env and provide correct db details.
   &nbsp;
   &nbsp;
3) After Generate the application key using following command,
- php artisan key:generate
  &nbsp;
  &nbsp;
4) Migrate the application using following command,
- php artisan migrate
  &nbsp;
  &nbsp;
5) Create the encryption keys needed to generate secure access tokens,
- php artisan passport:install
  &nbsp;
  &nbsp;
6) Finally run the application using following command,
- php artisan serve
  &nbsp;


<br>
<br>
<p align="center">You can change api as you wish and according to the requirements.</p>
