<?php
session_start();
require 'QuizLogic.php';
$username = $_SESSION['username'];

// Ambil objek QuizLogic
$logic = isset($_SESSION['quiz_logic']) ? unserialize($_SESSION['quiz_logic']) : null;
if (!$logic instanceof QuizLogic) {
    echo "<h2>Data quiz tidak ditemukan.</h2>";
    exit;
}

// Ambil nama + hasil
$nama = $logic->getUsername();
$result = $logic->calculateResult();

// Tentukan tipe kulit
if (strpos($result, "Kering") !== false) $type = "kering";
elseif (strpos($result, "Normal") !== false) $type = "normal";
elseif (strpos($result, "Kombinasi") !== false) $type = "kombinasi";
else $type = "berminyak";

// Hapus session quiz
unset($_SESSION['quiz_logic']);
unset($_SESSION['history_stack']);

// Produk Indonesia
$products = [
    "kering" => [
        ["img"=>"prod/skintific-ceramide.jpg","name"=>"Skintific 5X Ceramide","desc"=>"Ceramide • Hyaluronic Acid • Soothing","url"=>"https://shopee.co.id/SKINTIFIC-5X-Ceramide-Barrier-Series-Set-Cleanser-Low-PH-Toner-Barrier-Serum-Moisture-Gel-Sunscreen-SPF50-PA-Soothing-Serum-Sunscreen-Repair-Skin-Barrier-Hydrate-Brighten-Calm-Down-Sensitive-Skin-Skincare-Collection-Bundle-i.380266264.42102088960?extraParams=%7B%22display_model_id%22%3A285171461732%2C%22model_selection_logic%22%3A3%7D&sp_atk=55b0a8de-fecb-4131-b242-511b1a6b8848&xptdk=55b0a8de-fecb-4131-b242-511b1a6b8848"],
        ["img"=>"prod/hadalabo-gokujyun.png","name"=>"Hada Labo Gokujyun","desc"=>"3 Types Hyaluronic Acid","url"=>"https://shopee.co.id/Paket-Hada-Labo-Gokujyun-Ultimate-Moisturizing-Set-Facewash-100gr-Light-Lotion-i.78713320.53552217679?extraParams=%7B%22display_model_id%22%3A302207247617%2C%22model_selection_logic%22%3A3%7D&sp_atk=3da7f123-80fb-4360-9bb5-4fe4762156bc&xptdk=3da7f123-80fb-4360-9bb5-4fe4762156bc"],
        ["img"=>"prod/somethinc-ceramic.jpg","name"=>"Somethinc Ceramic Skin","desc"=>"Ceramide • Fatty Acid","url"=>"https://shopee.co.id/SOMETHINC-Ceramic-Skin-Saviour-i.270965687.8117743043?extraParams=%7B%22display_model_id%22%3A247016416661%2C%22model_selection_logic%22%3A3%7D&sp_atk=f7bc5a28-9d2c-424c-8868-87ed48e51ce1&xptdk=f7bc5a28-9d2c-424c-8868-87ed48e51ce1"]
    ],
    "normal" => [
        ["img"=>"prod/originote-hyalucera.png","name"=>"Originote Hyalucera","desc"=>"Hyaluronic Acid • Ceramide","url"=>"https://shopee.co.id/The-Originote-Moisturizer-%E2%80%93-Hyalucera-Cica-B5-Brightening-Pelembab-Wajah-Mencerahkan-Kulit-Sensitif-Berminyak-Kering-i.710619388.20803489571?extraParams=%7B%22display_model_id%22%3A247622178023%2C%22model_selection_logic%22%3A2%7D&sp_atk=32b88147-8de6-486c-8f73-9ae6035c3ce9&xptdk=32b88147-8de6-486c-8f73-9ae6035c3ce9"],
        ["img"=>"prod/whitelab-daycream.png","name"=>"Whitelab Brightening","desc"=>"Niacinamide • Collagen","url"=>"https://shopee.co.id/Whitelab-Paket-Wajah-Brightening-Niacinamide-Facial-Wash-Toner-Serum-Day-Night-Moisturizer-5-pcs-N-Dose-2.0-Skincare-i.201071840.21428517702?extraParams=%7B%22display_model_id%22%3A248345473513%2C%22model_selection_logic%22%3A3%7D&sp_atk=ad05d11d-736d-40f1-b4a6-f40836220707&xptdk=ad05d11d-736d-40f1-b4a6-f40836220707"],
        ["img"=>"prod/avoskin-niacinamide.jpg","name"=>"Avoskin Niacinamide","desc"=>"Niacinamide 5%","url"=>"https://shopee.co.id/-CREATOR-Serum-Avoskin-Your-Skin-Bae-Niacinamide-30ml-Mencerahkan-Kulit-i.154494405.28174118735?extraParams=%7B%22display_model_id%22%3A119383208430%2C%22model_selection_logic%22%3A3%7D&sp_atk=6ace1ee8-3ad4-47b8-b4db-18e8f8909b85&xptdk=6ace1ee8-3ad4-47b8-b4db-18e8f8909b85"]
    ],
    "kombinasi" => [
        ["img"=>"prod/somethinc-niacinamide.jpg","name"=>"Somethinc Somethinc 10% Niacinamide+Moisture Sabi Beet Maxbrightening","desc"=>"Niacinamide • Oil Control","url"=>"https://shopee.co.id/Somethinc-10-Niacinamide-Moisture-Sabi-Beet-Maxbrightening-Serum-20ml-i.1064357214.27460084217?extraParams=%7B%22display_model_id%22%3A147448001148%2C%22model_selection_logic%22%3A3%7D&sp_atk=e994acb4-2da5-4c8d-b589-a2808c4a510b&xptdk=e994acb4-2da5-4c8d-b589-a2808c4a510b"],
        ["img"=>"prod/skintific-sunscreen.jpeg","name"=>"Skintific Aqua Light Daily Sunscreen ","desc"=>"SPF 35 PA +++ • Non greasy","url"=>"https://shopee.co.id/Skintific-Aqua-Light-Daily-Sunscreen-SPF-35-PA-Size-30gr-i.224957239.29679587085?extraParams=%7B%22display_model_id%22%3A177034248251%2C%22model_selection_logic%22%3A3%7D&sp_atk=9a57b851-cace-4697-8a24-ed0eb2539c63&xptdk=9a57b851-cace-4697-8a24-ed0eb2539c63"],
        ["img"=>"prod/wardah-acnederm.jpg","name"=>"Wardah Acnederm","desc"=>"Witch Hazel • Pore care","url"=>"https://shopee.co.id/WARDAH-Acnederm-Acne-Care-All-Series-Lengkap-Balm-Salicylic-Acid-Zinc-Acne-Clearing-Low-pH-Foaming-Cleanser-Pore-Refining-Toner-Serum-Treatment-Gel-Day-Moisturizer-Night-Treatment-Moisturizer-Face-Powder-Micellar-Water-UV-Shield-Skincare-i.59763733.28070385006?extraParams=%7B%22display_model_id%22%3A257230823614%2C%22model_selection_logic%22%3A2%7D&sp_atk=e1f7bf32-f8b1-47e4-9b0c-a67913d5fd9a&xptdk=e1f7bf32-f8b1-47e4-9b0c-a67913d5fd9a"]
    ],
    "berminyak" => [
        ["img"=>"prod/somethinc-bha.jpg","name"=>"Somethinc Salicylic 2%","desc"=>"BHA • Sebum control","url"=>"https://shopee.co.id/SOMETHINC-Acne-Treatment-2-Salicylic-Acid-Serum-Kunci-Kulit-Bersih-Terlindungi-Dari-Jerawat-Melawan-Bakteri-Penyebab-Jerawat-Membersihkan-Pori-Tersumbat-dan-Mengontrol-Minyak-Berlebih-Serum-untuk-Komedo-i.195455930.11054556713?extraParams=%7B%22display_model_id%22%3A243513608774%2C%22model_selection_logic%22%3A3%7D&sp_atk=892ba4b8-4383-41e9-9083-9efa31ba8088&xptdk=892ba4b8-4383-41e9-9083-9efa31ba8088"],
        ["img"=>"prod/emina-gel.jpeg","name"=>"Emina Water Bright Glow Gel Moisturizer ","desc"=>"Lightweight gel","url"=>"https://shopee.co.id/Emina-Water-Bright-Glow-Gel-Moisturizer-30g-i.63983008.57151177970?extraParams=%7B%22display_model_id%22%3A405107112019%2C%22model_selection_logic%22%3A2%7D&sp_atk=c350df07-0d01-45d8-8bb2-3ccf4e11553e&xptdk=c350df07-0d01-45d8-8bb2-3ccf4e11553e"],
        ["img"=>"prod/wardah-uvshield.png","name"=>"Wardah UV Shield Acne Calming Sunscreen Moisturizer SPF 35 PA","desc"=>"Gel sunscreen • SPF 50","url"=>"https://shopee.co.id/WARDAH-UV-Shield-Acne-Calming-Sunscreen-Moisturizer-SPF-35-PA-untuk-komedo-jerawat-dan-bekas-jerawat-kulit-berminyak-tekstur-gel-ringan-mudah-meresap-Skincare-i.59763733.25476909498?extraParams=%7B%22display_model_id%22%3A240738581417%2C%22model_selection_logic%22%3A2%7D&sp_atk=e841838a-5cbe-4b03-aa4f-bb4a7c61faf6&xptdk=e841838a-5cbe-4b03-aa4f-bb4a7c61faf6"]
    ]
];

