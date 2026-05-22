<?php
namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel{
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'rol' => \App\Http\Middleware\CheckRole::class, 
    ];
}