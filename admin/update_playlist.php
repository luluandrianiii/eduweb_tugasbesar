<?php
    include '../components/connect.php';

    if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }

    if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header('location:playlist.php');
    }

    //update playlist

    if(isset($_POST['update'])){
        $title = $_POST['title'];
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        $descriptions = $_POST['descriptions'];
        $descriptions = htmlspecialchars($descriptions, ENT_QUOTES, 'UTF-8');

       
        $status = isset($_POST['status']) ? htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8') : 'default_status';

        $update_playlist = $conn->prepare("UPDATE playlist SET title = ?, descriptions = ?, status = ? WHERE id = ?");
        $update_playlist->execute([$title, $descriptions, $status, $get_id]);
        
        $old_image = $_POST['old_image'];
        $old_image = htmlspecialchars($old_image, ENT_QUOTES, 'UTF-8');

        $image = $_FILES['image']['name'];
        $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        if(!empty($image)){
            if($image_size > 2000000){
                $message[] = 'Ukuran gambar terlalu besar';
            }else{
                $update_image = $conn->prepare("UPDATE playlist SET thumb = ? WHERE id = ?");
                $update_image->execute([$rename, $get_id]);
                move_uploaded_file($image_tmp_name, $image_folder);

                if ($old_image != '' AND $old_image != $rename){
                    unlink('../uploaded_files/'.$old_image);
                }
            }
        }
        $message[] = 'playlist telah diperbarui';
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
                    $count_videos->execute([$playlist_id]);
                    $total_videos = $count_videos->rowCount();
        ?>
            <form action="" method ="post" enctype="multipart/form-data">
                <input type="hidden" name="old_image" value="<?=  $fetch_playlist['thumb']; ?>">
                <input type="hidden" name="playlist_id" value="<?= $playlist_id; ?>">
                <p>Playlist Status <span>*</span></p>
                <select name="status" class="box">
                    <option value="<?= $fetch_playlist['status']; ?>" selected disabled><?= $fetch_playlist['status']; ?></option>
                    <option value="active">Aktif</option>
                    <option value="deactive">Non-Aktif</option>
                </select>
                <p>Judul Playlist <span>*</span></p>
                <input type="text" name="title" maxlength="150" placeholder="Masukkan Judul Playlist" value="<?= $fetch_playlist['title']; ?>" class="box">
                <p>Deskripsi Playlist <span>*</span></p>
                <textarea name="descriptions" class="box" placeholder="Tulis Deskripsi" maxlength="1000" cols="30" rows="10"><?= $fetch_playlist['descriptions']; ?></textarea>
                <p>Thumbnail Playlist <span>*</span></p>
                <div class="thumb">
                    <span><?= $total_videos; ?></span>
                    <img src="../uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
                </div>
                <input type="file" name="image" accept="image/*"  class="box">

                <div class="flex-btn">
                    <input type="submit" name="update" value="perbarui playlist" class="btn">
                    <input type="submit" name="delete" value="hapus playlist" class="btn" onclick="return confirm('hapus playlist ini');">
                    <a href="view_playlist.php?get_id=<?= $playlist_id; ?>" class="btn">Lihat Playlist</a>
                </div>
            </form>

            <?php 
                    }
                }else{
                    echo'<p class="empty">belum ada playlist ditambahkan!</p>';
                }
            ?>
            
    </section>
    <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>