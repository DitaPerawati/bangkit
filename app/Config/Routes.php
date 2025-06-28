<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;
use App\Controllers\ProductController;
use App\Controllers\Home;
use App\Controllers\Admin;
use App\Controllers\Customer;

/**
 * @var RouteCollection $routes
 */

// Halaman umum
$routes->get('/bangkit', [Home::class, 'index']);

// ----------------- AUTH -----------------
$routes->get('/login', [Auth::class, 'login']); 
$routes->post('/login', [Auth::class, 'loginPost']); 
$routes->get('/logout', [Auth::class, 'logout']); 

$routes->get('/register', [Auth::class, 'register']);
$routes->post('/register', [Auth::class, 'registerPost']);

// ----------------- CUSTOMER -----------------
$routes->get('/customer', fn () => redirect()->to('/customer/dashboard'));
$routes->get('/customer/dashboard', [Customer::class, 'dashboard']); 

// Pesanan Customer
$routes->post('/beli', [ProductController::class, 'beli']); // Tetap di ProductController karena pembelian terkait produk
$routes->get('/riwayat', [Customer::class, 'riwayat']); // Lihat pesanan customer
$routes->get('/riwayat/selesai/(:num)', [Customer::class, 'selesai']); // Konfirmasi barang diterima


// ----------------- ADMIN -----------------
$routes->get('/admin', fn () => redirect()->to('/admin/dashboard'));
$routes->get('/admin/dashboard', [Admin::class, 'dashboard']); 

// Produk Admin
$routes->get('/products', [ProductController::class, 'list']); // Semua produk
$routes->group('products', function($routes) {
    $routes->get('addStock/(:num)', [ProductController::class, 'addStock']); 
    $routes->post('processAddStock/(:num)', [ProductController::class, 'processAddStock']); 
    $routes->post('processReduceStock/(:num)', [ProductController::class, 'processReduceStock']);
    $routes->post('delete/(:num)', [ProductController::class, 'delete']); 
});

// Pesanan Admin
$routes->get('/admin/pesanan', [Admin::class, 'pesanan']); // Menampilkan daftar semua pesanan
$routes->get('/admin/pesanan/konfirmasi/(:num)', [Admin::class, 'konfirmasi']); // Admin konfirmasi pengiriman


// ----------------- PRODUK (Detail & Komentar) -----------------
$routes->get('/customer/detail/(:num)', [ProductController::class, 'detail']);
$routes->get('/admin/detail/(:num)', [ProductController::class, 'detail']);
$routes->get('/bangkit/detail/(:num)', [ProductController::class, 'detail']);
$routes->post('/customer/komen', [ProductController::class, 'komen']);

// ----------------- DASHBOARD OTOMATIS -----------------
$routes->get('/dashboard', function () {
    $role = session()->get('role');
    if ($role === 'customer') {
        return redirect()->to('/customer/dashboard');
    } elseif ($role === 'admin') {
        return redirect()->to('/admin/dashboard');
    } else {
        return redirect()->to('/bangkit');
    }
});
