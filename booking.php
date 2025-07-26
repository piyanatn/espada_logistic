 <?php

    include 'db_connect.php';
    // query ทุก record (หรือใส่ limit/page ได้)
    $sql = "SELECT * FROM booking ORDER BY BookingDate DESC, BookingID DESC";
    $result = $conn->query($sql);
    ?>
<div class="container mx-auto px-2 py-8">
   
        <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-wider">รายการจอง</h1>
        <a href="booking_add.php"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-800 text-white text-base font-semibold shadow hover:bg-green-600 transition"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            เพิ่มรายการจอง
        </a>
    </div>
    <div class="overflow-auto rounded-2xl shadow-xl border border-gray-200 bg-primary">
        <table class="min-w-[900px] w-full border-separate border-spacing-0 bg-white text-gray-700">
            <thead>
                <tr class="bg-blue-600">
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">#</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">Booking No</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">Booking Date</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">ลูกค้า</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">หัวลาก</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">หางลาก</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">คนขับ</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">ContainerNo</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">รับตู้</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">ตรวจตู้</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">ท่าเรือ</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">สถานะ</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">ผู้บันทึก</th>
                <th class="px-3 py-3 font-semibold text-sm text-white text-center align-middle">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                $n = 1;
                while ($row = $result->fetch_assoc()) {

                    //Booking date and time
                 
                    $Bookingdate = $row['BookingDate'];

                    if ($Bookingdate && $Bookingdate !== '0000-00-00' ) {
                        // รวมวันและเวลา
                        $Bookingdt = date('d/m/y', strtotime($Bookingdate ));
                    } elseif ($Bookingdate && $Bookingdate !== '0000-00-00') {
                        $Bookingdt = date('d/m/y', strtotime($Bookingdate));
                    } else {
                        $Bookingdt = '-';
                    }
                    
                    
                    //Pickup date and time
                 
                    $Pickupdate = $row['PickupArriveDate'];
                    $Pickuptime = $row['PickupArriveTime'];

                    if ($Pickupdate && $Pickupdate !== '0000-00-00' && $Pickuptime && $Pickuptime !== '00:00:00') {
                        // รวมวันและเวลา
                        $Pickupdt = date('d/m/y H:i', strtotime($Pickupdate . ' ' . $Pickuptime));
                    } elseif ($Pickupdate && $Pickupdate !== '0000-00-00') {
                        $Pickupdt = date('d/m/y', strtotime($Pickupdate));
                    } else {
                        $Pickupdt = '-';
                    }
                      //Inspection date and time
                    $Inspecdate = $row['InspectionDate'];
                    $Inspectime = $row['InspectionTime'];

                    if ($Inspecdate && $Inspecdate !== '0000-00-00' && $Inspectime && $Inspectime !== '00:00:00') {
                        // รวมวันและเวลา
                        $Inspecdt = date('d/m/y H:i', strtotime($Inspecdate . ' ' . $Inspectime));
                    } elseif ($Inspecdate && $Inspecdate !== '0000-00-00') {
                        $Inspecdt = date('d/m/y', strtotime($Inspecdate));
                    } else {
                        $Inspecdt = '-';
                    }
                 
                    //Load date and time
                    $Loaddate = $row['PortArriveDate'];
                    $Loadtime = $row['PortArriveTime'];

                    if ($Loaddate && $Loaddate !== '0000-00-00' && $Loadtime && $Loadtime !== '00:00:00') {
                        // รวมวันและเวลา
                        $Loaddt = date('d/m/y H:i', strtotime($Loaddate . ' ' . $Loadtime));
                    } elseif ($Loaddate && $Loaddate !== '0000-00-00') {
                        $Loaddt = date('d/m/y', strtotime($Loaddate));
                    } else {
                        $Loaddt = '-';
                    }
                    

                    $ฺBookingNO = $row['BookingID'];
                    $CustomerCode = $row['CustomerCode'];

                    $rowBg = $n % 2 == 0 ? "bg-gray-50" : "bg-white";
                    echo '<tr class="'.$rowBg.' hover:bg-gray-100 transition">';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.$n++.'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($ฺBookingNO).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($Bookingdt).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($CustomerCode).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($row['HeadTruckPlate']).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($row['TrailerPlate']).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($row['DriverName']).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($row['ContainerNo']).'</td>';

             
                   echo '<td class="px-3 py-2 text-sm text-center align-middle">'
                    .htmlspecialchars($Pickupdt).
                    ' <a href="PickupPoint.php?id='.$row['BookingID'].'&state=PickupPoint"'
                    .' title="แก้ไขรับตู้"'
                    .' class="inline-flex items-center justify-center w-7 h-7 rounded hover:bg-blue-100 text-blue-600 ml-1 transition">'
                    .'<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">'
                    .'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-2.828 0L9 13l-6 6V9h6z"/>'
                    .'</svg>'
                    .'</a>'
                    .'</td>';

                    echo '<td class="px-3 py-2 text-sm text-center align-middle">';


                    if (empty($row['CustomerCode']) || strtoupper($row['CustomerCode']) === 'TOSHIBA') {
                        // เฉพาะลูกค้าไม่ใช่ TOSHIBA ถึงจะโชว์ปุ่ม
                        echo htmlspecialchars($Inspecdt).' <a href="InspectionPoint.php?id='.$row['BookingID'].'&state=InspectionPoint"'
                            .' title="แก้ไขรับตู้"'
                            .' class="inline-flex items-center justify-center w-7 h-7 rounded hover:bg-blue-100 text-blue-600 ml-1 transition">'
                            .'<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">'
                            .'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-2.828 0L9 13l-6 6V9h6z"/>'
                            .'</svg>'
                            .'</a>';
                    }
                    echo '</td>';

                   echo '<td class="px-3 py-2 text-sm text-center align-middle">'
                    .htmlspecialchars($Loaddt).
                    ' <a href="PortPoint.php?id='.$row['BookingID'].'&state=PortPoint"'
                    .' title="แก้ไขรับตู้"'
                    .' class="inline-flex items-center justify-center w-7 h-7 rounded hover:bg-blue-100 text-blue-600 ml-1 transition">'
                    .'<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">'
                    .'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-2.828 0L9 13l-6 6V9h6z"/>'
                    .'</svg>'
                    .'</a>'
                    .'</td>';
 

                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($row['Status']).'</td>';
                    echo '<td class="px-3 py-2 text-sm  text-center align-middle">'.htmlspecialchars($row['CreatedBy']).'</td>';
                    echo '<td class="px-3 py-2 text-sm text-center align-middle space-x-1">';
                    echo '<button onclick="window.open(\'booking_print.php?id='.$row['BookingID'].'\', \'_blank\')" 
                    title="พิมพ์" 
                    class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-blue-200 hover:bg-blue-100 text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 9V2h12v7M6 18v4h12v-4M6 14v2h12v-2" /></svg>พิมพ์</button>';

                    echo '<a href="booking_edit.php?id='.$row['BookingID'].'" title="แก้ไข" class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-yellow-200 hover:bg-yellow-100 text-yellow-700 transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16.862 3.487l3.651 3.651a2 2 0 010 2.829l-9.071 9.071a4 4 0 01-1.414.944l-4.092 1.36a1 1 0 01-1.264-1.264l1.36-4.092a4 4 0 01.944-1.414l9.071-9.071a2 2 0 012.829 0z" /></svg>แก้ไข</a>';
                    echo '</td>';                    
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="19" class="text-red-400 py-8 text-center text-base">ไม่พบข้อมูล</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    $conn->close();
?>
<script>
    // function window.printRow(id) {
    // // ตัวอย่าง: popup พิมพ์หรือ redirect ไปหน้า print
    // window.open('booking_print.php?id='+id, '_blank');
    // // หรือ window.print() ทั้งหน้า
//}   
</script>