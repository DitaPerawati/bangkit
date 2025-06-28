<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BANGKIT COMPUTER</title>
    <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            width: 220px;
            background-color: rgb(10, 77, 255);
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        #sidebar.active {
            transform: translateX(0);
        }

        #sidebar h2 {
            text-align: center;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
        }

        #sidebar li {
            margin: 15px 0;
        }

        #sidebar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: 220px;
        }

        header {
            background-color: rgb(10, 0, 209);
            color: white;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .menu-toggle {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
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
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
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

        .card-body button[disabled] {
            background-color: gray;
        }

        .footer {
            text-align: center;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            width: 48%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button[type="submit"] {
            background-color: rgb(10, 77, 255);
            color: white;
        }

        .modal-content button[type="button"] {
            background-color: gray;
            color: white;
            margin-right: 4%;
        }

        #infoTransfer {
            display: none;
            background: #eef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<?= view('sidebar') ?>

<!-- Main Content -->
<div class="main-content" id="main">
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

                    <?php if ($laptop['stok'] > 0): ?>
                        <button onclick="bukaModal(<?= $index ?>)">Beli</button>
                    <?php else: ?>
                        <button disabled>Stok Habis</button>
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
        <form method="post" action="<?= site_url('beli') ?>">
            <input type="hidden" name="id" id="modalId">

            <label for="jumlahBeli">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlahBeli" min="1" required>

            <label for="metode">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode" required> //yg diubah
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>

            <div id="infoTransfer">
                <strong>Transfer ke:</strong><br>
                Bank BCA: <strong>1234567890</strong><br>
                a.n. <strong>Bangkit Computer</strong>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <button type="button" onclick="tutupModal()">Batal</button>
                <button type="submit">Ya, Beli</button>
            </div>
        </form>
    </div>
</div>

<script>
    const laptops = <?= json_encode($laptops) ?>;

    function bukaModal(index) {
        const laptop = laptops[index];
        document.getElementById('modalNama').textContent = laptop.nama;
        document.getElementById('modalSpek').innerHTML = laptop.spesifikasi;
        document.getElementById('modalHarga').textContent = 'Rp ' + laptop.harga.toLocaleString('id-ID');
        document.getElementById('modalId').value = laptop.id;

        const jumlahInput = document.getElementById('jumlahBeli');
        jumlahInput.value = 1;
        jumlahInput.min = 1;
        jumlahInput.max = laptop.stok;

        document.getElementById('modal').style.display = 'block';
        toggleTransferInfo(); // cek info transfer awal
    }

    function tutupModal() {
        document.getElementById('modal').style.display = 'none';
    }

    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('main').classList.toggle('shifted');
    }

    document.getElementById('metode').addEventListener('change', toggleTransferInfo);

    function toggleTransferInfo() {
        const metode = document.getElementById('metode').value;
        const info = document.getElementById('infoTransfer');
        info.style.display = (metode === 'transfer') ? 'block' : 'none';
    }
</script>

</body>
</html>
