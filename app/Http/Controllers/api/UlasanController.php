<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Exception;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function getAll()
    {
        try {
            $data = Ulasan::orderByDesc('created_at')->get();
            return response()->json(
                [
                    "message" => "Success get all Ulasan",
                    "status" => "success",
                    "data" => $data
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => "Failed to get all ulasan",
                    "status" => "failed",
                    "error" => $e->getMessage()
                ],
                500
            );
        }
    }

    public function getByIdProduk($id)
    {
        try {
            $data = Ulasan::findOrFail($id);
            return response()->json(
                [
                    "message" => "Success get ulasan by produk id",
                    "status" => "success",
                    "data" => $data
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => "Failed to get ulasan by produk id",
                    "status" => "failed",
                    "error" => $e->getMessage()
                ],
                500
            );
        }
    }
}
