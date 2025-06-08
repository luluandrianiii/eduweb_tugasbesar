<?php
$db_name = 'mysql:host=localhost;port=3307;dbname=course_db';
$user_name = 'root';
$user_password = '';

  try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "You are connected"; // hanya untuk debug, bisa dihapus nanti
} catch (PDOException $e) { 
    echo "Could not connect: " . $e->getMessage();
    exit;
}


function unique_id(){
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $rand = array();
    $length = strlen($str) - 1;
    for($i=0; $i < 20; $i++){
        $n = mt_rand(0, $length);
        $rand[] = $str[$n];
    }
    return implode($rand);
}
?>