<?php
/*
 * This file is part of the Laravel Platfourm package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\Platfourm\Auth\Middleware;

use Closure;
use Longman\Platfourm\Contracts\Auth\AuthUserService as AuthUserServiceContract;

class ResponseGuestIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $authService;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(AuthUserServiceContract $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->authService->check()) {
            if ($request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return $this->redirect();
            }
        }

        return $next($request);
    }

    protected function redirect()
    {
        $url = app()->isAdmin() ? admin_url('login') : site_url('/');
        return redirect()->guest($url)->with('success', 'You are logged in');
    }

}
