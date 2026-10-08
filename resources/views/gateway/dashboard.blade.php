<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Panel Gateway API</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial,sans-serif}
body{background:#e8edf3;color:#16233a}
.top{background:#0f2160;color:#fff;padding:12px 18px;position:sticky;top:0;z-index:5}
.topin{max-width:1360px;margin:0 auto;display:flex;align-items:center;gap:10px}
.top h1{font-size:16px}.top small{color:#c7d6ff;font-size:12px;display:block}
.top .acts{margin-left:auto;display:flex;gap:8px}
.btn-t{background:#16a34a;color:#fff;padding:8px 14px;border-radius:9px;text-decoration:none;font-size:13px;font-weight:800}
.btn-o{background:rgba(255,255,255,.15);color:#fff;border:none;padding:8px 12px;border-radius:9px;font-size:13px;cursor:pointer}
.wrap{max-width:1360px;margin:0 auto;padding:12px 14px 24px}
.pgrid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;margin-top:8px}
@media(max-width:1100px){.pgrid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:640px){.pgrid{grid-template-columns:1fr}}
.pitem{border:1.5px solid #e2e8f0;border-radius:10px;padding:10px;background:#f8fafc}
.pitem small{display:block}.errline{color:#b91c1c !important;font-weight:700}
.cols2{display:grid;grid-template-columns:minmax(0,1fr) 350px;gap:10px;align-items:start;margin-top:10px}
@media(max-width:1000px){.cols2{grid-template-columns:1fr}}
.hero{background:#fff;border:2px solid #16a34a;border-radius:12px;padding:10px 16px;margin-bottom:10px;display:flex;align-items:center;gap:12px;text-align:left}
.hero .ic{font-size:28px}.hero b{font-size:16px;color:#14532d}.hero p{font-size:12.5px;color:#334155}
.cols{display:grid;grid-template-columns:320px minmax(0,1fr) 360px;gap:10px;align-items:start}
@media(max-width:1100px){.cols{grid-template-columns:1fr 1fr}}
@media(max-width:720px){.cols{grid-template-columns:1fr}.hero{flex-direction:column;text-align:center}}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:14px;padding:14px 16px;margin-bottom:12px}
.card h2{font-size:15px;margin-bottom:2px}
.tag{display:inline-block;font-size:10.5px;font-weight:800;padding:2px 8px;border-radius:6px;letter-spacing:.5px;margin-bottom:6px}
.t-pusat{background:#dbeafe;color:#1e3a8a;border:1px solid #3b82f6}
.t-kons{background:#dcfce7;color:#14532d;border:1px solid #16a34a}
.d{font-size:12.5px;color:#475569;margin-bottom:10px;line-height:1.55}
table{width:100%;border-collapse:collapse;font-size:13px}
th{background:#0f172a;color:#fff;padding:8px;text-align:left;font-size:11.5px}
td{padding:9px 8px;border-bottom:1.5px solid #e2e8f0;vertical-align:top;color:#1e293b}
td small{font-family:Consolas,monospace;font-size:11.5px;color:#475569;display:block}
.dot{display:inline-block;width:12px;height:12px;border-radius:50%;background:#eab308;margin-right:6px;vertical-align:middle}
.dot.ok{background:#16a34a}.dot.bad{background:#dc2626}
.pill{font-size:12px;font-weight:800;padding:3px 9px;border-radius:7px;white-space:nowrap}
.p-ok{background:#dcfce7;color:#14532d;border:1.5px solid #16a34a}.p-bad{background:#fee2e2;color:#7f1d1d;border:1.5px solid #dc2626}.p-wait{background:#fef9c3;color:#713f12;border:1.5px solid #eab308}
label.f{font-size:12.5px;font-weight:800;display:block;margin:10px 0 4px;color:#0f172a}
select{width:100%;padding:10px;border:2px solid #94a3b8;border-radius:9px;font-size:13.5px;background:#fff;color:#0f172a}
.radio{display:flex;gap:8px;margin-top:6px}
.radio label{flex:1;border:2px solid #94a3b8;border-radius:9px;padding:9px;font-size:12.5px;cursor:pointer;text-align:center}
.radio input{display:none}
.radio input:checked+span{font-weight:800}
.radio label:has(input:checked){border-color:#1d4ed8;background:#eff6ff}
button.act{width:100%;background:#1d4ed8;color:#fff;border:none;padding:12px;border-radius:10px;font-size:14.5px;font-weight:800;cursor:pointer;margin-top:10px}
.out{background:#0f172a;color:#e2e8f0;border-radius:10px;padding:12px;margin-top:10px;font-size:13px;line-height:1.6;white-space:pre-wrap}
table.err{font-size:12.5px}table.err td:first-child{font-weight:800;white-space:nowrap}
kbd{background:#0f172a;color:#fff;padding:1px 7px;border-radius:6px;font-size:11.5px;font-family:Consolas,monospace}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:26px">🚪</div>
<div><h1>Panel Gateway API</h1><small>1 pintu untuk semua aplikasi</small></div>
<div class="acts"><a class="btn-t" href="/settings">🔑 Token</a>
<form method="POST" action="/logout" style="display:inline">@csrf<button class="btn-o">Keluar</button></form></div>
</div></div>
<div class="wrap">
<div class="hero"><div class="ic">✅</div><div><b>Gateway HIDUP dan siap dipakai</b><p>Baris status = PUSAT (tujuan akhir). Bawah = uji per konsumen + konsumen + tabel error.</p></div></div>
<div class="card">
<div style="display:flex;align-items:center;gap:8px;margin-bottom:4px"><span class="tag t-pusat">A — PUSAT (TUJUAN AKHIR, bukan pengirim)</span>
<button onclick="loadStatus()" style="margin-left:auto;border:2px solid #94a3b8;background:#fff;border-radius:8px;padding:6px 12px;font-size:12px;font-weight:700;cursor:pointer">🔄 Cek ulang</button></div>
<div class="d">Yang <b>menyimpan data asli</b>. Merah = server gateway tidak bisa mencapai pusat (lihat pesan kecil di bawah status).</div>
<div class="pgrid">
@foreach($pusat as $key => $p)
<div class="pitem"><div style="display:flex;align-items:center;gap:7px"><span class="dot" id="dot-{{ $key }}"></span><b>{{ $p['nama'] }}</b>
<span class="pill p-wait" id="ms-{{ $key }}" style="margin-left:auto">Cek…</span></div>
<small>{{ $p['peran'] }}</small><small>{{ $p['url'] }}</small>
<small class="errline" id="err-{{ $key }}"></small></div>
@endforeach
</div>
</div>
<div class="cols2">

<div class="card">
<span class="tag t-pusat">C — UJI KONEKSI (per konsumen + per endpoint)</span>
<h2>Tes 2 jalur: via gateway / langsung ke pusat</h2>
<div class="d"><b>Via Gateway</b> = kondisi asli (gateway tempelkan kunci otomatis). <b>Langsung</b> = tembak pusat tanpa gateway, untuk vonis pusatnya hidup/mati.</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
<div><label class="f">1. Sebagai konsumen</label>
<select id="kons"><option>MIS</option><option>AO</option><option>APM</option><option>LANDING</option><option>PICKER</option></select></div>
<div><label class="f">2. Pusat dituju</label>
<select id="svc" onchange="fillEp()">
@foreach($pusat as $key => $p)<option value="{{ $key }}">{{ $p['nama'] }} — {{ $p['peran'] }}</option>@endforeach
</select></div>
</div>
<label class="f">3. Endpoint</label>
<select id="ep"></select>
<label class="f">4. Jalur</label>
<div class="radio">
<label><input type="radio" name="mode" value="gateway" checked><span>↔ Via Gateway</span></label>
<label><input type="radio" name="mode" value="langsung"><span>→ Langsung</span></label>
</div>
<button class="act" onclick="jalanTes()">▶ Jalankan tes</button>
<div class="out" id="out">Belum dites.</div>
<div class="d" style="margin-top:8px">Pakai: <b>/api/v1/drive/list?path=/</b> + header <b>X-GW-KEY</b> · 200 = ok, 401 = kunci salah.</div>
</div>

<div>
<div class="card">
<h2>🛠 Error & penanganan</h2>
<table class="err">
<tr><th>Hasil</th><th>Penanganan</th></tr>
<tr><td>200 ✅</td><td>Berhasil, siap dipakai.</td></tr>
<tr><td>401</td><td>Gateway: betulkan di 🔑 Token. Langsung: wajar (butuh kunci).</td></tr>
<tr><td>404</td><td>Salah endpoint, pilih lain.</td></tr>
<tr><td>500/0</td><td>Pusat mati — buka alamat pusat langsung.</td></tr>
<tr><td>Langsung OK, Gateway 401</td><td>Token di gateway salah → perbaiki di 🔑 Token.</td></tr>
<tr><td>no-res / timeout</td><td>Server gateway tidak bisa keluar ke internet / DNS diblokir host → cek curl di Terminal + tanya Jagoan Hosting soal outbound.</td></tr>
</table>
</div>
<div class="card">
<span class="tag t-kons">B — KONSUMEN (PENGIRIM, pemakai X-GW-KEY)</span>
<table><tr><th>Siapa</th><th>Untuk apa</th></tr>
@foreach($konsumen as $k)
<tr><td><b>{{ $k['nama'] }}</b></td><td style="font-size:12px">{{ $k['pakai'] }}</td></tr>
@endforeach
</table>
</div>
</div>
</div>
<script>
const UJI = @json($uji);
const CSRF = @json(csrf_token());
function fillEp(){
  const s=document.getElementById('svc').value, ep=document.getElementById('ep');
  ep.innerHTML='';
  (UJI[s]||[]).forEach((e,i)=>{const o=document.createElement('option');o.value=e.path;o.textContent=e.label;ep.appendChild(o);});
}
async function loadStatus(){
  try{
    const r=await fetch(window.location.href.replace(/\/$/,'')+'/services-status'); const j=await r.json();
    for(const k in j.data){
      const v=j.data[k], d=document.getElementById('dot-'+k), m=document.getElementById('ms-'+k), e=document.getElementById('err-'+k);
      if(!d||!m)continue;
      d.className='dot '+(v.up?'ok':'bad');
      m.textContent=v.up?('Terhubung ✔ · '+v.ms+'ms'):('Putus ✘ · '+(v.http||'no-res'));
      m.className='pill '+(v.up?'p-ok':'p-bad');
      if(e)e.textContent=v.up?'':('⁉ '+(v.err||'pusat tidak menjawab, cek outbound/DNS server'));
    }
  }catch(e){}
}
async function jalanTes(){
  const out=document.getElementById('out');
  const kons=document.getElementById('kons').value, svc=document.getElementById('svc').value;
  const ep=document.getElementById('ep').value;
  const mode=document.querySelector('input[name=mode]:checked').value;
  out.textContent='⏳ Mengetes sebagai '+kons+' → '+svc.toUpperCase()+' '+ep+' ('+(mode==='gateway'?'via gateway':'langsung ke pusat')+')…';
  try{
    const r=await fetch(window.location.href.replace(/\/$/,'')+'/test-endpoint',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({konsumen:kons,service:svc,path:ep,mode:mode})});
    const j=await r.json();
    if(j.success&&j.http<400){out.textContent='✅ BERHASIL ('+j.http+', '+j.ms+'ms)\nSebagai: '+kons+' | Jalur: '+mode+'\n\nArtinya: jalur ini BENAR dan siap dipakai.\n\nCuplikan:\n'+(j.body||'-').substring(0,500);}
    else if(j.http===401){out.textContent='❌ 401 Kunci salah.\nSebagai: '+kons+' | Jalur: '+mode+'\n\nPenanganan:\n- Jalur gateway → buka 🔑 Token, perbaiki token '+svc.toUpperCase()+', Simpan, tes ulang.\n- Jalur langsung → wajar untuk endpoint privat (memang butuh kunci).';}
    else{out.textContent='⚠️ Gagal ('+(j.http||'no-res')+', '+j.ms+'ms)\nSebagai: '+kons+' | Jalur: '+mode+'\n\nPenanganan: lihat tabel error. Kemungkinan pusat '+svc.toUpperCase()+' mati / alamat salah.\n\nDetail:\n'+((j.body||j.error||'-')).substring(0,500);}
  }catch(e){out.textContent='❌ Tidak bisa menghubungi gateway: '+e.message;}
}
fillEp(); loadStatus();
</script>
</body></html>
