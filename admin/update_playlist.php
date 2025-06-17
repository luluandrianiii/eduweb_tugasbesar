<?php
    include '../components/connect.php';

    if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }

    if(isset($_COOKIE['get_id'])){
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header('location:playlist.php');
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
    <section class="playlist-form">
        <h1 class="heading">Perbarui Playlist</h1>
                  
        <?php  
            $select_playlist = $conn->prepare("SELECT * FROM playlist WHERE id = ?");
            $select_playlist->execute([$get_id]);
            if($select_playlist->rowCount() > 0) {
                while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                    $playlist_id = $fetch_playlist['id'];
                    $count_videos = $conn->prepare("SELECT * FROM content WHERE playlist_id = ?");
                    $total_videos = $count_videos->rowCount();
                }
            }
        ?>
            <form action="" method ="post" enctype="multipart/form-data">
                <input type="hidden" name="old_image" value="<?=  $fetch_playlist['thumb']; ?>">
                <p>Playlist Status <span>*</span></p>
                <select name="status" class="box">
                    <option value="<?= $fetch_playlist['status']; ?>" selected disabled>--Pilih Status--</option>
                    <option value="active">Aktif</option>
                    <option value="deactive">Non-Aktif</option>
                </select>
                <p>Judul Playlist <span>*</span></p>
                <input type="text" name="title" maxlength="150" required placeholder="Masukkan Judul Playlist" value="<?= $fetch_playlist['title']; ?>" class="box">
                <p>Deskripsi Playlist <span>*</span></p>
                <textarea name="descriptions" class="box" placeholder="Tulis Deskripsi" maxlength="1000" cols="30" rows="10"></textarea>
                <p>Thumbnail Playlist <span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
                <input type="submit" name="submit" value="buat playlist" class="btn">
            </form>
            
    </section>
    <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>