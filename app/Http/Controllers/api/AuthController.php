<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginPembeli()
    {
        $user = 0;
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

    public function registerPembeli()
    {
        $user = 0;
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
}
