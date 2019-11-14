<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\ISettingsRepository;


class CommonMiddleware
{
    public function __construct(ISettingsRepository $settingsRepo) {
        $this->settingsRepo = $settingsRepo;
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
        View::share('appName', $this->settingsRepo->getValue('Application name'));
        View::share('user', Auth::user());
        return $next($request);
    }
}
