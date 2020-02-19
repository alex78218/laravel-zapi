<?php

namespace App\Http\Middleware;

use App\Enums\CodeEnum;
use Closure;
use App\Traits\ApiResponse;

class ApiTokenCheck
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->user()){
            return $this->error([],CodeEnum::ERROR_NOT_AUTH);
        }
        return $next($request);
    }
}
