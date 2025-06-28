<?php

namespace App\Controllers;

use App\Models\LaptopModel;
use App\Models\KomentarModel;
use App\Models\PenjualanModel;

class ProductController extends BaseController
{
    public function index()
    {
        $model = new LaptopModel();
        $data['products'] = $model->findAll();
        return view('dashboard', $data);
    }

    public function list()
    {
        $this->adminOnly();
        $model = new LaptopModel();
        $data['products'] = $model->findAll();
        return view('products/product', $data);
    }

    public function addStock($id)
    {
        $this->adminOnly();
        $model = new LaptopModel();
        $product = $model->find($id);
        if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');
        return view('tambah', ['product' => $product]);
    }

    public function processAddStock($id)
    {
        $this->adminOnly();
        $model = new LaptopModel();
        $product = $model->find($id);
        if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');

        $amount = (int) $this->request->getPost('amount');
        if ($amount <= 0) return redirect()->back()->with('error', 'Jumlah harus lebih besar dari 0');

        $newStock = $product['stok'] + $amount;
        $model->update($id, ['stok' => $newStock]);
        return redirect()->to(site_url('products'))->with('success', 'Stok berhasil ditambah');
    }

    public function processReduceStock($id)
    {
        $this->adminOnly();
        $model = new LaptopModel();
        $product = $model->find($id);
        if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');

        $amount = (int) $this->request->getPost('amount');
        if ($amount <= 0) return redirect()->back()->with('error', 'Jumlah harus lebih besar dari 0');
        if ($amount > $product['stok']) return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia');

        $newStock = $product['stok'] - $amount;
        $model->update($id, ['stok' => $newStock]);
        return redirect()->to(site_url('products'))->with('success', 'Stok berhasil dikurangi');
    }

    public function delete($id)
    {
        $this->adminOnly();
        $model = new LaptopModel();
        $product = $model->find($id);
        if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');
        $model->delete($id);
        return redirect()->to(site_url('products'))->with('success', 'Produk berhasil dihapus');
    }

    public function detail($id)
    {
        $productModel = new LaptopModel();
        $komentarModel = new KomentarModel();

        $data['laptop'] = $productModel->find($id);
        $data['komentar'] = $komentarModel
            ->where('laptop_id', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('laptop_detail', $data);
    }

    public function komen()
    {
        $komentarModel = new KomentarModel();
        $komentarModel->insert([
            'laptop_id' => $this->request->getPost('laptop_id'),
            'nama'      => $this->request->getPost('nama'),
            'isi'       => $this->request->getPost('isi'),
        ]);
        return redirect()->to('/customer/detail/' . $this->request->getPost('laptop_id'));
    }


    public function beli()
    {
        if (!session()->get('role')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $id     = $this->request->getPost('id');
        $jumlah = (int) $this->request->getPost('jumlah');
        $metode = $this->request->getPost('metode_pembayaran'); // disesuaikan

        if (!$metode) {
            return redirect()->back()->with('error', 'Metode pembayaran harus dipilih');
        }

        $laptopModel = new LaptopModel();
        $product = $laptopModel->find($id);
        if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');
        if ($jumlah <= 0 || $jumlah > $product['stok']) {
            return redirect()->back()->with('error', 'Jumlah pembelian tidak valid');
        }

        $penjualanModel = new PenjualanModel();
        $penjualanModel->insert([
            'user_id'           => session()->get('user_id'),
            'laptop_id'         => $id,
            'nama_laptop'       => $product['nama'],
            'harga'             => $product['harga'],
            'jumlah'            => $jumlah,
            'total_harga'       => $jumlah * $product['harga'],
            'tanggal'           => date('Y-m-d H:i:s'),
            'status'            => 'menunggu',
            'metode_pembayaran' => $metode
        ]);

        return redirect()->to('/customer')->with('success', 'Pesanan Anda sedang menunggu konfirmasi admin.');
    }

    private function adminOnly()
    {
        if (session()->get('role') !== 'admin') {
            exit(redirect()->to('/login')->with('error', 'Akses ditolak'));
        }
    }
}
