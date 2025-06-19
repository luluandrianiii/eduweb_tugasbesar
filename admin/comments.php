<?php
    include '../components/connect.php';

    if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }


    //delete komen 
    if(isset($_POST['delete_comment'])){
        $delete_id = $_POST['video_id'];
        $delete_id = htmlspecialchars($delete_id, ENT_QUOTES, 'UTF-8');

        $verify_comment = $conn->prepare("SELECT * FROM comments WHERE id = ?");
        $verify_comment->execute([$delete_id]);

        if($verify_comment->rowCount() > 0){
            $delete_comment = $conn->prepare("SELECT * FROM comments WHERE id = ?");
            $delete_comment->execute([$delete_id]);
            $message[] = 'menghapus komentar berhasil';
        }else{
            $message[] = 'komentar telah dihapus';
        }
    }



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
    <section class="comments">
            <h1 class="heading">komentar pengguna</h1>
            <div class="show-comments">
                <?php
                     $select_comments = $conn->prepare("SELECT * FROM comments WHERE tutor_id = ?");
                     $select_comments->execute([$tutor_id]);

                        if($select_comments->rowCount() > 0){
                         while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
                         $select_content = $conn->prepare("SELECT * FROM content WHERE id = ?");
                         $select_content->execute([$fetch_comment['content']]);
                         $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);
                     
                ?>
                <div class="box" style="<?php if ($fetch_comment['tutor_id' == $tutor_id]) {echo 'order:-1';} ?>">
                    <div class="content">
                        <span><?= $fetch_comment['date'];?></span>
                        <p>- <?= $fetch_content['title'];?> -</p>
                        <a href="view_content.php?get_id=<?= $fetch_content['id']; ?>">Lhat Konten</a>

                        <p class="text"><?= $fetch_comment['comment'];?></p>
                        <form action="" method="post">
                            <input type="hidden" name="comment_id" value="<?= $fetch_comment['id'];?>">
                            <button type="submit" name="delete_comment" value="hapus komentar" class="btn" onclick="return confirm('hapus komentar ini');">Hapus Komentar</button>
                        </form>
                    </div>
                </div>
                <?php
                        }
                    }else{
                         echo'<p class="empty">belum ada komentar ditambahkan!</p>';
                    }
                ?>
            </div>
    </section>
    <?php include '../components/footer.php'?>
    <script src="../js/admin_script.js" defer></script>
</body>
</html>