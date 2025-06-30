<?php include 'koneksi.php'; ?>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            background: url('BG_Martabak.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .dashboard {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }
        .dashboard h1 {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            justify-content: center;
        }
        .menu-item {
            background-color: rgba(255, 255, 255, 0.66);
            border-radius: 10px;
            padding: 30px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
            font-size: 18px;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            background-color: #e9f2ff;
        }
        .menu-item i {
            font-size: 32px;
            display: block;
            margin-bottom: 10px;
            color: #0d6efd;
        }
        footer {
            text-align: center;
            margin-top: 50px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>

<body>
<a href="logout.php" class="btn btn-danger">🚪 Logout</a>

<body>

<div class="dashboard">
   <h1>📋 SISTEM INFORMASI INVONTORY MARTABAK</h1>

    <div class="menu-grid">
        <a href="bahan_baku.php" class="menu-item">
            <i>📦</i> Stok Bahan Baku
        </a>
        <a href="pembelian_bahan.php" class="menu-item">
            <i>➕</i> Input Pembelian Bahan
        </a>
        <a href="penjualan.php" class="menu-item">
            <i>💰</i> Input Penjualan Produk
        </a>
        <a href="laporan_penjualan.php" class="menu-item">
            <i>📄</i> Laporan Penjualan
        </a>
        <a href="laporan_bahan.php" class="menu-item">
            <i>📋</i> Laporan Penggunaan Bahan
        </a>
    </div>

    <footer>
        <small>Made by Awan Bagus Kurniawan</small>
    </footer>
</div>

</body>
</html>
