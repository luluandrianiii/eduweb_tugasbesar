<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
        header('location:index.php');
    }

    if(isset($_POST['remove'])){
       if ($user_id != '') {
        $content_id = $_POST['content_id'];
        $content_id = htmlspecialchars($content_id, ENT_QUOTES, 'UTF-8');

        $verify_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND content_id = ?");
        $verify_likes->execute([$user_id, $content_id]);

        if($verify_likes->rowCount() > 0){
            $remove_likes = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND content_id = ?");
            $remove_likes->execute([$user_id, $content_id]);
            $message[] = 'hapus dari favorite';
        }
    }else{
        $message[] = 'masuk terlebih dahulu';
    }
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Jadi Pintar - disukai</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">video yang disukai</i></span>
            </div>
            <h1>video yang disukai</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>

    <!----------daftar section------------- -->
    <section class="liked-videos">
        <div class="heading">
            <h1>video yang disukai</h1>
        </div>
        <div class="box-container">
            <?php
                $select_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ?");
                $select_likes->execute([$user_id]);
                
                if ($select_likes->rowCount() > 0){
                    while($fetch_likes = $select_likes->fetch(PDO::FETCH_ASSOC)){
                        
                    $select_content = $conn->prepare("SELECT * FROM content WHERE id = ? ORDER BY date DESC");
                    $select_content->execute([$fetch_likes['content_id']]);

                    if ($select_content->rowCount() > 0) {
                        while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
                        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE id = ?");
                        $select_tutor->execute([$fetch_content['tutor_id']]);
                        $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);  

            ?>   
            <div class="box">
                <div class="tutor">
                    <img src="uploaded_files/<?=  $fetch_tutor['image'];?>">
                    <div>
                        <h3><?= $fetch_tutor['name'];?></h3>
                        <span><?= $fetch_tutor['profession'];?></span>
                    </div>
                </div>
                <img src="uploaded_files/<?= $fetch_content['thumb'];?>" class="thumb">
                <h3 class="title"><?=$fetch_content['title'];?></h3>
                <form action="" method="post">
                    <input type="hidden" name="content_id" value="<?= $fetch_content['id'];?>">
                    <a href="watch_video.php?get_id=<?= $fetch_content['id'];?>" class="btn">tonton video</a>
                    <input type="submit" name="remove" value="hapus" class="btn">
                </form>
            </div>
            <?php
                            }
                        }else{
                            echo '<p class="empty">tidak ada hasil ditemukan/p>';
                        }
                    }
                }else{
                    echo '<p class="empty">belum ada video yang disukai/p>';
                }
            ?>
        </div>
        
    </section>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>