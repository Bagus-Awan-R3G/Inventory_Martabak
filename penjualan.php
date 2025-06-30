<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Penjualan - Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet">
    <style>
         body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif; 
            background: url('BG_PEMBELIAN1.jpg') no-repeat center center fixed;
            background-size: cover;
         }

    .form-box {
    max-width: 600px; 
    margin: 40px auto;
    background: rgba(255, 255, 255, 0.85); 
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

.form-box h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 28px; 
}

.form-control {
    margin-bottom: 20px;
    height: 50px; 
    font-size: 18px; /
}

.btn-primary {
    height: 50px;
    font-size: 18px;
}

    </style>
</head>
<body>

<div class="form-box">
    <h2>💰 Input Penjualan Produk</h2>
    <form method="POST" action="">
    <div class="form-group">
        <label class="form-label">Pilih Produk:</label>
      <select name="id_produk" class="form-control" required>
    <option value="">-- Pilih Produk --</option>
    <?php
    $produk = mysqli_query($koneksi, "SELECT * FROM nama_produk ORDER BY Nama_Produk ASC");
    while ($row = mysqli_fetch_array($produk)) {
        echo "<option value='".$row['Id_Produk']."'>".$row['Nama_Produk']."</option>";
    }
    ?>
</select>

    </div>

    <div class="form-group">
        <label class="form-label">Jumlah Terjual:</label>
        <input type="number" name="jumlah" class="form-control" min="1" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan Penjualan</button>
</form>


    <?php
    if (isset($_POST['submit'])) {
        $id_penjualan = 'PJ' . date('ymdHis');
        $tanggal = date('Y-m-d');
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];

        $query_harga = mysqli_query($koneksi, "SELECT Harga_Produk FROM nama_produk WHERE Id_Produk='$id_produk'");
        $data_harga = mysqli_fetch_array($query_harga);
        $total_harga = $data_harga['Harga_Produk'] * $jumlah;

        mysqli_query($koneksi, "INSERT INTO penjualan (Id_Penjualan, Tanggal, Id_Produk, Jumlah, Total_Harga)
                                VALUES ('$id_penjualan', '$tanggal', '$id_produk', '$jumlah', '$total_harga')");

        $resep = mysqli_query($koneksi, "SELECT * FROM resep_produk WHERE Id_Produk='$id_produk'");
        while ($bahan = mysqli_fetch_array($resep)) {
            $id_bahan = $bahan['Id_Bahan'];
            $jumlah_bahan = $bahan['Jumlah_Bahan'] * $jumlah;

            $id_penggunaan = 'PB' . date('ymdHis') . rand(10,99);
            mysqli_query($koneksi, "INSERT INTO penggunaan_bahan (Id_Penggunaan, Id_Penjualan, Id_Bahan, Jumlah_Terpakai, Tanggal)
                                    VALUES ('$id_penggunaan', '$id_penjualan', '$id_bahan', '$jumlah_bahan', '$tanggal')");

            mysqli_query($koneksi, "UPDATE persedian_bahan_baku
                                    SET Stok_Saat_ini = Stok_Saat_ini - $jumlah_bahan
                                    WHERE Id_Bahan = '$id_bahan'");
        }

        echo "<div class='alert alert-success mt-4 text-center'>✅ Penjualan berhasil disimpan & stok bahan ter-update!</div>";
    }
    ?>

    <a href="index.php" class="btn btn-secondary w-100 mt-3">⬅️ Kembali ke Dashboard</a>
</div>

</body>
</html>
