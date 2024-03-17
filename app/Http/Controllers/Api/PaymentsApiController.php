<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PaymentsApiController extends Controller
{
    //
    public function tambahPembayaran(Request $request)
    {
        $namaPembayar = $request->input('namaPembayar');
        $jumlahBayar = $request->input('jumlahBayar');
        $metodeBayar = $request->input('metodeBayar');
        $buktiBayar = $request->file('buktiBayar');

        $filename = $buktiBayar != null ? strtolower($namaPembayar).'-'.Str::random(20). '-' . $buktiBayar->extension() : "Tidak Ada Bukti";
        DB::beginTransaction();
        try {
            PaymentsModel::create([
                'nama_pembayar' => $namaPembayar,
                'metode_pembayaran' => $metodeBayar,
                'bukti_bayar_img' => $filename,
                'jumlah_bayar' => $jumlahBayar
            ]);
            $buktiBayar != null ? $buktiBayar->move('assets/images', $filename) : null;
            DB::commit();
            return response()->json($this->responseTemplate(201, 'Data Berhasil Ditambahkan'),201);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }
    }

    public function getAllPembayaran(){
        $data = PaymentsModel::all();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function deletePembayaran($id){
        DB::beginTransaction();
        try {
            PaymentsModel::where('id', $id)->delete();
            DB::commit();
            return response()->json($this->responseTemplate(200, 'Data Berhasil DiHapus'),200);
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
