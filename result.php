<?php
session_start();
require 'QuizLogic.php';

// Ambil objek QuizLogic dari Session
$logic = isset($_SESSION['quiz_logic']) ? unserialize($_SESSION['quiz_logic']) : null;

if (!$logic instanceof QuizLogic) {
    echo "<h2>Data quiz tidak ditemukan atau belum lengkap.</h2>";
    exit;
}

// Modul 4 & 6: Pake Method Getter dan Method Perhitungan
$nama = $logic->getUsername();
$result = $logic->calculateResult();

// Hapus quiz dan riwayat setelah selesai
unset($_SESSION['quiz_logic']);
unset($_SESSION['history_stack']);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Hasil Analisis</title>
</head>
<body>

<div class="hasil-card">
    <h2>Halo, <?= htmlspecialchars($nama) ?>!<br>Hasil Analisis Tipe Kulitmu</h2>
    <h3><?= $result ?></h3>

    <a href="quiz.php" class="restart-btn">Ulangi Quiz</a>
</div>

</body>
</html>