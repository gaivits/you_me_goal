<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Premium Gifts — UI Demo</title>
  <meta name="description" content="Landing UI inspired by sumuppremium.net built with TailwindCSS and vanilla JS" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#eef7ff', 100:'#d9ecff', 200:'#bfe0ff', 300:'#94caff', 400:'#64acff', 500:'#3c8dff', 600:'#1e6ff2', 700:'#1456c5', 800:'#0f4399', 900:'#0c397d'
            },
          },
          boxShadow: {
            soft: '0 6px 24px rgba(0,0,0,.08)'
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    html,body{font-family:"Noto Sans Thai",ui-sans-serif,system-ui,sans-serif}
    .container-pad{padding-left:clamp(1rem,5vw,2rem);padding-right:clamp(1rem,5vw,2rem)}
    .menu-open body{overflow:hidden}
    .floating-contact{backdrop-filter:saturate(140%) blur(6px)}
  </style>
</head>
<body class="bg-white text-gray-800 selection:bg-primary-100 selection:text-primary-900">
  <!-- Topbar -->
  <div class="bg-primary-900 text-white text-sm">
    <div class="max-w-7xl mx-auto container-pad flex items-center justify-between py-2">
      <p class="hidden md:block">ผลิตสินค้าพรีเมี่ยม กระบอกน้ำเก็บอุณหภูมิ แฟลชไดร์ฟ • ออกแบบโลโก้ฟรี</p>
      <div class="flex items-center gap-4">
        <a href="mailto:sumup.info@gmail.com" class="hover:underline">sumup.info@gmail.com</a>
        <a href="tel:024158994" class="font-semibold">02-415-8994-7</a>
        <div class="hidden sm:flex items-center gap-3 opacity-90">
          <a aria-label="Facebook" href="#" class="hover:opacity-100"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M13 22v-9h3l1-4h-4V7c0-1.03.21-1.5 1.5-1.5H17V2.1C16.54 2.04 15.36 2 14.04 2 11.33 2 9.5 3.66 9.5 6.7V9H6v4h3.5v9h3.5z"/></svg></a>
          <a aria-label="Instagram" href="#" class="hover:opacity-100"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A5.5 5.5 0 1 1 6.5 13 5.5 5.5 0 0 1 12 7.5zm0 2A3.5 3.5 0 1 0 15.5 13 3.5 3.5 0 0 0 12 9.5zM18 6.8a1.2 1.2 0 1 1-1.2 1.2A1.2 1.2 0 0 1 18 6.8z"/></svg></a>
          <a aria-label="YouTube" href="#" class="hover:opacity-100"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .6 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .6 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.3.6 9.3.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8zM9.6 15.5V8.5L15.8 12z"/></svg></a>
          <a aria-label="LINE" href="#" class="hover:opacity-100"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M19.5 3A5.5 5.5 0 0 1 25 8.5C25 15.4 14.5 20 12 20c-.8 0-1.6-.1-2.3-.2l-3.6 2.2c-.4.3-.9-.1-.8-.5l.7-3.2C3.1 17.4 1 13.5 1 10 1 5.6 4.6 3 9 3h10.5z" transform="translate(-1 -1)"/></svg></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Header / Navbar -->
  <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-gray-100">
    <div class="max-w-7xl mx-auto container-pad">
      <div class="flex items-center justify-between py-3">
        <a href="#" class="flex items-center gap-2">
          <img src="https://dummyimage.com/120x40/0f4399/ffffff&text=SUMUP" alt="Logo" class="h-8 w-auto" />
          <span class="sr-only">Home</span>
        </a>
        <nav class="hidden lg:flex">
          <ul class="flex items-center gap-6">
            <li><a class="hover:text-primary-700 font-medium" href="#">HOME</a></li>
            <li class="group relative">
              <button class="inline-flex items-center gap-1 hover:text-primary-700 font-medium">PRODUCT
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
              </button>
              <!-- Mega menu -->
              <div class="invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 absolute left-1/2 -translate-x-1/2 mt-3 w-[900px]">
                <div class="bg-white shadow-soft rounded-2xl p-6 grid grid-cols-4 gap-6 border border-gray-100">
                  <div>
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">แก้วน้ำ-บรรจุภัณฑ์</h4>
                    <ul class="space-y-2 text-sm">
                      <li><a class="hover:text-primary-700" href="./glass/glass_products.php">แก้วน้ำเก็บอุณหภูมิ</a></li>
                      <li><a class="hover:text-primary-700" href="#">กระติกน้ำเก็บอุณหภูมิ</a></li>
                      <li><a class="hover:text-primary-700" href="#">กระบอกน้ำพลาสติก</a></li>
                      <li><a class="hover:text-primary-700" href="#">แก้วน้ำใส</a></li>
                      <li><a class="hover:text-primary-700" href="#">แก้วน้ำ ECO</a></li>
                    </ul>
                  </div>
                  <div>
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">ร่ม พรีเมี่ยม</h4>
                    <ul class="space-y-2 text-sm">
                      <li><a class="hover:text-primary-700" href="#">ร่มกอล์ฟ</a></li>
                      <li><a class="hover:text-primary-700" href="#">ร่มกลับด้าน</a></li>
                      <li><a class="hover:text-primary-700" href="#">ร่ม 1-5 ตอน</a></li>
                      <li><a class="hover:text-primary-700" href="#">ร่มสนาม</a></li>
                    </ul>
                  </div>
                  <div>
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">สินค้าไอที</h4>
                    <ul class="space-y-2 text-sm">
                      <li><a class="hover:text-primary-700" href="#">แฟลชไดร์ฟ</a></li>
                      <li><a class="hover:text-primary-700" href="#">หูฟังไร้สาย</a></li>
                      <li><a class="hover:text-primary-700" href="#">แบตสำรอง</a></li>
                      <li><a class="hover:text-primary-700" href="#">ลำโพงบลูทูธ</a></li>
                    </ul>
                  </div>
                  <div class="col-span-1 bg-gradient-to-br from-primary-50 to-white rounded-xl p-4 border border-primary-100">
                    <p class="text-xs text-primary-800 font-semibold">Catalog</p>
                    <p class="text-sm text-gray-600">ดาวน์โหลดแคตตาล็อกสินค้ารวมล่าสุด</p>
                    <a href="#" class="inline-flex items-center gap-2 mt-3 text-primary-700 font-semibold">ดาวน์โหลด
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16M7 10l5 5 5-5"/></svg>
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <li><a class="hover:text-primary-700 font-medium" href="#brand">BRAND</a></li>
            <li><a class="hover:text-primary-700 font-medium" href="#portfolio">PORTFOLIO</a></li>
            <li><a class="hover:text-primary-700 font-medium" href="#contact">CONTACT</a></li>
            <li><a class="hover:text-primary-700 font-medium" href="#payment">PAYMENT</a></li>
          </ul>
        </nav>
        <div class="flex items-center gap-2">
          <button id="searchBtn" class="hidden md:inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-gray-200 hover:border-primary-300 hover:bg-primary-50">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"/></svg>
            <span class="text-sm">ค้นหา</span>
          </button>
          &nbsp;
          <a href="./admin/admin_login.php">Admin</a>
          <button id="menuBtn" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200">
            <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
          </button>
          &nbsp;
          <a href="./users/user_login.php">เข้าสู่ระบบ</a>
          <button id="menuBtn" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200">
            <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="lg:hidden hidden border-t border-gray-100 bg-white">
      <div class="max-w-7xl mx-auto container-pad py-4">
        <details class="group">
          <summary class="flex items-center justify-between py-3 font-semibold cursor-pointer">PRODUCT <span class="group-open:rotate-180 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></span></summary>
          <div class="grid grid-cols-2 gap-3 pl-2 pb-4 text-sm">
            <a class="hover:text-primary-700" href="#">แก้วน้ำเก็บอุณหภูมิ</a>
            <a class="hover:text-primary-700" href="#">ร่มกอล์ฟ</a>
            <a class="hover:text-primary-700" href="#">แฟลชไดร์ฟ</a>
            <a class="hover:text-primary-700" href="#">กระเป๋า</a>
            <a class="hover:text-primary-700" href="#">สมุดโน้ต</a>
            <a class="hover:text-primary-700" href="#">สินค้า ECO</a>
          </div>
        </details>
        <a class="block py-2" href="#brand">BRAND</a>
        <a class="block py-2" href="#portfolio">PORTFOLIO</a>
        <a class="block py-2" href="#contact">CONTACT</a>
        <a class="block py-2" href="#payment">PAYMENT</a>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <section class="relative overflow-hidden">
    <div class="max-w-7xl mx-auto container-pad grid md:grid-cols-2 gap-8 items-center py-12 md:py-16">
      <div class="order-2 md:order-1">
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">ของพรีเมี่ยมสกรีนโลโก้ <span class="text-primary-700">สำหรับทุกองค์กร</span></h1>
        <p class="mt-4 text-gray-600">บริการออกแบบฟรี • ขั้นต่ำยืดหยุ่น • จัดส่งทั่วประเทศ • งานด่วนมีบริการ</p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a href="#catalog" class="px-5 py-3 rounded-xl bg-primary-700 text-white font-semibold shadow-soft hover:bg-primary-800">ดูแคตตาล็อก</a>
          <a href="#contact" class="px-5 py-3 rounded-xl border border-gray-300 font-semibold hover:border-primary-400 hover:bg-primary-50">ขอใบเสนอราคา</a>
        </div>
        <dl class="mt-8 grid grid-cols-3 gap-4 text-center">
          <div class="rounded-xl border p-4"><dt class="text-2xl font-extrabold">3K+</dt><dd class="text-xs text-gray-500">บริษัทลูกค้า</dd></div>
          <div class="rounded-xl border p-4"><dt class="text-2xl font-extrabold">10Y</dt><dd class="text-xs text-gray-500">ประสบการณ์</dd></div>
          <div class="rounded-xl border p-4"><dt class="text-2xl font-extrabold">48H</dt><dd class="text-xs text-gray-500">งานด่วน</dd></div>
        </dl>
      </div>
      <div class="order-1 md:order-2 relative">
        <div class="aspect-[4/3] rounded-3xl bg-gradient-to-br from-primary-50 to-white border border-primary-100 shadow-soft overflow-hidden">
          <img src="https://images.unsplash.com/photo-1516387938699-a93567ec168e?q=80&w=1600&auto=format&fit=crop" alt="Premium gifts collage" class="w-full h-full object-cover"/>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories -->
  <section class="py-8 md:py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto container-pad">
      <div class="flex items-end justify-between">
        <h2 class="text-xl md:text-2xl font-extrabold">หมวดหมู่ยอดนิยม</h2>
        <a href="#" class="text-sm font-semibold text-primary-700">ดูทั้งหมด</a>
      </div>
      <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Card -->
        <a href="#" class="group block rounded-2xl overflow-hidden border bg-white hover:shadow-soft transition">
          <div class="aspect-square overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1602143407151-7111542de6e8?q=80&w=1600&auto=format&fit=crop" alt="Tumbler"/></div>
          <div class="p-3"><p class="font-semibold">แก้วน้ำเก็บอุณหภูมิ</p><p class="text-xs text-gray-500">เริ่มต้น 100 ใบ</p></div>
        </a>
        <a href="#" class="group block rounded-2xl overflow-hidden border bg-white hover:shadow-soft transition">
          <div class="aspect-square overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=1600&auto=format&fit=crop" alt="USB"/></div>
          <div class="p-3"><p class="font-semibold">แฟลชไดร์ฟ</p><p class="text-xs text-gray-500">ขั้นต่ำ 50 ชิ้น</p></div>
        </a>
        <a href="#" class="group block rounded-2xl overflow-hidden border bg-white hover:shadow-soft transition">
          <div class="aspect-square overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1520975890090-6c130c47f2d3?q=80&w=1600&auto=format&fit=crop" alt="Umbrella"/></div>
          <div class="p-3"><p class="font-semibold">ร่ม พรีเมี่ยม</p><p class="text-xs text-gray-500">กันยูวี สกรีนโลโก้</p></div>
        </a>
        <a href="#" class="group block rounded-2xl overflow-hidden border bg-white hover:shadow-soft transition">
          <div class="aspect-square overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1520975680376-b6c3cf84de8c?q=80&w=1600&auto=format&fit=crop" alt="Bag"/></div>
          <div class="p-3"><p class="font-semibold">ถุงผ้า & กระเป๋า</p><p class="text-xs text-gray-500">ผ้าแคนวาส/PU</p></div>
        </a>
        <a href="#" class="group block rounded-2xl overflow-hidden border bg-white hover:shadow-soft transition">
          <div class="aspect-square overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1535016120720-40c646be5580?q=80&w=1600&auto=format&fit=crop" alt="Notebook"/></div>
          <div class="p-3"><p class="font-semibold">สมุดโน้ตไดอารี่</p><p class="text-xs text-gray-500">A5/A6</p></div>
        </a>
        <a href="#" class="group block rounded-2xl overflow-hidden border bg-white hover:shadow-soft transition">
          <div class="aspect-square overflow-hidden"><img class="w-full h-full object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1509914398892-963f53e6f2f1?q=80&w=1600&auto=format&fit=crop" alt="Eco"/></div>
          <div class="p-3"><p class="font-semibold">สินค้า ECO</p><p class="text-xs text-gray-500">รักษ์โลก</p></div>
        </a>
      </div>
    </div>
  </section>

  <!-- Product grid -->
  <section class="py-10">
    <div class="max-w-7xl mx-auto container-pad">
      <div class="flex items-end justify-between">
        <h2 class="text-xl md:text-2xl font-extrabold">สินค้าแนะนำ</h2>
        <div class="flex items-center gap-2">
          <button class="px-3 py-1.5 rounded-lg border text-sm" data-filter="all">ทั้งหมด</button>
          <button class="px-3 py-1.5 rounded-lg border text-sm" data-filter="drinkware">แก้วน้ำ</button>
          <button class="px-3 py-1.5 rounded-lg border text-sm" data-filter="it">ไอที</button>
          <button class="px-3 py-1.5 rounded-lg border text-sm" data-filter="eco">ECO</button>
        </div>
      </div>

      <div id="products" class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <!-- Product Card Template -->
      </div>
      <div class="text-center mt-8"><a href="#" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border font-semibold hover:border-primary-400 hover:bg-primary-50">ดูสินค้าเพิ่ม</a></div>
    </div>
  </section>

  <!-- Brand strip -->
  <section id="brand" class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto container-pad">
      <h2 class="text-xl md:text-2xl font-extrabold">แบรนด์ที่ไว้วางใจเรา</h2>
      <div class="mt-6 grid grid-cols-3 sm:grid-cols-6 gap-4 items-center">
        <img class="h-10 mx-auto opacity-70" src="https://dummyimage.com/120x40/ddd/333.png&text=SCG" alt="SCG"/>
        <img class="h-10 mx-auto opacity-70" src="https://dummyimage.com/120x40/ddd/333.png&text=PTT" alt="PTT"/>
        <img class="h-10 mx-auto opacity-70" src="https://dummyimage.com/120x40/ddd/333.png&text=TRUE" alt="True"/>
        <img class="h-10 mx-auto opacity-70" src="https://dummyimage.com/120x40/ddd/333.png&text=AIS" alt="AIS"/>
        <img class="h-10 mx-auto opacity-70" src="https://dummyimage.com/120x40/ddd/333.png&text=LINE" alt="LINE"/>
        <img class="h-10 mx-auto opacity-70" src="https://dummyimage.com/120x40/ddd/333.png&text=CP" alt="CP"/>
      </div>
    </div>
  </section>

  <!-- Portfolio -->
  <section id="portfolio" class="py-12">
    <div class="max-w-7xl mx-auto container-pad">
      <div class="flex items-end justify-between">
        <h2 class="text-xl md:text-2xl font-extrabold">ผลงานบางส่วน</h2>
        <a href="#" class="text-sm font-semibold text-primary-700">ดูเพิ่มเติม</a>
      </div>
      <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="relative group rounded-2xl overflow-hidden border">
          <img class="w-full h-64 object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1532635223-29e448f4e05a?q=80&w=1600&auto=format&fit=crop" alt="Portfolio 1"/>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3 text-white font-semibold">Gift Set — ECO</div>
        </div>
        <div class="relative group rounded-2xl overflow-hidden border">
          <img class="w-full h-64 object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1540574163026-643ea20ade25?q=80&w=1600&auto=format&fit=crop" alt="Portfolio 2"/>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3 text-white font-semibold">Tumbler — สกรีนโลโก้</div>
        </div>
        <div class="relative group rounded-2xl overflow-hidden border">
          <img class="w-full h-64 object-cover group-hover:scale-105 transition" src="https://images.unsplash.com/photo-1503602642458-232111445657?q=80&w=1600&auto=format&fit=crop" alt="Portfolio 3"/>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3 text-white font-semibold">Umbrella — งานกิจกรรม</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto container-pad">
      <div class="rounded-3xl overflow-hidden border bg-gradient-to-br from-primary-700 to-primary-900 text-white p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
          <h3 class="text-2xl md:text-3xl font-extrabold">พร้อมผลิตและส่งมอบอย่างมืออาชีพ</h3>
          <p class="opacity-90 mt-2">ให้เราช่วยแนะนำสินค้าให้เหมาะกับงบประมาณและสไตล์ของแบรนด์คุณ</p>
        </div>
        <a href="#contact" class="px-6 py-3 rounded-xl bg-white text-primary-800 font-bold shadow-soft hover:opacity-90">ติดต่อเรา</a>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto container-pad grid md:grid-cols-2 gap-8 items-start">
      <div>
        <h2 class="text-xl md:text-2xl font-extrabold">ติดต่อฝ่ายขาย</h2>
        <p class="text-gray-600 mt-2">ตอบกลับภายใน 1 วันทำการ</p>
        <form id="quoteForm" class="mt-6 space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <input required name="name" class="w-full rounded-xl border px-4 py-3" placeholder="ชื่อบริษัท/ผู้ติดต่อ"/>
            <input required name="phone" class="w-full rounded-xl border px-4 py-3" placeholder="เบอร์โทร"/>
          </div>
          <input required type="email" name="email" class="w-full rounded-xl border px-4 py-3" placeholder="อีเมล"/>
          <select name="category" class="w-full rounded-xl border px-4 py-3">
            <option>หมวดหมู่ที่สนใจ</option>
            <option>แก้วน้ำ</option>
            <option>แฟลชไดร์ฟ</option>
            <option>ร่ม</option>
            <option>กระเป๋า</option>
            <option>ECO</option>
          </select>
          <textarea name="message" rows="4" class="w-full rounded-xl border px-4 py-3" placeholder="รายละเอียดเพิ่มเติม"></textarea>
          <button class="px-6 py-3 rounded-xl bg-primary-700 text-white font-semibold hover:bg-primary-800">ขอใบเสนอราคา</button>
          <p id="formMsg" class="text-sm text-green-700 hidden">เรารับคำขอแล้ว ขอบคุณค่ะ 🧡</p>
        </form>
      </div>
      <div class="rounded-2xl overflow-hidden border bg-white shadow-soft">
        <iframe title="Map" class="w-full h-80" src="https://maps.google.com/maps?q=Bangkok&t=&z=11&ie=UTF8&iwloc=&output=embed"></iframe>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="border-t">
    <div class="max-w-7xl mx-auto container-pad py-10 grid md:grid-cols-4 gap-8">
      <div>
        <img src="https://dummyimage.com/120x40/0f4399/ffffff&text=SUMUP" alt="Logo" class="h-8 w-auto" />
        <p class="text-sm text-gray-600 mt-3">ผู้เชี่ยวชาญด้านของพรีเมี่ยมสกรีนโลโก้ — สินค้าคุณภาพ บริการรวดเร็ว ราคายุติธรรม</p>
      </div>
      <div>
        <h4 class="font-bold mb-3">หมวดหมู่</h4>
        <ul class="space-y-2 text-sm text-gray-600">
          <li><a href="#">แก้วน้ำ</a></li>
          <li><a href="#">แฟลชไดร์ฟ</a></li>
          <li><a href="#">ร่ม</a></li>
          <li><a href="#">กระเป๋า</a></li>
          <li><a href="#">ECO</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-3">บริการ</h4>
        <ul class="space-y-2 text-sm text-gray-600">
          <li>ออกแบบโลโก้ฟรี</li>
          <li>ตัวอย่างงานก่อนผลิต</li>
          <li>บริการงานด่วน</li>
          <li>ส่งทั่วประเทศ</li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-3">ติดต่อ</h4>
        <ul class="space-y-2 text-sm text-gray-600">
          <li>โทร: 02-415-8994-7</li>
          <li>อีเมล: sumup.info@gmail.com</li>
          <li>LINE: @sumup</li>
        </ul>
      </div>
    </div>
    <div class="border-t py-4 text-center text-xs text-gray-500">© 2025 Premium Gifts Co., Ltd. All rights reserved.</div>
  </footer>

  <!-- Floating contact -->
  <div class="fixed bottom-6 right-6 flex flex-col gap-2 z-40">
    <button class="floating-contact shadow-soft inline-flex items-center gap-2 rounded-full px-4 py-2 bg-white/90 border"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 8V7l-3 2-2-1-3 2-4-2-4 2v7h18V8z"/></svg><span class="text-sm font-semibold">ขอใบเสนอราคา</span></button>
    <a href="#" class="shadow-soft w-12 h-12 rounded-full grid place-items-center bg-green-500 text-white" title="LINE">L</a>
    <a href="#" class="shadow-soft w-12 h-12 rounded-full grid place-items-center bg-blue-600 text-white" title="Facebook">f</a>
  </div>

  <script>
    // Mobile Menu toggle
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    menuBtn?.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      const isOpen = !mobileMenu.classList.contains('hidden');
      menuIcon.innerHTML = isOpen
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>'
    });

    // Simple product data
    const data = [
      {id:1, name:'Tumbler 500ml', price:199, tag:'drinkware', img:'https://images.unsplash.com/photo-1567059756274-2c3d9a7b8a6b?q=80&w=1200&auto=format&fit=crop'},
      {id:2, name:'USB 32GB', price:119, tag:'it', img:'https://images.unsplash.com/photo-1588864004081-8b998a97029d?q=80&w=1200&auto=format&fit=crop'},
      {id:3, name:'Umbrella UV', price:159, tag:'drinkware', img:'https://images.unsplash.com/photo-1445810694374-0a94739e4a03?q=80&w=1200&auto=format&fit=crop'},
      {id:4, name:'Notebook A5', price:99, tag:'eco', img:'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1200&auto=format&fit=crop'},
      {id:5, name:'Bluetooth Speaker', price:349, tag:'it', img:'https://images.unsplash.com/photo-1507878866276-a947ef722fee?q=80&w=1200&auto=format&fit=crop'},
      {id:6, name:'Canvas Bag', price:129, tag:'eco', img:'https://images.unsplash.com/photo-1618354691510-58fd3d7953be?q=80&w=1200&auto=format&fit=crop'},
      {id:7, name:'Thermal Flask', price:249, tag:'drinkware', img:'https://images.unsplash.com/photo-1636718283795-063dda8332d0?q=80&w=1200&auto=format&fit=crop'},
      {id:8, name:'Powerbank 10,000mAh', price:399, tag:'it', img:'https://images.unsplash.com/photo-1588702547923-7093a6c3ba33?q=80&w=1200&auto=format&fit=crop'}
    ];

    const grid = document.getElementById('products');
    const render = (list) => {
      grid.innerHTML = '';
      list.forEach(p => {
        const el = document.createElement('a');
        el.href = '#';
        el.className = 'group block rounded-2xl overflow-hidden border hover:shadow-soft transition bg-white';
        el.innerHTML = `
          <div class="aspect-[4/3] overflow-hidden">
            <img class="w-full h-full object-cover group-hover:scale-105 transition" src="${p.img}" alt="${p.name}"/>
          </div>
          <div class="p-4 flex items-start justify-between gap-2">
            <div>
              <p class="font-semibold">${p.name}</p>
              <p class="text-xs text-gray-500">สกรีนโลโก้ได้</p>
            </div>
            <div class="text-right">
              <p class="text-sm font-bold">฿${p.price}</p>
              <span class="inline-block mt-1 text-[10px] px-2 py-1 rounded-full bg-gray-100">${p.tag}</span>
            </div>
          </div>`;
        grid.appendChild(el);
      })
    };
    render(data);

    // Filtering
    document.querySelectorAll('[data-filter]').forEach(btn => {
      btn.addEventListener('click', () => {
        const tag = btn.getAttribute('data-filter');
        if(tag === 'all') return render(data);
        render(data.filter(i => i.tag === tag));
      })
    });

    // Fake submit
    const form = document.getElementById('quoteForm');
    const msg = document.getElementById('formMsg');
    form?.addEventListener('submit', (e) => {
      e.preventDefault();
      msg.classList.remove('hidden');
      form.reset();
      setTimeout(()=> msg.classList.add('hidden'), 3500)
    });
  </script>
</body>
</html>
