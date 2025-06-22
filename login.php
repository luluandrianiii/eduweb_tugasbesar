<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['submit'])){
    $email = strtolower(trim($_POST['email']));

    $pass = $_POST['pass'];

    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount() > 0){
        setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
        header('location:index.php');
        exit;
    }else{
        $message[] = 'Email atau password salah';
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
    <title>Jadi Pintar - masuk</title>
</head>
<body>
    <?php include 'components/user_header.php'?>

    <!----------banner section------------- -->
    <div class="banner">
        <div class="detail">
            <div class="title">
                <a href="index.php">beranda</a><span><i class="bx bx-chevron-right">masuk</i></span>
            </div>
            <h1>masuk sekarang</h1>
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
            <span>selamat datang kembali</span>
            <h1>ayo masuk</h1>
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <p>email  <span>*</span></p>
            <input type="email" name="email" placeholder="masukkan email Anda" maxlength="50" required class="box">
            <p>password <span>*</span></p>
            <input type="password" name="pass" placeholder="masukkan password Anda" maxlength="20" required class="box">
            
            <p class="link">belum punya akun? <a href="register.php">Daftar</a></p>
            <input type="submit" name="submit" class="btn" value="masuk sekarang" >
        </form>
    </section>
    
    <?php include 'components/footer.php'?>
    <script type="text/javascript" src="js/user_script.js"></script>
</body>
</html>