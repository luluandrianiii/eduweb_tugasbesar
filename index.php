<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Jadi Pintar - beranda</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------home section------------- -->
    <div class="hero">
        <div class="box-container">
            <div class="box">
                <img src="/jadipintar/image/taylorswift.png">
            </div>
            <div class="box">
                <h1>Bangun skill untuk tingkatkan karirmu</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi sequi fugiat accusantium reprehenderit facere fugit ipsa atque quos voluptatem quas adipisci, minima enim explicabo illo! Reiciendis illo distinctio inventore rem?</p>
                <a href="courses.php" class="btn">Lihat Konten</a>
            </div>
        </div>
    </div>
    <!----------kategori section------------- -->
    <div class="categories">
        <div class="heading">
            <span>kategori</span>
            <h1>jelajahi kategori kursus populer<br>yang akan merubah dirimu</h1>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="/jadipintar/image/graphic.png">
                <h3>graphic design</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/web-design.png">
                <h3>web design</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/profit-up.png">
                <h3>sales marketing</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/user-interface.png">
                <h3>mobile aplication</h3>
                <a href="courses.php">5 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/personal-development.png">
                <h3>personal development</h3>
                <a href="courses.php">3 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/palette.png">
                <h3>art & humanities</h3>
                <a href="courses.php">2 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
            <div class="box">
                <img src="/jadipintar/image/accounting.png">
                <h3>finance & accounting</h3>
                <a href="courses.php">2 kursus <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>
















    <?php include 'components/footer.php'?>
    <script src="js/user_script.js" defer></script>
</body>
</html>