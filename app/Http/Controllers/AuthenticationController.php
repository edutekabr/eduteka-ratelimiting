<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthenticationController extends Controller
{
    /**
     * Validates user login.
     */
    public function login(LoginRequest $loginRequest, User $user)
    {
        $credentialsValidated = $loginRequest->validated();

        if (Auth::attempt($credentialsValidated)) {
            RateLimiter::clear('fail-login:'.$credentialsValidated['email']);

            $user = User::where('email', $credentialsValidated['email'])
                        ->select('id', 'name', 'email')
                        ->first();

            /* Realiza a autenticação e devolve um Token JWT ou Cookie */

            return response([
                'status' => 'success',
                'message' => 'Logado com sucesso!',
                'data' => [
                    'user' => $user
                ]
            ], 200);
        }


        $executed = RateLimiter::attempt(
            'fail-login:'.$credentialsValidated['email'],
            $maxAttempts = 5,
            function() {
                // Send message...
            },
            300
        );

        if (! $executed) {
            $seconds = RateLimiter::availableIn('fail-login:'.$credentialsValidated['email']);

            return response([
                'status' => 'error',
                'message' => "Limite de tentativas de login atingido, tente novamente daqui {$seconds} segundos!"
            ], 429);
        }

        return response([
            'status' => 'error',
            'message' => 'Login inválido!'
        ], 401);
    }
}
