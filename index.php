<!DOCTYPE html>
<html lang="th" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistic Landing - Tailwind CSS</title>
    <meta name="description" content="Template HTML5 + Tailwind CSS Responsive">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-200 flex flex-col">
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
                <li><a href="#" class="text-blue-700 hover:text-blue-500 transition">หน้าแรก</a></li>
                <li><a href="#" class="text-blue-700 hover:text-blue-500 transition">บริการ</a></li>
                <li><a href="#" class="text-blue-700 hover:text-blue-500 transition">เกี่ยวกับเรา</a></li>
                <li><a href="#" class="text-blue-700 hover:text-blue-500 transition">ติดต่อ</a></li>
            </ul>
            <button class="md:hidden text-blue-700 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="flex-1 flex items-center justify-center py-10 px-4">
        <div class="max-w-3xl w-full bg-white/95 rounded-3xl shadow-2xl p-10 text-center relative overflow-hidden">
            <!-- Decoration background shape -->
            <div class="absolute -top-14 -right-14 w-48 h-48 bg-blue-200 rounded-full opacity-30 z-0"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-100 rounded-full opacity-20 z-0"></div>
            <div class="relative z-10">
                <div class="mx-auto w-28 h-28 mb-6 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-400 via-sky-300 to-blue-200 shadow-lg">
                    <!-- SVG Truck Icon -->
                    <svg class="w-16 h-16 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                        <rect x="8" y="22" width="22" height="12" rx="2" fill="currentColor" class="text-blue-500"/>
                        <rect x="30" y="27" width="10" height="7" rx="2" fill="currentColor" class="text-blue-400"/>
                        <circle cx="15" cy="36" r="3" fill="currentColor" class="text-blue-600"/>
                        <circle cx="37" cy="36" r="3" fill="currentColor" class="text-blue-600"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-3 tracking-tight">
                    ระบบโลจิสติกส์<br>ทันสมัย
                </h1>
                <p class="text-gray-600 mb-8 text-lg">
                    ยกระดับธุรกิจขนส่งของคุณด้วยเทคโนโลยีที่ใช้งานง่ายและทันสมัย<br>เทมเพลตนี้ Responsive จริงจัง รองรับทุกหน้าจอ
                </p>
                <a href="#" class="inline-block px-8 py-3 bg-gradient-to-r from-blue-500 to-sky-400 text-white text-lg rounded-full font-semibold shadow hover:scale-105 transition">
                    ทดลองใช้ระบบ
                </a>
            </div>
        </div>
    </section>
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
    <!-- Footer -->
    <footer class="bg-white shadow-inner py-5 mt-auto">
        <div class="container mx-auto px-4 text-center text-gray-500 text-base">
            © 2025 Logistic Team. All rights reserved.
        </div>
    </footer>
</body>
</html>
