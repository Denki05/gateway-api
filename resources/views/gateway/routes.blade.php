<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rute — Gateway API</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial,sans-serif}
body{background:#eef2f7;color:#1e293b}
.top{background:#0f2160;color:#fff;padding:10px 16px;position:sticky;top:0;z-index:5}
.topin{max-width:1280px;margin:0 auto;display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.top h1{font-size:15px}
.nav{margin-left:auto;display:flex;gap:6px;align-items:center;flex-wrap:wrap}
.nav a,.nav button{font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px;text-decoration:none;cursor:pointer;border:none}
.nav a{background:rgba(255,255,255,.12);color:#fff}.nav a.on{background:#fff;color:#0f2160}
.nav .btn-t{background:#16a34a;color:#fff}
.wrap{max-width:1280px;margin:0 auto;padding:12px 14px 32px}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;padding:12px 14px;margin-bottom:10px}
.card h2{font-size:13.5px}.d{font-size:12px;color:#475569;margin:2px 0 8px}
table{width:100%;border-collapse:collapse;font-size:12px}
th{background:#0f172a;color:#fff;padding:7px 8px;text-align:left;font-size:10.5px}
td{padding:7px 8px;border-bottom:1.5px solid #e2e8f0;vertical-align:top}
td code{font-family:Consolas,monospace;font-size:11px;background:#f1f5f9;padding:1px 5px;border-radius:5px;word-break:break-all}
.mtd{font-weight:800;font-size:10.5px;background:#1e3a8a;color:#fff;padding:2px 7px;border-radius:6px;white-space:nowrap}
.st{font-size:11px;font-weight:800;padding:2px 8px;border-radius:6px;white-space:nowrap}
.ok{background:#dcfce7;color:#14532d}.next{background:#fef9c3;color:#713f12}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:22px">🚪</div><h1>Gateway API</h1>
<div class="nav"><a href="/">Panel</a><a href="/routes" class="on">Rute</a><a href="/cutover">Cutover</a><a href="/settings" class="btn-t">Token</a><a href="/help">Bantuan</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button type="submit">Keluar</button></form></div>
</div></div>
<div class="wrap">
<div class="card">
<h2>🗺️ Peta rute: gateway ↔ PUSAT</h2>
<div class="d">Dibaca: PENERIMA memanggil kolom <b>Gateway</b> → gateway meneruskan ke kolom <b>PUSAT</b> sambil menempelkan kunci. Status <b>Aktif</b> = sudah bisa dipakai hari ini.</div>
<table><tr><th>Metode</th><th>Gateway (panggil ini)</th><th>PUSAT (tujuan)</th><th>Kunci ditempel</th><th>Status</th><th>Pemakai</th></tr>
@foreach($rows as $r)
<tr><td><span class="mtd">{{ $r[0] }}</span></td><td><code>{{ $r[1] }}</code></td><td><code>{{ $r[2] }}</code></td><td>{{ $r[3] }}</td><td><span class="st {{ strpos($r[4],'Aktif')!==false?'ok':'next' }}">{{ $r[4] }}</span></td><td>{{ $r[5] }}</td></tr>
@endforeach
</table>
</div>
</div>
</body></html>
