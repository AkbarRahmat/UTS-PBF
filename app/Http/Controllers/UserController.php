<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use GuzzleHttp\Client;

class UserController extends Controller
{
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error Validation',
                'data' => $validator->errors()
            ], 422);
        }
        $validated = $validator->validated();

        if (!Auth::attempt($validated)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed'
            ], 422);
        }

        $user = Auth::user();
        $payload = [
            'name' => $user->name,
            'role' => $user->role,
            'iat' => Carbon::now()->timestamp,
            'exp' => Carbon::now()->timestamp + 60 * 60 * 2,
        ];

        $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

        return response()->json([
            'success' => true,
            'message' => 'Login Succes',
            'data' => 'Bearer ' . $token
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error Validation',
                'data' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $payload = [
            'sub' => $user->id,
            'name' => $user->name,
            'iat' => Carbon::now()->timestamp,
            'exp' => Carbon::now()->timestamp + 60 * 60 * 2,
        ];

        $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

        return response()->json([
            'success' => true,
            'message' => 'User Registered',
            'data' => 'Bearer ' . $token
        ], 200);
    }

    public function redirectGoogle()
    {
        $parameters = [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'redirect_uri' => 'http://127.0.0.1:8000/api/oauth/register/call-back',
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'offline',
            'include_granted_scopes' => 'true',
            'state' => 'state_parameter_passthrough_value',
            'prompt' => 'consent' // Ensure the consent screen is shown
        ];

        $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($parameters);
        return response()->json([
            'success' => true,
            'redirect' => $authUrl
        ], 200);
    }

    public function callbackGoogle(Request $request)
    {
        $code = $request->input('code');
        if (!$code) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization code not found'
            ], 400);
        }

        $client = new Client();

        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'code' => $code,
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
                'grant_type' => 'authorization_code',
                'access_type' => 'offline',
            ],
        ]);
        $tokenData = json_decode($response->getBody(), true);
        $accessToken = $tokenData['access_token'];

        return response()->json([
            'success' => true,
            'data' => $accessToken
        ], 400);
    }
}
