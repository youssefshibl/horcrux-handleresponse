# horcrux-handleresponse
horcrux-handleresponse is small laravel package handle schema of response in laravel
### install
```bash
composer require horcrux/handleresponse
```
### add config file 
```bash
php artisan vendor:publish --provider="Horcrux\Handleresponse\HandleresponseServiceProvider" --tag="config"
```
this will load config file its name "horcruxresponse.php" in config directory
the file will be like this 
```php
<?php

return [
    'withstatus' => false,
    'default_dirver' => 'default',
    'drivers' => [
        'drivers_name' => [
            'status_key' => 'status',
            'reset_success' => ['data'],
            'reset_error' => ['number', 'message']
        ]
    ]
];
```
 `withstatus`  refere to add status code in the response or not 
 
 `default_dirver` name of default driver or schema you want to use 
 
 `driver` array of drivers you want to use 
 
 `driver.status_key` is status key of state of response true/false
 
 `driver.reset_success` array of data in success response
 
 `driver.reset_error`   array of data in failed response
 
 ## using
 #### 1- make driver like this 
 ```php
<?php

return [
    'withstatus' => false,
    'default_dirver' => 'profile-api',
    'drivers' => [
        'profile-api' => [
            'status_key' => 'status',
            'reset_success' => [ 'api_number','data'],
            'reset_error' => ['error_number', 'error_message']
        ]
    ]
];
```
#### 2- make controller and use `LaravelResponse`
 ```php
<?php

namespace App\Http\Controllers;

use Horcrux\Handleresponse\Core\Traits\LaravelResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use LaravelResponse;
    public function index()
    {
        return $this->senddata([152 , 'one']);
    }
}
```
this will return 
```js
{ status: true,
  api_number: 152,
  data: "one" }
```
##### if you want return error 
```php
return $this->senderror([258 , 'user is not found'])
```
will return 
```js
{	
status:	false,
error_number:258,
error_message:"user is not found" }
```

you can set status code in method like 
```php
return $this->senderror([258 , 'user is not found'],500);
// response will return with 500 status code
```
as well as you can set dirver name if you want to change default driver in some response
```php
return $this->senderror([258 , 'user is not found'],500 , 'other_driver');
```
another method to change driver
```php
$this->change_driver('other_driver');
return $this->senderror([258 , 'user is not found']);
```
method to send success only 
```php
return $this->sendsuccess();
```
will return 
```js
{status:true}
```
