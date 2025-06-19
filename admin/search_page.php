<?php
    include '../components/connect.php';

    if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }


    //delete plalylist
    if(isset($_POST['delete'])){
        $delete_id = $_POST['playlist_id'];
        $delete_id = htmlspecialchars($delete_id, ENT_QUOTES, 'UTF-8');

        $delete_playlist_thumb = $conn->prepare("SELECT * FROM playlist WHERE id = ? LIMIT 1");
        $delete_playlist_thumb->execute([$delete_id]);
        $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
        unlink('../uploaded_files/'.$fetch_thumb['thumb']);

        $delete_bookmark = $conn->prepare("DELETE FROM bookmark WHERE playlist_id = ?");
        $delete_bookmark->execute([$delete_id]);
        $delete_playlist = $conn->prepare("DELETE FROM playlist WHERE id = ?");
        $delete_playlist->execute([$delete_id]);
        
        $message[] = 'playlist dihapus';
    }

    //delete video dari playlist
    if(isset($_POST['delete_video'])){
        $delete_id = $_POST['video_id'];
        $delete_id = htmlspecialchars($delete_id, ENT_QUOTES, 'UTF-8');

        $verify_video = $conn->prepare("SELECT * FROM content WHERE id = ? LIMIT 1");
        $verify_video->execute([$delete_id]);

        if($verify_video->rowCount() > 0){
            $delete_video_thumb = $conn->prepare("SELECT * FROM content WHERE id = ? LIMIT 1");
            $delete_video_thumb->execute([$delete_id]);
            $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
            unlink('../uploaded_files/'.$fetch_thumb['thumb']);

            $delete_video = $conn->prepare("SELECT * FROM content WHERE id = ? LIMIT 1");
            $delete_video->execute([$delete_id]);
            $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
            unlink('../uploaded_files/'.$fetch_video['video']);

            $delete_likes= $conn->prepare("SELECT * FROM likes WHERE content_id = ?");
            $delete_likes->execute([$delete_id]);

            $delete_comments= $conn->prepare("SELECT * FROM comments WHERE content_id = ?");
            $delete_comments->execute([$delete_id]);

            $delete_content= $conn->prepare("DELETE FROM content WHERE id = ?");
            $delete_content->execute([$delete_id]);

            $message[] = 'video dihapus';

        }else{
            $message[] = 'video sudah terhapus';
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
   <section class="contents">
        <h1 class="heading">Konten</h1>
        <div class="box-container">
            <?php
                if (isset($_POST['search']) or isset($_POST['search_btn'])) {
                    $search = $_POST['search'];
                    $select_videos = $conn->prepare("SELECT * FROM content WHERE title LIKE '%{$search}%' AND tutor_id = ? ORDER BY date DESC");
                    $select_videos->execute([$tutor_id]);
                    if ($select_videos->rowCount() > 0) {
                        while($fetch_videos = $select_videos->fetch(PDO::FETCH_ASSOC)){
                            $video_id = $fetch_videos['id'];
            
            ?>
            <div class="box">
                <div class="flex">
                    <div> <i class="bx bx-dots-vertical-rounded" style="<?php  if ($fetch_videos['status'] == 'active') {echo 'color:limegreen';}
                    else{echo 'color:red';}?>">
                    </i> <span style="<?php  if ($fetch_videos['status'] == 'active') {echo 'color:limegreen';}
                    else{echo 'color:red';}?>"><?= $fetch_videos['status'];?></span></div>
                    <div> <i class="bx bxs calendar-alt"></i> <span><?= $fetch_videos['date'];?></span> </div>
                </div>
                <img src="../uploaded_files/<?= $fetch_videos['thumb'];?>" class="thumb">
                <h3 class="title"><?= $fetch_videos['title'];?></h3>
                <form action="" method="post">
                    <input type="hidden" name="video_id" value="<?= $video_id;?>">
                    <a href="update_content.php?get_id=<?= $video_id?>" class="btn">Perbarui</a>
                    <input type="submit" name="delete_video" value="Hapus" class="btn" onclick="return confirm('hapus');">
                    <a href="view_content.php?get_id=<?= $video_id;?>" class="btn">Lihat Konten</a>
                </form>
            </div>
            <?php
                        }
                    }else{
                        echo '<p class="empty">konten tidak ditemukan!</p>';
                    }
                }else{
                    echo '<p class="empty">temukan!</p>';
                }
            ?>
        </div>
   </section>
   <section class="playlists">
        <h1 class="heading">Playlist</h1>
        <div class="box-container">
            <?php
                if (isset($_POST['search']) or isset($_POST['search_btn'])) {
                    $search = $_POST['search'];
                    $select_playlist = $conn->prepare("SELECT * FROM playlist WHERE title LIKE '%{$search}%' AND tutor_id = ? ORDER BY date DESC");
                    $select_playlist->execute([$tutor_id]);
                    if ($select_playlist->rowCount() > 0) {
                        while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                            $playlist_id = $fetch_playlist['id'];
                            $count_videos = $conn->prepare("SELECT * FROM content WHERE playlist_id = ?");
                            $count_videos->execute([$playlist_id]);
                            $total_videos = $count_videos->rowCount();
            
            ?>
            <div class="box">
                <div class="flex">
                    <div> <i class="bx bx-dots-vertical-rounded" style="<?php  if ($fetch_playlist['status'] == 'active') {echo 'color:limegreen';}
                    else{echo 'color:red';}?>">
                    </i> <span style="<?php  if ($fetch_playlist['status'] == 'active') {echo 'color:limegreen';}
                    else{echo 'color:red';}?>"><?= $fetch_playlist['status'];?></span></div>
                    <div> <i class="bx bxs calendar-alt"></i> <span><?= $fetch_playlist['date'];?></span> </div>
                </div>
                <div class="thumb">
                    <span><?= $total_videos; ?></span>
                    <img src="../uploaded_files/<?= $fetch_playlist ['thumb'];?>" class="thumb">
                </div>
                <h3 class="title"><?= $fetch_playlist['title'];?></h3>
                <p class="descriptions"><?= $fetch_playlist['title'];?></p>
                <form action="" method="post">
                    <input type="hidden" name="playlist_id" value="<?= $playlist_id;?>">
                    <a href="update_playlist.php?get_id=<?= $playlist_id?>" class="btn">Perbarui</a>
                    <input type="submit" name="delete" value="Hapus Playlist" class="btn" onclick="return confirm('hapus');">
                    <a href="view_playlist.php?get_id=<?= $playlist_id;?>" class="btn">Lihat Playlist</a>
                </form>
            </div>
            <?php
                        }
                    }else{
                        echo '<p class="empty">konten tidak ditemukan!</p>';
                    }
                }else{
                    echo '<p class="empty">temukan!</p>';
                }
            ?>
        </div>
   </section>
    <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>