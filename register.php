<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id =$_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['submit'])) {
        $id = uniqid();
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');

        $email = strtolower(trim($_POST['email']));

        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $rename = uniqid(). '.' .$image_ext;
        $image_folder = 'uploaded_files/'.$rename;
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $select_user->execute([$email]);

        if ($select_user->rowCount() > 0) {
            $message[] = 'email sudah terpakai';
        }else{
            if ($pass != $cpass) {
                $message[] = 'konfirmasi sandi tidak cocok';
            }else{
                $insert_user = $conn->prepare("INSERT INTO users (id, name,email,password,image) VALUES (?,?,?,?,?)");
                $insert_user->execute([$id, $name, $email, $cpass, $rename]);
                move_uploaded_file($image_tmp, $image_folder);
                
                $verify_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
                $verify_user->execute([$email, $pass]);
                $row = $verify_user->fetch(PDO::FETCH_ASSOC);

                if ($verify_user->rowCount() > 0) {
                   setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
                   header('location:index.php');
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
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">daftar sekarang</i></span>
            </div>
            <h1>daftar sekarang</h1>
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
            <h1>buat akun</h1>
        </div>
        <form class="register" action="" method="post" enctype="multipart/form-data">
            <div class="flex">
                <div class="col">
                    <p>nama <span>*</span></p>
                    <input type="text" name="name" placeholder="masukkan nama Anda" maxlength="50" required class="box">
                    <p>email  <span>*</span></p>
                    <input type="email" name="email" placeholder="masukkan email Anda" maxlength="50" required class="box">
                </div>
                <div class="col">
                        <p>password <span>*</span></p>
                        <input type="password" name="pass" placeholder="masukkan password Anda" maxlength="20" required class="box">
                        <p>password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="konfirmasi password" maxlength="20" required class="box">
                </div>
            </div>
            <p>pilih gambar <span>*</span></p>
            <input type="file" name="image" accept="image/*" maxlength="20" required class="box">
            <p class="link">sudah punya akun? <a href="login.php">login sekarang</a></p>
            <input type="submit" name="submit" class="btn" value="daftar sekarang" >
        </form>
    </section>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>