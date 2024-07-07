<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\BaseController;
use Symfony\Component\HttpFoundation\Response;


class AuthenticationController extends BaseController
{

    //use this method to signin users
    public function login(LoginRequest $request)
    {
        //$attempt = JWTAuth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]);
        $attempt = JWTAuth::attempt($request->all());

        if ($attempt && Auth::user()->level == User::USER_EMPLOYEE){
            return $this->handleResponse($this->createNewToken($attempt), 'User logged-in!');
        }
        else
        {
            return $this->handleError('Unauthorised.', [ 'error' => 'Unauthorised']);
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        //Request is validated, do logout
        $forever = true;
        try {
            JWTAuth::parseToken()->invalidate($forever);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        }
        catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];
    }
}
