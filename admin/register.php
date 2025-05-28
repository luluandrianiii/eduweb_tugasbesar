<?php
    include '../components/connect.php';

    if(isset($_POST['submit'])){
        $id = uniqid();
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
        $profession = htmlspecialchars($_POST['profession'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $rename = uniqid(). '.' .$image_ext;
        $image_folder = '../uploaded_files/'.$rename;
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE email = ?");
        $select_tutor->execute([$email]);

        if($select_tutor->rowCount() > 0){
            $message[] = 'email already exist';
        }else{
            if ($pass != $cpass){
                $message[] = 'configure password not matched';
            }else{

                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                
                $insert_tutor = $conn->prepare("INSERT INTO tutors (id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
                $insert_tutor->execute([$id, $name, $profession, $email, $cpass, $rename]);

                move_uploaded_file($image_tmp, $image_folder);
                $message[] = 'new tutor regisrated';
            }
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
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>register now</h3>

            <div class="form-flex">
                <div class="col">
                    <p>name <span>*</span></p>
                    <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
                    <p>profession <span>*</span></p>
                    <select name="profession" required class="box">
                        <option value="" disabled selected>--select your profession--</option>
                        <option value="developer">developer</option>
                        <option value="designer">designer</option>
                        <option value="musician">musician</option>
                        <option value="biologist">biologist</option>
                        <option value="teacher">teacher</option>
                        <option value="engineer">engineer</option>
                        <option value="lawyer">lawyer</option>
                        <option value="accountant">accountant</option>
                        <option value="doctor">doctor</option>
                        <option value="journalist">journalist</option>
                        <option value="photographer">photographer</option>
                        <option value="software developer">software developer</option>
                    </select>
                    <p>email  <span>*</span></p>
                    <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
                </div>
                <div class="col">
                        <p>password <span>*</span></p>
                        <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
                        <p>password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="confirm your passwod" maxlength="20" required class="box">
                        <p>select picture <span>*</span></p>
                        <input type="file" name="image" accept="image/*" maxlength="20" required class="box">
                </div>
            </div>
                <p class="link">already have an account ? <a href="login.php">login now</a></p>
                <input type="submit" name="submit" class="btn" value="register now" >
        </form>
    </div>
</body>
</html>