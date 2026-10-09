<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Bantuan — Gateway API</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial,sans-serif}
body{background:#eef2f7;color:#1e293b}
.top{background:#0f2160;color:#fff;padding:10px 16px;position:sticky;top:0;z-index:5}
.topin{max-width:1280px;margin:0 auto;display:flex;align-items:center;gap:8px}
.top h1{font-size:15px}
.nav{margin-left:auto;display:flex;gap:6px;align-items:center}
.nav a,.nav button{font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px;text-decoration:none;cursor:pointer;border:none}
.nav a{background:rgba(255,255,255,.12);color:#fff}.nav a.on{background:#fff;color:#0f2160}
.nav .btn-t{background:#16a34a;color:#fff}
.wrap{max-width:1280px;margin:0 auto;padding:12px 14px 28px}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;padding:12px 14px;margin-bottom:10px}
.card h2{font-size:13.5px;margin-bottom:6px}
p,li{font-size:12.5px;line-height:1.6;color:#334155}
ul,ol{margin:6px 0 0 20px}
table{width:100%;border-collapse:collapse;font-size:12.5px;margin-top:8px}
th{background:#0f172a;color:#fff;padding:7px 8px;text-align:left;font-size:11px}
td{padding:8px;border-bottom:1.5px solid #e2e8f0;vertical-align:top}
kbd{background:#0f172a;color:#fff;padding:1px 7px;border-radius:6px;font-size:11px;font-family:Consolas,monospace}
.helpdesk{background:#eff6ff;border:2px solid #1d4ed8;border-radius:12px;padding:14px 16px;margin-bottom:10px;font-size:13px}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:22px">🚪</div><h1>Gateway API</h1>
<div class="nav"><a href="/">Panel</a><a href="/settings" class="btn-t">Token</a><a href="/help" class="on">Bantuan</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button type="submit">Keluar</button></form></div>
</div></div>
<div class="wrap">
<div class="helpdesk">Helpdesk gateway: kalau panel menunjukkan merah / tes gagal dan panduan di bawah belum membantu, hubungi <b>tim IT (admin gateway)</b> sertakan: jam kejadian + nama PENERIMA + nama PUSAT + hasil tes (copy teksnya). Jangan kirim kunci asli lewat chat umum.</div>
<div class="card">
<h2>📖 Istilah baku (dipakai di semua halaman)</h2>
<table><tr><th>Istilah</th><th>Artinya</th><th>Contoh</th></tr>
<tr><td><b>PUSAT</b></td><td>Aplikasi <b>pemilik data asli</b> (tujuan akhir). Tidak pernah menghubungi gateway.</td><td>MIS, AO, Transaksi, Drive</td></tr>
<tr><td><b>PENERIMA</b></td><td>Aplikasi <b>pemakai/pengirim</b> yang meminta data lewat gateway pakai kunci <kbd>X-GW-KEY</kbd>.</td><td>MIS, AO, APM, Landing, Picker</td></tr>
<tr><td><b>Gateway</b></td><td>1 pintu di tengah. Menerima dari PENERIMA, meneruskan ke PUSAT.</td><td><kbd>gw.lssoft88.xyz</kbd></td></tr>
<tr><td><b>Via Gateway / Langsung</b></td><td>Via Gateway = kondisi asli. Langsung = tembak PUSAT tanpa gateway (pembanding).</td><td>Tes bagian B panel</td></tr>
</table>
</div>
<div class="card">
<h2>🛠 Arti hasil & yang dilakukan</h2>
<table><tr><th>Hasil</th><th>Artinya</th><th>Lakukan ini</th></tr>
<tr><td><b>200 ✅</b></td><td>Berhasil. Jalur + kunci benar.</td><td>Tidak ada tindakan.</td></tr>
<tr><td><b>401</b></td><td>Kunci salah / belum diisi.</td><td>Buka 🔑 Token → perbaiki → Simpan → tes ulang.</td></tr>
<tr><td><b>404</b></td><td>Nama data salah.</td><td>Pilih data lain di langkah 3.</td></tr>
<tr><td><b>500 / no-res / timeout</b></td><td>PUSAT mati atau server gateway tidak bisa keluar internet.</td><td>Buka alamat PUSAT langsung. Kalau ikut mati = perbaiki aplikasinya. Kalau hidup = lapor admin (kemungkinan outbound diblokir).</td></tr>
<tr><td><b>Langsung OK, Via Gateway 401</b></td><td>Token yang disimpan gateway salah.</td><td>Perbaiki di 🔑 Token → Simpan → tes ulang.</td></tr>
</table>
</div>
<div class="card">
<h2>🔑 Cara pakai dari aplikasi (untuk teknisi)</h2>
<ol>
<li>Alamat data diganti ke gateway, contoh: <kbd>/api/v1/drive/list?path=/</kbd></li>
<li>Wajib kirim header: <kbd>X-GW-KEY: (isi GATEWAY_TOKEN)</kbd></li>
<li>200 = ok. 401 = kunci salah.</li>
</ol>
</div>
<div class="card">
<h2>❓ Kalau panel tidak bisa dibuka</h2>
<ul>
<li><b>Halaman tidak terbuka sama sekali</b> → Apache / hosting mati. Hubungi admin hosting.</li>
<li><b>Diminta login terus</b> → sesi habis. Login ulang.</li>
<li><b>Semua PUSAT merah bersamaan</b> → server gateway tidak bisa keluar internet. Lapor admin + Jagoan Hosting (outbound).</li>
</ul>
</div>
</div>
</body></html>
