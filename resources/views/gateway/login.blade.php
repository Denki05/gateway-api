<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Masuk — Gateway API</title>
<style>*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial}body{background:#0f2160;display:flex;min-height:100vh;align-items:center;justify-content:center;padding:20px}.box{background:#fff;border-radius:16px;padding:28px;width:100%;max-width:380px;box-shadow:0 16px 40px rgba(0,0,0,.3)}h1{font-size:20px;color:#0f172a}.sub{color:#475569;font-size:13px;margin:4px 0 16px}label{font-size:13.5px;font-weight:800;color:#0f172a;display:block;margin:12px 0 5px}input{width:100%;padding:12px;border:2px solid #94a3b8;border-radius:10px;font-size:15px;color:#0f172a}input:focus{outline:none;border-color:#1d4ed8;box-shadow:0 0 0 3px #bfdbfe}button{width:100%;margin-top:16px;background:#1d4ed8;color:#fff;border:none;padding:13px;border-radius:10px;font-size:15px;font-weight:800;cursor:pointer}.err{background:#fee2e2;border:1.5px solid #dc2626;color:#7f1d1d;font-size:13.5px;font-weight:700;padding:10px;border-radius:9px;margin-bottom:8px}.hint{font-size:12.5px;color:#475569;margin-top:12px;text-align:center;line-height:1.5}</style>
</head><body>
<div class="box">
<div style="font-size:34px">🚪</div>
<h1>Masuk Gateway</h1>
<!-- <div class="sub">Panel pengelola koneksi MIS · AO · Transaksi · Drive.<br>Bawaan: <b>admin / admin123</b> — segera ganti di menu Token.</div> -->
@if($errors->any())<div class="err">❌ {{ $errors->first() }}</div>@endif
<form method="POST" action="/login">@csrf
<label>Username</label><input name="username" value="{{ old('username') }}" autofocus autocomplete="username">
<label>Password</label><input type="password" name="password" autocomplete="current-password">
<button>Masuk →</button>
</form>
<div class="hint">Lupa password? Minta admin membuka file<br><b>storage/app/gateway_settings.json</b></div>
</div>
</body></html>
