<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Panel Gateway API</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial,sans-serif}
body{background:#eef2f7;color:#1e293b}
.top{background:#0f2160;color:#fff;padding:10px 16px;position:sticky;top:0;z-index:5}
.topin{max-width:1280px;margin:0 auto;display:flex;align-items:center;gap:10px}
.top h1{font-size:15px}.top small{color:#c7d6ff;font-size:11.5px;display:block}
.top .acts{margin-left:auto;display:flex;gap:8px}
.btn-t{background:#16a34a;color:#fff;padding:8px 14px;border-radius:9px;text-decoration:none;font-size:13px;font-weight:800}
.btn-o{background:rgba(255,255,255,.15);color:#fff;border:none;padding:8px 12px;border-radius:9px;font-size:13px;cursor:pointer}
.wrap{max-width:1280px;margin:0 auto;padding:12px 14px 32px}
.hero{background:#fff;border:2px solid #16a34a;border-radius:12px;padding:10px 16px;margin-bottom:10px;display:flex;align-items:center;gap:12px}
.hero b{font-size:15.5px;color:#14532d}.hero p{font-size:12.5px;color:#475569}
.hero .auto{margin-left:auto;font-size:11.5px;color:#475569;text-align:right;white-space:nowrap}
.hero .auto button{border:2px solid #94a3b8;background:#fff;border-radius:8px;padding:5px 10px;font-size:11.5px;font-weight:700;cursor:pointer;margin-top:4px}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:12px;padding:14px 16px;margin-bottom:10px}
.card h2{font-size:14.5px;margin-bottom:2px}
.d{font-size:12.5px;color:#475569;margin-bottom:10px;line-height:1.55}
.tag{display:inline-block;font-size:10.5px;font-weight:800;padding:2px 8px;border-radius:6px;letter-spacing:.4px;margin-bottom:6px}
.t-pusat{background:#dbeafe;color:#1e3a8a;border:1px solid #3b82f6}
.t-kons{background:#dcfce7;color:#14532d;border:1px solid #16a34a}
.t-uji{background:#fef9c3;color:#713f12;border:1px solid #eab308}
.pgrid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;margin-top:8px}
@media(max-width:1100px){.pgrid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:620px){.pgrid{grid-template-columns:1fr}}
.pitem{border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 12px;background:#f8fafc}
.pitem .nm{display:flex;align-items:center;gap:7px;font-weight:800;font-size:13.5px}
.pitem small{display:block;color:#475569;font-size:11.5px;margin-top:2px;word-break:break-all}
.pill{font-size:11.5px;font-weight:800;padding:3px 9px;border-radius:7px;white-space:nowrap}
.p-ok{background:#dcfce7;color:#14532d;border:1.5px solid #16a34a}.p-bad{background:#fee2e2;color:#7f1d1d;border:1.5px solid #dc2626}.p-wait{background:#fef9c3;color:#713f12;border:1.5px solid #eab308}
.dot{display:inline-block;width:11px;height:11px;border-radius:50%;background:#eab308}
.dot.ok{background:#16a34a}.dot.bad{background:#dc2626}
.errline{color:#b91c1c !important;font-weight:700}
.main{display:grid;grid-template-columns:minmax(0,1fr) 340px;gap:10px;align-items:start}
@media(max-width:1000px){.main{grid-template-columns:1fr}}
label.f{font-size:12.5px;font-weight:800;display:block;margin:9px 0 4px}
label.f small{font-weight:400;color:#64748b}
select{width:100%;padding:9px 10px;border:2px solid #94a3b8;border-radius:9px;font-size:13px;background:#fff;color:#0f172a}
.radio{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.radio label{border:2px solid #94a3b8;border-radius:9px;padding:9px;font-size:12px;cursor:pointer;text-align:center;line-height:1.4}
.radio label small{display:block;color:#64748b;font-weight:400}
.radio input{display:none}
.radio label:has(input:checked){border-color:#1d4ed8;background:#eff6ff;box-shadow:0 0 0 2px #bfdbfe}
button.act{width:100%;background:#1d4ed8;color:#fff;border:none;padding:12px;border-radius:10px;font-size:14px;font-weight:800;cursor:pointer;margin-top:10px}
button.act:disabled{background:#94a3b8;cursor:wait}
.out{border-radius:10px;padding:12px;margin-top:10px;font-size:13px;line-height:1.6;white-space:pre-wrap;border:2px solid #e2e8f0;background:#f8fafc;color:#1e293b}
.out.ok{border-color:#16a34a;background:#f0fdf4}
.out.fail{border-color:#dc2626;background:#fef2f2}
.out a{color:#1d4ed8;font-weight:800}
table{width:100%;border-collapse:collapse;font-size:12.5px}
th{background:#0f172a;color:#fff;padding:7px 8px;text-align:left;font-size:11px}
td{padding:8px;border-bottom:1.5px solid #e2e8f0;vertical-align:top;color:#1e293b}
kbd{background:#0f172a;color:#fff;padding:1px 7px;border-radius:6px;font-size:11px;font-family:Consolas,monospace}
.cap{font-size:11.5px;color:#64748b;margin-top:6px;line-height:1.5}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:24px">🚪</div>
<div><h1>Panel Gateway API</h1><small>1 pintu untuk semua aplikasi</small></div>
<div class="acts"><a class="btn-t" href="/settings">🔑 Token</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button class="btn-o">Keluar</button></form></div>
</div></div>
<div class="wrap">
<div class="hero"><div style="font-size:26px">✅</div>
<div><b>Gateway hidup. Di bawah ini kondisi tiap aplikasi tujuan.</b><p>Hijau = bisa dihubungi. Merah = tidak bisa dihubungi (baca pesan merah kecilnya).</p></div>
<div class="auto">Cek otomatis tiap <b id="cd">30</b> dtk<br><span id="upd">Terakhir: -</span><br><button id="pauseBtn" onclick="toggleAuto()">⏸ Jeda</button></div>
</div>

<div class="card">
<span class="tag t-pusat">A — APLIKASI TUJUAN (pemilik data asli)</span>
<h2>Apakah aplikasi tujuan bisa dihubungi?</h2>
<div class="d">Ini tes sambungan saja (belum pakai token). Kalau merah, berarti alamat salah / aplikasinya mati / server tidak bisa keluar internet.</div>
<div class="pgrid">
@foreach($pusat as $key => $p)
<div class="pitem"><div class="nm"><span class="dot" id="dot-{{ $key }}"></span>{{ $p['nama'] }}
<span class="pill p-wait" id="ms-{{ $key }}" style="margin-left:auto">Cek…</span></div>
<small>{{ $p['peran'] }}</small><small>{{ $p['url'] }}</small>
<small class="errline" id="err-{{ $key }}"></small></div>
@endforeach
</div>
</div>

<div class="main">
<div class="card">
<span class="tag t-uji">B — COBA MINTA DATA (tes pakai token)</span>
<h2>Coba minta data seperti aplikasi aslinya</h2>
<div class="d">Contoh: pura-pura jadi <b>Landing</b> yang minta daftar file ke <b>Drive</b>. Pilih lewat gateway (kondisi asli) atau langsung (pembanding).</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
<div><label class="f">1. Siapa yang meminta? <small>— pura-pura jadi…</small></label>
<select id="kons"><option>MIS</option><option>AO</option><option>APM</option><option>LANDING</option><option>PICKER</option></select></div>
<div><label class="f">2. Minta ke siapa? <small>— pemilik datanya</small></label>
<select id="svc" onchange="fillEp()">
@foreach($pusat as $key => $p)<option value="{{ $key }}">{{ $p['nama'] }} — {{ $p['peran'] }}</option>@endforeach
</select></div>
</div>
<label class="f">3. Minta apa? <small>— datanya</small></label>
<select id="ep"></select>
<label class="f">4. Lewat mana?</label>
<div class="radio">
<label><input type="radio" name="mode" value="gateway" checked><b>↔ Lewat gateway</b><small>Seperti aslinya, kunci ditempel otomatis</small></label>
<label><input type="radio" name="mode" value="langsung"><b>→ Langsung</b><small>Tanpa gateway, untuk pembanding</small></label>
</div>
<button class="act" id="goBtn" onclick="jalanTes()">▶ Coba sekarang</button>
<div class="out" id="out">Belum dicoba. Atur 1–4 lalu tekan tombol biru.</div>
<div class="cap">Catatan: hasil <b>401</b> = kunci salah (wajar sebelum token diisi). Hasil <b>200</b> = jalur + kunci benar.</div>
</div>

<div>
<div class="card">
<span class="tag t-kons">C — SIAPA PEMAKAINYA</span>
<h2>Aplikasi yang memakai gateway</h2>
<div class="d">Mereka menghubungi gateway pakai 1 kunci: <kbd>X-GW-KEY</kbd>.</div>
<table><tr><th>Siapa</th><th>Buat apa</th></tr>
@foreach($konsumen as $k)
<tr><td><b>{{ $k['nama'] }}</b></td><td>{{ $k['pakai'] }}</td></tr>
@endforeach
</table>
</div>
<div class="card">
<h2>🛠 Arti hasil & yang dilakukan</h2>
<table>
<tr><th>Hasil</th><th>Artinya → lakukan ini</th></tr>
<tr><td><b>200 ✅</b></td><td>Berhasil. Siap dipakai.</td></tr>
<tr><td><b>401</b></td><td>Kunci salah → buka <a href="/settings">🔑 Token</a>, perbaiki, Simpan, coba lagi.</td></tr>
<tr><td><b>404</b></td><td>Nama data salah → pilih data lain di langkah 3.</td></tr>
<tr><td><b>500 / no-res</b></td><td>Aplikasi tujuan mati / tidak terjangkau → buka alamatnya langsung di browser.</td></tr>
</table>
</div>
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
function stamp(){const d=new Date();document.getElementById('upd').textContent='Terakhir: '+d.toLocaleTimeString('id-ID');}
async function loadStatus(silent){
  try{
    const r=await fetch(window.location.href.replace(/\/$/,'')+'/services-status'); const j=await r.json();
    for(const k in (j.data||{})){
      const v=j.data[k], d=document.getElementById('dot-'+k), m=document.getElementById('ms-'+k), e=document.getElementById('err-'+k);
      if(!d||!m)continue;
      d.className='dot '+(v.up?'ok':'bad');
      m.textContent=v.up?('Bisa ✔ · '+v.ms+'ms'):('Tidak ✘');
      m.className='pill '+(v.up?'p-ok':'p-bad');
      if(e)e.textContent=v.up?'':('Sebab: '+(v.err||'tidak menjawab ('+(v.http||'no-res')+')'));
    }
    stamp();
  }catch(e){ if(!silent){} }
}
function toggleAuto(){
  auto=!auto;
  document.getElementById('pauseBtn').textContent=auto?'⏸ Jeda':'▶ Jalan';
  if(auto)startAuto();
  else{clearInterval(timer);document.getElementById('cd').textContent='jeda';}
}
function startAuto(){
  clearInterval(timer); cd=30;
  timer=setInterval(()=>{
    cd--;
    if(cd<=0){loadStatus(true);cd=30;}
    document.getElementById('cd').textContent=auto?cd:'jeda';
  },1000);
}
async function jalanTes(){
  const out=document.getElementById('out'), btn=document.getElementById('goBtn');
  const kons=document.getElementById('kons').value, svc=document.getElementById('svc').value;
  const ep=document.getElementById('ep').value;
  const mode=document.querySelector('input[name=mode]:checked').value;
  btn.disabled=true; btn.textContent='⏳ Mencoba…';
  out.className='out'; out.textContent='Mencoba sebagai '+kons+' meminta '+ep+' '+(mode==='gateway'?'lewat gateway…':'langsung ke aplikasi…');
  try{
    const r=await fetch(window.location.href.replace(/\/$/,'')+'/test-endpoint',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({konsumen:kons,service:svc,path:ep,mode:mode})});
    const j=await r.json();
    if(j.success&&j.http<400){out.className='out ok';out.textContent='✅ BERHASIL ('+j.http+', '+j.ms+'ms)\n'+kons+' → '+svc.toUpperCase()+' '+ep+'\nJalur ini benar dan siap dipakai.\n\nCuplikan data:\n'+(j.body||'-').substring(0,400);}
    else if(j.http===401){out.className='out fail';out.innerHTML='❌ Kunci salah (401).\n'+kons+' → '+svc.toUpperCase()+'\nBuka <a href="/settings">🔑 Token</a>, perbaiki token '+svc.toUpperCase()+', Simpan, lalu coba lagi.';}
    else{out.className='out fail';out.textContent='⚠️ Belum berhasil ('+(j.http||'no-res')+', '+j.ms+'ms)\n'+kons+' → '+svc.toUpperCase()+'\nKemungkinan: token belum diisi (wajar sebelum weekend) atau aplikasi tujuan mati.\n\nDetail:\n'+((j.body||j.error||'-')).substring(0,400);}
  }catch(e){out.className='out fail';out.textContent='❌ Gateway tidak menjawab: '+e.message;}
  btn.disabled=false; btn.textContent='▶ Coba sekarang';
}
fillEp(); loadStatus(false); startAuto();
</script>
</body></html>
