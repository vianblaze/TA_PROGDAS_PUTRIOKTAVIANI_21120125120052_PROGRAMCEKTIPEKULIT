<?php
session_start();
require 'QuizLogic.php';

// Ambil Object QuizLogic dari sesi
$logic = isset($_SESSION['quiz_logic']) ? unserialize($_SESSION['quiz_logic']) : null;
if (!$logic instanceof QuizLogic) {
    header('Location: index.php'); // Redirect kalo object ilang
    exit;
}

// Modul 7 buat inisialisasi stack history buat fitur kembali
if (!isset($_SESSION['history_stack'])) {
    $_SESSION['history_stack'] = [];
}

$total_questions = $logic->getTotalQuestions();

// buat nentuin nomor pertanyaan sekarang
$current = isset($_GET['q']) ? intval($_GET['q']) : 1;

// Modul 7 buat button kembali pake Stack POP
if (isset($_GET['action']) && $_GET['action'] === 'back') {
    // Ambil (POP) nomor pertanyaan sebelumnya dari Stack
    $previous_q = array_pop($_SESSION['history_stack']);
    if ($previous_q && $previous_q < $current) {
        $current = $previous_q;
        header("Location: quiz.php?q=" . $current);
        exit;
    }
}

// Modul2 buat proses jawaban user
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selected = $_POST['answer'] ?? '';
    $number = isset($_POST['number']) ? intval($_POST['number']) : $current;

    if ($selected) {
        // Modul 4 & 6 buat menyimpan jawaban pake Method Setter
        $logic->setAnswer($number, $selected);
        $_SESSION['quiz_logic'] = serialize($logic);

        if ($number < $total_questions) {
            // Modul 7 buat menyimpan (PUSH) nomor pertanyaan saat ini ke Stack sebelum maju
            if ($current == $number) { 
                 array_push($_SESSION['history_stack'], $number);
            }
            header("Location: quiz.php?q=" . ($number + 1));
            exit;
        } else {
            header("Location: result.php");
            exit;
        }
    }
}

// Persiapan data untuk tampilan
$question = $logic->getQuestion($current);
$saved_answer = $logic->getSavedAnswer($current);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Kuis Tipe Kulit</title>
</head>
<body>

<div class="quiz-card">
    <h2>Pertanyaan <?php echo $current; ?> dari <?php echo $total_questions; ?></h2>

    <form method="post">
        <input type="hidden" name="number" value="<?php echo $current; ?>">

        <table class="question-table">
            <tr>
                <th><?php echo $question["text"]; ?></th>
            </tr>
            <?php foreach ($question["options"] as $opt): // Modul 3 buat perulangan untuk opsi jawaban ?>
                <tr>
                    <td>
                        <label class="opsi-item">
                            <input type="radio" name="answer" value="<?= $opt ?>"
                                onclick="this.form.submit();"
                                <?= ($saved_answer === $opt) ? 'checked' : '' ?>>
                            <span><?= $opt ?></span>
                        </label>

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>

    <?php if ($current > 1 && count($_SESSION['history_stack']) > 0): ?>
        <a class="back-btn" href="quiz.php?action=back">← Kembali</a>
    <?php endif; ?>

</div>

</body>
</html>