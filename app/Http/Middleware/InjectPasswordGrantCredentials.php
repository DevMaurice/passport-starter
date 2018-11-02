<?php

namespace App\Http\Middleware;

use DB;
use Closure;

class InjectPasswordGrantCredentials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->grant_type == 'password') {
            $client = DB::table('oauth_clients')
                        ->where('id', config('auth.password_grant_client_id'))
                        ->first();

            $request->request->add([
                'grant_type' => request('grant_type'),
                'client_id' => $client->id,
                'client_secret' => $client->secret,

            ]);
        } else {
            $client = DB::table('oauth_clients')
            ->where('id', config('auth.password_grant_client_id'))
            ->first();
            $request->request->add([
                'grant_type' => request('grant_type'),
                'client_id' => $client->id,
                'client_secret' => $client->secret,

            ]);
        }

        return $next($request);
    }
}
