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

#Login
To login here are the steps:
- Create a middleware `InjectPasswordGrantCredentials` and add it to the  named `middleware Kernel` file.
- On the `AuthServiceProvider` override the `oauth/token` route to include the `InjectPasswordGrantCredentials` middleware.
- The middleware will require a `password_grant_client_id` setting in the `auth` file or you can put it in your app specific config file.
- Now it's okay and you can login using `{{url}}/oauth/token` with the following parameters: 
        1. `email = 'myemail@gmail.com'` //user input
        2. `password = 'supersecretpassword'` //user input
        3. `grant_type = 'password'`  // This must be *password*.
- In response you will get a `token`, `refresh_token`,`expires_in` and `token_type` (See login .png)

#Refresh Token
The access token given expires after `expire_in` time given and to get a new token you will need to refresh token.
Here are the steps:
- use  `{{url}}/oauth/token` with the following parameters: 
        1. `refresh_token = {{refresh_token}}` //Refresh token you got when you logged in
        3. `grant_type = 'refresh_token'`  // This must be *refresh_token*.
- make sure the header contains `Authorization: Bearer {{token}} ` //Access token got from loggig in.

#Log out
To log out just send a post request to `{{url}}/api/logout
The header must contain `Authorization: Bearer {{token}} `

