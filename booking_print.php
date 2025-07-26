<?php
include 'db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM booking WHERE BookingID = $id";
$result = $conn->query($sql);
$row = $result ? $result->fetch_assoc() : null;
$conn->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>พิมพ์รายงานจองรถเทลเลอร์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      @media print {
        .no-print { display: none !important; }
        body { background: white !important; }
      }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-8 flex flex-col items-center">
    <div class="w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200 print:shadow-none print:border-none">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-blue-900 tracking-wide">รายงานการจองรถเทลเลอร์</h1>
            <button onclick="window.print()" class="no-print px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition font-semibold">
                พิมพ์รายงาน
            </button>
        </div>
        <?php if ($row): ?>
        <div class="mb-3 text-gray-700 text-sm">เลขที่จอง: <span class="font-semibold text-blue-700"><?= htmlspecialchars($row['BookingID']) ?></span></div>
        <table class="w-full text-gray-700 border-t border-b border-gray-200 mb-6">
            <tbody>
                <tr>
                    <td class="py-2 font-semibold w-48">วันที่จอง</td>
                    <td class="py-2"><?= $row['BookingDate'] ? date('d/m/Y', strtotime($row['BookingDate'])) : '-' ?></td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">ทะเบียนหัวลาก</td>
                    <td class="py-2"><?= htmlspecialchars($row['HeadTruckPlate']) ?></td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">ทะเบียนหางลาก</td>
                    <td class="py-2"><?= htmlspecialchars($row['TrailerPlate']) ?></td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">ชื่อคนขับ</td>
                    <td class="py-2"><?= htmlspecialchars($row['DriverName']) ?></td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">หมายเลขตู้</td>
                    <td class="py-2"><?= htmlspecialchars($row['ContainerNo']) ?></td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">วันที่ใช้รถ / เวลา</td>
                    <td class="py-2">
                        <?= $row['UseDate'] ? date('d/m/Y', strtotime($row['UseDate'])) : '-' ?>
                        <?= $row['UseTime'] ? ' ' . date('H:i', strtotime($row['UseTime'])) : '' ?>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">จุดรับตู้</td>
                    <td class="py-2"><?= htmlspecialchars($row['PickupPoint']) ?>
                        <?php if($row['PickupPointLat'] && $row['PickupPointLong']): ?>
                            <span class="text-xs text-gray-400">[<?= $row['PickupPointLat'] ?>, <?= $row['PickupPointLong'] ?>]</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">วันที่ถึงจุดรับ / เวลา</td>
                    <td class="py-2">
                        <?= ($row['PickupArriveDate'] ? date('d/m/Y', strtotime($row['PickupArriveDate'])) : '-') ?>
                        <?= ($row['PickupArriveTime'] ? ' ' . date('H:i', strtotime($row['PickupArriveTime'])) : '') ?>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">จุดตรวจตู้</td>
                    <td class="py-2"><?= htmlspecialchars($row['InspectionPoint']) ?>
                        <?php if($row['InspectionPointLat'] && $row['InspectionPointLong']): ?>
                            <span class="text-xs text-gray-400">[<?= $row['InspectionPointLat'] ?>, <?= $row['InspectionPointLong'] ?>]</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">วันที่ถึงจุดตรวจ / เวลา</td>
                    <td class="py-2">
                        <?= ($row['InspectionDate'] ? date('d/m/Y', strtotime($row['InspectionDate'])) : '-') ?>
                        <?= ($row['InspectionTime'] ? ' ' . date('H:i', strtotime($row['InspectionTime'])) : '') ?>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">ท่าเรือ</td>
                    <td class="py-2"><?= htmlspecialchars($row['PortPoint']) ?>
                        <?php if($row['PortPointLat'] && $row['PortPointLong']): ?>
                            <span class="text-xs text-gray-400">[<?= $row['PortPointLat'] ?>, <?= $row['PortPointLong'] ?>]</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">วันที่ถึงท่าเรือ / เวลา</td>
                    <td class="py-2">
                        <?= ($row['PortArriveDate'] ? date('d/m/Y', strtotime($row['PortArriveDate'])) : '-') ?>
                        <?= ($row['PortArriveTime'] ? ' ' . date('H:i', strtotime($row['PortArriveTime'])) : '') ?>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">สถานะ</td>
                    <td class="py-2"><?= htmlspecialchars($row['Status']) ?></td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="py-2 font-semibold">ผู้บันทึก</td>
                    <td class="py-2"><?= htmlspecialchars($row['CreatedBy']) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="mt-8 flex justify-end gap-8">
            <div class="text-gray-700 text-sm text-center">
                <div class="mb-10"></div>
                ..................................................<br>
                ผู้รับทราบ
            </div>
            <div class="text-gray-700 text-sm text-center">
                <div class="mb-10"></div>
                ..................................................<br>
                ผู้บันทึกข้อมูล
            </div>
        </div>
        <?php else: ?>
            <div class="text-red-500 py-12 text-center text-lg">ไม่พบข้อมูลการจอง</div>
        <?php endif; ?>
        <?php $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]" . dirname($_SERVER['REQUEST_URI']); ?>

<div class="flex flex-wrap gap-8 justify-center mt-10 print:mt-8">
    <div class="flex flex-col items-center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=<?= urlencode($baseUrl . '/PickupPoint.php?id=' . $row['BookingID'] . '&state=PickupPoint') ?>"
             alt="QR รับตู้" class="rounded shadow"/>
        <div class="text-xs text-gray-600 mt-2">จุดรับตู้ (PickupPoint)</div>
    </div>
<?php
if (empty($row['CustomerCode']) || strtoupper($row['CustomerCode']) === 'TOSHIBA') {
    echo '<div class="flex flex-col items-center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data='
        . urlencode($baseUrl . '/InspectionPoint.php?id=' . $row['BookingID'] . '&state=InspectionPoint')
        . '" alt="QR ตรวจตู้" class="rounded shadow"/>
        <div class="text-xs text-gray-600 mt-2">จุดตรวจตู้ (InspectionPoint)</div>
    </div>';
}
?>
    <div class="flex flex-col items-center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=<?= urlencode($baseUrl . '/PortPoint.php?id=' . $row['BookingID'] . '&state=PortPoint') ?>"
             alt="QR ท่าเรือ" class="rounded shadow"/>
        <div class="text-xs text-gray-600 mt-2">ท่าเรือ (PortPoint)</div>
    </div>
</div>
    </div>
</body>
</html>
