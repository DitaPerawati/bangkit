<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BANGKIT COMPUTER</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
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
            <a href="<?= base_url('bangkit/detail/' . $laptop['id']) ?>">
                <img src="<?= base_url('img/laptop/' . $laptop['gambar']) ?>" alt="<?= $laptop['nama'] ?>">
            </a>
            <div class="card-body">
                <h3><?= esc($laptop['nama']) ?></h3>
                <p><?= $laptop['spesifikasi'] ?></p>
                <p><strong>Harga: Rp <?= number_format($laptop['harga'], 0, ',', '.') ?></strong></p>
                <p><strong>Stok: <?= $laptop['stok'] ?></strong></p>
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

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('main').classList.toggle('shifted');
    }
</script>

</body>
</html>
