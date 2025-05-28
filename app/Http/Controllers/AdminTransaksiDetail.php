<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class AdminTransaksiDetail extends Controller
{
    public function create(Request $request)
    {
        $produk_id     = $request->produk_id;
        $transaksi_id  = $request->transaksi_id;

        $td = TransaksiDetail::whereProdukId($produk_id)
                             ->whereTransaksiId($transaksi_id)
                             ->first();

        $transaksi = Transaksi::findOrFail($transaksi_id);

        // Hitung harga_satuan dari subtotal dibagi qty
        $qty = max(1, (int)$request->qty); // Hindari pembagian dengan nol
        $subtotal = (float)$request->subtotal;
        $harga_satuan = $subtotal / $qty;

        if ($td === null) {
            // Barang belum ada di transaksi, insert baru
            $data = [
                'produk_id'     => $produk_id,
                'produk_name'   => $request->produk_name,
                'transaksi_id'  => $transaksi_id,
                'qty'           => $qty,
                'harga_satuan'  => $harga_satuan,
                'subtotal'      => $subtotal,
            ];
            TransaksiDetail::create($data);

            $transaksi->update([
                'total' => $transaksi->total + $subtotal,
            ]);
        } else {
            // Barang sudah ada di transaksi, update qty, harga_satuan, dan subtotal
            $newQty = $td->qty + $qty;
            $newSubtotal = $td->subtotal + $subtotal;
            $newHargaSatuan = $newSubtotal / $newQty;

            $td->update([
                'qty'           => $newQty,
                'harga_satuan'  => $newHargaSatuan,
                'subtotal'      => $newSubtotal,
            ]);

            $transaksi->update([
                'total' => $transaksi->total + $subtotal,
            ]);
        }

        return redirect('/admin/transaksi/' . $transaksi_id . '/edit');
    }
}
