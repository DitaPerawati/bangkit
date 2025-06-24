<!-- File: app/Views/sidebar.php -->
<aside id="sidebar" class="sidebar-closed">
    <h2>Menu</h2>
    <ul>
        <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
        <li><a href="<?= site_url('riwayat') ?>">Riwayat</a></li>
        <?php if (session()->get('role') === 'admin'): ?>
            <li><a href="<?= site_url('products') ?>">Kelola Stok</a></li>
        <?php endif; ?>
        <li><a href="<?= site_url('logout') ?>">Logout</a></li>
    </ul>
</aside>