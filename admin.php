<?php
require_once "koneksi.php";

if (!isset($_SESSION["admin_key"])) {
    header("Location: login.php");
    exit;
}

$kunciAktif = $_SESSION["admin_key"];
$kunciCocok = ($kunciAktif === $KUNCI_SISTEM);

if (isset($_GET["update_status"]) && isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $statusBaru = mysqli_real_escape_string($koneksi, $_GET["update_status"]);
    mysqli_query($koneksi, "UPDATE servis SET status = '$statusBaru' WHERE id = $id");
    header("Location: admin.php");
    exit;
}

$dataServis = mysqli_query($koneksi, "SELECT * FROM servis ORDER BY id DESC");
$totalData = mysqli_num_rows($dataServis);

$hitungProses = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM servis WHERE status = 'Sedang Dikerjakan'"))["jml"] ?? 0;
$hitungSelesai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM servis WHERE status = 'Selesai'"))["jml"] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Manajemen Servis Gadget</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#0b0f19] text-slate-100 min-h-screen p-4 sm:p-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-slate-900/90 border border-slate-800 p-6 rounded-3xl shadow-xl backdrop-blur-xl">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">Portal Teknisi Servis</h1>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= $kunciCocok ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-rose-950 text-rose-400 border border-rose-800' ?>">
                        <?= $kunciCocok ? 'Kunci Valid' : 'Kunci Tidak Cocok' ?>
                    </span>
                </div>
                <p class="text-xs text-slate-400">
                    Private Key aktif: <span class="font-mono text-cyan-300 font-bold bg-[#0b0f19] px-2 py-0.5 rounded border border-slate-800"><?= htmlspecialchars($kunciAktif) ?></span>
                </p>
            </div>

            <div class="flex items-center gap-2.5">
                <a href="index.php" target="_blank" class="text-xs font-semibold px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition">
                    + Input Servis Baru
                </a>
                <a href="logout.php" class="text-xs font-semibold px-4 py-2 rounded-xl bg-rose-600/20 hover:bg-rose-600 text-rose-300 hover:text-white border border-rose-700/50 transition">
                    Kunci Ulang
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-slate-900/80 border border-slate-800 p-5 rounded-2xl">
                <p class="text-xs text-slate-400">Total Antrean Masuk</p>
                <p class="text-2xl font-extrabold text-white mt-1"><?= $totalData ?></p>
            </div>
            <div class="bg-slate-900/80 border border-slate-800 p-5 rounded-2xl">
                <p class="text-xs text-slate-400">Sedang Dikerjakan</p>
                <p class="text-2xl font-extrabold text-amber-400 mt-1"><?= $hitungProses ?></p>
            </div>
            <div class="bg-slate-900/80 border border-slate-800 p-5 rounded-2xl">
                <p class="text-xs text-slate-400">Servis Selesai</p>
                <p class="text-2xl font-extrabold text-emerald-400 mt-1"><?= $hitungSelesai ?></p>
            </div>
            <div class="bg-slate-900/80 border border-slate-800 p-5 rounded-2xl">
                <p class="text-xs text-slate-400">Metode Enkripsi DB</p>
                <p class="text-sm font-bold text-cyan-400 font-mono mt-2">AES-128-ECB</p>
            </div>
        </div>

        <div class="bg-slate-900/90 border border-slate-800 rounded-3xl p-6 shadow-2xl backdrop-blur-xl">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-slate-800/80 pb-4 mb-4">
                <div>
                    <h2 class="text-base font-bold text-white">Daftar Rekam Servis Pelanggan</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Semua data sensitif di bawah ini didekripsi langsung menggunakan Private Key Anda.</p>
                </div>

                <button type="button" onclick="gantiTampilan()" id="btn-toggle" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-cyan-950 text-cyan-300 border border-cyan-800/80 hover:bg-cyan-900 transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Lihat Data Mentah Database (Ciphertext)
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-800 bg-[#0b0f19]/60">
                            <th class="p-3.5 rounded-l-xl">No</th>
                            <th class="p-3.5">Pelanggan</th>
                            <th class="p-3.5">Perangkat</th>
                            <th class="p-3.5">Kontak WhatsApp</th>
                            <th class="p-3.5">Kunci / PIN Layar</th>
                            <th class="p-3.5 max-w-xs">Keluhan Kerusakan</th>
                            <th class="p-3.5">Status</th>
                            <th class="p-3.5 text-right rounded-r-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        <?php if ($totalData == 0): ?>
                        <tr>
                            <td colspan="8" class="p-8 text-center text-slate-500">Belum ada data tiket masuk.</td>
                        </tr>
                        <?php endif; ?>

                        <?php 
                        $no = 1;
                        mysqli_data_seek($dataServis, 0);
                        while ($row = mysqli_fetch_assoc($dataServis)): 
                        ?>
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="p-3.5 font-mono text-slate-500"><?= $no++ ?></td>
                            <td class="p-3.5 font-semibold text-white"><?= htmlspecialchars($row["nama_pelanggan"]) ?></td>
                            <td class="p-3.5 text-cyan-300 font-medium"><?= htmlspecialchars($row["tipe_gadget"]) ?></td>
                            
                            <td class="p-3.5 font-mono">
                                <span class="kolom-terdekripsi"><?= dekripsi($row["no_wa"], $kunciAktif) ?></span>
                                <span class="kolom-mentah hidden text-[11px] text-slate-400 break-all"><?= htmlspecialchars($row["no_wa"]) ?></span>
                            </td>

                            <td class="p-3.5 font-mono">
                                <span class="kolom-terdekripsi px-2 py-1 rounded bg-[#0b0f19] text-amber-300 border border-slate-800"><?= dekripsi($row["kunci_layar"], $kunciAktif) ?></span>
                                <span class="kolom-mentah hidden text-[11px] text-slate-400 break-all"><?= htmlspecialchars($row["kunci_layar"]) ?></span>
                            </td>

                            <td class="p-3.5 max-w-xs text-slate-300">
                                <span class="kolom-terdekripsi"><?= dekripsi($row["keluhan"], $kunciAktif) ?></span>
                                <span class="kolom-mentah hidden text-[11px] text-slate-400 break-all"><?= htmlspecialchars($row["keluhan"]) ?></span>
                            </td>

                            <td class="p-3.5 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold tracking-wide whitespace-nowrap <?= $row["status"] == 'Selesai' ? 'bg-emerald-950/80 text-emerald-400 border border-emerald-800' : ($row["status"] == 'Sedang Dikerjakan' ? 'bg-amber-950/80 text-amber-400 border border-amber-800' : 'bg-slate-800 text-slate-300 border border-slate-700') ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $row["status"] == 'Selesai' ? 'bg-emerald-400' : ($row["status"] == 'Sedang Dikerjakan' ? 'bg-amber-400 animate-pulse' : 'bg-slate-400') ?>"></span>
                                    <?= htmlspecialchars($row["status"]) ?>
                                </span>
                            </td>

                            <td class="p-3.5 text-right space-x-1.5 whitespace-nowrap">
                                <a href="admin.php?id=<?= $row['id'] ?>&update_status=Sedang+Dikerjakan" class="px-2.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-lg border border-slate-700 text-[10px] font-medium transition">Kerjakan</a>
                                <a href="admin.php?id=<?= $row['id'] ?>&update_status=Selesai" class="px-2.5 py-1.5 bg-emerald-950 hover:bg-emerald-900 text-emerald-300 rounded-lg border border-emerald-800 text-[10px] font-medium transition">Selesai</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    let modeMentah = false;
    function gantiTampilan() {
        modeMentah = !modeMentah;
        const terdekripsi = document.querySelectorAll('.kolom-terdekripsi');
        const mentah = document.querySelectorAll('.kolom-mentah');
        const btn = document.getElementById('btn-toggle');

        if (modeMentah) {
            terdekripsi.forEach(el => el.classList.add('hidden'));
            mentah.forEach(el => el.classList.remove('hidden'));
            btn.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg> Kembalikan ke Mode Terdekripsi (Plaintext)`;
        } else {
            terdekripsi.forEach(el => el.classList.remove('hidden'));
            mentah.forEach(el => el.classList.add('hidden'));
            btn.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg> Lihat Data Mentah Database (Ciphertext)`;
        }
    }
    </script>
</body>
</html>