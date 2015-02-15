<?php namespace Branches\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

    /*
     * Array of Routes to skip CSRF check
     * @see http://www.laravel-tricks.com/tricks/disable-csrf-on-specific-routes
     */
    private $openRoutes = ['/'];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        foreach($this->openRoutes as $route) {

            if ($request->is($route)) {
                return $next($request);
            }
        }
		return parent::handle($request, $next);
	}

}
