<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Panel Gateway API</title>
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
.hero{background:#fff;border:2px solid #16a34a;border-radius:10px;padding:8px 14px;margin-bottom:10px;display:flex;align-items:center;gap:10px}
.hero b{font-size:14px;color:#14532d}.hero p{font-size:11.5px;color:#475569}
.hero .auto{margin-left:auto;font-size:11px;color:#475569;text-align:right;white-space:nowrap}
.hero .auto button{border:2px solid #94a3b8;background:#fff;border-radius:7px;padding:4px 9px;font-size:11px;font-weight:700;cursor:pointer;margin-top:3px}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;padding:12px 14px;margin-bottom:10px}
.card h2{font-size:13.5px;margin-bottom:2px}
.d{font-size:12px;color:#475569;margin-bottom:8px;line-height:1.5}
.pgrid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:8px;margin-top:6px}
@media(max-width:1100px){.pgrid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:620px){.pgrid{grid-template-columns:1fr}}
.pitem{border:1.5px solid #e2e8f0;border-radius:9px;padding:8px 10px;background:#f8fafc}
.pitem .nm{display:flex;align-items:center;gap:6px;font-weight:800;font-size:13px}
.pitem small{display:block;color:#475569;font-size:11px;margin-top:1px;word-break:break-all}
.pill{font-size:11px;font-weight:800;padding:2px 8px;border-radius:6px;white-space:nowrap}
.p-ok{background:#dcfce7;color:#14532d;border:1.5px solid #16a34a}.p-bad{background:#fee2e2;color:#7f1d1d;border:1.5px solid #dc2626}.p-wait{background:#fef9c3;color:#713f12;border:1.5px solid #eab308}
.dot{display:inline-block;width:10px;height:10px;border-radius:50%;background:#eab308}
.dot.ok{background:#16a34a}.dot.bad{background:#dc2626}
.errline{color:#b91c1c !important;font-weight:700}
.main{display:grid;grid-template-columns:minmax(0,1fr) 320px;gap:10px;align-items:start}
@media(max-width:1000px){.main{grid-template-columns:1fr}}
label.f{font-size:12px;font-weight:800;display:block;margin:8px 0 3px}
label.f small{font-weight:400;color:#64748b}
select{width:100%;padding:8px 9px;border:2px solid #94a3b8;border-radius:8px;font-size:12.5px;background:#fff;color:#0f172a}
.radio{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.radio label{border:2px solid #94a3b8;border-radius:8px;padding:8px;font-size:11.5px;cursor:pointer;text-align:center;line-height:1.4}
.radio label small{display:block;color:#64748b;font-weight:400}
.radio input{display:none}
.radio label:has(input:checked){border-color:#1d4ed8;background:#eff6ff;box-shadow:0 0 0 2px #bfdbfe}
button.act{width:100%;background:#1d4ed8;color:#fff;border:none;padding:11px;border-radius:9px;font-size:13.5px;font-weight:800;cursor:pointer;margin-top:9px}
button.act:disabled{background:#94a3b8;cursor:wait}
.out{border-radius:9px;padding:10px;margin-top:9px;font-size:12.5px;line-height:1.6;white-space:pre-wrap;border:2px solid #e2e8f0;background:#f8fafc;color:#1e293b}
.out.ok{border-color:#16a34a;background:#f0fdf4}
.out.fail{border-color:#dc2626;background:#fef2f2}
.out a{color:#1d4ed8;font-weight:800}
table{width:100%;border-collapse:collapse;font-size:12px}
th{background:#0f172a;color:#fff;padding:6px 8px;text-align:left;font-size:10.5px}
td{padding:7px 8px;border-bottom:1.5px solid #e2e8f0;vertical-align:top}
.mini{font-size:11.5px;color:#64748b;margin-top:6px;line-height:1.5}
.mini a{color:#1d4ed8;font-weight:700}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:22px">🚪</div><h1>Gateway API</h1>
<div class="nav"><a href="/" class="on">🏠 Panel</a><a href="/settings" class="btn-t">🔑 Token</a><a href="/help">🛟 Bantuan</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button type="submit">🚪 Keluar</button></form></div>
</div></div>
<div class="wrap">
<div class="hero"><div style="font-size:24px">✅</div>
<div><b>Gateway hidup — 4 PUSAT di bawah ini kondisi terkini.</b><p>Hijau = bisa dihubungi · Merah = baca pesan merah kecilnya · Detail error ada di menu Bantuan.</p></div>
<div class="auto">Otomatis tiap <b id="cd">30</b> dtk · <span id="upd">-</span><br><button id="pauseBtn" onclick="toggleAuto()">⏸ Jeda</button> <button onclick="loadStatus(false)">↻ Cek</button></div>
</div>

<div class="card">
<h2>A — PUSAT (pemilik data asli)</h2>
<div class="pgrid">
@foreach($pusat as $key => $p)
<div class="pitem"><div class="nm"><span class="dot" id="dot-{{ $key }}"></span>{{ $p['nama'] }}
<span class="pill p-wait" id="ms-{{ $key }}" style="margin-left:auto">…</span></div>
<small>{{ $p['peran'] }} · {{ $p['url'] }}</small>
<small class="errline" id="err-{{ $key }}"></small></div>
@endforeach
</div>
</div>

<div class="main">
<div class="card">
<h2>B — Coba minta data (tes pakai token)</h2>
<div class="d">Pura-pura jadi PENERIMA yang meminta ke PUSAT. Gagal 401 = kunci belum diisi (wajar). Panduan lengkap di <a href="/help" style="color:#1d4ed8;font-weight:700">Bantuan</a>.</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
<div><label class="f">1. PENERIMA <small>— siapa meminta</small></label>
<select id="kons"><option>MIS</option><option>AO</option><option>APM</option><option>LANDING</option><option>PICKER</option></select></div>
<div><label class="f">2. PUSAT <small>— minta ke siapa</small></label>
<select id="svc" onchange="fillEp()">
@foreach($pusat as $key => $p)<option value="{{ $key }}">{{ $p['nama'] }} — {{ $p['peran'] }}</option>@endforeach
</select></div>
</div>
<label class="f">3. Data <small>— minta apa</small></label>
<select id="ep"></select>
<label class="f">4. Jalur</label>
<div class="radio">
<label><input type="radio" name="mode" value="gateway" checked><b>↔ Lewat gateway</b><small>Asli, kunci ditempel otomatis</small></label>
<label><input type="radio" name="mode" value="langsung"><b>→ Langsung</b><small>Tanpa gateway, pembanding</small></label>
</div>
<button class="act" id="goBtn" onclick="jalanTes()">▶ Coba sekarang</button>
<div class="out" id="out">Belum dicoba.</div>
</div>

<div class="card">
<h2>C — PENERIMA (pemakai gateway)</h2>
<div class="d">Memakai 1 kunci: <b>X-GW-KEY</b>.</div>
<table><tr><th>Siapa</th><th>Buat apa</th></tr>
@foreach($konsumen as $k)
<tr><td><b>{{ $k['nama'] }}</b></td><td>{{ $k['pakai'] }}</td></tr>
@endforeach
</table>
<p class="mini">Hasil 200 = siap · 401 = <a href="/settings">perbaiki Token</a> · lainnya = <a href="/help">lihat Bantuan</a>.</p>
</div>
</div>
</div>
<script>
const UJI = @json($uji);
const CSRF = @json(csrf_token());
let auto = true, cd = 30, timer = null;
function fillEp(){
  const s=document.getElementById('svc').value, ep=document.getElementById('ep');
  ep.innerHTML='';
  (UJI[s]||[]).forEach(e=>{const o=document.createElement('option');o.value=e.path;o.textContent=e.label;ep.appendChild(o);});
}
function stamp(){const d=new Date();document.getElementById('upd').textContent=d.toLocaleTimeString('id-ID');}
async function loadStatus(silent){
  try{
    const r=await fetch(window.location.href.replace(/\/$/,'')+'/services-status'); const j=await r.json();
    for(const k in (j.data||{})){
      const v=j.data[k], d=document.getElementById('dot-'+k), m=document.getElementById('ms-'+k), e=document.getElementById('err-'+k);
      if(!d||!m)continue;
      d.className='dot '+(v.up?'ok':'bad');
      m.textContent=v.up?(v.ms+'ms ✔'):('Tidak ✘');
      m.className='pill '+(v.up?'p-ok':'p-bad');
      if(e)e.textContent=v.up?'':('Sebab: '+(v.err||'tidak menjawab'));
    }
    stamp();
  }catch(e){}
}
function toggleAuto(){
  auto=!auto;
  document.getElementById('pauseBtn').textContent=auto?'⏸ Jeda':'▶ Jalan';
  if(auto)startAuto();
  else{clearInterval(timer);document.getElementById('cd').textContent='jeda';}
}
function startAuto(){
  clearInterval(timer); cd=30;
  timer=setInterval(()=>{cd--;if(cd<=0){loadStatus(true);cd=30;}document.getElementById('cd').textContent=auto?cd:'jeda';},1000);
}
async function jalanTes(){
  const out=document.getElementById('out'), btn=document.getElementById('goBtn');
  const kons=document.getElementById('kons').value, svc=document.getElementById('svc').value;
  const ep=document.getElementById('ep').value;
  const mode=document.querySelector('input[name=mode]:checked').value;
  btn.disabled=true; btn.textContent='⏳ Mencoba…';
  out.className='out'; out.textContent='Mencoba…';
  try{
    const r=await fetch(window.location.href.replace(/\/$/,'')+'/test-endpoint',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({konsumen:kons,service:svc,path:ep,mode:mode})});
    const j=await r.json();
    if(j.success&&j.http<400){out.className='out ok';out.textContent='✅ BERHASIL ('+j.http+', '+j.ms+'ms). Jalur benar, siap dipakai.\n\n'+(j.body||'').substring(0,300);}
    else if(j.http===401){out.className='out fail';out.innerHTML='❌ Kunci salah (401). <a href="/settings">Buka Token</a>, perbaiki, Simpan, coba lagi.';}
    else{out.className='out fail';out.textContent='⚠️ Gagal ('+(j.http||'no-res')+'). '+(j.body||j.error||'').substring(0,300)+' — panduan: Bantuan.';}
  }catch(e){out.className='out fail';out.textContent='❌ Gateway tidak menjawab: '+e.message;}
  btn.disabled=false; btn.textContent='▶ Coba sekarang';
}
fillEp(); loadStatus(false); startAuto();
</script>
</body></html>
