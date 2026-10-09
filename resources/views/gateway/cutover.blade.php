<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Cutover — Gateway API</title>
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
.wrap{max-width:720px;margin:0 auto;padding:12px 14px 32px}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;padding:12px 14px;margin-bottom:10px}
.bar{height:12px;background:#e2e8f0;border-radius:8px;overflow:hidden;margin:8px 0}
.bar div{height:100%;background:#16a34a}
.item{display:flex;gap:10px;align-items:flex-start;padding:9px 4px;border-bottom:1.5px solid #e2e8f0;font-size:13px}
.item input{width:20px;height:20px;margin-top:1px;accent-color:#16a34a}
.item.done span{text-decoration:line-through;color:#64748b}
button{background:#1d4ed8;color:#fff;border:none;padding:11px;border-radius:9px;font-size:14px;font-weight:800;cursor:pointer;width:100%;margin-top:10px}
.okmsg{background:#dcfce7;border:1.5px solid #16a34a;color:#14532d;padding:9px;border-radius:8px;font-size:13px;font-weight:700;margin-bottom:8px}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:22px">🚪</div><h1>Gateway API</h1>
<div class="nav"><a href="/">Panel</a><a href="/routes">Rute</a><a href="/cutover" class="on">Cutover</a><a href="/settings" class="btn-t">Token</a><a href="/help">Bantuan</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button type="submit">Keluar</button></form></div>
</div></div>
<div class="wrap">
<div class="card">
<h2>✅ Checklist cutover (weekend)</h2>
<div style="font-size:13px"><b>{{ $done }}/{{ $total }}</b> selesai</div>
<div class="bar"><div style="width:{{ $total?round($done/$total*100):0 }}%"></div></div>
@if(session('ok'))<div class="okmsg">✅ {{ session('ok') }}</div>@endif
<form method="POST" action="/cutover">@csrf
@foreach($items as $it)
<label class="item {{ $it['done']?'done':'' }}"><input type="checkbox" name="done[]" value="{{ $it['id'] }}" {{ $it['done']?'checked':'' }}><span>{{ $it['nama'] }}</span></label>
@endforeach
<button>💾 Simpan progres</button>
</form>
</div>
</div>
</body></html>
