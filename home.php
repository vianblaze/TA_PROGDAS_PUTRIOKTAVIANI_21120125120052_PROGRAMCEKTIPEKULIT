<?php
session_start();
$namaUser = $_SESSION['nama'] ?? "User";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="home-page">

    <!-- TOP HEADER -->
    <div class="header-top">
        <div class="menu-btn">&#9776;</div>

        <div class="profile">
            <img src="img/profile.jpg" alt="profile">
        </div>
    </div>

    <div class="welcome-box">
        <p class="welcome-text">Welcome To</p>
        <h1 class="nama-user"><?php echo strtoupper($namaUser); ?></h1>
    </div>

    <!-- SEARCH -->
    <div class="search-container">
        <input type="text" id="searchBar" placeholder="Search the products">
        <button class="search-btn">🔍</button>
    </div>

    <!-- CATEGORY FILTER -->
    <div class="kategori-menu">
        <button class="kategori-btn active" data-kategori="all">Popular</button>
        <button class="kategori-btn" data-kategori="Toner">Toner</button>
        <button class="kategori-btn" data-kategori="Cleanser">Cleanser</button>
        <button class="kategori-btn" data-kategori="Serum">Serum</button>
        <button class="kategori-btn" data-kategori="Moisturizer">Moisturizer</button>
        <button class="kategori-btn" data-kategori="Sunscreen">Sunscreen</button>
        <button class="kategori-btn" data-kategori="Mask">Masker</button>
    </div>

    <h2 class="title-section">Trending Products</h2>

    <!-- PRODUCTS -->
    <div class="produk-grid">

        <div class="produk-item" data-kategori="Toner">
            <img src="img/toner1.jpg" alt="">
            <p class="nama-produk">Hydrating Toner</p>
            <span class="harga">$15.00</span>
        </div>

        <div class="produk-item" data-kategori="Cleanser">
            <img src="img/cleanser1.jpg" alt="">
            <p class="nama-produk">Foam Cleanser</p>
            <span class="harga">$10.00</span>
        </div>

        <div class="produk-item" data-kategori="Serum">
            <img src="img/serum1.jpg" alt="">
            <p class="nama-produk">Glow Serum</p>
            <span class="harga">$18.00</span>
        </div>

        <div class="produk-item" data-kategori="Mask">
            <img src="img/mask1.jpg" alt="">
            <p class="nama-produk">Masker</p>
            <span class="harga">$20.00</span>
        </div>

    </div>

    <script src="script.js"></script>
</body>
</html>