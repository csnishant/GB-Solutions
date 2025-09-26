<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // ...
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        'isCustomer' => \App\Http\Middleware\IsCustomer::class,
    ];
}
