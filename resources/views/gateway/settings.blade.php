<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Token — Gateway API</title>
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
.wrap{max-width:1280px;margin:0 auto;padding:12px 14px 28px}
.alert-ok{background:#dcfce7;border:1.5px solid #16a34a;color:#14532d;padding:9px 12px;border-radius:9px;font-size:12.5px;font-weight:700;margin-bottom:10px}
.lead{font-size:12px;color:#475569;margin-bottom:10px;line-height:1.55}
.tokgrid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:8px;align-items:start}
@media(max-width:1100px){.tokgrid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:700px){.tokgrid{grid-template-columns:1fr}}
.sect{background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;margin-bottom:8px;overflow:hidden}
.sect-h{background:#f8fafc;padding:7px 10px;font-size:12px;font-weight:800;border-bottom:1.5px solid #e2e8f0}
.sect-h small{font-weight:400;color:#64748b}
.sect-b{padding:8px 10px}
.fld{margin-bottom:7px}.fld:last-child{margin-bottom:0}
.fld label{font-size:11.5px;font-weight:800;display:block;margin-bottom:2px}
.fld label span{font-weight:400;color:#fff;background:#64748b;font-size:10px;padding:1px 6px;border-radius:5px;margin-left:5px;font-family:Consolas,monospace}
.fld input{width:100%;padding:8px 9px;border:2px solid #94a3b8;border-radius:8px;font-size:12.5px;font-family:Consolas,monospace;color:#0f172a;background:#fff}
.fld input:focus{outline:none;border-color:#1d4ed8;box-shadow:0 0 0 3px #bfdbfe}
.fld .hint{font-size:11px;color:#64748b;margin-top:3px;line-height:1.5}
.warntag{display:inline-block;font-size:11px;font-weight:800;margin-top:3px;padding:2px 8px;border-radius:6px}
.empty{background:#fef9c3;color:#713f12;border:1px solid #eab308}
.filled{background:#dcfce7;color:#14532d;border:1px solid #16a34a}
.savebar{position:sticky;bottom:10px;background:#0f2160;border-radius:10px;padding:9px 10px;margin-top:8px;box-shadow:0 8px 22px rgba(0,0,0,.25);display:flex;gap:10px;align-items:center}
.savebar button{flex:1;background:#16a34a;color:#fff;border:none;padding:11px;border-radius:9px;font-size:13.5px;font-weight:800;cursor:pointer}
.savebar a{color:#fff;font-size:12.5px}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:22px">Gateway</div><h1>Gateway API</h1>
<div class="nav"><a href="/">Panel</a><a href="/routes">Rute</a><a href="/cutover">Cutover</a><a href="/settings" class="btn-t on">Token</a><a href="/help">Bantuan</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button type="submit">Keluar</button></form></div>
</div></div>
<div class="wrap">
@if(session('ok'))<div class="alert-ok">{{ session('ok') }}</div>@endif
<p class="lead">Isi cukup sekali di sini. <b>Berlaku langsung</b>, tanpa oprek kode. Tanda <b style="background:#fef9c3;padding:0 6px;border:1px solid #eab308;border-radius:6px">BELUM DIISI</b> = masih kosong.</p>
<form method="POST" action="/settings">@csrf
<div class="tokgrid">
<div>
@php
function st($v){ return empty($v) ? '<span class="warntag empty">BELUM DIISI</span>' : '<span class="warntag filled">Terisi</span>'; }
@endphp
<div class="sect"><div class="sect-h">1. Kunci gateway <small>ke PENERIMA</small></div><div class="sect-b">
<div class="fld"><label>GATEWAY_TOKEN</label><input name="GATEWAY_TOKEN" value="{{ $values['GATEWAY_TOKEN'] ?? '' }}">{!! st($values['GATEWAY_TOKEN'] ?? '') !!}<div class="hint">Dipakai PENERIMA sebagai header X-GW-KEY.</div></div>
</div></div>
<div class="sect"><div class="sect-h">6. Login panel ini</div><div class="sect-b">
<div class="fld"><label>ADMIN_USER</label><input name="ADMIN_USER" value="{{ $values['ADMIN_USER'] ?? '' }}"></div>
<div class="fld"><label>ADMIN_PASS <small>(kosong = tetap)</small></label><input name="ADMIN_PASS" value="" placeholder="(tidak ganti)"></div>
</div></div>
</div>
<div>
<div class="sect"><div class="sect-h">2. MIS <small>crm.lsfragrance.id</small></div><div class="sect-b">
<div class="fld"><label>MIS_BASE_URL</label><input name="MIS_BASE_URL" value="{{ $values['MIS_BASE_URL'] ?? '' }}">{!! st($values['MIS_BASE_URL'] ?? '') !!}</div>
<div class="fld"><label>MIS_API_KEY <small>= API_SECRET_KEY</small></label><input name="MIS_API_KEY" value="{{ $values['MIS_API_KEY'] ?? '' }}">{!! st($values['MIS_API_KEY'] ?? '') !!}</div>
</div></div>
<div class="sect"><div class="sect-h">3. AO <small>sys-af.lsfragrance.id</small></div><div class="sect-b">
<div class="fld"><label>AO_BASE_URL</label><input name="AO_BASE_URL" value="{{ $values['AO_BASE_URL'] ?? '' }}">{!! st($values['AO_BASE_URL'] ?? '') !!}</div>
<div class="fld"><label>AGENDA_TOKEN</label><input name="AGENDA_TOKEN" value="{{ $values['AGENDA_TOKEN'] ?? '' }}">{!! st($values['AGENDA_TOKEN'] ?? '') !!}</div>
<div class="fld"><label>AO_KEY <small>= X-AO-KEY</small></label><input name="AO_KEY" value="{{ $values['AO_KEY'] ?? '' }}">{!! st($values['AO_KEY'] ?? '') !!}</div>
</div></div>
</div>
<div>
<div class="sect"><div class="sect-h">4. Transaksi <small>trans.lssoft88.xyz</small></div><div class="sect-b">
<div class="fld"><label>TRANS_BASE_URL</label><input name="TRANS_BASE_URL" value="{{ $values['TRANS_BASE_URL'] ?? '' }}">{!! st($values['TRANS_BASE_URL'] ?? '') !!}</div>
<div class="fld"><label>AO_API_KEY</label><input name="AO_API_KEY" value="{{ $values['AO_API_KEY'] ?? '' }}">{!! st($values['AO_API_KEY'] ?? '') !!}</div>
<div class="fld"><label>USER_API_KEY</label><input name="USER_API_KEY" value="{{ $values['USER_API_KEY'] ?? '' }}">{!! st($values['USER_API_KEY'] ?? '') !!}</div>
</div></div>
<div class="sect"><div class="sect-h">5. Drive <small>drive.lssoft88.xyz</small></div><div class="sect-b">
<div class="fld"><label>DRIVE_BASE_URL</label><input name="DRIVE_BASE_URL" value="{{ $values['DRIVE_BASE_URL'] ?? '' }}">{!! st($values['DRIVE_BASE_URL'] ?? '') !!}</div>
<div class="fld"><label>DRIVE_API_KEY <small>opsional</small></label><input name="DRIVE_API_KEY" value="{{ $values['DRIVE_API_KEY'] ?? '' }}">@if(empty($values['DRIVE_API_KEY'] ?? ''))<span class="warntag empty">Boleh kosong</span>@else<span class="warntag filled">Terisi</span>@endif</div>
</div></div>
</div>
</div>
<div class="savebar"><button>Simpan semua — berlaku langsung</button><a href="/">Batal</a></div>
</form>
</div>
</body></html>
