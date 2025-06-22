<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id =$_COOKIE['user_id'];
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
    <title>Jadi Pintar - tutor</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right"> cari tutor</i></span>
            </div>
            <h1>tutor berpengalaman</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>

    <!----------tutor section------------- -->
    <section class="teachers">
        <div class="heading">
            <h1>Tutor Berpengalaman</h1>
        </div>
        <form action="" method="post" class="search-tutor">
            <input type="text" name="search_tutor" maxlength="100" required placeholder="cari tutor">
            <button type="submit" name="search_tutor_btn" class="bx bx-search-alt-2"></button>
        </form>
        <div class="box-container">
            <?php
                if (isset($_POST['search_tutor_btn']) && isset($_POST['search_tutor']) && !empty($_POST['search_tutor'])) {

                    $search_tutor = $_POST['search_tutor'];

                    $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE name LIKE '%{$search_tutor}%' ");
                    $select_tutor->execute();

                    if ($select_tutor->rowCount() > 0) {
                        while($fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC)){

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
            ?>
            <div class="box">
                <div class="tutor">
                    <img src="uploaded_files/<?= $fetch_tutor['image']; ?>">
                    <div>
                        <h3><?= $fetch_tutor['name']; ?></h3>
                        <span><?= $fetch_tutor['profession']; ?></span>
                    </div>
                </div>
                <p>playlist : <span><?= $total_playlists; ?></span></p>
                <p>total video : <span><?= $total_contents; ?></span></p>
                <p>total like : <span><?= $total_likes; ?></span></p>
                <p>total komen : <span><?= $total_comments; ?></span></p>
                <form action="tutor_profile.php" method="post">
                    <input type="hidden" name="tutor_email" value="<?= $fetch_tutor['email'] ?>">
                    <input type="submit" value="lihat profil" name="tutor_fetch" class="btn">
                </form>
            </div>
            <?php
                        }
                    }else{
                        echo '<p class="empty"tidak ada hasil ditemukan!</p>';
                    }
                }else{
                    echo '<p class="empty"cari yang lain!</p>';
                }
            ?>
        </div>
    </section>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>