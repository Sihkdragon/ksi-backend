<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\FlareClient\Truncation\ReportTrimmer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $response = [
            'message' => 'Success',
            'status' => 200,
            'payload' => [
                'data' => 'username',
                'email' => 'test@email.com'
            ]
        ];
        return response($response);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = ModelsUser::where('email', $request->email)->first();
            if (!$user) return response(['status' => 'Failed', 'message' => 'User Not Found']);
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($user->name)->accessToken;
                return response([
                    'status' => 201,
                    'payload' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ]);
            } else {
                return response((['status' => 'Failed', 'message' => 'Wrong Password']));
            }
        } catch (\Exception $e) {
            return response(['status' => 'Failed', 'message' => $e->getMessage()]);
        }
    }
}
