<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

   if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header('location:index.php');
    }

    //-----------like------------------
    if (isset($_POST['like_content'])) {
        if ($user_id != '') {
            $content_id = $_POST['content_id'];
            $content_id = htmlspecialchars($content_id,ENT_QUOTES, 'UTF-8');

            $select_content = $conn->prepare("SELECT * FROM content WHERE id = ? LIMIT 1");
            $select_content->execute([$content_id]);
            $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);

            $tutor_id = $fetch_content['tutor_id'];

            $select_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND content_id = ?");
            $select_likes->execute([$user_id, $content_id]);

            if ($select_likes->rowCount() > 0) {
                $remove_likes = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND content_id = ?");
                $remove_likes->execute([$user_id, $content_id]);
                $message[] = 'hapus dari disukai';
            }else{
                $insert_likes = $conn->prepare("INSERT INTO likes (user_id, tutor_id, content_id) VALUES(?,?,?)");
                $insert_likes->execute([$user_id, $tutor_id, $content_id]);
                $message[] = 'disukai';
            }
        }else{
            $message[] = 'masuk terlebih dahulu';
        }
    }

    // add coment
    if (isset($_POST['add_comment'])) {
       if ($user_id != '') {
            $id = unique_id();
            $comment_box = $_POST['comment_box'];
            $comment_box = htmlspecialchars($comment_box,ENT_QUOTES, 'UTF-8');
            $content_id = $_POST['content_id'];
            $content_id = htmlspecialchars($content_id,ENT_QUOTES, 'UTF-8');

            $select_content = $conn->prepare("SELECT * FROM content WHERE id = ? LIMIT 1");
            $select_content->execute([$content_id]);
            $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);

            $tutor_id = $fetch_content['tutor_id'];

            if ($select_content->rowCount() > 0) {
                $select_comment = $conn->prepare("SELECT * FROM comments WHERE content_id = ? AND user_id = ? AND comment = ?");
                $select_comment->execute([$content_id, $user_id, $comment_box]);

                if ($select_comment->rowCount() > 0) {
                    $message[] = 'komentar sudah ditambahkan';
                }else{
                    $insert_comment = $conn->prepare("INSERT INTO comments (id, content_id, user_id, tutor_id, comment) VALUES(?,?,?,?,?)");
                    $insert_comment->execute([$id, $content_id, $user_id, $tutor_id, $comment_box]);
                    $message[] = 'komentar ditambahkan';
                }
            }else{
                $message[] = 'ada kesalahan';
            }
       }else{
        $message[] = 'masuk terlebih dulu';
       }
    }
    // delete comment
    if(isset($_POST['delete_comment'])){
        $delete_id = $_POST['comment_id'];
        $delete_id = htmlspecialchars($delete_id, ENT_QUOTES, 'UTF-8');

        $verify_comment = $conn->prepare("SELECT * FROM comments WHERE id = ?");
        $verify_comment->execute([$delete_id]);

        if($verify_comment->rowCount() > 0){
            $delete_comment = $conn->prepare("DELETE FROM comments WHERE id = ?");
            $delete_comment->execute([$delete_id]);
            $message[] = 'menghapus komentar berhasil';
        }else{
            $message[] = 'komentar telah dihapus';
        }
    }
    // edit commentt
    if (isset($_POST['update_now'])) {
        $update_id = $_POST['update_id'];
        $update_id = htmlspecialchars($update_id, ENT_QUOTES, 'UTF-8');

        $update_box = $_POST['update_box'];
        $update_box = htmlspecialchars($update_box, ENT_QUOTES, 'UTF-8');

        $verify_comment = $conn->prepare("SELECT * FROM comments WHERE id = ? AND comment = ?");
        $verify_comment->execute([$update_id, $update_box]);

        if($verify_comment->rowCount() > 0){
            $message[] = 'komentar sudah ditambahkan';
        }else{
            $update_comment = $conn->prepare("UPDATE comments SET comment = ? WHERE id = ?");
            $update_comment->execute([$update_box, $update_id]);
            $message[] = 'komentar berhasil diperbarui';
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


    <title>Jadi Pintar - tonton video</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">tonton video</i></span>
            </div>
            <h1>tonton video</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/banner.png">
    </div>

    <!-- ------------edit section---------------- -->
    <?php
        if (isset($_POST['edit_comment'])) {
            $edit_id= $_POST['comment_id'];
            $edit_id = htmlspecialchars($edit_id, ENT_QUOTES, 'UTF-8');

            $verify_comment = $conn->prepare("SELECT * FROM comments WHERE id = ? LIMIT 1");
            $verify_comment->execute([$edit_id]);

            if($verify_comment->rowCount() > 0){
                $fetch_edit_comment = $verify_comment->fetch(PDO::FETCH_ASSOC);
    ?>
    <section class="edit_comment">
        <div class="heading">
            <h1>edit komentar</h1>
        </div>
        <form action="" method="post">
            <input type="hidden" name="update_id" value="<?= $fetch_edit_comment['id'];?>">
            <textarea name="update_box" class="box" maxlength="1000" required cols="30" rows="10"><?= $fetch_edit_comment['comment'];?></textarea>
            <div class="flex-btn">
                <a href="watch_video.php?get_id=<?= $get_id;?>" class="btn">cancel edit</a>
                <input type="submit" name="update_now" class="btn" value="perbarui sekarang">
            </div>
        </form>
    </section>
    <?php
            }else{
            $message[] = 'komentar tidak ditemukan';
            }
        }
    ?>
    <!----------video section------------- -->
    <section class="watch-video">
        <?php
            $select_content = $conn->prepare("SELECT * FROM content WHERE id = ? AND status = ?");
            $select_content->execute([$get_id,'active']);

           if ($select_content->rowCount() > 0){
                while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
                    
                    $content_id = $fetch_content['id'];

                    $select_likes = $conn->prepare("SELECT * FROM likes WHERE content_id = ?");
                    $select_likes->execute([$content_id]);
                    $total_likes = $select_likes->rowCount();

                    $verify_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND content_id = ?");
                    $verify_likes->execute([$user_id, $content_id]);

                    $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE id = ? LIMIT 1");
                    $select_tutor->execute([$fetch_content['tutor_id']]);
                    $fetch_tutor= $select_tutor->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="video-details">
            <video src="uploaded_files/<?= $fetch_content['video']; ?>" class="video" 
            poster="uploaded_files/<?= $fetch_content['thumb']; ?>" controls autoplay></video>
            <h3 class="title"><?= $fetch_content['title']; ?></h3>
            <div class="info">
                <p><i class="bx bxs-calendar-alt"></i><span><?= date('d-m-Y', strtotime($fetch_content['date'])); ?></span></p>
                <p><i class="bx bxs-heart"></i><span><?= $total_likes; ?></span></p>
            </div>
            <div class="tutor">
                <img src="uploaded_files/<?= $fetch_tutor['image']; ?>">
                <div>
                    <h3><?= $fetch_tutor['name']; ?></h3>
                    <span><?= $fetch_tutor['profession']; ?></span>
                </div>
            </div>
            <form action="" method="post" class="flex">
                <input type="hidden" name="content_id" value="<?= $content_id; ?>">
                <a href="playlist.php?=<?= $fetch_content['playlist_id']; ?>" class="btn">Lihat Playlist</a>

                <?php 
                    if ($verify_likes->rowCount() > 0) { ?>

                    <button type="submit" name="like_content" ><i class="bx bxs-heart"></i><span>disukai</span></button>
                <?php }else{ ?>
                    <button type="submit" name="like_content" ><i class="bx bxs-heart"></i><span>sukai</span></button>
                <?php } ?>
            </form>
            <div class="descriptions">
                <p><?= $fetch_content['descriptions']; ?></p>
            </div>
        </div>
        <?php
                }
           }else{
            echo '<p class="empty">belum ada video ditambahkan</p>';
           }
        ?>
    </section>

    <!-- ------komen section--------- -->
    <section class="comments">
        <div class="heading">
           <h1>beri komentar</h1>
        </div>

        <form action="" method="post" class="add-comment">
            <input type="hidden" name="content_id" value="<?= $get_id; ?>">
            <textarea name="comment_box" required placeholder="tulis komentar di sini" maxlength="1000" cols="30" rows="10"></textarea>
            <input type="submit" name="add_comment" class="btn" value="kirim komentar">
        </form>

         <div class="heading">
           <h1>komentar pengguna</h1>
        </div>
        <div class="show-comments">
            <?php
                $select_comments = $conn->prepare("SELECT * FROM comments WHERE content_id = ?");
                $select_comments->execute([$get_id]);

                if ($select_comments->rowCount() > 0) {
                    while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
                        $select_commentor = $conn->prepare("SELECT * FROM users WHERE id = ?");
                        $select_commentor->execute([$fetch_comment['user_id']]);
                        $fetch_commentor = $select_commentor->fetch(PDO::FETCH_ASSOC);

            ?>
            <div class="box" style="<?php if($fetch_comment['user_id'] == $user_id) 
                {echo 'order:-1';}
            ?>">
                <div class="user">
                    <img src="uploaded_files/<?= $fetch_commentor['image']; ?>">
                    <div>
                        <h3><?= $fetch_commentor['name']; ?></h3>
                        <span><?= date('d-m-Y', strtotime($fetch_comment['date'])); ?></span>
                    </div>
                </div>
                <p class="text"> <?= $fetch_comment['comment']; ?> </p>
                <?php
                    if ($fetch_comment['user_id'] == $user_id) {
                        
                    
                ?>
                <form action="" method="post" class="flex-btn">
                    <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
                    <button type="submit" name="edit_comment" class="btn">edit komentar</button>
                    <button type="submit" name="delete_comment" class="btn" onclick="return confirm('hapus komentar ini')">hapus komentar</button>
                </form>
                <?php } ?>
            </div>
            <?php
                    }
                }else{
                     echo '<p class="empty">belum ada komentar</p>';
                }
            ?>
        </div>
    </section



    
    <?php include 'components/footer.php'?>
     <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>