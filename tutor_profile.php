<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id =$_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['tutor_fetch'])) {

        $tutor_email = $_POST['tutor_email'];
        $tutor_email = htmlspecialchars($tutor_email,ENT_QUOTES, 'UTF-8');

        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE email= ?");
        $select_tutor->execute([$tutor_email]);

        $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
        $tutor_id = $fetch_tutor['id'];

        $count_playlists = $conn->prepare("SELECT * FROM playlist WHERE tutor_id = ?");
        $count_playlists->execute([$tutor_id]);
        $total_playlists = $count_playlists->rowCount();

        $count_likes = $conn->prepare("SELECT * FROM likes WHERE tutor_id = ?");
        $count_likes->execute([$tutor_id]);
        $total_likes = $count_likes->rowCount();

        $count_comments = $conn->prepare("SELECT * FROM comments WHERE tutor_id = ?");
        $count_comments->execute([$tutor_id]);
        $total_comments = $count_comments->rowCount();

        $count_contents = $conn->prepare("SELECT * FROM content WHERE tutor_id = ?");
        $count_contents->execute([$tutor_id]);
        $total_contents = $count_contents->rowCount();

    }else{
        header('location:teachers.php');
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Jadi Pintar - tutor profil</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">tutor profil</i></span>
            </div>
            <h1>profile tutor jadi pintar</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/banner.png">
    </div>

    <!----------tutor section------------- -->
    <section class="tutor-profile">
        <div class="heading">
            <h1>detail profil tutor</h1>
        </div>
        <div class="details">
            <div class="tutor">
                <img src="uploaded_files/<?= $fetch_tutor['image'] ?>">
                <h3><?= $fetch_tutor['name']; ?></h3>
                <span><?= $fetch_tutor['profession']; ?></span>
            </div>
            <div class="flex">
                <p>playlist : <span><?= $total_playlists; ?></span></p>
                <p>total video : <span><?= $total_contents; ?></span></p>
                <p>total like : <span><?= $total_likes; ?></span></p>
                <p>total komen : <span><?= $total_comments; ?></span></p>
            </div>
        </div>
    </section>

    <!-- --------kursus section--------- -->
    <div class="courses">
        <div class="heading">
            <span>kursus populer</span>
            <h1>peserta didik jadi pintar <br> bisa gabung dengan kita !!!</h1>
        </div>
        <div class="box-container">
            <?php
                $select_courses = $conn->prepare("SELECT * FROM playlist WHERE tutor_id = ?  AND status = ?");
                $select_courses->execute([$tutor_id, 'active']);
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
                        <span><?= date('d-m-Y', strtotime($fetch_courses['date'])); ?></span>
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