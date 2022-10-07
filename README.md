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
            'status_key' => 'stateo',
            'reset_success' => ['data'],
            'reset_error' => ['number', 'message']
        ]
    ]
];
```
 `withstatus`  refere to add status code in the response or not 
 
 `default_dirver` name of default driver or schema you want to use 
 
 `driver` array of drivers you want to use 
 
 
 

