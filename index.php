<?php 
session_start();
   if(!isset($_SESSION)) 
    { 
     session_start(); 
    }      
 if (!isset($_SESSION["username"])) 
     {
    
          $avatarLetter = strtoupper(mb_substr('', 0, 1, 'UTF-8'));    
     }else
        {
            $username = $_SESSION["username"];
            $avatarLetter = strtoupper(mb_substr($username, 0, 1, 'UTF-8'));
        }
    
if (isset($_GET["page"])) 
    {
      $page = $_GET["page"]; 
    }else{
      $page = '';         
    }
    
?>
<!DOCTYPE html>
<html lang="th" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistic Landing - Tailwind CSS</title>
    <meta name="description" content="Template HTML5 + Tailwind CSS Responsive">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br  flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white/90 shadow-lg backdrop-blur-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="7" width="20" height="10" rx="3" fill="currentColor" class="text-blue-300"/>
                    <rect x="6" y="15" width="12" height="2" rx="1" fill="currentColor" class="text-blue-500"/>
                </svg>
                <span class="text-2xl font-extrabold text-blue-700 tracking-widest">LOGISTIC</span>
            </div>
            <ul class="hidden md:flex space-x-8 font-medium">
                <?php
                    if (isset($_SESSION["username"])) 
                        {
                          echo '
                                <li>
                              
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-200 text-blue-800 font-bold text-lg shadow-sm">' . $avatarLetter . '</span>
                                    <span>' . htmlspecialchars($username) . '</span>
                             
                                </li>
                                ';
                        }

                ?>                
                <li><a href="index.php" class="text-blue-700 hover:text-blue-500 transition">หน้าแรก</a></li>
                <li><a href="index.php?page=tracking" class="text-blue-700 hover:text-blue-500 transition">บริการ</a></li>
                <li><a href="index.php?page=booking" class="text-blue-700 hover:text-blue-500 transition">จัดการ Booking</a></li>
                
                <?php
                    if (isset($_SESSION["username"])) 
                        {
                            echo  "<li><a href=\"#\" id=\"logoutBtn\" class=\"text-blue-700 hover:text-blue-500 transition\">ออกจากระบบ</a></li>";
                        }

                ?>
               
            </ul>
            <button class="md:hidden text-blue-700 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>
    <?php
   
          switch ($page) {
            case 'tracking':                
                include('tracking.php');
                break;                                        
            case 'login':
                include('login.php');
                break;
            case 'booking':
                  if (!isset($_SESSION["username"])) 
                {
                    include 'login.php';                
                    break;            
                } else {               
                include('booking.php');
                break;
                }
            default:
                include('tracking.php');
                break;
                
          }

    ?>
    
    <!-- Footer -->
    <footer class="bg-white shadow-inner py-5 mt-auto">
        <div class="container mx-auto px-4 text-center text-gray-500 text-base">
            © 2025 Logistic Team. All rights reserved.
        </div>
    </footer>
</body>
</html>
<script>
document.getElementById('logoutBtn').addEventListener('click', async function(e) {
    e.preventDefault();
    // ยืนยันก่อนออกจากระบบ
    Swal.fire({
        title: 'ออกจากระบบ?',
        text: "คุณต้องการออกจากระบบใช่หรือไม่",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'ออกจากระบบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then(async (result) => {
        if (result.isConfirmed) {
            // ส่ง ajax ไป logout.php
            try {
                const res = await fetch('logout.php', { method: 'POST' });
                const text = await res.text();
                if (text.trim() === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'ออกจากระบบสำเร็จ',
                        showConfirmButton: false,
                        timer: 1200
                    }).then(() => {
                        window.location.href = 'index.php'; // หรือหน้า login
                    });
                } else {
                    Swal.fire('ผิดพลาด', 'ออกจากระบบไม่สำเร็จ!', 'error');
                }
            } catch (err) {
                Swal.fire('ผิดพลาด', 'เกิดข้อผิดพลาดในการเชื่อมต่อ!', 'error');
            }
        }
    });
});
</script>

