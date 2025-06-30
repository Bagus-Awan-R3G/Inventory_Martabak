<?php include 'koneksi.php'; session_start(); ?>
<?php
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Pembelian Bahan - Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet">
    <style>
        body {
            background: url('BG_PEMBELIAN1.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-box {
            max-width: 600px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.88);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.2);
        }
        .form-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 50px;
            font-size: 18px;
        }
        .btn-primary {
            height: 50px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>➕ Input Pembelian Bahan</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label class="form-label">Pilih Bahan:</label>
            <select name="id_bahan" class="form-control" required>
                <option value="">-- Pilih Bahan --</option>
                <?php
                $bahan = mysqli_query($koneksi, "SELECT * FROM persedian_bahan_baku ORDER BY Nama_Bahan ASC");
                while ($row = mysqli_fetch_array($bahan)) {
                    echo "<option value='".$row['Id_Bahan']."'>".$row['Nama_Bahan']."</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jumlah Pembelian:</label>
            <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Simpan Pembelian</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $id_pembelian = 'PEM' . date('ymdHis');
        $tanggal = date('Y-m-d');
        $id_bahan = $_POST['id_bahan'];
        $jumlah = $_POST['jumlah'];

        mysqli_query($koneksi, "INSERT INTO pembelian_bahan (Id_Pembelian, Id_Bahan, Jumlah, Tanggal)
                                VALUES ('$id_pembelian', '$id_bahan', '$jumlah', '$tanggal')");

        mysqli_query($koneksi, "UPDATE persedian_bahan_baku
                                SET Stok_Masuk = Stok_Masuk + $jumlah,
                                    Stok_Saat_ini = Stok_Saat_ini + $jumlah
                                WHERE Id_Bahan = '$id_bahan'");

        echo "<div class='alert alert-success mt-4 text-center'>✅ Pembelian berhasil disimpan & stok bahan diperbarui!</div>";
    }
    ?>

    <a href="index.php" class="btn btn-secondary w-100 mt-3">⬅️ Kembali ke Dashboard</a>
</div>

</body>
</html>
