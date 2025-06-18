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
        header('location:dashboard.php');
    }



if (isset($_POST['submit'])){
    $id = unique_id();
    $title = $_POST['title'];
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $descriptions = $_POST['descriptions'];
    $descriptions = htmlspecialchars($descriptions, ENT_QUOTES, 'UTF-8');
    $status = $_POST['status'];
    $status = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
    $playlist = $_POST['playlist'];
    $playlist = htmlspecialchars($playlist, ENT_QUOTES, 'UTF-8');

    $image = $_FILES['image']['name'];
    $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder ='../uploaded_files/'.$rename;

    $video = $_FILES['video']['name'];
    $video = htmlspecialchars($video, ENT_QUOTES, 'UTF-8');
    $video_ext = pathinfo($video, PATHINFO_EXTENSION);
    $rename_video = unique_id().'.'.$video_ext;
    $video_tmp_name = $_FILES['video']['tmp_name'];
    $video_folder = '../uploaded_files/'.$rename_video;

   if($image_size > 2000000){
    $message[] = 'Ukuran gambar terlalu besar';
   }else{
    $add_playlist = $conn->prepare("INSERT INTO content (id, tutor_id, playlist_id, title, descriptions, video, thumb, status) VALUES (?,?,?,?,?,?,?,?)");
    $add_playlist->execute(([$id, $tutor_id, $playlist, $title, $descriptions, $rename_video, $rename, $status]));
    move_uploaded_file($image_tmp_name, $image_folder);
    move_uploaded_file($video_tmp_name, $video_folder);
    $message[] = 'Kursus Baru telah diunggah';
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
    <section class="video-form">
        <h1 class="heading">Unggah Konten</h1>
        <?php
            $select_video = $conn->prepare("SELECT * FROM content WHERE id = ? AND tutor_id = ?");
            $select_video->execute([$get_id, $tutor_id]);

            if ($select_video->rowCount() > 0) {
                while($fetch_video = $select_video->fetch(PDO::FETCH_ASSOC)){
                    $video_id = $fetch_video['id'];
                
        ?>
        <form action="" method ="post" enctype="multipart/form-data">
            <input type="hidden" name="video_id" value="<?= $fetch_video['id'];?>">
            <input type="hidden" name="olde_thumb" value="<?= $fetch_video['thumb'];?>">
            <input type="hidden" name="old_video" value="<?= $fetch_video['video'];?>">
            <p>Perbarui Status <span>*</span></p>
            <select name="status" class="box">
                <option value="<?= $fetch_video['status'];?>" selected><?= $fetch_video['status'];?></option>
                <option value="active">Aktif</option>
                <option value="deactive">Non-Aktif</option>
            </select>
            <p>Perbarui Judul<span>*</span></p>
            <input type="text" name="title" maxlength="150" required placeholder="Masukkan Judul Video" value= "<?= $fetch_video['title'];?>"class="box">
            <p>Perbarui Deskripsi<span>*</span></p>
            <textarea name="descriptions" class="box" placeholder="Tulis Deskripsi" maxlength="1000" cols="30" rows="10"><?= $fetch_video['descriptions'];?></textarea>
            <p>Perbarui Playlist <span>*</span></p>
            <select name="playlist" class="box" required>
                <option value="<?= $fetch_video['playlist_id'];?>" selected disabled>--Pilih Playlist--</option>
                <?php 
                    $select_playlist = $conn->prepare("SELECT * FROM playlist WHERE tutor_id = ?");
                    $select_playlist->execute([$tutor_id]);
                    if($select_playlist->rowCount() > 0){
                        while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){


                ?>
                <option value="<?= $fetch_playlist['id'];?>"><?= $fetch_playlist['title'];?>></option>
                <?php 
                    }
                ?>
                <?php 
                    }else{
                        echo'<p class="empty">belum ada playlist ditambahkan!</p>';
                    }
                ?>
            </select>
            <img src="../uploaded_files/<?= $fetch_video['thumb'];?>" alt="">
            <p>Perbarui Thumbnail<span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
            <video src="../uploaded_files/<?= $fetch_video['video'];?>" controls ></video>
            <p>Perbarui Video<span>*</span></p>
            <input type="file" name="video" accept="video/*" required class="box">
            <div class="flex-btn">
                <input type="submit" name="submit" value="Unggah Video" class="btn">
                <a href="view_content.php?get_id=<?= $video_id;?>" class="btn">Lihat Konten</a>
                <input type="submit" value="Hapus Video" name="delete_video" class="btn">
            </div>
        </form>
        <?php
                 }
            }else{
                echo '
                        <div class="empty">
                        <p style="margin-bottom: 1.5rem;">belum ada video yang ditambahkan!</p>
                        <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">Tambah Video</a>
                        </div>
                     ';
            }
        ?>
    </section>
    <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>