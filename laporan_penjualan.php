<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: url('llaporan_keuangan.jpg') no-repeat center center fixed;
            background-color: rgba(255, 255, 255, 0.72);
            background-size: cover;
            font-family: 'Poppins', sans-serif;

                }
    .container {
    max-width: 1000px;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
    
    
   
   
}
            

        
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">💰 Laporan Penjualan</h2>
    <hr>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID Penjualan</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Jumlah Terjual</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_penjualan = 0;
            $penjualan = mysqli_query($koneksi, "SELECT p.Id_Penjualan, p.Tanggal, n.Nama_Produk, p.Jumlah, p.Total_Harga 
                                                 FROM penjualan p 
                                                 JOIN nama_produk n ON p.Id_Produk = n.Id_Produk
                                                 ORDER BY p.Tanggal DESC");
            while ($row = mysqli_fetch_array($penjualan)) {
                echo "<tr>
                        <td>".$row['Id_Penjualan']."</td>
                        <td>".$row['Tanggal']."</td>
                        <td>".$row['Nama_Produk']."</td>
                        <td>".$row['Jumlah']."</td>
                        <td>Rp ".number_format($row['Total_Harga'], 0, ',', '.')."</td>
                      </tr>";
                $total_penjualan += $row['Total_Harga'];
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Total Penjualan:</th>
                <th>Rp <?= number_format($total_penjualan, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>

    <a href="index.php" class="btn btn-secondary">⬅️ Kembali ke Dashboard</a>
</div>

</body>
</html>
