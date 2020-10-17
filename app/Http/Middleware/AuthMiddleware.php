<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Token;
use League\OAuth2\Server\ResourceServer;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Laravel\Passport\Exceptions\MissingScopeException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;

class AuthMiddleware
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    protected $server;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory $auth
     * @param ResourceServer $server
     */
    public function __construct(Auth $auth, ResourceServer $server)
    {
        $this->auth = $auth;
        $this->server = $server;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Closure $next
     * @param  string[] ...$guards
     * @return mixed
     *
     * @throws AuthenticationException
     * @throws MissingScopeException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($guards);
        } catch (\Exception $exception) {
            $psr = (new DiactorosFactory)->createRequest($request);

            try {
                $psr = $this->server->validateAuthenticatedRequest($psr);
            } catch (OAuthServerException $e) {
                throw new AuthenticationException;
            }
            $scopes = [];
            $this->validateScopes($psr, $scopes);
            $request->merge([
                'client_id' => $psr->getAttribute('oauth_client_id'),
                'id' => $psr->getAttribute('oauth_client_id'),
                'type' => 1,
            ]);

            $user = \Illuminate\Support\Facades\Auth::loginUsingId(1300);

            $user->withAccessToken(Token::where('client_id', $psr->getAttribute('oauth_client_id'))->orderByDesc('created_at')->first());
            $request->merge(['user' => $user ]);

            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        }

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }

    /**
     * Validate the scopes on the incoming request.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $psr
     * @param  array  $scopes
     * @return void
     * @throws \Laravel\Passport\Exceptions\MissingScopeException
     */
    protected function validateScopes($psr, $scopes)
    {
        if (in_array('*', $tokenScopes = $psr->getAttribute('oauth_scopes'))) {
            return;
        }

        foreach ($scopes as $scope) {
            if (! in_array($scope, $tokenScopes)) {
                throw new MissingScopeException($scope);
            }
        }
    }
}
