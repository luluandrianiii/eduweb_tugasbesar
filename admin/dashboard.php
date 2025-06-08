<?php
    include '../components/connect.php';

    if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }

    $select_contents = $conn->prepare("SELECT * FROM content WHERE tutor_id = ?");
    $select_contents->execute([$tutor_id]);
    $total_contents = $select_contents->rowCount();

    $select_playlist = $conn->prepare("SELECT * FROM playlist WHERE tutor_id = ?");
    $select_playlist->execute([$tutor_id]);
    $total_playlist = $select_playlist->rowCount();

    $select_likes = $conn->prepare("SELECT * FROM likes WHERE tutor_id = ?");
    $select_likes->execute([$tutor_id]);
    $total_likes = $select_likes->rowCount();

    $select_comments = $conn->prepare("SELECT * FROM comments WHERE tutor_id = ?");
    $select_comments->execute([$tutor_id]);
    $total_comments = $select_comments->rowCount();
?>
<style type="text/css">
    <?php include '../css/admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard</title>
</head>
<body>

    <?php include '../components/admin_header.php'?>
    <section class="dashboard">
         <h1 class="heading">Dashboard</h1>
         <div class="box-container">
            <div class="box">
                <h3>Welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="profile.php" class="btn">Lihat Profil</a>
            </div>
            <div class="box">
                <h3><?= $total_contents; ?></h3>
                <p>Total Konten</p>
                <a href="add_content.php" class="btn">Tambah Konten Baru</a>
            </div>
            <div class="box">
                <h3><?= $total_playlist; ?></h3>
                <p>Total Playlist</p>
                <a href="add_playlist.php" class="btn">Tambah Playlist Baru</a>
            </div>
            <div class="box">
                <h3><?= $total_likes; ?></h3>
                <p>Total Like</p>
                <a href="contents.php" class="btn">Lihat Konten</a>
            </div>
            <div class="box">
                <h3><?= $total_comments; ?></h3>
                <p>Total Komen</p>
                <a href="comments.php" class="btn">Lihat Komen</a>
            </div>
            <div class="box">
                <h3>Mulai</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn" style="width: 200px;">Masuk Sekarang</a>
                    <a href="register.php" class="btn" style="width: 200px;">Daftar Sekarang</a>
                </div>
            </div>
         </div>
    </section>
    <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>