<?php

namespace App\Http\Middleware;

use App\Http\Resources\MessageResource;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->bearerToken();
            $decoded = JWT::decode($token, new Key(env('API_SECRET_KEY'), 'HS256'));

            if ($decoded->exp and $decoded->exp < time()) {
                return new MessageResource(['errorCode' => 4, 'message' => 'Token expired']);
            }
            if ($decoded->api_key and $decoded->api_key === env('API_KEY')) {
                return $next($request);
            }

            return new MessageResource([
                'errorCode' => 401,
                'message'   => Response::$statusTexts[Response::HTTP_UNAUTHORIZED]
            ]);

        } catch (\Exception) {
            return new MessageResource([
                'errorCode' => 401,
                'message'   => Response::$statusTexts[Response::HTTP_UNAUTHORIZED]
            ]);
        }
    }
}
