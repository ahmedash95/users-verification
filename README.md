# Laravel Users Verification


This package contains a trait to support Eloquent Models Verification

```php
$user = App\User::find(1);

// Generate token or get it if exists
$user->getToken();

// check if user is verified or not
$user->isVerified()

// check if token is valid for user
$token = 'random_token_generated_by_getToken()_method'
$user->verifyToken($token) // return true or false

// verify the user
if($user->verifyToken($token)) {
	$user->verify();
}

// remove user token
$user->flushToken();
```

## Installation

You can install the package via composer:
```bash
composer require ahmedash95/users-verification
```

Next up, the service provider must be registered:

```php
// config/app.php
'providers' => [
    ...
    Ahmedash95\UsersVerification\UsersVerificationServiceProvider::class,

];
```

you must publish the migration file:
```bash
php artisan vendor:publish --provider="Ahmedash95\UsersVerification\UsersVerificationServiceProvider" --tag="migrations"
```


## Use verification in User model

```php
use Illuminate\Foundation\Auth\User as Authenticatable;

use Ahmedash95\UsersVerification\UsersVerification;

class User extends Authenticatable
{
    use UsersVerification;
```

## Available Methods

### Get\Generate token for user

The `getToken` method will return the user token string or generate it if it doesn't not exists.

```php
public function getToken() : string
```

### Check user token

This method will verify if the given token is valid for the user

```php
public function verifyToken(String $token) : bool
```

### Verify the user

After checking if the token is valid you may want to activate user verification .. then you should use `verify` method

```php
public function verify()
```

### Get user by token
If you want to validate your users using token you could use `findByToken` method

```php
public static function findByToken($token)
```

this method return object of user or null if doesn't exists

### Remove user's token
```php
public function flushToken()
```

## Security

If you discover any security related issues, please email ahmed29329@gmail.com instead of using the issue tracker.

## Credits

- [Ahmed Ashraf](https://github.com/ahmedash95)
- [All Contributors](https://github.com/ahmedash95/users-verification/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
