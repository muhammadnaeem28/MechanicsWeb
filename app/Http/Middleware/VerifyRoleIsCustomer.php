<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;

class VerifyRoleIsCustomer
{
    /**
     * create a new instance
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->check() && ($this->auth->user()->role == 'customer' || $this->auth->user()->role == 'admin')) {
            return $next($request);
        }
        return redirect()->route('home.index');
               
    }
}
