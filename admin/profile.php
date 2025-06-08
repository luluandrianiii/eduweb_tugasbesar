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
    <title>Profil Tutor</title>
</head>
<body>

    <?php include '../components/admin_header.php'?>
    <section class="tutor-profile" style="min-height: calc(100vh - 19rem);">
         <h1 class="heading">Detail Profil</h1>
         
         <div class="details">
            <div class="tutor">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3><?= $fetch_profile['name']; ?></h3>
                <span><?= $fetch_profile['profession']; ?></span>
                <a href="update.php" class="btn">Update Profil</a>
            </div>
            <div class="flex">
                <div class="box">
                    <span><?= $total_playlist; ?></span>
                    <p>Total Playlist</p>
                    <a href="playlist.php" class="btn">Lihat Playlist</a>
                </div>
                <div class="box">
                    <span><?= $total_contents; ?></span>
                    <p>Total Video</p>
                    <a href="contents.php" class="btn">Lihat Konten</a>
                </div>
                <div class="box">
                    <span><?= $total_likes; ?></span>
                    <p>Total Like</p>
                    <a href="contents.php" class="btn">Lihat Konten</a>
                </div>
                <div class="box">
                    <span><?= $total_comments; ?></span>
                    <p>Total Komen</p>
                    <a href="comments.php" class="btn">Lihat Komen</a>
                </div>
            </div>
         </div>
         
    </section>
    <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>