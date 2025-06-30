<?php include 'koneksi.php'; session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Inventaris Martabak</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: url('BG_Martabak.jpg') no-repeat center center fixed;
            background-size: cover;

        }
        .login-box {
            width: 800px;
            background: rgba(252, 252, 252, 0.55);
            padding: 100px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(252, 252, 252, 0.55);
            text-align: center;
        }
        .login-box h1 {
            margin-bottom: 400px;
            color: #333;
        }
        .form-control {
            margin-bottom: 30px;
        }
        .btn-primary {
            width: 100%;
        }
        .error-msg {
            margin-bottom: 15px;
            color: red;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>🔐 Login Admin</h2>
    
    <?php
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $query = mysqli_query($koneksi, "SELECT * FROM login 
                                         WHERE Nama_Admin='$username' AND Password='$password'");

        if (mysqli_num_rows($query) > 0) {
           
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            
            echo "<div class='error-msg'>❌ Username atau Password salah!</div>";
        }
    }
    ?>

    <form method="POST" action="">
        <input type="text" name="username" class="form-control" placeholder="Nama Admin" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
    </form>
</div>

</body>
</html>
