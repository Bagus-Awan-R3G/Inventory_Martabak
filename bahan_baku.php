<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Stok Bahan Baku - Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            background: url('bahan_baku2.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">📦 Stok Bahan Baku</h2>
    <hr>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID Bahan</th>
                <th>Nama Bahan</th>
                <th>Satuan</th>
                <th>Stok Awal</th>
                <th>Stok Masuk</th>
                <th>Stok Saat Ini</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_stok = 0;
            $bahan = mysqli_query($koneksi, "SELECT * FROM persedian_bahan_baku ORDER BY Nama_Bahan ASC");
            while ($row = mysqli_fetch_array($bahan)) {
                echo "<tr>
                        <td>".$row['Id_Bahan']."</td>
                        <td>".$row['Nama_Bahan']."</td>
                        <td>".$row['Satuan_Bahan']."</td>
                        <td>".$row['Stok_Awal']."</td>
                        <td>".$row['Stok_Masuk']."</td>
                        <td>".$row['Stok_Saat_ini']."</td>
                      </tr>";
                $total_stok += $row['Stok_Saat_ini'];
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Total Stok Saat Ini:</th>
                <th><?= number_format($total_stok, 2); ?></th>
            </tr>
        </tfoot>
    </table>

    <a href="index.php" class="btn btn-secondary">⬅️ Kembali ke Dashboard</a>
</div>

</body>
</html>
