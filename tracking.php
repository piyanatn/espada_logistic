<?php
include 'db_connect.php';
header('Content-Type: text/html; charset=utf-8');

// รับหมายเลขตู้หรือเลขที่จองจาก URL หรือ Form
$key = trim($_GET['key'] ?? $_POST['key'] ?? '');
$booking = null;

if ($key !== '') {
    // หาโดย BookingID หรือ ContainerNo ก็ได้
    $sql = "SELECT * FROM booking WHERE BookingID = ? OR ContainerNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $key, $key);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
</br>
<div class="w-full max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-xl font-bold text-blue-800 mb-6 text-center tracking-wide">Tracking สถานะตู้คอนเทนเนอร์</h1>
        <form method="get" class="flex items-center gap-2 mb-6 justify-center">
            <input type="text" name="key" required autofocus
                value="<?= htmlspecialchars($key) ?>"
                placeholder="ระบุหมายเลขตู้ หรือ เลขที่จอง"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 outline-none text-base"
            />
            <button type="submit"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition"
            >ค้นหา</button>
        </form>

        <?php if ($key && !$booking): ?>
            <div class="bg-red-50 text-red-700 p-4 rounded mb-2 text-center">ไม่พบข้อมูล</div>
        <?php elseif ($booking): ?>
            <div class="mb-4 text-center">
                <div class="text-sm text-gray-500">Booking ID: <b><?= htmlspecialchars($booking['BookingID']) ?></b></div>
                <div class="text-sm text-gray-500">ContainerNo: <b><?= htmlspecialchars($booking['ContainerNo']) ?></b></div>
            </div>
            <div class="space-y-4">
                <!-- 1. จุดรับตู้ -->
                <div class="flex gap-3 items-center border rounded-lg p-3 bg-blue-50">
                    <span class="inline-block bg-sky-500 text-white px-3 py-1 rounded-full text-xs font-semibold">รับตู้</span>
                    <div>
                        <div class="font-semibold"><?= htmlspecialchars($booking['PickupPoint']) ?></div>
                        <div class="text-xs text-gray-600">
                            <?= ($booking['PickupArriveDate'] ? date('d/m/Y', strtotime($booking['PickupArriveDate'])) : '-') ?>
                            <?= ($booking['PickupArriveTime'] ? ' ' . date('H:i', strtotime($booking['PickupArriveTime'])) : '') ?>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <?= ($booking['PickupArriveDate'] && $booking['PickupArriveTime']) 
                            ? '<span class="inline-block bg-green-100 text-green-700 rounded-full px-3 py-1 text-xs font-semibold">เสร็จสิ้น</span>' 
                            : '<span class="inline-block bg-yellow-100 text-yellow-700 rounded-full px-3 py-1 text-xs font-semibold">รอดำเนินการ</span>'; ?>
                    </div>
                </div>
                <!-- 2. จุดตรวจตู้ -->
                <div class="flex gap-3 items-center border rounded-lg p-3 bg-blue-50">
                    <span class="inline-block bg-indigo-500 text-white px-3 py-1 rounded-full text-xs font-semibold">ตรวจตู้</span>
                    <div>
                        <div class="font-semibold"><?= htmlspecialchars($booking['InspectionPoint']) ?></div>
                        <div class="text-xs text-gray-600">
                            <?= ($booking['InspectionDate'] ? date('d/m/Y', strtotime($booking['InspectionDate'])) : '-') ?>
                            <?= ($booking['InspectionTime'] ? ' ' . date('H:i', strtotime($booking['InspectionTime'])) : '') ?>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <?= ($booking['InspectionDate'] && $booking['InspectionTime']) 
                            ? '<span class="inline-block bg-green-100 text-green-700 rounded-full px-3 py-1 text-xs font-semibold">เสร็จสิ้น</span>' 
                            : '<span class="inline-block bg-yellow-100 text-yellow-700 rounded-full px-3 py-1 text-xs font-semibold">รอดำเนินการ</span>'; ?>
                    </div>
                </div>
                <!-- 3. ท่าเรือ -->
                <div class="flex gap-3 items-center border rounded-lg p-3 bg-blue-50">
                    <span class="inline-block bg-emerald-600 text-white px-3 py-1 rounded-full text-xs font-semibold">ท่าเรือ</span>
                    <div>
                        <div class="font-semibold"><?= htmlspecialchars($booking['PortPoint']) ?></div>
                        <div class="text-xs text-gray-600">
                            <?= ($booking['PortArriveDate'] ? date('d/m/Y', strtotime($booking['PortArriveDate'])) : '-') ?>
                            <?= ($booking['PortArriveTime'] ? ' ' . date('H:i', strtotime($booking['PortArriveTime'])) : '') ?>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <?= ($booking['PortArriveDate'] && $booking['PortArriveTime']) 
                            ? '<span class="inline-block bg-green-100 text-green-700 rounded-full px-3 py-1 text-xs font-semibold">เสร็จสิ้น</span>' 
                            : '<span class="inline-block bg-yellow-100 text-yellow-700 rounded-full px-3 py-1 text-xs font-semibold">รอดำเนินการ</span>'; ?>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <span class="text-gray-600 text-xs">สถานะล่าสุด: 
                    <span class="font-semibold text-blue-800"><?= htmlspecialchars($booking['Status']) ?></span>
                </span>
            </div>
        <?php endif; ?>
    </div>

      <!-- Feature Section -->
    <section class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-6 shadow flex flex-col items-center text-center hover:shadow-xl transition">
                <svg class="w-12 h-12 text-blue-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M2 8l10 6 10-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 8v8a2 2 0 002 2h16a2 2 0 002-2V8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="font-bold text-lg mb-2 text-blue-700">ใช้งานง่าย</h3>
                <p class="text-gray-500 text-base">UI/UX เน้นใช้งานจริง สะดวกสบาย ไม่ต้องอบรมซ้ำ</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow flex flex-col items-center text-center hover:shadow-xl transition">
                <svg class="w-12 h-12 text-green-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 12l2 2 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="font-bold text-lg mb-2 text-green-700">ปลอดภัยสูง</h3>
                <p class="text-gray-500 text-base">ข้อมูลทุกอย่างถูกปกป้องด้วยระบบ Security ระดับสากล</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow flex flex-col items-center text-center hover:shadow-xl transition">
                <svg class="w-12 h-12 text-yellow-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9l-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13 2v7h7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="font-bold text-lg mb-2 text-yellow-700">รายงานสวยงาม</h3>
                <p class="text-gray-500 text-base">ระบบสร้างรายงาน กราฟ ชาร์ต ส่งออกไฟล์ง่ายเว่อร์</p>
            </div>
        </div>
    </section>