<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Panel Gateway API</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:"Segoe UI",Arial,sans-serif}
body{background:#eef2f7;color:#1e293b}
.top{background:#0f2160;color:#fff;padding:10px 16px;position:sticky;top:0;z-index:5}
.topin{max-width:1280px;margin:0 auto;display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.top h1{font-size:15px}
.tabs{margin-left:auto;display:flex;gap:6px;align-items:center;flex-wrap:wrap}
.tabs button{font-size:12.5px;font-weight:700;padding:7px 12px;border-radius:8px;cursor:pointer;border:none;background:rgba(255,255,255,.12);color:#fff}
.tabs button.on{background:#fff;color:#0f2160;box-shadow:0 0 0 2px #fff}
.tabs .btn-t{background:#16a34a;color:#fff}.tabs .btn-t.on{background:#fff;color:#14532d}
.wrap{max-width:1280px;margin:0 auto;padding:12px 14px 28px}
.tabpage{display:none}.tabpage.on{display:block}
.hero{background:#fff;border:2px solid #16a34a;border-radius:10px;padding:8px 14px;margin-bottom:10px;display:flex;align-items:center;gap:10px}
.hero b{font-size:14px;color:#14532d}.hero p{font-size:11.5px;color:#475569}
.hero .auto{margin-left:auto;font-size:11px;color:#475569;text-align:right;white-space:nowrap}
.hero .auto button{border:2px solid #94a3b8;background:#fff;border-radius:7px;padding:4px 9px;font-size:11px;font-weight:700;cursor:pointer;margin-top:3px}
.card{background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;padding:12px 14px;margin-bottom:10px}
.card h2{font-size:13.5px;margin-bottom:2px}
.d{font-size:12px;color:#475569;margin-bottom:8px;line-height:1.5}
.d a{color:#1d4ed8;font-weight:700}
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
select,input.txt{width:100%;padding:8px 9px;border:2px solid #94a3b8;border-radius:8px;font-size:12.5px;background:#fff;color:#0f172a}
input.txt{font-family:Consolas,monospace}
.radio{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.radio label{border:2px solid #94a3b8;border-radius:8px;padding:8px;font-size:11.5px;cursor:pointer;text-align:center;line-height:1.4}
.radio label small{display:block;color:#64748b;font-weight:400}
.radio input{display:none}
button.act{width:100%;background:#1d4ed8;color:#fff;border:none;padding:11px;border-radius:9px;font-size:13.5px;font-weight:800;cursor:pointer;margin-top:9px}
button.act:disabled{background:#94a3b8;cursor:wait}
button.save{width:100%;background:#16a34a;color:#fff;border:none;padding:12px;border-radius:9px;font-size:14px;font-weight:800;cursor:pointer;margin-top:10px}
.out{border-radius:9px;padding:10px;margin-top:9px;font-size:12.5px;line-height:1.6;white-space:pre-wrap;border:2px solid #e2e8f0;background:#f8fafc;color:#1e293b}
.out.ok{border-color:#16a34a;background:#f0fdf4}
.out.fail{border-color:#dc2626;background:#fef2f2}
.out a{color:#1d4ed8;font-weight:800}
table{width:100%;border-collapse:collapse;font-size:12px}
th{background:#0f172a;color:#fff;padding:6px 8px;text-align:left;font-size:10.5px}
td{padding:7px 8px;border-bottom:1.5px solid #e2e8f0;vertical-align:top}
td code{font-family:Consolas,monospace;font-size:11px;background:#f1f5f9;padding:1px 5px;border-radius:5px;word-break:break-all}
.mtd{font-weight:800;font-size:10.5px;background:#1e3a8a;color:#fff;padding:2px 7px;border-radius:6px;white-space:nowrap}
.st{font-size:11px;font-weight:800;padding:2px 8px;border-radius:6px;white-space:nowrap}
.okk{background:#dcfce7;color:#14532d}.next{background:#fef9c3;color:#713f12}
.bar{height:12px;background:#e2e8f0;border-radius:8px;overflow:hidden;margin:8px 0}
.bar div{height:100%;background:#16a34a}
.item{display:flex;gap:10px;align-items:flex-start;padding:9px 4px;border-bottom:1.5px solid #e2e8f0;font-size:13px}
.item input{width:19px;height:19px;margin-top:1px;accent-color:#16a34a}
.item.done span{text-decoration:line-through;color:#64748b}
.sect{border:1.5px solid #e2e8f0;border-radius:9px;margin-bottom:10px;overflow:hidden}
.sect-h{background:#f8fafc;padding:8px 12px;font-size:13px;font-weight:800;border-bottom:1.5px solid #e2e8f0}
.sect-b{padding:10px 12px}
.fld{margin-bottom:9px}.fld label{font-size:12px;font-weight:800;display:block;margin-bottom:3px}
.fld .hint{font-size:11px;color:#64748b;margin-top:3px}
.okmsg{background:#dcfce7;border:1.5px solid #16a34a;color:#14532d;padding:9px;border-radius:8px;font-size:12.5px;font-weight:700;margin-bottom:8px}
.helpdesk{background:#eff6ff;border:2px solid #1d4ed8;border-radius:10px;padding:10px 12px;margin-bottom:10px;font-size:12.5px}
.mini{font-size:11.5px;color:#64748b;margin-top:6px;line-height:1.5}
kbd{background:#0f172a;color:#fff;padding:1px 7px;border-radius:6px;font-size:11px;font-family:Consolas,monospace}
</style>
</head><body>
<div class="top"><div class="topin">
<div style="font-size:22px">Gateway</div><h1>Gateway API</h1>
<div class="tabs" role="tablist">
<button id="nav-panel" class="on" onclick="showTab('panel')">Panel</button>
<button id="nav-rute" onclick="showTab('rute')">Rute</button>
<button id="nav-cutover" onclick="showTab('cutover')">Cutover</button>
<button id="nav-token" class="btn-t" onclick="showTab('token')">Token</button>
<button id="nav-help" onclick="showTab('help')">Bantuan</button>
<form method="POST" action="/logout" style="display:inline">@csrf<button type="submit">Keluar</button></form>
</div>
</div></div>
<div class="wrap">
<div class="tabpage on" id="tab-panel">
<div class="hero"><div style="font-size:24px">OK</div>
<div><b>Gateway hidup — 4 PUSAT di bawah ini kondisi terkini.</b><p>Hijau = bisa dihubungi. Merah = baca pesan merah kecilnya.</p></div>
<div class="auto">Otomatis tiap <b id="cd">30</b> dtk · <span id="upd">-</span><br><button id="pauseBtn" onclick="toggleAuto()">Jeda</button> <button onclick="loadStatus(false)">Cek</button></div>
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
<div class="d">Pura-pura jadi PENERIMA yang meminta ke PUSAT. Gagal 401 = kunci belum diisi (wajar).</div>
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
<label><input type="radio" name="mode" value="gateway" checked><b>Lewat gateway</b><small>Asli, kunci ditempel otomatis</small></label>
<label><input type="radio" name="mode" value="langsung"><b>Langsung</b><small>Tanpa gateway, pembanding</small></label>
</div>
<button class="act" id="goBtn" onclick="jalanTes()">Coba sekarang</button>
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
<p class="mini">200 = siap. 401 = perbaiki Token. Lainnya = lihat Bantuan.</p>
</div>
</div>
</div>
<div class="tabpage" id="tab-rute">
<div class="card">
<h2>Peta rute: gateway ke PUSAT</h2>
<div class="d">PENERIMA memanggil kolom <b>Gateway</b> lalu gateway meneruskan ke <b>PUSAT</b>. Aktif = bisa dipakai hari ini.</div>
<table><tr><th>Metode</th><th>Gateway (panggil ini)</th><th>PUSAT (tujuan)</th><th>Kunci</th><th>Status</th><th>Pemakai</th></tr>
@foreach($routesRows as $r)
<tr><td><span class="mtd">{{ $r[0] }}</span></td><td><code>{{ $r[1] }}</code></td><td><code>{{ $r[2] }}</code></td><td>{{ $r[3] }}</td><td><span class="st {{ strpos($r[4],'Aktif')!==false?'okk':'next' }}">{{ $r[4] }}</span></td><td>{{ $r[5] }}</td></tr>
@endforeach
</table>
</div>
</div>
<div class="tabpage" id="tab-cutover">
<div class="card">
<h2>Checklist cutover (weekend)</h2>
<div style="font-size:13px"><b id="coDone">{{ $cutoverDone }}/{{ $cutoverTotal }}</b> selesai</div>
<div class="bar"><div id="coBar" style="width:{{ $cutoverTotal?round($cutoverDone/$cutoverTotal*100):0 }}%"></div></div>
<div id="coMsg"></div>
<form id="coForm" method="POST" action="/cutover">@csrf
@foreach($cutoverItems as $it)
<label class="item {{ $it['done']?'done':'' }}"><input type="checkbox" name="done[]" value="{{ $it['id'] }}" {{ $it['done']?'checked':'' }} onchange="saveCutover()"><span>{{ $it['nama'] }}</span></label>
@endforeach
</form>
</div>
</div>
<div class="tabpage" id="tab-token">
<div class="card">
<h2>Token PUSAT (isi sekali, berlaku langsung)</h2>
<div class="d">Tanpa oprek kode.</div>
<div id="tokMsg"></div>
<form id="tokForm" method="POST" action="/settings">@csrf
<div class="sect"><div class="sect-h">1. Kunci gateway (dibagikan ke PENERIMA)</div><div class="sect-b">
<div class="fld"><label>GATEWAY_TOKEN</label><input class="txt" name="GATEWAY_TOKEN" value="{{ $setValues['GATEWAY_TOKEN'] ?? '' }}"></div>
</div></div>
<div class="sect"><div class="sect-h">2. MIS (crm.lsfragrance.id)</div><div class="sect-b">
<div class="fld"><label>MIS_BASE_URL</label><input class="txt" name="MIS_BASE_URL" value="{{ $setValues['MIS_BASE_URL'] ?? '' }}"></div>
<div class="fld"><label>MIS_API_KEY (= API_SECRET_KEY di .env MIS)</label><input class="txt" name="MIS_API_KEY" value="{{ $setValues['MIS_API_KEY'] ?? '' }}"></div>
</div></div>
<div class="sect"><div class="sect-h">3. AO (sys-af.lsfragrance.id)</div><div class="sect-b">
<div class="fld"><label>AO_BASE_URL</label><input class="txt" name="AO_BASE_URL" value="{{ $setValues['AO_BASE_URL'] ?? '' }}"></div>
<div class="fld"><label>AGENDA_TOKEN</label><input class="txt" name="AGENDA_TOKEN" value="{{ $setValues['AGENDA_TOKEN'] ?? '' }}"></div>
<div class="fld"><label>AO_KEY (= X-AO-KEY)</label><input class="txt" name="AO_KEY" value="{{ $setValues['AO_KEY'] ?? '' }}"></div>
</div></div>
<div class="sect"><div class="sect-h">4. Transaksi (trans.lssoft88.xyz)</div><div class="sect-b">
<div class="fld"><label>TRANS_BASE_URL</label><input class="txt" name="TRANS_BASE_URL" value="{{ $setValues['TRANS_BASE_URL'] ?? '' }}"></div>
<div class="fld"><label>AO_API_KEY</label><input class="txt" name="AO_API_KEY" value="{{ $setValues['AO_API_KEY'] ?? '' }}"></div>
<div class="fld"><label>USER_API_KEY</label><input class="txt" name="USER_API_KEY" value="{{ $setValues['USER_API_KEY'] ?? '' }}"></div>
</div></div>
<div class="sect"><div class="sect-h">5. Drive (drive.lssoft88.xyz)</div><div class="sect-b">
<div class="fld"><label>DRIVE_BASE_URL</label><input class="txt" name="DRIVE_BASE_URL" value="{{ $setValues['DRIVE_BASE_URL'] ?? '' }}"></div>
<div class="fld"><label>DRIVE_API_KEY (opsional)</label><input class="txt" name="DRIVE_API_KEY" value="{{ $setValues['DRIVE_API_KEY'] ?? '' }}"></div>
</div></div>
<div class="sect"><div class="sect-h">6. Login panel ini</div><div class="sect-b">
<div class="fld"><label>ADMIN_USER</label><input class="txt" name="ADMIN_USER" value="{{ $setValues['ADMIN_USER'] ?? '' }}"></div>
<div class="fld"><label>ADMIN_PASS (kosongkan = tidak ganti)</label><input class="txt" name="ADMIN_PASS" value="" placeholder="(kosongkan = tidak ganti)"></div>
</div></div>
<button class="save" id="tokBtn">Simpan semua — berlaku langsung</button>
</form>
</div>
</div>
<div class="tabpage" id="tab-help">
<div class="card" style="border-color:#1d4ed8;background:#eff6ff">
<b>Helpdesk:</b> <span style="font-size:12.5px">sertakan jam + PENERIMA + PUSAT + copy hasil tes. Jangan kirim kunci asli di chat umum.</span>
</div>
<div class="card">
<h2>Istilah baku</h2>
<table><tr><th>Istilah</th><th>Artinya</th><th>Contoh</th></tr>
<tr><td><b>PUSAT</b></td><td>Pemilik data asli (tujuan akhir).</td><td>MIS, AO, Transaksi, Drive</td></tr>
<tr><td><b>PENERIMA</b></td><td>Pemakai yang meminta lewat gateway (<kbd>X-GW-KEY</kbd>).</td><td>MIS, AO, APM, Landing, Picker</td></tr>
<tr><td><b>Gateway</b></td><td>1 pintu di tengah.</td><td><kbd>gw.lssoft88.xyz</kbd></td></tr>
</table>
</div>
<div class="card">
<h2>Arti hasil</h2>
<table><tr><th>Hasil</th><th>Lakukan ini</th></tr>
<tr><td><b>200</b></td><td>Berhasil, siap dipakai.</td></tr>
<tr><td><b>401</b></td><td>Buka tab Token, perbaiki, Simpan, coba lagi.</td></tr>
<tr><td><b>404</b></td><td>Salah data, pilih lain di langkah 3.</td></tr>
<tr><td><b>500 / no-res</b></td><td>PUSAT mati / tak terjangkau — buka alamatnya langsung.</td></tr>
</table>
</div>
<div class="card">
<h2>Panel tak bisa dibuka?</h2>
<p style="font-size:12.5px;line-height:1.7">Halaman tak terbuka = Apache/hosting mati. Diminta login terus = sesi habis, login ulang. Semua PUSAT merah = server tak bisa keluar internet (lapor admin + hosting).</p>
</div>
</div>
</div>
<script>
var UJI = @json($uji);
var CSRF = @json(csrf_token());
var auto = true, cd = 30, timer = null;
function showTab(name){
  var pages = document.querySelectorAll('.tabpage');
  for (var i=0;i<pages.length;i++) pages[i].classList.remove('on');
  var btns = document.querySelectorAll('.tabs button');
  for (var j=0;j<btns.length;j++) btns[j].classList.remove('on');
  document.getElementById('tab-'+name).classList.add('on');
  var nav = document.getElementById('nav-'+name);
  if (nav) nav.classList.add('on');
  try { location.hash = name; } catch(e){}
  if (name==='panel') loadStatus(false);
  window.scrollTo(0,0);
}
function fillEp(){
  var s=document.getElementById('svc').value, ep=document.getElementById('ep');
  ep.innerHTML='';
  (UJI[s]||[]).forEach(function(e){var o=document.createElement('option');o.value=e.path;o.textContent=e.label;ep.appendChild(o);});
}
function stamp(){var d=new Date();document.getElementById('upd').textContent=d.toLocaleTimeString('id-ID');}
async function loadStatus(silent){
  try{
    var r=await fetch(location.origin+'/services-status'); var j=await r.json();
    var data=j.data||{};
    for(var k in data){
      var v=data[k], d=document.getElementById('dot-'+k), m=document.getElementById('ms-'+k), e=document.getElementById('err-'+k);
      if(!d||!m)continue;
      d.className='dot '+(v.up?'ok':'bad');
      m.textContent=v.up?(v.ms+'ms ok'):('Tidak');
      m.className='pill '+(v.up?'p-ok':'p-bad');
      if(e)e.textContent=v.up?'':('Sebab: '+(v.err||'tidak menjawab'));
    }
    stamp();
  }catch(e){}
}
function toggleAuto(){
  auto=!auto;
  document.getElementById('pauseBtn').textContent=auto?'Jeda':'Jalan';
  if(auto)startAuto();
  else{clearInterval(timer);document.getElementById('cd').textContent='jeda';}
}
function startAuto(){
  clearInterval(timer); cd=30;
  timer=setInterval(function(){cd--;if(cd<=0){loadStatus(true);cd=30;}document.getElementById('cd').textContent=auto?cd:'jeda';},1000);
}
async function jalanTes(){
  var out=document.getElementById('out'), btn=document.getElementById('goBtn');
  var kons=document.getElementById('kons').value, svc=document.getElementById('svc').value;
  var ep=document.getElementById('ep').value;
  var mode=document.querySelector('input[name=mode]:checked').value;
  btn.disabled=true; btn.textContent='Mencoba...';
  out.className='out'; out.textContent='Mencoba...';
  try{
    var r=await fetch(location.origin+'/test-endpoint',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({konsumen:kons,service:svc,path:ep,mode:mode})});
    var jj=await r.json();
    if(jj.success&&jj.http<400){out.className='out ok';out.textContent='BERHASIL ('+jj.http+', '+jj.ms+'ms). Siap dipakai.\n\n'+(jj.body||'').substring(0,300);}
    else if(jj.http===401){out.className='out fail';out.innerHTML='Kunci salah (401). Buka tab Token, perbaiki, Simpan, coba lagi.';}
    else{out.className='out fail';out.textContent='Gagal ('+(jj.http||'no-res')+'). '+(jj.body||jj.error||'').substring(0,300);}
  }catch(e){out.className='out fail';out.textContent='Gateway tidak menjawab: '+e.message;}
  btn.disabled=false; btn.textContent='Coba sekarang';
}
async function saveCutover(){
  var form=document.getElementById('coForm');
  var fd=new FormData(form);
  await fetch('/cutover',{method:'POST',headers:{'X-CSRF-TOKEN':CSRF},body:fd});
  var boxes=form.querySelectorAll('input[type=checkbox]');
  var done=0; boxes.forEach(function(b){if(b.checked)done++;b.closest('.item').classList.toggle('done',b.checked);});
  document.getElementById('coDone').textContent=done+'/'+boxes.length;
  document.getElementById('coBar').style.width=(boxes.length?Math.round(done/boxes.length*100):0)+'%';
  document.getElementById('coMsg').innerHTML='<div class="okmsg">Progres tersimpan.</div>';
}
document.getElementById('tokForm').addEventListener('submit',async function(e){
  e.preventDefault();
  var btn=document.getElementById('tokBtn'), msg=document.getElementById('tokMsg');
  btn.disabled=true; btn.textContent='Menyimpan...';
  try{
    await fetch('/settings',{method:'POST',headers:{'X-CSRF-TOKEN':CSRF},body:new FormData(e.target)});
    msg.innerHTML='<div class="okmsg">Tersimpan dan langsung berlaku.</div>';
  }catch(err){msg.innerHTML='<div class="out fail">Gagal menyimpan.</div>';}
  btn.disabled=false; btn.textContent='Simpan semua — berlaku langsung';
});
(function(){
  var h=(location.hash||'').replace('#','');
  if(['panel','rute','cutover','token','help'].indexOf(h)>=0)showTab(h);
  fillEp(); loadStatus(false); startAuto();
})();
</script>
</body></html>
