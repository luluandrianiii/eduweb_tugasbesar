<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id =$_COOKIE['user_id'];
    }else{
        $user_id = '';
        header('location:login.php');
    }

   if(isset($_POST['submit'])){
        $select_user = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $select_user->execute([$user_id]);
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

        $prev_pass = $fetch_user['password'];
        $prev_image = $fetch_user['image'];

        $name = $_POST['name'];
        $name = trim($name);
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $name = preg_replace("/[^a-zA-Z\s]/", "", $name);

        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');


        if (!empty($name)) {
            $update_name = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
            $update_name->execute([$name, $user_id]);
            $message[] = 'update username berhasil';
        }
         if (!empty($email)) {
            $select_email = $conn->prepare("SELECT * FROM users WHERE id = ? AND email = ?");
            $select_email->execute([$user_id, $email]);
            if ($select_email->rowCount() > 0){
                $message[] = 'email sudah terpakai';
            }else{
                $update_email = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
                $update_email->execute([$email, $user_id]);
                $message[] = 'update email berhasil';
            }
        }

        // Update Gambar
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $rename = unique_id() . '.' . $ext;
            $image_size = $_FILES['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = 'uploaded_files/' . $rename;

            if ($image_size > 2000000) {
                $message[] = 'Ukuran gambar terlalu besar';
            } else {
                // Simpan gambar baru
                if (move_uploaded_file($image_tmp_name, $image_folder)) {
                    if (!empty($prev_image) && $prev_image != $rename) {
                        $old_image_path = 'uploaded_files/' . $prev_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                    $update_image = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
                    $update_image->execute([$rename, $user_id]);
                    $message[] = 'Image berhasil diupdate';
                } else {
                    $message[] = 'Gagal mengunggah gambar';
                }
            }
        }

         //update password

        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
        $old_pass = (trim($_POST['old_pass']));
        $new_pass = (trim($_POST['new_pass']));
        $cpass    = (trim($_POST['cpass']));


        if ($old_pass != $empty_pass){
            if ($old_pass != $prev_pass){
                $message[] = 'password lama tidak cocok';
            }elseif ($new_pass != $cpass){
                $message[] = 'password tidak cocok';
            }else{
                if ($new_pass != $empty_pass){
                    $update_pass = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $update_pass->execute([$cpass, $user_id]);
                    $message[] = 'password berhasil diupdate';
                }else{
                    $message[] = 'tolong masukkan password baru';
                }
            }
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
    <title>Jadi Pintar - resgistrasi</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">perbarui profil</i></span>
            </div>
            <h1>perbarui profile</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut molestias eum eligendi commodi modi temporibus quibusdam vel esse harum, quidem dolorum ea cupiditate deleniti fuga, doloremque sit? Vitae, ipsam maxime.</p>
            <div class="flex-btn">
                <a href="login.php" class="btn">masuk untuk mulai</a>
                <a href="contact.php" class="btn">hubungi kami</a>
            </div>
        </div>
        <img src="image/taylorswift.png">
    </div>

    <!----------daftar section------------- -->
    <section class="form-container">
        <div class="heading">
            <span>ayo bergabung dengan jadi pintar</span>
            <h1>perbarui profil</h1>
        </div>
        <form class="register" action="" method="post" enctype="multipart/form-data">
            <div class="flex">
                <div class="col">
                    <p>nama <span>*</span></p>
                    <input type="text" name="name" placeholder="<?=  $fetch_profile['name']; ?>" maxlength="50" class="box">
                    <p>email  <span>*</span></p>
                    <input type="email" name="email" placeholder="<?=  $fetch_profile['email']; ?>" maxlength="50" class="box">
                    <p>perbarui gambar <span>*</span></p>
                    <input type="file" name="image" accept="image/*" maxlength="20" class="box">
                </div>
                <div class="col">
                        <p>password lama<span>*</span></p>
                        <input type="password" name="old_pass" placeholder="masukkan password Anda" maxlength="20" class="box">
                        <p>password <span>*</span></p>
                        <input type="password" name="new_pass" placeholder="masukkan password Anda" maxlength="20" class="box">
                        <p>password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="konfirmasi password" maxlength="20" class="box">
                </div>
            </div>
            <input type="submit" name="submit" class="btn" value="perbarui profil" >
        </form>
    </section>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>