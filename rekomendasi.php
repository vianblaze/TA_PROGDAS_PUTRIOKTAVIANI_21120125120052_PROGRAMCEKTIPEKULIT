<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "User";

$products = [
    ["name" => "Somethinc Low pH Gentle Jelly Cleanser", "type" => "cleanser", "img" => "prod/Somethinc-Cleanser.jpg"],
    ["name" => "Skintific Gentle Cleanser", "type" => "cleanser", "img" => "prod/Cleanser-Skintific.png"],
    ["name" => "Skintific 5X Ceramide Toner", "type" => "toner", "img" => "prod/toner1.png"],
    ["name" => "Azarine Hydrasoothe Essence Toner", "type" => "toner", "img" => "prod/toner2.jpg"],
    ["name" => "Skintific Mugwort Anti Pores & Acne Clay Stick", "type" => "mask", "img" => "prod/mask1.jpg"],
    ["name" => "Whitelab Hydrating Sleeping Mask", "type" => "mask", "img" => "prod/mask2.jpg"],
    ["name" => "Skintific 10% Niacinamide + Beta-Glucan Serum", "type" => "serum", "img" => "prod/serum1.jpg"],
    ["name" => "Avoskin Your Skin Bae Hyaluron 3% Serum", "type" => "serum", "img" => "prod/serum2.png"],
    ["name" => "Skintific 5X Ceramide Moisturizer", "type" => "moisturizer", "img" => "prod/moist1.jpeg"],
    ["name" => "Somethinc Ceramic Skin Saviour", "type" => "moisturizer", "img" => "prod/moist2.jpg"],
    ["name" => "Amaterasun Physical Sunscreen SPF 50+ PA++++", "type" => "sunscreen", "img" => "prod/sun1.png"],
    ["name" => "Skintific 5X Ceramide Sunscreen", "type" => "sunscreen", "img" => "prod/sun2.png"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekomendasi Skincare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ==== STYLE TAMBAHAN KHUSUS HALAMAN REKOMENDASI ==== */
        .rekom-container {
            width: 90%;
            max-width: 520px;
            margin: 30px auto;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #573b8a;
        }
        .subtitle {
            color: #777;
            margin-bottom: 20px;
        }
        .search-box input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: #eee;
        }
        .categories {
            display: flex;
            gap: 10px;
            margin: 18px 0;
            overflow-x: scroll;
        }
        .cat-btn {
            padding: 10px 16px;
            background: #e3dbff;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }
        .cat-btn.active {
            background: #573b8a;
            color: white;
        }
        .product-card {
            display: flex;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 18px;
            align-items: center;
            gap: 15px;
        }
        .product-card img {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
        }
        .product-card .p-name {
            font-size: 17px;
            font-weight: bold;
            margin: 0;
        }
        .product-card .p-type {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="rekom-container">

    <div class="title">Hi, <?php echo htmlspecialchars($username); ?> 👋</div>
    <div class="subtitle">Ayo temukan produk yang cocok buat kulitmu!</div>

    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search the products...">
    </div>

    <div class="categories">
        <div class="cat-btn active" data-type="all">Popular</div>
        <div class="cat-btn" data-type="toner">Toner</div>
        <div class="cat-btn" data-type="cleanser">Cleanser</div>
        <div class="cat-btn" data-type="serum">Serum</div>
        <div class="cat-btn" data-type="moisturizer">Moisturizer</div>
        <div class="cat-btn" data-type="sunscreen">Sunscreen</div>
        <div class="cat-btn" data-type="mask">Skin Mask</div>
    </div>

    <div id="productList">
        <?php foreach ($products as $p): ?>
        <div class="product-card" data-type="<?= $p['type']; ?>">
            <img src="<?= $p['img']; ?>" alt="">
            <div>
                <p class="p-name"><?= $p['name']; ?></p>
                <p class="p-type"><?= ucfirst($p['type']); ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="rekomendasi.js"></script>

</body>
</html>