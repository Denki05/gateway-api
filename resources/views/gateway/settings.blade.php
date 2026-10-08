<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Pengaturan Token — Gateway API</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial,sans-serif}
body{background:#e8edf3;color:#16233a;padding:0}
.top{background:#0f2160;color:#fff;padding:14px 20px;position:sticky;top:0;z-index:5}
.topin{max-width:1360px;margin:0 auto;display:flex;align-items:center;gap:10px}
.top a{color:#c7d6ff;font-size:13px;text-decoration:none}
.top h1{font-size:16px}
.wrap{max-width:1360px;margin:0 auto;padding:14px 14px 40px}
.alert-ok{background:#dcfce7;border:1.5px solid #16a34a;color:#14532d;padding:11px 14px;border-radius:10px;font-size:14px;font-weight:700;margin-bottom:14px}
.lead{font-size:13.5px;color:#334155;margin-bottom:14px;line-height:1.5}
.sect{background:#fff;border:1.5px solid #cbd5e1;border-radius:14px;margin-bottom:14px;overflow:hidden}
.sect-h{padding:12px 16px;border-bottom:1.5px solid #e2e8f0;display:flex;gap:10px;align-items:center;background:#f8fafc}
.sect-h .ic{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:18px;color:#fff;flex-shrink:0}
.sect-h b{font-size:15px;color:#0f172a;display:block}
.sect-h small{font-size:12px;color:#475569}
.sect-b{padding:14px 16px}
.field{margin-bottom:12px}
.field label{font-size:13.5px;font-weight:800;color:#0f172a;display:block;margin-bottom:5px}
.field label span{font-weight:400;color:#fff;background:#64748b;font-size:10.5px;padding:2px 7px;border-radius:6px;margin-left:6px;font-family:Consolas,monospace}
.field input{width:100%;padding:11px 12px;border:2px solid #94a3b8;border-radius:9px;font-size:13.5px;font-family:Consolas,monospace;color:#0f172a;background:#fff}
.field input:focus{outline:none;border-color:#1d4ed8;box-shadow:0 0 0 3px #bfdbfe}
.field .hint{font-size:12px;color:#475569;margin-top:4px;line-height:1.45}
.field .warntag{display:inline-block;font-size:11.5px;font-weight:800;margin-top:4px;padding:2px 8px;border-radius:6px}
.empty{background:#fef9c3;color:#713f12;border:1px solid #eab308}
.filled{background:#dcfce7;color:#14532d;border:1px solid #16a34a}
.savebar{position:sticky;bottom:12px;background:#0f2160;border-radius:14px;padding:12px;display:flex;gap:10px;align-items:center;box-shadow:0 8px 24px rgba(0,0,0,.25)}
.savebar button{flex:1;background:#16a34a;color:#fff;border:none;padding:13px;border-radius:10px;font-size:15px;font-weight:800;cursor:pointer}
.savebar button:active{transform:scale(.98)}
.savebar a{color:#fff;font-size:13px}
.c1{background:#1d4ed8}.c2{background:#7c3aed}.c3{background:#0e7490}.c4{background:#b45309}.c5{background:#166534}.c6{background:#334155}
</style>
</head><body>
<div class="top"><div class="topin"><a href="/" style="color:#fff;text-decoration:none;font-size:22px">🚪</a><h1 style="color:#fff">🔑 Token Pusat</h1>
<div style="margin-left:auto;display:flex;gap:6px;flex-wrap:wrap"><a href="/" style="background:rgba(255,255,255,.12);color:#fff;padding:7px 12px;border-radius:8px;text-decoration:none;font-size:12.5px;font-weight:700">🏠 Panel</a><a href="/routes" style="background:rgba(255,255,255,.12);color:#fff;padding:7px 12px;border-radius:8px;text-decoration:none;font-size:12.5px;font-weight:700">🗺️ Rute</a><a href="/cutover" style="background:rgba(255,255,255,.12);color:#fff;padding:7px 12px;border-radius:8px;text-decoration:none;font-size:12.5px;font-weight:700">✅ Cutover</a><a href="/help" style="background:rgba(255,255,255,.12);color:#fff;padding:7px 12px;border-radius:8px;text-decoration:none;font-size:12.5px;font-weight:700">❓ Bantuan</a></div></div></div>
<div class="wrap">
@if(session('ok'))<div class="alert-ok">✅ {{ session('ok') }}</div>@endif
<p class="lead">Isi cukup sekali di sini. <b>Berlaku langsung</b>, tidak perlu buka kode / restart. Kolom bertanda <b style="background:#fef9c3;padding:0 6px;border:1px solid #eab308;border-radius:6px">BELUM DIISI</b> berarti masih kosong dan wajib dilengkapi.</p>
<form method="POST" action="/settings">@csrf
<div style="display:grid;grid-template-columns:1fr 1fr;gap:0 14px">
<style>@media(max-width:900px){div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr !important}}</style>
<div>
@php
function st($v){ return empty($v) ? '<span class="warntag empty">⚠ BELUM DIISI</span>' : '<span class="warntag filled">● Terisi</span>'; }
@endphp
<div class="sect"><div class="sect-h"><div class="ic c1">🚪</div><div><b>1. Kunci Gateway (pintu depan)</b><small>Bagikan kunci ini ke MIS / AO / Landing. Ganti di sini = semua ikut ganti.</small></div></div>
<div class="sect-b">
<div class="field"><label>Kunci gateway <span>GATEWAY_TOKEN</span></label><input name="GATEWAY_TOKEN" value="{{ $values['GATEWAY_TOKEN'] ?? '' }}">{!! st($values['GATEWAY_TOKEN'] ?? '') !!}<div class="hint">Contoh pakai: header <b>X-GW-KEY: {{ $values['GATEWAY_TOKEN'] ?? '' }}</b>. Kalau aplikasi balas 401, berarti kunci ini yang salah.</div></div>
</div></div>
<div class="sect"><div class="sect-h"><div class="ic c2">🏢</div><div><b>2. MIS</b><small>crm.lsfragrance.id — sumber data customer & prospek</small></div></div>
<div class="sect-b">
<div class="field"><label>Alamat MIS <span>MIS_BASE_URL</span></label><input name="MIS_BASE_URL" value="{{ $values['MIS_BASE_URL'] ?? '' }}">{!! st($values['MIS_BASE_URL'] ?? '') !!}</div>
<div class="field"><label>Token MIS <span>MIS_API_KEY</span></label><input name="MIS_API_KEY" value="{{ $values['MIS_API_KEY'] ?? '' }}">{!! st($values['MIS_API_KEY'] ?? '') !!}<div class="hint">Samakan dengan <b>API_SECRET_KEY</b> di file .env MIS.</div></div>
</div></div>
<div class="sect"><div class="sect-h"><div class="ic c3">📋</div><div><b>3. AO (Agenda / SO)</b><small>sys-af.lsfragrance.id — agenda + order + notifikasi</small></div></div>
<div class="sect-b">
<div class="field"><label>Alamat AO <span>AO_BASE_URL</span></label><input name="AO_BASE_URL" value="{{ $values['AO_BASE_URL'] ?? '' }}">{!! st($values['AO_BASE_URL'] ?? '') !!}</div>
<div class="field"><label>Token Agenda <span>AGENDA_TOKEN</span></label><input name="AGENDA_TOKEN" value="{{ $values['AGENDA_TOKEN'] ?? '' }}">{!! st($values['AGENDA_TOKEN'] ?? '') !!}<div class="hint">Samakan dengan <b>AGENDA_TOKEN</b> di .env AO. Dipakai untuk /agenda, /ao/notif, /receive-invoice.</div></div>
<div class="field"><label>Token Order-Progress <span>AO_KEY</span></label><input name="AO_KEY" value="{{ $values['AO_KEY'] ?? '' }}">{!! st($values['AO_KEY'] ?? '') !!}<div class="hint">Samakan dengan <b>X-AO-KEY</b> di AO. Khusus callback /ao/order-progress.</div></div>
</div></div>
</div><div>
<div class="sect"><div class="sect-h"><div class="ic c4">💰</div><div><b>4. Transaksi</b><small>trans.lssoft88.xyz — produk, customer, SO, picker</small></div></div>
<div class="sect-b">
<div class="field"><label>Alamat Transaksi <span>TRANS_BASE_URL</span></label><input name="TRANS_BASE_URL" value="{{ $values['TRANS_BASE_URL'] ?? '' }}">{!! st($values['TRANS_BASE_URL'] ?? '') !!}</div>
<div class="field"><label>Token untuk AO <span>AO_API_KEY</span></label><input name="AO_API_KEY" value="{{ $values['AO_API_KEY'] ?? '' }}">{!! st($values['AO_API_KEY'] ?? '') !!}<div class="hint">Samakan dengan <b>AO_API_KEY</b> di .env Transaksi. Dipakai /ao/so-awal/*.</div></div>
<div class="field"><label>Token untuk User <span>USER_API_KEY</span></label><input name="USER_API_KEY" value="{{ $values['USER_API_KEY'] ?? '' }}">{!! st($values['USER_API_KEY'] ?? '') !!}<div class="hint">Samakan dengan <b>USER_API_KEY</b> di .env Transaksi (= AGENDA_TOKEN AO). Dipakai /superusers.</div></div>
</div></div>
<div class="sect"><div class="sect-h"><div class="ic c5">💾</div><div><b>5. Drive (file & gambar)</b><small>drive.lssoft88.xyz — dipakai semua aplikasi + landing</small></div></div>
<div class="sect-b">
<div class="field"><label>Alamat Drive <span>DRIVE_BASE_URL</span></label><input name="DRIVE_BASE_URL" value="{{ $values['DRIVE_BASE_URL'] ?? '' }}">{!! st($values['DRIVE_BASE_URL'] ?? '') !!}</div>
<div class="field"><label>Token Drive <span>DRIVE_API_KEY</span></label><input name="DRIVE_API_KEY" value="{{ $values['DRIVE_API_KEY'] ?? '' }}">@if(empty($values['DRIVE_API_KEY'] ?? ''))<span class="warntag empty">○ Opsional — boleh kosong</span>@else<span class="warntag filled">● Terisi</span>@endif<div class="hint">Drive saat ini tanpa token. Isi hanya jika nanti Drive dipasang kunci.</div></div>
</div></div>
<div class="sect"><div class="sect-h"><div class="ic c6">👤</div><div><b>6. Login panel ini</b><small>Akun untuk staf yang membuka halaman ini</small></div></div>
<div class="sect-b">
<div class="field"><label>Username <span>ADMIN_USER</span></label><input name="ADMIN_USER" value="{{ $values['ADMIN_USER'] ?? '' }}"></div>
<div class="field"><label>Password <span>ADMIN_PASS</span></label><input name="ADMIN_PASS" value="" placeholder="Kosongkan = password tidak diganti"><div class="hint">Demi keamanan, password tidak ditampilkan. Isi hanya kalau mau ganti.</div></div>
</div></div>
</div>
<div class="savebar"><button>💾 Simpan semua — berlaku langsung</button><a href="/">Batal</a></div>
</form>
</div>
</body></html>
