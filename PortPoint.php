<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>
 

<?php
include 'db_connect.php';

// รับ id และ state จาก URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$state = isset($_GET['state']) ? $_GET['state'] : '';

// ตรวจสอบว่ามี record หรือไม่
$sql = "SELECT * FROM booking WHERE BookingID = $id";
$result = $conn->query($sql);
$row = $result ? $result->fetch_assoc() : null;

// ถ้ากดบันทึก
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $InspectionPoint = trim($_POST['InspectionPoint'] ?? '');
    $InspectionPointLat = trim($_POST['InspectionPointLat'] ?? '');
    $InspectionPointLong = trim($_POST['InspectionPointLong'] ?? '');
    $InspectionDate = trim($_POST['InspectionDate'] ?? '');
    $InspectionTime = trim($_POST['InspectionTime'] ?? '');

    $stmt = $conn->prepare(
        "UPDATE booking SET 
            InspectionPoint=?, InspectionPointLat=?, InspectionPointLong=?, 
            InspectionDate=?, InspectionTime=? 
        WHERE BookingID=?"
    );
    $stmt->bind_param('sssssi', $InspectionPoint, $InspectionPointLat, $InspectionPointLong, $InspectionDate, $InspectionTime, $id);

    if ($stmt->execute()) {
        $msg = '<div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">บันทึกข้อมูลเรียบร้อยแล้ว</div>';
        // รีเฟรชข้อมูลใหม่
        $sql = "SELECT * FROM booking WHERE BookingID = $id";
        $result = $conn->query($sql);
        $row = $result ? $result->fetch_assoc() : null;
    } else {
        $msg = '<div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">เกิดข้อผิดพลาดในการบันทึกข้อมูล</div>';
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>บันทึกข้อมูลจุดตรวจตู้ (InspectionPoint)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex flex-col items-center py-8">
    <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-xl font-bold text-blue-800 mb-2">บันทึกข้อมูลท่าเรือ</h1>
        <div class="text-gray-500 text-sm mb-6">Booking ID: <span class="font-semibold text-blue-700"><?= htmlspecialchars($id) ?></span></div>
        <?= $msg ?>
        <?php if ($row): ?>
        <form method="post" autocomplete="off" class="space-y-4">
            <div>
                <label class="block font-semibold mb-1 text-gray-700">จุดท่าเรือ</label>
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <input type="text" name="InspectionPoint" required
                    value="<?= htmlspecialchars($row['InspectionPoint'] ?? '') ?>"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 outline-none" />
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block font-semibold mb-1 text-gray-700">ละติจูด (Lat)</label>
                    <input type="text" name="InspectionPointLat" pattern="^-?\d+(\.\d+)?$" required
                        value="<?= htmlspecialchars($row['InspectionPointLat'] ?? '') ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 outline-none" />
                </div>
                <div class="flex-1">
                    <label class="block font-semibold mb-1 text-gray-700">ลองจิจูด (Long)</label>
                    <input type="text" name="InspectionPointLong" pattern="^-?\d+(\.\d+)?$" required
                        value="<?= htmlspecialchars($row['InspectionPointLong'] ?? '') ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 outline-none" />
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block font-semibold mb-1 text-gray-700">วันที่ (InspectionDate)</label>
                    <input type="date" name="InspectionDate" required
                        value="<?= htmlspecialchars($row['InspectionDate'] ?? '') ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 outline-none" />
                </div>
                <div class="flex-1">
                    <label class="block font-semibold mb-1 text-gray-700">เวลา (InspectionTime)</label>
                    <input type="time" name="InspectionTime" required
                        value="<?= htmlspecialchars($row['InspectionTime'] ?? '') ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 outline-none" />
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow font-semibold transition">บันทึกข้อมูล</button>
                <a href="javascript:history.back()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg shadow font-semibold transition">ย้อนกลับ</a>
            </div>
        </form>
        <?php else: ?>
            <div class="text-red-500 text-lg text-center py-8">ไม่พบข้อมูลการจองนี้</div>
        <?php endif; ?>
    </div>
</body>
</html>
   <script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('save_PortPoint_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        if(res.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: res.msg,
                confirmButtonText: 'ตกลง',
            }).then(() => {
                window.location = 'index.php?page=booking';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.msg,
                confirmButtonText: 'ปิด',
            });
        }
    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้',
            confirmButtonText: 'ปิด',
        });
    });
});
</script>
   