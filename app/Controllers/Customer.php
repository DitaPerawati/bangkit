<?php
namespace App\Controllers;

use App\Models\LaptopModel;

class Customer extends BaseController
{
    public function dashboard()
    {
        if (session()->get('role') !== 'customer') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }
        
        $model = new LaptopModel();
        $data['laptops'] = $model->findAll();

        return view('customer/dashboard', $data);
    }
        // Menampilkan riwayat pesanan customer
    public function riwayat()
    {
        if (session()->get('role') !== 'customer') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $penjualanModel = new \App\Models\PenjualanModel();
        $userId = session()->get('user_id');

        $data['pesanan'] = $penjualanModel
            ->where('user_id', $userId)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('customer/riwayat', $data);
    }

    // Konfirmasi bahwa pesanan sudah diterima
    public function selesai($id)
    {
        if (session()->get('role') !== 'customer') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $penjualanModel = new \App\Models\PenjualanModel();

        $pesanan = $penjualanModel->find($id);

        if (!$pesanan || $pesanan['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('error', 'Pesanan tidak valid');
        }

        $penjualanModel->update($id, ['status' => 'selesai']);

        return redirect()->to('/riwayat')->with('success', 'Pesanan telah dikonfirmasi selesai');
    }

}
