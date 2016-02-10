<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	protected $exclude = [
		'images/upload'
	];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->isReading($request) || $this->excludedRoutes($request) || $this->tokensMatch($request))
		{
			return $this->addCookieToResponse($request, $next($request));
		}

		throw new TokenMismatchException;
	}

	protected function excludedRoutes($request)
	{
		$routes = $this->exclude;

		foreach($routes as $route)
			if ($request->is($route))
				return true;

		return false;
	}

}
