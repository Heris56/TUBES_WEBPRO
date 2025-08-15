<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Exception;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function getAll()
    {
        try {
            $data = Umkm::orderByDesc('created_at')->get();
            return response()->json(
                [
                    "message" => "Success get Umkm",
                    "status" => "success",
                    "data" => $data
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => "Failed to get Umkm",
                    "status" => "failed",
                    "error" => $e->getMessage()
                ],
                500
            );
        }
    }
}
