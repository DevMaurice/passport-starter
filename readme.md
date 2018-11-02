#Steps

- Create a new Laravel project.
        `composer create-project laravel/laravel -passport-starter --prefer-dist`
- Install(add) laravel passport
    `composer require laravel/passport`
- Make sure your database is well set-up
- Run `php artisan migrate `
- Run `php artisan passport:install ` This will generate encryption keys and     database access clients(personal and Password grant) 
- Add `HasApiTokens` trait to your User class. 
- Next add `Passport::routes(); ` to the `AuthServiceProvider` to register all  the routes needed by passport.
- Finally for setup change the api driver fromm `token` ro `passport` in         `auth.php` config file.

#Register
For registration do it like any other registration in laravel application, You can even add email verification and the likes.
