<?php
include 'db_connect.php';

header('Content-Type: application/json; charset=utf-8');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$InspectionPoint = trim($_POST['InspectionPoint'] ?? '');
$InspectionPointLat = trim($_POST['InspectionPointLat'] ?? '');
$InspectionPointLong = trim($_POST['InspectionPointLong'] ?? '');
$InspectionDate = trim($_POST['InspectionDate'] ?? '');
$InspectionTime = trim($_POST['InspectionTime'] ?? '');

if ($id > 0 && $InspectionPoint && $InspectionPointLat && $InspectionPointLong && $InspectionDate && $InspectionTime) {
    $stmt = $conn->prepare(
        "UPDATE booking SET 
            PortPoint=?, PortPointLat=?, PortPointLong=?, 
            PortArriveDate=?, PortArriveTime=? 
        WHERE BookingID=?"
    );
    $stmt->bind_param('sssssi', $InspectionPoint, $InspectionPointLat, $InspectionPointLong, $InspectionDate, $InspectionTime, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'msg' => 'บันทึกข้อมูลสำเร็จ']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'เกิดข้อผิดพลาดในการบันทึก']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'msg' => 'ข้อมูลไม่ครบถ้วน']);
}
$conn->close();
?>
