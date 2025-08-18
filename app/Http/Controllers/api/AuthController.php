<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Pembeli;
use App\Models\Umkm;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginPembeli(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 400);
            }

            $email = strtolower($request->email);
            $password = $request->password;

            $user = Pembeli::where('email', $email)->first();
            if (!$user) {
                return response()->json([
                    'error' => 'Email tidak terdaftar'
                ], 401);
            }

            if (!Hash::check($password, $user->password)) {
                return response()->json([
                    'error' => 'Kata sandi salah'
                ], 401);
            }

            if (!$user->is_verified) {
                $otp = rand(100000, 999999);
                $user->auth_code = $otp;
                $user->save();

                try {
                    Mail::raw("Kode OTP anda adalah $otp", function ($message) use ($user) {
                        $message->to($user->email)
                            ->from(env('MAIL_FROM_ADDRESS'))
                            ->subject("Kode OTP Untuk Masuk ke Akun Pembeli");
                    });
                } catch (\Exception $mailError) {
                    return response()->json([
                        'error' => 'Gagal mengirim email OTP: ' . $mailError->getMessage()
                    ], 500);
                }

                return response()->json([
                    'message' => 'OTP terkirim ke email anda',
                    'id_pembeli' => $user->id_pembeli,
                    'is_verified' => 0,
                ], 200);
            }

            return response()->json([
                'message' => 'Login berhasil',
                'id_pembeli' => $user->id_pembeli,
                'is_verified' => 1,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal masuk: ' . $e->getMessage()
            ], 500);
        }
    }

    public function loginUmkm(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 400);
            }

            $email = strtolower($request->email);
            $password = $request->password;

            $user = Umkm::where('email', $email)->first();
            if (!$user) {
                return response()->json([
                    'error' => 'Email tidak terdaftar'
                ], 401);
            }

            if (!Hash::check($password, $user->password)) {
                return response()->json([
                    'error' => 'Kata sandi salah'
                ], 401);
            }

            if (!$user->is_verified) {
                $otp = rand(100000, 999999);
                $user->auth_code = $otp;
                $user->save();

                try {
                    Mail::raw("Kode OTP anda adalah $otp", function ($message) use ($user) {
                        $message->to($user->email)
                            ->from(env('MAIL_FROM_ADDRESS'))
                            ->subject("Kode OTP Untuk Masuk ke Akun UMKMKU");
                    });
                } catch (\Exception $mailError) {
                    return response()->json([
                        'error' => 'Gagal mengirim email OTP: ' . $mailError->getMessage()
                    ], 500);
                }

                return response()->json([
                    'message' => 'OTP terkirim ke email anda',
                    'id_umkm' => $user->id_umkm,
                    'is_verified' => 0,
                ], 200);
            }

            return response()->json([
                'message' => 'Login berhasil',
                'id_umkm' => $user->id_umkm,
                'is_verified' => 1,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal masuk: ' . $e->getMessage()
            ], 500);
        }
    }

    public function registerPembeli(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap'   => 'required|string|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'username'       => 'required|string|max:255|unique:pembelis,username',
            'email'          => 'required|string|email|max:255|unique:pembelis,email',
            'password'       => 'required|string|min:6',
            'alamat'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status'  => 'failed',
                'errors'  => $validator->errors()
            ], 400);
        }

        try {
            $pembeli = Pembeli::create([
                'nama_lengkap'      => $request->nama_lengkap,
                'nomor_telepon'     => $request->nomor_telepon,
                'username'          => $request->username,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'alamat'            => $request->alamat ?? null,
                'is_verified'       => false,
                'auth_code'         => null,
                'reset_token'       => null,
                'reset_token_expiry' => null,
            ]);

            return response()->json([
                'message' => 'Pembeli registered successfully',
                'status'  => 'success',
                'data'    => $pembeli
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to register Pembeli',
                'status'  => 'failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function registerUmkm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap'   => 'required|string|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'username'       => 'required|string|max:255|unique:umkms,username',
            'email'          => 'required|string|email|max:255|unique:umkms,email',
            'password'       => 'required|string|min:6',
            'NIK_KTP'        => 'required|digits:16|unique:umkms,NIK_KTP',
            'alamat'         => 'nullable|string',
            'nama_usaha'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status'  => 'failed',
                'errors'  => $validator->errors()
            ], 400);
        }

        try {
            $umkm = Umkm::create([
                'nama_lengkap'      => $request->nama_lengkap,
                'nomor_telepon'     => $request->nomor_telepon,
                'username'          => $request->username,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'NIK_KTP'           => $request->NIK_KTP,
                'alamat'            => $request->alamat ?? null,
                'nama_usaha'        => $request->nama_usaha ?? null,
                'is_verified'       => false,
                'auth_code'         => null,
                'reset_token'       => null,
                'reset_token_expiry' => null,
            ]);

            return response()->json([
                'message' => 'UMKM registered successfully',
                'status'  => 'success',
                'data'    => $umkm
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to register UMKM',
                'status'  => 'failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    use HttpResponses;
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_telepon'     => $request->nomor_telepon,
            'username'          => $request->username,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'nik'           => $request->nik,
            'alamat'            => $request->alamat ?? null,
            'nama_usaha'        => $request->nama_usaha ?? null,
            'is_verified'       => false,
            'auth_code'         => null,
            'reset_token'       => null,
            'reset_token_expiry' => null,
        ]);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->username)->plainTextToken
        ]);
    }

    public function login(StoreUserRequest $request)
    {
        return 'Login success';
    }
}
