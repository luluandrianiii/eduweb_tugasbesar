<?php
    include '../components/connect.php';

     if(isset($_COOKIE['tutor_id'])){
        $tutor_id = $_COOKIE['tutor_id'];
    }else{
        $tutor_id = '';
        header('location: login.php');
    }

    if(isset($_POST['submit'])){
        $select_tutor = $conn->prepare("SELECT * FROM tutors WHERE id = ? LIMIT 1");
        $select_tutor->execute([$tutor_id]);
        $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

        $prev_pass = $fetch_tutor['password'];
        $prev_image = $fetch_tutor['image'];

        $name = $_POST['name'];
        $name = trim($name);
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $name = preg_replace("/[^a-zA-Z\s]/", "", $name);

        $profession = $_POST['profession'];
        $profession = htmlspecialchars($profession, ENT_QUOTES, 'UTF-8');

       $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');


        if (!empty($name)) {
            $update_name = $conn->prepare("UPDATE tutors SET name = ? WHERE id = ?");
            $update_name->execute([$name, $tutor_id]);
            $message[] = 'update username berhasil';
        }
        if (!empty($profession)) {
            $update_profession = $conn->prepare("UPDATE tutors SET profession = ? WHERE id = ?");
            $update_profession->execute([$profession, $tutor_id]);
            $message[] = 'update profesi berhasil';
        }
         if (!empty($email)) {
            $select_email = $conn->prepare("SELECT * FROM tutors WHERE id = ? AND email = ?");
            $select_email->execute([$tutor_id, $email]);
            if ($select_email->rowCount() > 0){
                $message[] = 'email sudah terpakai';
            }else{
                $update_email = $conn->prepare("UPDATE tutors SET email = ? WHERE id = ?");
                $update_email->execute([$email, $tutor_id]);
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
            $image_folder = '../uploaded_files/' . $rename;

            if ($image_size > 2000000) {
                $message[] = 'Ukuran image terlalu besar';
            } else {
                // Simpan gambar baru
                if (move_uploaded_file($image_tmp_name, $image_folder)) {
                    if (!empty($prev_image) && $prev_image != $rename) {
                        $old_image_path = '../uploaded_files/' . $prev_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                    $update_image = $conn->prepare("UPDATE tutors SET image = ? WHERE id = ?");
                    $update_image->execute([$rename, $tutor_id]);
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
                    $update_pass = $conn->prepare("UPDATE tutors SET password = ? WHERE id = ?");
                    $update_pass->execute([$cpass, $tutor_id]);
                    $message[] = 'password berhasil diupdate';
                }else{
                    $message[] = 'tolong masukkan password baru';
                }
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
     <title>Update Profile</title>
</head>
<body>
     <?php include '../components/admin_header.php'?>
    <div class="form-container" style="min-height: calc(100vh - 19rem); padding: 5rem 0;">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>Update Profile</h3>
            <div class="form-flex">
                <div class="col">
                    <p>name <span>*</span></p>
                    <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50" required class="box">
                    <p>profession <span>*</span></p>
                    <select name="profession" required class="box">
                        <option value="" disabled selected><?= $fetch_profile['profession']; ?></option>
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
                    <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="50" required class="box">
                </div>
                <div class="col">
                        <p>old password <span>*</span></p>
                        <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20" required class="box">
                        <p>new password <span>*</span></p>
                        <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20" required class="box">
                        <p>confim password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
                        
                </div>
            </div>
               <p>update picture <span>*</span></p>
               <input type="file" name="image" accept="image/*" maxlength="20" class="box">
               <input type="submit" name="submit" class="btn" value="update profile">
        </form>
    </div>
     <?php include '../components/footer.php'?>
    <script src="../components/admin_script.js" defer></script>
</body>
</html>