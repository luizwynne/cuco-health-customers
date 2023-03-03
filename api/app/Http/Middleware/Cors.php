<?php

namespace App\Http\Middleware;

use App\Language;
use Closure;
use Illuminate\Support\Facades\App;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response           = $next($request);
        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResponse    = 'Symfony\Component\HttpFoundation\Response';
        $headers            = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, PUT, POST, DELETE, PATCH',
            'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Authorization, Access-Control-Request-Headers',
            'Access-Control-Allow-Credentials' => 'true',
        ];

        if ($response instanceof $IlluminateResponse) {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }

            return $response;
        } else if ($response instanceof $SymfonyResponse) {
            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }

            return $response;
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS');
    }
}