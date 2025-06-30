<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggunaan Bahan - Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet">
    <style>
         body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            background: url('bahan_baku2.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
      
        }
    .container {
    max-width: 1000px;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
    
    
   
   
}


h2 {
    margin-bottom: 20px;
    text-align: center;
}


.table th {
    background-color: #6c757d;
    color: white;
    text-align: center;
}
.table td {
    text-align: center;
    vertical-align: middle;
}



        
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">📋 Laporan Penggunaan Bahan</h2>
    <hr>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID Penggunaan</th>
                <th>Tanggal</th>
                <th>ID Penjualan</th>
                <th>Nama Bahan</th>
                <th>Jumlah Terpakai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $penggunaan = mysqli_query($koneksi, "SELECT pb.Id_Penggunaan, pb.Tanggal, pb.Id_Penjualan, bb.Nama_Bahan, pb.Jumlah_Terpakai, bb.Satuan_Bahan
                                                  FROM penggunaan_bahan pb
                                                  JOIN persedian_bahan_baku bb ON pb.Id_Bahan = bb.Id_Bahan
                                                  ORDER BY pb.Tanggal DESC");
            while ($row = mysqli_fetch_array($penggunaan)) {
                echo "<tr>
                        <td>".$row['Id_Penggunaan']."</td>
                        <td>".$row['Tanggal']."</td>
                        <td>".$row['Id_Penjualan']."</td>
                        <td>".$row['Nama_Bahan']."</td>
                        <td>".$row['Jumlah_Terpakai']." ".$row['Satuan_Bahan']."</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">⬅️ Kembali ke Dashboard</a>
</div>

</body>
</html>
