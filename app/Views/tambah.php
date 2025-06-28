<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Stok Produk</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        header {
            background-color: rgb(19, 92, 250);
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
        .container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .stock-actions {
            display: flex;
            gap: 10px;
        }
        @media (max-width: 768px) {
            .stock-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Load Sidebar -->
    <?= view('sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="main">
        <header>
            <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            <h1>Kelola Stok Produk</h1>
        </header>
        
        <div class="container mt-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="mb-4">
                <h2><?= esc($product['nama']) ?></h2>
                <p class="text-muted"><?= esc($product['spesifikasi']) ?></p>
                <div class="alert alert-info">
                    <strong>Stok Sekarang:</strong> <?= esc($product['stok']) ?>
                </div>
            </div>

            <div class="stock-actions">
                <!-- Form Tambah Stok -->
                <form method="post" action="<?= site_url('products/processAddStock/' . $product['id']) ?>" class="flex-grow-1">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Tambahan <span class="text-danger">*</span></label>
                        <input type="number" name="amount" class="form-control" required min="1" placeholder="Masukkan jumlah">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle"></i> Tambah Stok
                    </button>
                </form>

                <!-- Form Kurangi Stok -->
                <form method="post" action="<?= site_url('products/processReduceStock/' . $product['id']) ?>" class="flex-grow-1">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Pengurangan <span class="text-danger">*</span></label>
                        <input type="number" name="amount" class="form-control" required min="1" max="<?= $product['stok'] ?>" placeholder="Maks <?= $product['stok'] ?>">
                    </div>
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="bi bi-dash-circle"></i> Kurangi Stok
                    </button>
                </form>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="<?= site_url('products') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Produk
                </a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="bi bi-trash"></i> Hapus Produk
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                    <p><strong><?= esc($product['nama']) ?></strong></p>
                    <p class="text-danger">Aksi ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Batal
                    </button>
                    <form action="<?= site_url('products/delete/' . $product['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            sidebar.classList.toggle('active');
            main.classList.toggle('shifted');
        }

        function confirmDelete() {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Validasi real-time untuk pengurangan stok
        document.querySelector('form[action*="processReduceStock"] input').addEventListener('input', function() {
            const maxStock = <?= $product['stok'] ?>;
            if (parseInt(this.value) > maxStock) {
                this.setCustomValidity(`Jumlah tidak boleh melebihi ${maxStock}`);
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>