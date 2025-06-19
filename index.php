<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_i = '';
    }
?>

<style>
    <?php include 'css/user_style.css';?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Jadi Pintar - beranda</title>
</head>
<body>



    <?php include 'components/user_header.php'?>
    <?php include 'components/footer.php'?>
    <script src="../js/user_script.js" defer></script>
</body>
</html>