<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthServices
{
    public static function login($credentials)
    {
        try {
            if (Auth::attempt($credentials)) {
                return (object)[
                    'status' => 200,
                    'message' => 'Login successful',
                    'data' => Auth::user(),
                    'errors' => null
                ];
            }
            
            return (object)[
                'status' => 401,
                'message' => 'Invalid credentials',
                'data' => null,
                'errors' => 'Email dan password salah.'
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => 500,
                'message' => 'An error occurred',
                'data' => null,
                'errors' => $e->getMessage(),
            ];
        }
    }

    public static function register($data)
    {
        try {
            DB::beginTransaction();
            
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            
            DB::commit();
            
            return (object)[
                'status' => 200,
                'message' => 'Registration successful',
                'errors' => null,
                'data' => $user
            ];
        } catch (Exception $e) {
            DB::rollBack();
            
            return (object)[
                'status' => 401,
                'message' => 'Registration failed',
                'errors' => $e->getMessage(),
                'data' => null
            ];
        }
    }
}
