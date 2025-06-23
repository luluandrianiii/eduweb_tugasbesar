<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
        header('location:login.php');
    }

    $select_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ?");
    $select_likes->execute([$user_id]);
    $total_likes = $select_likes->rowCount();

    $select_comments = $conn->prepare("SELECT * FROM comments WHERE user_id = ?");
    $select_comments->execute([$user_id]);
    $total_comments = $select_comments->rowCount();

    $select_bookmark = $conn->prepare("SELECT * FROM bookmark WHERE user_id = ?");
    $select_bookmark->execute([$user_id]);
    $total_bookmark = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Jadi Pintar - masuk</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">masuk</i></span>
            </div>
            <h1>profil pengguna</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>

    <!----------daftar section------------- -->
    <section class="profile">
        <div class="heading">
            <h1>detail profil</h1>
        </div>
        <div class="details">
            <div class="user">
                <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3><?= $fetch_profile['name']; ?></h3>
                <p>peserta didik</p>
                <a href="update.php" class="btn">perbarui profil</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-bookmark"></i>
                        <h3><?= $total_bookmark; ?></h3>
                        <span>boookmark</span>
                    </div>
                    <a href="bookmark.php" class="btn">lihat playlist</a>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-heart"></i>
                        <h3><?= $total_likes; ?></h3>
                        <span>disukai</span>
                    </div>
                    <a href="likes.php" class="btn">lihat yang disukai</a>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-chat"></i>
                        <h3><?= $total_comments; ?></h3>
                        <span>komentar video</span>
                    </div>
                    <a href="comments.php" class="btn">lihat komentar</a>
                </div>
            </div>
        </div>
    </section>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>