$slides = $products[$type] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Analisis</title>
    <link rel="stylesheet" href="slider.css">
</head>
<body>

<div class="hasil-card">
    <h2 style="margin-top:20px; text-align:center">Halo, <?= htmlspecialchars($nama) ?>!<br>Hasil Analisis Tipe Kulitmu</h2>
    <h3 style="margin-top:20px; text-align:center"><?= htmlspecialchars($result) ?></h3>

    <h3 style="margin-top:20px; text-align:center;">Rekomendasi Skincare</h3>

    <!-- SLIDER PRODUK -->
    <div class="product-slider">

        <button class="slider-btn left" id="prevBtn">❮</button>

        <div class="slider-track-wrapper">
            <div class="slider-track" id="sliderTrack">
                <?php foreach ($slides as $p): 
                    $img = file_exists(__DIR__ . "/" . $p["img"]) ? $p["img"] : "prod/placeholder.jpg";
                ?>
                <div class="slide-item">
                    <a href="<?= $p['url'] ?>" target="_blank">
                        <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                    </a>
                    <h4><?= htmlspecialchars($p['name']) ?></h4>
                    <p><?= htmlspecialchars($p['desc']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <button class="slider-btn right" id="nextBtn">❯</button>
    </div>

    <div class="slider-dots" id="sliderDots"></div>

    <a href="quiz.php" class="restart-btn">Ulangi Quiz</a>
    <a href="rekomendasi.php" class="btn-more">Lihat rekomendasi skincare lebih lengkap</a>
</div>

<script src="slider.js"></script>

</body>
</html>
