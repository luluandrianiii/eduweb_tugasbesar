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
    <title>Jadi Pintar - kursus</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="indec.php">beranda</a><span><i class="bx bx-chevron-right">kursus</i></span>
            </div>
            <h1>kursus kami</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>

    <!----------krusus section------------- -->
    <div class="courses">
        <div class="heading">
            <span>kursus populer</span>
            <h1>peserta didik jadi pintar <br> bisa gabung dengan kita !!!</h1>
        </div>
        <div class="box-container">
            <?php
                $select_courses = $conn->prepare("SELECT * FROM playlist WHERE status = ? ORDER BY date DESC");
                $select_courses->execute(['active']);
                if ($select_courses->rowCount() > 0) {
                    while($fetch_courses = $select_courses->fetch(PDO::FETCH_ASSOC)){
                        $course_id = $fetch_courses['id'];

                        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE id = ?");
                        $select_tutor->execute([$fetch_courses['tutor_id']]);
                        $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);    
            ?>
            <div class="box">
                <div class="tutor">
                    <img src="uploaded_files/<?= $fetch_tutor['image']; ?>">
                    <div>
                        <h3><?= $fetch_tutor['name']; ?></h3>
                        <span><?= $fetch_courses['date']; ?></span>
                    </div>
                </div>
                <img src="uploaded_files/<?= $fetch_courses['thumb']; ?>" class="thumb">
                <h3 class="title"><?= $fetch_courses['title']; ?></h3>
                <a href="playlist.php?get_id=<?= $course_id; ?>" class="btn">lihat playlist</a>
            </div>
            <?php
                  }
                }else{
                    echo '<p class="empty">belum ada kursus ditambahkan</p>';
                }
            ?>
        </div>
    </div>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>