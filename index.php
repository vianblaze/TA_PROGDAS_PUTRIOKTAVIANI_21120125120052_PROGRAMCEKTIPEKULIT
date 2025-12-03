<?php
session_start();
require 'QuizLogic.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    unset($_SESSION['quiz_logic']); // Hapus object kuis
    unset($_SESSION['history_stack']); // Hapus riwayat Stack
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    if ($nama === '') $nama = 'Pengguna';
    
    // Modul 5 buat object dari class QuizLogic
    $logic = new QuizLogic($nama); 
    $_SESSION['quiz_logic'] = serialize($logic); // Menyimpan object ke Session
    
    header('Location: quiz.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    </head>

<body class="halaman-awal">

    <div class="main-box">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="masuk-card">
            <form method="post">
                <label for="chk" aria-hidden="true">Glowskin App</label>
            </form>
        </div>
        <div class="nama-card">
            <form method="post">
                <label for="chk" aria-hidden="true">Jelajahi</label><br><br>
                <p align="center">
                    Welcome to Glowskin!<br>
                    Masukin namamu dulu ingyh sebelum cek jenis kulitmu!
                </p>
                <br>
                <input type="text" name="nama" placeholder="Nama" required>

                <button type="submit" name="cek_sekarang">Cek Sekarang</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>