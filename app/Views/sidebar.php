<aside id="sidebar">
    <h2>Menu</h2>
    <ul>
        <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>

        <?php if (session()->get('role') === 'customer'): ?>
            <li><a href="<?= site_url('riwayat') ?>">Pesanan Saya</a></li>
        <?php endif; ?>

        <?php if (session()->get('role') === 'admin'): ?>
            <li><a href="<?= site_url('products') ?>">Kelola Stok</a></li>
            <li><a href="<?= site_url('admin/pesanan') ?>">Pesanan Masuk</a></li>
        <?php endif; ?>

        <?php if (session()->has('role')): ?>
            <li><a href="<?= site_url('logout') ?>">Logout</a></li>
        <?php else: ?>
            <li><a href="<?= site_url('login') ?>">Login</a></li>
        <?php endif; ?>
    </ul>
</aside>
