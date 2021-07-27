<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages());
        }

        $data = $request->all();
        $user = User::create($data);
        $data = [
            'token' => $user->createToken('BreakingBad')->plainTextToken,
            'user' => $user
        ];
        return responder()->success($data);
    }

    /**
     * Login
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $user = User::find($user->id);
            $data = [
                'token' => $user->createToken('BreakingBad')->plainTextToken,
                'user' => $user
            ];
            return responder()->success($data);
        }
        return responder()->error(401, 'Unauthorised');
    }


    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return responder()->success(['message' => 'Logged out']);
    }
}
