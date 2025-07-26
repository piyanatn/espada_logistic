<?php
//p5NU4Ecxvd5%y^fd
// db_connect.php
// ใช้งาน: include หรือ require_once 'db_connect.php';

$DB_HOST = 'espadatechnology.com';    // หรือ IP ของเซิร์ฟเวอร์
$DB_USER = 'espada_logistic';         // ชื่อผู้ใช้ MySQL
$DB_PASS = 'p5NU4Ecxvd5%y^fd';             // รหัสผ่าน MySQL
$DB_NAME = 'espada_logistic';    // ชื่อฐานข้อมูล

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// ตั้งค่า charset ให้รองรับภาษาไทย (UTF-8)
$conn->set_charset('utf8');
?>