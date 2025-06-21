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

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="indec.php">beranda</a><span><i class="bx bx-chevron-right">tentang</i></span>
            </div>
            <h1>tentang kami</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>
    <!----------about section------------- -->
    <div class="about">
        <div class="box-container">
            <div class="box">
                <img src="image/taylorswift.jpg" class="img">
                <div class="thumbnail-1">
                    <img src="image/Alex.jpg">
                </div>
                <div class="thumbnail-2">
                    <img src="image/Maudy-Ayunda.jpg">
                </div>
                <div class="thumbnail-3">
                    <img src="image/candra.jpg">
                </div>
            </div>
            <div class="box">
                <div class="title">
                    <span>ketahui tentang kami</span>
                    <h1>ketahui tentang platform jadi pintar</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis dignissimos pariatur itaque rem? Expedita, nesciunt commodi, debitis alias obcaecati unde animi corrupti assumenda minus ex cumque, illo fuga eos sed!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia cumque animi, facilis mollitia quam atque expedita. Magnam repudiandae, nisi aliquam, at impedit recusandae sint quasi consectetur officiis fugiat deleniti perferendis.</p>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>kelas fleksibel</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto quae veritatis error debitis magni in reiciendis, alias, nihil ut vitae fugit ipsum. Quae saepe repellat veniam ad! Totam, natus harum.</p>
                    </div>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>belajar dari mana aja</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto quae veritatis error debitis magni in reiciendis, alias, nihil ut vitae fugit ipsum. Quae saepe repellat veniam ad! Totam, natus harum.</p>
                    </div>
                </div>
                <div class="detail">
                    <i class="bx bxl-facebook"></i>
                    <div>
                        <h3>tutor yang berpengalaman</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto quae veritatis error debitis magni in reiciendis, alias, nihil ut vitae fugit ipsum. Quae saepe repellat veniam ad! Totam, natus harum.</p>
                    </div>
                </div><a href="" class="btn">ketahui lebih banyak tentang kami</a>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'?>
    <script src="js/user_script.js" defer></script>
</body>
</html>