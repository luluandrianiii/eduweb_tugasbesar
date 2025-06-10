<?php
    include '../components/connect.php';

    if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }

   if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location: login.php');
}

if (isset($_POST['submit'])){
    $id = unique_id();
    $title = $_POST['title'];
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $descriptions = $_POST['descriptions'];
    $descriptions = htmlspecialchars($descriptions, ENT_QUOTES, 'UTF-8');
    $status = $_POST['status'];
    $status = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');

    $image = $_FILES['image']['name'];
    $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder ='../uploaded_files/'.$rename;

    $add_playlist = $conn->prepare("INSERT INTO playlist (id, tutor_id, title, descriptions, thumb, status) VALUES(?,?,?,?,?,?)");
    $add_playlist->execute([$id, $tutor_id, $title, $descriptions, $rename, $status]);
    move_uploaded_file($image_tmp_name, $image_folder);

    $message[] = 'playlist terbaru terbuat';
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
        <h1 class="heading">Buat Playlist</h1>
                  
        <form action="" method ="post" enctype="multipart/form-data">
            <p>Playlist Status <span>*</span></p>
            <select name="status" class="box">
                <option value="" selected disabled>--Pilih Status</option>
                <option value="active">Aktif</option>
                <option value="deactive">Non-Aktif</option>
            </select>
            <p>Judul Playlist <span>*</span></p>
            <input type="text" name="title" maxlength="150" required placeholder="Masukkan Judul Playlist" class="box">
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