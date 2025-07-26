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
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-3 tracking-tight">ระบบงานโลจิสติกส์</h1>

                    <!-- Login Form -->
                    <form id="loginForm" class="max-w-sm mx-auto bg-white/90 rounded-xl shadow p-6 flex flex-col space-y-4 text-left">
                        <div>
                            <label for="username" class="block text-gray-700 font-semibold">ชื่อผู้ใช้</label>
                            <input type="text" id="username" name="username" required 
                                class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Username">
                        </div>
                        <div>
                            <label for="password" class="block text-gray-700 font-semibold">รหัสผ่าน</label>
                            <input type="password" id="password" name="password" required 
                                class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Password">
                        </div>
                        <button type="submit"
                            class="w-full py-2 bg-gradient-to-r from-blue-500 to-sky-400 text-white text-lg rounded-full font-semibold shadow hover:scale-105 transition">
                            เข้าสู่ระบบ
                        </button>
                        <div id="loginMsg" class="text-center text-sm pt-1"></div>
                    </form>
                    <script>
                    document.getElementById('loginForm').addEventListener('submit', async function(e) {
                        e.preventDefault();
                        const form = e.target;
                        const formData = new FormData(form);
                        const msgBox = document.getElementById('loginMsg');
                        msgBox.textContent = "กำลังตรวจสอบ...";
                        try {
                            const res = await fetch('authen.php', {
                                method: 'POST',
                                body: formData,
                            });
                            const text = await res.text();
                            // ปรับตาม response ที่ authen.php ส่งกลับ เช่น "success" หรือ "fail"
                            if (text.trim() === "success") {
                                msgBox.textContent = "เข้าสู่ระบบสำเร็จ! กำลังเปลี่ยนหน้า...";
                                msgBox.className = "text-center text-green-600 pt-1";
                                setTimeout(()=>{ window.location.href="index.php?page=booking"; }, 1500);
                            } else {
                                msgBox.textContent = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
                                msgBox.className = "text-center text-red-600 pt-1";
                            }
                        } catch (err) {
                            msgBox.textContent = "เกิดข้อผิดพลาดในการเชื่อมต่อ!";
                            msgBox.className = "text-center text-red-600 pt-1";
                        }
                        
                    });
                    </script>
            </div>
        </div>
    </section>
  