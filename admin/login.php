<?php
    include '../components/connect.php';

    if(isset($_POST['submit'])){
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $pass = $_POST['pass'];

        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE email = ? AND password = ? LIMIT 1");
        $select_tutor->execute([$email, $pass]);
        $row = $select_tutor->fetch(PDO::FETCH_ASSOC);

        if($select_tutor->rowCount() > 0){
            setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:dashboard.php');
        }else{
            $message[] = 'incorrect email or password';
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
     <title>Admin login</title>
</head>
<body>
    <?php
        if(isset($message)){
            foreach ($message as $message){
                echo '
                <div class="message">
                <span>'.$message.'</span>
                <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
            </div> 
            ';
            }
        }
    ?>

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>Masuk sekarang</h3>
            <p>email  <span>*</span></p>
            <input type="email" name="email" placeholder="masukkan email Anda" maxlength="50" required class="box">
            <p>password <span>*</span></p>
            <input type="password" name="pass" placeholder="masukkan password Anda" maxlength="20" required class="box">
            
            <p class="link">belum punya akun? <a href="register.php">Daftar</a></p>
            <input type="submit" name="submit" class="btn" value="masuk sekarang" >
        </form>
    </div>
</body>
</html>