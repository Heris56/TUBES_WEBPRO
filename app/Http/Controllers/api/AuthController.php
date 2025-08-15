<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginPembeli()
    {
        $user = 0;
    }

    public function loginUmkm()
    {
        $user = 0;
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
                'reset_token_expiry'=> null,
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
