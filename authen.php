<?php
session_start();
header('Content-Type: text/plain; charset=utf-8');
require_once 'db_connect.php';

// รับค่าจาก POST
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// ดึง password hash ออกจากฐานข้อมูล
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username=? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($user_id, $password_hash);
    $stmt->fetch();

   //  echo "POST=" . $password . " DB=" . $password_hash;
   //  echo "DB PASS=" . password_hash('adminadmin', PASSWORD_DEFAULT);
    // เช็ค password ที่ผู้ใช้กรอกกับ hash ในฐานข้อมูล
    if (password_verify($password, $password_hash)) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        echo 'success';
    } else {
        echo 'password incorrect';
    }
} else {
    echo 'User not found';
}
$stmt->close();
$conn->close();
