<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function getListProduk(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $pageSize = $request->input('pageSize', 10);
            $query = ListModel::where('is_active', 1);
            $jenisProduk = $request->query('jenisProduk');
            $jenisProduk = $request->input('jenisProduk');
            if ($request->has('jenisProduk') && !empty($jenisProduk)) {
                // Check if 'jenisProduk' is an array, if not, convert it to an array
                if (!is_array($jenisProduk)) {
                    $jenisProduk = explode(',', $jenisProduk);

                }
                $query->whereIn('jenis_produk', $jenisProduk);
            }
            if ($request->has('min') && $request->input('min') != '') {
                $query->where('harga', '>=', $request->input('min'));
            }
            if ($request->has('max') && $request->input('max') != '') {
                $query->where('harga', '<=', $request->input('max'));
            }
            $listProduk = $query->paginate($pageSize, ['*'], 'page', $page);
            $response = [
                "status" => "200",
                "message" => "sukses",
                "data" => [
                    "responseData" => $listProduk->items(),
                    "total" => $listProduk->total(),
                    "page" => $listProduk->currentPage(),
                    "pageSize" => $listProduk->perPage(),
                ]
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage(),
                'data' => null,
            ], 400);
        }
    }
}
