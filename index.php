<?php
require_once "koneksi.php";

$pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST["nama"]);
    $tipe = htmlspecialchars($_POST["tipe"]);
    
    $no_wa_enkrip = enkripsi($_POST["no_wa"], $KUNCI_SISTEM);
    $kunci_enkrip = enkripsi($_POST["kunci_layar"], $KUNCI_SISTEM);
    $keluhan_enkrip = enkripsi($_POST["keluhan"], $KUNCI_SISTEM);

    $sql = "INSERT INTO servis (nama_pelanggan, tipe_gadget, no_wa, kunci_layar, keluhan) VALUES ('$nama', '$tipe', '$no_wa_enkrip', '$kunci_enkrip', '$keluhan_enkrip')";
    
    if (mysqli_query($koneksi, $sql)) {
        $pesan = "Tiket servis berhasil dibuat! Data sensitif Anda telah diamankan dengan enkripsi AES-128.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetCare - Bengkel Servis HP & Laptop Bergaransi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0f19] text-slate-100 min-h-screen selection:bg-cyan-500 selection:text-slate-900">
    <!-- Navbar -->
    <header class="border-b border-slate-800/80 bg-[#0b0f19]/75 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-18 flex items-center justify-between py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-emerald-400 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                    <svg class="w-5 h-5 text-slate-950 font-bold" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>
                <div>
                    <span class="font-extrabold text-lg text-white tracking-tight">GadgetCare<span class="text-cyan-400">.</span></span>
                    <span class="hidden sm:inline-block text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 ml-2 bg-slate-800 text-cyan-300 rounded-full border border-slate-700">Lab Reparasi</span>
                </div>
            </div>
            
            <a href="login.php" class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white border border-slate-800 hover:border-slate-700 transition">
                <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                Portal Teknisi
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-12 lg:py-16">
        <?php if ($pesan): ?>
            <div class="mb-8 p-4 rounded-2xl bg-emerald-950/40 border border-emerald-500/30 flex items-center gap-3 text-emerald-300 text-sm">
                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?= $pesan ?></span>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Kolom Kiri: Value & Branding -->
            <div class="lg:col-span-5 space-y-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-950/60 border border-cyan-800/60 text-cyan-300 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                        Standar Keamanan Kriptografi AES-128
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                        Servis HP & Laptop <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-emerald-400">Tanpa Cemas</span> Data Diintip.
                    </h1>
                    <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                        Kami menjamin kerahasiaan penuh. PIN, nomor kontak, dan keluhan perangkat Anda langsung dienkripsi sebelum tersimpan di server.
                    </p>
                </div>

                <!-- Keunggulan Workshop -->
                <div class="space-y-4 border-t border-slate-800/80 pt-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center shrink-0 text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-2.471-5.717a6.002 6.002 0 017.07 7.07l-3.328 3.328a2 2 0 01-1.414.586H12a2 2 0 01-1.414-.586L7.258 13.1a6 6 0 017.07-7.07z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-200">Hardware & Software Repair</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Penanganan ganti LCD, IC charging, thermal paste CPU, instalasi OS, hingga bypass kunci resmi.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center shrink-0 text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-200">End-to-End Cryptography</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Bahkan jika database bocor, teks PIN perangkat tetap berupa sandi acak tak terbaca.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form Pendaftaran -->
            <div class="lg:col-span-7">
                <div class="relative rounded-3xl bg-slate-900/90 border border-slate-800 p-7 sm:p-9 shadow-2xl backdrop-blur-xl">
                    <div class="flex items-center justify-between border-b border-slate-800/80 pb-5 mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-white">Form Booking Tiket Servis</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Isi data perangkat untuk dimasukkan ke antrean perbaikan teknisi.</p>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-cyan-950 text-cyan-400 border border-cyan-800/50">Tiket Online</span>
                    </div>

                    <form method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nama Pemilik Perangkat</label>
                                <input type="text" name="nama" required placeholder="Contoh: Mustab" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Model & Tipe Perangkat</label>
                                <input type="text" name="tipe" required placeholder="Oppo Reno7 Z 5G / Asus ROG" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="flex items-center justify-between text-xs font-semibold text-slate-300 mb-1.5">
                                    <span>Nomor WhatsApp</span>
                                    <span class="text-[10px] text-cyan-400 font-mono flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                        Terenkripsi
                                    </span>
                                </label>
                                <input type="text" name="no_wa" required placeholder="08xxxxxxxxxx" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition">
                            </div>
                            <div>
                                <label class="flex items-center justify-between text-xs font-semibold text-slate-300 mb-1.5">
                                    <span>PIN / Pola Layar</span>
                                    <span class="text-[10px] text-cyan-400 font-mono flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                        Terenkripsi
                                    </span>
                                </label>
                                <input type="text" name="kunci_layar" required placeholder="PIN: 123456 / Pola Huruf Z" class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition">
                            </div>
                        </div>

                        <div>
                            <label class="flex items-center justify-between text-xs font-semibold text-slate-300 mb-1.5">
                                <span>Detail Kerusakan / Keluhan</span>
                                <span class="text-[10px] text-cyan-400 font-mono flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                    Terenkripsi
                                </span>
                            </label>
                            <textarea name="keluhan" rows="3" required placeholder="Contoh: Layar bergaris setelah jatuh, baterai drop cepat, perlu tes touchscreen..." class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl px-3.5 py-2.5 text-sm text-white placeholder-slate-600 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-emerald-400 hover:from-cyan-400 hover:to-emerald-300 text-slate-950 font-bold py-3.5 rounded-xl text-sm transition shadow-lg shadow-cyan-500/20 active:scale-[0.99] flex items-center justify-center gap-2">
                            <span>Daftarkan & Enkripsi Data ke Database</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>