<?php
require_once "koneksi.php";

if (isset($_SESSION["admin_key"])) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputKunci = trim($_POST["private_key"]);
    if ($inputKunci !== "") {
        $_SESSION["admin_key"] = $inputKunci;
        header("Location: admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Autentikasi Kunci - GadgetCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#0b0f19] text-slate-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <div class="relative bg-slate-900/90 border border-slate-800 rounded-3xl p-8 shadow-2xl backdrop-blur-xl">
            <!-- Icon Lock -->
            <div class="mx-auto w-14 h-14 rounded-2xl bg-gradient-to-tr from-cyan-600 to-emerald-400 flex items-center justify-center shadow-lg shadow-cyan-500/20 mb-6">
                <svg class="w-7 h-7 text-slate-950 font-bold" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                </svg>
            </div>

            <div class="text-center mb-6">
                <h1 class="text-xl font-bold text-white tracking-tight">Autentikasi Private Key</h1>
                <p class="text-xs text-slate-400 mt-1.5">Masukkan kunci rahasia untuk mendekripsi seluruh isi database antrean servis.</p>
            </div>

            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Input Kunci / Private Key</label>
                    <input type="text" id="private_key" name="private_key" required placeholder="Masukkan kunci dekripsi..." class="w-full bg-[#0b0f19] border border-slate-800 rounded-xl px-3.5 py-3 text-sm text-center font-mono text-cyan-300 tracking-wider focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 outline-none transition">
                </div>

                <!-- Tombol Pintas Preset Kunci -->
                <div class="flex items-center justify-center gap-2 pt-1">
                    <span class="text-[10px] text-slate-500">Preset Demo:</span>
                    <button type="button" onclick="isiKunci('TEKNISI2026')" class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 text-emerald-400 border border-slate-700 transition">Kunci Benar (TEKNISI2026)</button>
                    <button type="button" onclick="isiKunci('KUNCISALAH')" class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 text-rose-400 border border-slate-700 transition">Kunci Salah</button>
                </div>

                <button type="submit" class="w-full mt-2 bg-gradient-to-r from-cyan-500 to-emerald-400 hover:from-cyan-400 hover:to-emerald-300 text-slate-950 font-bold py-3 rounded-xl text-sm transition shadow-lg shadow-cyan-500/20 active:scale-[0.99]">
                    Buka & Dekripsi Halaman Admin
                </button>
            </form>

            <div class="mt-6 text-center border-t border-slate-800/80 pt-4">
                <a href="index.php" class="text-xs text-slate-400 hover:text-slate-200 transition inline-flex items-center gap-1.5">
                    &larr; Kembali ke Halaman Pendaftaran
                </a>
            </div>
        </div>
    </div>

    <script>
    function isiKunci(kunci) {
        document.getElementById('private_key').value = kunci;
    }
    </script>
</body>
</html>