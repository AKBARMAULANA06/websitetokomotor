<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class AdminTransaksiDetailController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'produk_id'     => 'required|exists:produks,id',
            'transaksi_id'  => 'required|exists:transaksis,id',
            'produk_name'   => 'required|string|max:255',
            'qty'           => 'required|integer|min:1',
            'subtotal'      => 'required|numeric|min:0',
        ]);

        $produk_id = $validated['produk_id'];
        $transaksi_id = $validated['transaksi_id'];
        $qty = $validated['qty'];
        $subtotal = $validated['subtotal'];

        // Hitung harga_satuan
        $harga_satuan = $qty > 0 ? $subtotal / $qty : 0;

        // Ambil transaksi dan detail
        $transaksi = Transaksi::findOrFail($transaksi_id);
        $td = TransaksiDetail::where('produk_id', $produk_id)
            ->where('transaksi_id', $transaksi_id)
            ->first();

        if ($td === null) {
            // Tambah data baru
            TransaksiDetail::create([
                'produk_id'     => $produk_id,
                'produk_name'   => $validated['produk_name'],
                'transaksi_id'  => $transaksi_id,
                'qty'           => $qty,
                'harga_satuan'  => $harga_satuan,
                'subtotal'      => $subtotal,
            ]);

            // Update total transaksi
            $transaksi->update([
                'total' => $transaksi->total + $subtotal,
            ]);
        } else {
            // Update data lama
            $td->update([
                'qty'           => $td->qty + $qty,
                'harga_satuan'  => $harga_satuan,
                'subtotal'      => $td->subtotal + $subtotal,
            ]);

            // Update total transaksi
            $transaksi->update([
                'total' => $transaksi->total + $subtotal,
            ]);
        }

        return redirect('/admin/transaksi/' . $transaksi_id . '/edit');
    }
}
