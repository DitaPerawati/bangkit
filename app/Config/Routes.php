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

// Halaman Auth
$routes->get('/login', [Auth::class, 'login']); 
$routes->post('/login', [Auth::class, 'loginPost']); 
$routes->get('/logout', [Auth::class, 'logout']); 

// Halaman Customer
$routes->get('/customer/dashboard', [Customer::class, 'dashboard']); 
$routes->get('/riwayat', [Home::class, 'riwayat']); 
$routes->post('/beli', [Home::class, 'beli']); 

// Halaman Admin
$routes->get('/admin/dashboard', [Admin::class, 'dashboard']); 
$routes->get('/products', [ProductController::class, 'list']); // Daftar produk

//Detail Produks
$routes->get('/customer/detail/(:num)', [ProductController::class, 'detail']);
$routes->get('/admin/detail/(:num)', [ProductController::class, 'detail']);
$routes->get('/bangkit/detail/(:num)', [ProductController::class, 'detail']);
$routes->post('/customer/komen', [ProductController::class, 'komen']);

// Routes untuk ProductController
$routes->group('products', function($routes) {
    // Menampilkan form tambah stok (GET)
    $routes->get('addStock/(:num)', [ProductController::class, 'addStock']); 
    
    // Memproses form tambah stok (POST)
    $routes->post('processAddStock/(:num)', [ProductController::class, 'processAddStock']); 
    
    //kurangi produk
    $routes->post('processReduceStock/(:num)', [ProductController::class, 'processReduceStock']);
    
    // Hapus produk (POST)
    $routes->post('delete/(:num)', [ProductController::class, 'delete']); 

    //detail produk
});

// Route Dinamis ke Dashboard berdasarkan role
$routes->get('/dashboard', function () {
    $role = session()->get('role');
    if ($role === 'customer') {
        return redirect()->to('/customer/dashboard');
    } elseif ($role === 'admin') {
        return redirect()->to('/admin/dashboard');
    } else {
        return redirect()->to('/login');
    }
});