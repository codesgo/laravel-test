<?php

namespace Codesgo\Laraback\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckRole
{

	protected $auth;

	/**
	 * Creates a new instance of the middleware.
	 *
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string  $role
	 * @return mixed
	 */
	public function handle($request, Closure $next, $roles)
	{
		dd( $request->user()->hasRole(explode('|', $roles)) );
		if ($this->auth->guest() || !$request->user()->hasRole(explode('|', $roles))) {
			abort(403);
		}

		return $next($request);
	}

}