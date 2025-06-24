<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
    <title>BANGKIT COMPUTER</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        /* Main content */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: rgb(10, 0, 209);
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .sub-header {
            background-color: rgb(10, 77, 255);
            padding: 10px;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .container {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            z-index: 2;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card-body {
            padding: 15px;
        }

        .card-body h3 {
            margin-top: 0;
        }

        .card-body button {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            background-color: rgb(10, 77, 255);
            color: white;
            border: none;
            cursor: pointer;
        }

        .footer {
            text-align: center;
            margin-top: auto;
            padding: 20px;
            background-color: #eee;
            font-size: 14px;
        }

        .bonus {
            text-align: center;
            margin-top: 30px;
        }

        .bonus img {
            width: 150px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
        }

        .modal-content h3 {
            margin-top: 0;
        }

        .modal-content button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<?= view('sidebar')?>

<!-- Main Content -->
<div class="main-content">
    <header>
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <h1>BANGKIT COMPUTER</h1>
    </header>
    <div class="sub-header">TERMURAH, BERGARANSI DAN TERPERCAYA</div>

    <div class="container">
        <?php foreach ($laptops as $index => $laptop): ?>
            <div class="card">
            <a href="<?= base_url('customer/detail/' . $laptop['id']) ?>">
    <img src="<?= base_url('img/laptop/' . $laptop['gambar']) ?>" alt="<?= $laptop['nama'] ?>">
</a>

                <div class="card-body">
                    <h3><?= esc($laptop['nama']) ?></h3>
                    <p><?= $laptop['spesifikasi'] ?></p>
                    <p><strong>Harga: Rp <?= number_format($laptop['harga'], 0, ',', '.') ?></strong></p>
                    <p><strong>Stok: <?= $laptop['stok'] ?></strong></p>
                    <?php if (session()->get('is_admin')): ?>
<?php endif; ?>

                    <?php if ($laptop['stok'] > 0): ?>
                        <button onclick="bukaModal(<?= $index ?>)">Beli</button>
                    <?php else: ?>
                        <button disabled style="background-color: gray;">Stok Habis</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="bonus">
        <h3 style="background: yellow; display: inline-block; padding: 5px;">GRATIS TAS LAPTOP</h3>
        <br><br>
        <img src="<?= base_url('img/laptop/tas.jpg') ?>" alt="Tas Laptop">
    </div>

    <div class="footer">
        &copy; <?= date('M Y') ?> Toko Komputer Bangkit. Semua Hak Dilindungi.
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <h3 id="modalNama"></h3>
        <p id="modalSpek"></p>
        <p><strong>Harga: <span id="modalHarga"></span></strong></p>
        <form id="formBeli" method="post" action="<?= site_url('beli') ?>">
            <input type="hidden" name="id" id="modalId">
            <button type="button" onclick="tutupModal()">Batal</button>
            <button type="submit">Ya, Beli</button>
        </form>
    </div>
</div>

<script>
    const laptops = <?= json_encode($laptops) ?>;

    function bukaModal(index) {
        const laptop = laptops[index];
        document.getElementById('modalNama').textContent = laptop.nama;
        document.getElementById('modalSpek').innerHTML = laptop.spesifikasi;
        document.getElementById('modalHarga').textContent = 'Rp ' + formatRupiah(laptop.harga);
        document.getElementById('modalId').value = laptop.id;
        document.getElementById('modal').style.display = 'block';
    }

    function tutupModal() {
        document.getElementById('modal').style.display = 'none';
    }

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-closed');
    }
</script>

</body>
</html>
