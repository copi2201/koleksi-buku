<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $menu = DB::table('modul6_menus')
            ->join('modul6_vendors', 'modul6_menus.vendor_id', '=', 'modul6_vendors.id')
            ->select('modul6_menus.*', 'modul6_vendors.nama_vendor')
            ->where('modul6_menus.id', $request->menu_id)
            ->first();

        if (!$menu) {
            return redirect('/')->with('error', 'Menu tidak ditemukan.');
        }

        return view('modul6.payment.index', compact('menu'));
    }

    public function bayar(Request $request)
    {
        try {
            $menu = DB::table('modul6_menus')->where('id', $request->menu_id)->first();

            if (!$menu) {
                return response()->json([
                    'error' => 'Menu tidak ditemukan.'
                ], 404);
            }

            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = (bool) config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $orderId = 'ORDER-' . time() . '-' . $menu->id;

            // SIMPAN KE DATABASE (PENDING)
            DB::table('modul6_pesanans')->insert([
                'kode_pesanan' => $orderId,
                'nama_customer' => 'Guest',
                'total' => (int) $menu->harga,
                'metode_bayar' => 'Midtrans',
                'status_bayar' => 'Pending',
                'status_pesanan' => 'Menunggu Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $menu->harga,
                ],
                'customer_details' => [
                    'first_name' => 'Guest',
                    'email' => 'guest@example.com',
                ],
                'item_details' => [
                    [
                        'id' => $menu->id,
                        'price' => (int) $menu->harga,
                        'quantity' => 1,
                        'name' => $menu->nama_menu,
                    ]
                ]
            ];

            $token = Snap::getSnapToken($params);

            return response()->json([
                'token' => $token,
                'order_id' => $orderId
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

        public function updateStatus(Request $request)
        {
            DB::table('modul6_pesanans')
                ->where('kode_pesanan', $request->order_id)
                ->update([
                    'status_bayar' => 'Lunas',
                    'status_pesanan' => 'Diproses',
                    'metode_bayar' => 'Midtrans',
                    'waktu_bayar' => now(),
                    'updated_at' => now(),
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil. Status pesanan sudah Lunas.'
            ]);
        }
        public function success(Request $request)
        {
            $order_id = $request->query('order_id');

            $pesanan = DB::table('modul6_pesanans')
                ->where('kode_pesanan', $order_id)
                ->first();

            return view('modul6.payment.success', compact('order_id', 'pesanan'));
        }
    }
