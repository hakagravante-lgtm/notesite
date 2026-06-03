<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notesite</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
:root{--blue:#2563EB;--dark:#1E293B;--bg:#F1F5F9;--gray:#94A3B8;--red:#EF4444;--green:#22C55E;--sw:220px}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Arial,sans-serif;background:var(--bg)}
#tb{position:fixed;top:16px;right:16px;z-index:9999;display:flex;flex-direction:column;gap:6px}
.tm{background:var(--dark);color:#fff;padding:10px 16px;border-radius:8px;font-size:13px;min-width:220px;animation:si .3s;transition:opacity .4s}
.tm.ok{border-left:4px solid var(--green)}.tm.err{border-left:4px solid var(--red)}
@keyframes si{from{opacity:0;transform:translateX(40px)}to{opacity:1;transform:translateX(0)}}
.auth{min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#EFF6FF,#DBEAFE)}
.abox{background:#fff;padding:36px;border-radius:14px;width:100%;max-width:380px;box-shadow:0 8px 24px rgba(0,0,0,.1)}
.abox .logo{font-size:24px;font-weight:700;color:var(--dark);margin-bottom:4px}
.abox .logo span{color:var(--blue)}
.em{color:var(--red);font-size:12px;display:none;margin-top:3px}
.app{display:flex;min-height:100vh}
.sb{width:var(--sw);background:var(--dark);color:#fff;position:fixed;top:0;left:0;height:100vh;display:flex;flex-direction:column}
.sb .brand{padding:20px 16px;font-size:18px;font-weight:700;border-bottom:1px solid rgba(255,255,255,.1)}
.sb .brand span{color:var(--blue)}
.sb nav{flex:1;padding:10px}
.nl{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:8px;color:rgba(255,255,255,.65);text-decoration:none;font-size:14px;cursor:pointer;margin-bottom:3px}
.nl:hover,.nl.on{background:var(--blue);color:#fff}
.ub{padding:14px;border-top:1px solid rgba(255,255,255,.1);display:flex;align-items:center;gap:8px}
.av{width:34px;height:34px;border-radius:8px;background:var(--blue);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;overflow:hidden;flex-shrink:0}
.av img{width:100%;height:100%;object-fit:cover}
.mn{margin-left:var(--sw);flex:1}
.bar{background:#fff;padding:14px 24px;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;gap:10px;position:sticky;top:0;z-index:10}
.bar h5{margin:0;font-size:17px}.bar .ra{margin-left:auto;display:flex;gap:8px;align-items:center}
.pg{padding:24px;display:none}.pg.on{display:block}
.box{background:#fff;border-radius:12px;padding:18px;box-shadow:0 1px 4px rgba(0,0,0,.07);margin-bottom:16px}
.sc{background:#fff;border-radius:12px;padding:18px;box-shadow:0 1px 4px rgba(0,0,0,.07);display:flex;align-items:center;gap:14px}
.si{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.si.b{background:#DBEAFE;color:var(--blue)}.si.g{background:#DCFCE7;color:#16A34A}
.si.y{background:#FEF9C3;color:#CA8A04}.si.r{background:#FEE2E2;color:var(--red)}
.sn{font-size:26px;font-weight:700}.sl{font-size:12px;color:var(--gray)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:12px}
.nc{background:#fff;border-radius:10px;padding:16px;box-shadow:0 1px 4px rgba(0,0,0,.07);border-top:4px solid var(--blue);transition:.2s}
.nc:hover{transform:translateY(-2px);box-shadow:0 4px 14px rgba(0,0,0,.1)}
.nc.cb{border-color:var(--blue)}.nc.cg{border-color:var(--green)}.nc.cy{border-color:#F59E0B}.nc.cr{border-color:var(--red)}
.ntag{font-size:11px;background:var(--bg);border-radius:20px;padding:2px 8px;color:var(--gray)}
.ntt{font-size:15px;font-weight:700;margin:7px 0 5px}
.nb{font-size:13px;color:var(--gray);overflow:hidden;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical}
.nf{display:flex;justify-content:space-between;align-items:center;margin-top:10px}
.nd{font-size:11px;color:var(--gray)}.nbs{display:flex;gap:5px}
.ib{width:26px;height:26px;border:none;border-radius:6px;background:var(--bg);cursor:pointer;font-size:11px}
.ib.e:hover{background:var(--blue);color:#fff}.ib.d:hover{background:var(--red);color:#fff}
table{width:100%;border-collapse:collapse}
thead th{font-size:11px;text-transform:uppercase;color:var(--gray);padding:0 10px 8px;border-bottom:1px solid #E2E8F0}
tbody tr{border-bottom:1px solid #F1F5F9}tbody tr:hover{background:#F8FAFC}
tbody td{padding:11px 10px;font-size:13px}
.bd{display:inline-block;padding:2px 9px;border-radius:20px;font-size:11px;font-weight:600}
.bd.ad{background:#DBEAFE;color:var(--blue)}.bd.us{background:#DCFCE7;color:#16A34A}
/* Role badge in sidebar */
.rbadge{font-size:10px;padding:2px 7px;border-radius:20px;font-weight:700;margin-left:auto}
.rbadge.admin{background:#2563EB;color:#fff}
.rbadge.user{background:rgba(255,255,255,.15);color:rgba(255,255,255,.7)}
/* Admin-only nav divider */
.nav-section{font-size:10px;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.3);padding:10px 12px 4px;margin-top:6px}
.mo{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:100;display:none;align-items:center;justify-content:center}
.mb{background:#fff;border-radius:14px;padding:26px;width:100%;max-width:440px;position:relative;max-height:90vh;overflow-y:auto}
.mb h5{font-size:18px;margin-bottom:16px}
.xb{position:absolute;top:14px;right:14px;border:none;background:var(--bg);border-radius:6px;width:28px;height:28px;cursor:pointer}
input,select,textarea{width:100%;border:1.5px solid #E2E8F0;border-radius:8px;padding:9px 12px;font-size:13px;font-family:Arial;margin-top:3px;outline:none}
input:focus,select:focus,textarea:focus{border-color:var(--blue)}
label{font-size:12px;font-weight:700;color:var(--dark)}
textarea{resize:vertical;min-height:90px}
.clrs{display:flex;gap:7px;margin-top:6px}
.cl{width:24px;height:24px;border-radius:50%;cursor:pointer;border:3px solid transparent;transition:.15s}
.cl.on,.cl:hover{border-color:var(--dark);transform:scale(1.2)}
.bb{background:var(--blue);color:#fff;border:none;border-radius:8px;padding:9px 18px;font-size:13px;font-weight:700;cursor:pointer}
.bg{background:var(--bg);color:var(--dark);border:none;border-radius:8px;padding:9px 14px;font-size:13px;cursor:pointer}
.br{background:var(--red);color:#fff;border:none;border-radius:8px;padding:9px 18px;font-size:13px;font-weight:700;cursor:pointer}
.pav{width:72px;height:72px;border-radius:14px;background:var(--blue);color:#fff;display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:700;cursor:pointer;overflow:hidden;border:3px solid #E2E8F0;position:relative;margin-bottom:10px}
.pav img{width:100%;height:100%;object-fit:cover}
.pav .cam{position:absolute;inset:0;background:rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;color:#fff;opacity:0;transition:.2s}
.pav:hover .cam{opacity:1}
.empty{text-align:center;padding:40px;color:var(--gray)}
.empty i{font-size:36px;opacity:.3;display:block;margin-bottom:10px}
.ch{height:200px;position:relative}
#ld{position:fixed;inset:0;background:rgba(255,255,255,.7);z-index:200;display:none;align-items:center;justify-content:center}
#ld .sp{width:36px;height:36px;border:4px solid #DBEAFE;border-top-color:var(--blue);border-radius:50%;animation:spin .7s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
/* Access denied page */
.denied{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:60vh;color:var(--gray);text-align:center}
.denied i{font-size:52px;opacity:.25;margin-bottom:14px}
.denied h4{color:var(--dark);margin-bottom:8px}
.denied p{font-size:13px;max-width:260px}
</style>
</head>
<body>

<div id="ld"><div class="sp"></div></div>
<div id="tb"></div>

<!-- LOGIN -->
<div id="LP" class="auth">
  <div class="abox">
    <div class="logo">Note<span>Log</span></div>
    <p style="color:var(--gray);font-size:13px;margin-bottom:20px">Sign in to your notes.</p>
    <div class="mb-2"><label>Email</label><input id="le" type="email" placeholder="you@email.com"><div class="em" id="lee">Enter your email.</div></div>
    <div class="mb-3"><label>Password</label><input id="lp" type="password" placeholder="Password"><div class="em" id="lpe">Wrong email or password.</div></div>
    <button class="bb w-100 mb-2" onclick="login()">Sign In</button>
    <p style="text-align:center;font-size:13px;color:var(--gray)">No account? <a href="#" onclick="swap('RP')" style="color:var(--blue)">Register</a></p>
    <p style="text-align:center;font-size:11px;color:var(--gray);margin-top:6px"></p>
  </div>
</div>

<!-- REGISTER -->
<div id="RP" class="auth" style="display:none">
  <div class="abox">
    <div class="logo">Note<span>Log</span></div>
    <p style="color:var(--gray);font-size:13px;margin-bottom:20px">Create your account.</p>
    <div class="mb-2"><label>Full Name</label><input id="rn" placeholder="Juan Dela Cruz"><div class="em" id="rne">Enter your name.</div></div>
    <div class="mb-2"><label>Email</label><input id="re" type="email" placeholder="you@email.com"><div class="em" id="ree">Enter a valid email.</div></div>
    <div class="mb-3"><label>Password</label><input id="rp" type="password" placeholder="Min. 6 characters"><div class="em" id="rpe">Need at least 6 characters.</div></div>
    <button class="bb w-100 mb-2" onclick="reg()">Create Account</button>
    <p style="text-align:center;font-size:13px;color:var(--gray)">Have account? <a href="#" onclick="swap('LP')" style="color:var(--blue)">Sign in</a></p>
  </div>
</div>

<!-- MAIN APP -->
<div id="AP" style="display:none">
  <div class="app">
    <aside class="sb">
      <div class="brand">Note<span>Log</span> 📓</div>
      <nav id="snav">
        <!-- Built dynamically based on role -->
      </nav>
      <div class="ub">
        <div class="av" id="sav">U</div>
        <div style="flex:1;overflow:hidden">
          <div style="font-size:13px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis" id="snm">User</div>
          <div style="font-size:11px;color:var(--gray);white-space:nowrap;overflow:hidden;text-overflow:ellipsis" id="sem">-</div>
        </div>
        <button onclick="logout()" style="background:none;border:none;color:var(--gray);cursor:pointer;font-size:17px"><i class="bi bi-box-arrow-right"></i></button>
      </div>
    </aside>

    <main class="mn">
      <!-- DASHBOARD (admin only) -->
      <div id="DP" style="display:none">
        <div class="bar"><h5>Dashboard</h5></div>
        <div class="pg on">
          <div class="row g-3 mb-3">
            <div class="col-6 col-md-3"><div class="sc"><div class="si b"><i class="bi bi-journal-text"></i></div><div><div class="sn" id="stN">0</div><div class="sl">My Notes</div></div></div></div>
            <div class="col-6 col-md-3"><div class="sc"><div class="si g"><i class="bi bi-people"></i></div><div><div class="sn" id="stU">0</div><div class="sl">Total Users</div></div></div></div>
            <div class="col-6 col-md-3"><div class="sc"><div class="si y"><i class="bi bi-tags"></i></div><div><div class="sn" id="stC">0</div><div class="sl">Categories</div></div></div></div>
            <div class="col-6 col-md-3"><div class="sc"><div class="si r"><i class="bi bi-calendar-check"></i></div><div><div class="sn" id="stT">0</div><div class="sl">Added Today</div></div></div></div>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-md-7"><div class="box"><strong style="font-size:14px">Notes by Category</strong><div class="ch mt-2"><canvas id="cc"></canvas></div></div></div>
            <div class="col-md-5"><div class="box"><strong style="font-size:14px">Users Overview</strong><div class="ch mt-2"><canvas id="uc"></canvas></div></div></div>
          </div>
          <div class="box"><strong style="font-size:14px">Recent Notes</strong><div id="rl" class="mt-2"></div></div>
        </div>
      </div>

      <!-- NOTES -->
      <div id="NP" style="display:none">
        <div class="bar"><h5>My Notes</h5>
          <div class="ra">
            <input id="sr" placeholder="Search..." oninput="showN()" style="width:180px;margin:0;padding:8px 10px">
            <button class="bb" onclick="openNM()"><i class="bi bi-plus"></i> New Note</button>
          </div>
        </div>
        <div class="pg on"><div id="ng" class="grid"></div></div>
      </div>

      <!-- USERS (admin only) -->
      <div id="UP" style="display:none">
        <div class="bar"><h5>Users</h5><div class="ra"><button class="bb" onclick="openUM()"><i class="bi bi-plus"></i> Add User</button></div></div>
        <div class="pg on"><div class="box">
          <table><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th><th>Actions</th></tr></thead>
          <tbody id="utb"></tbody></table>
        </div></div>
      </div>

      <!-- PROFILE -->
      <div id="PP" style="display:none">
        <div class="bar"><h5>My Profile</h5></div>
        <div class="pg on"><div class="row g-3">
          <div class="col-md-4"><div class="box text-center">
            <div class="pav mx-auto" id="bav" onclick="document.getElementById('fu').click()">
              <span id="bl">U</span><div class="cam"><i class="bi bi-camera-fill"></i></div>
            </div>
            <input type="file" id="fu" accept="image/*" style="display:none;width:auto;margin:0" onchange="upPic(event)">
            <div style="font-size:17px;font-weight:700" id="pnm">-</div>
            <div style="font-size:13px;color:var(--gray)" id="pem">-</div>
            <!-- Role display on profile -->
            <div id="prole" style="margin-top:6px"></div>
          </div></div>
          <div class="col-md-8"><div class="box">
            <strong style="font-size:14px">Edit Profile</strong>
            <div class="row g-2 mt-2">
              <div class="col"><label>Full Name</label><input id="fn" placeholder="Your name"></div>
              <div class="col"><label>Email</label><input id="fe" type="email" placeholder="Email"></div>
            </div>
            <div class="row g-2 mt-1">
              <div class="col"><label>Address</label><input id="fa" placeholder="Address"></div>
              <div class="col"><label>Gender</label><select id="fg"><option value="">Prefer not to say</option><option>Male</option><option>Female</option><option>Other</option></select></div>
            </div>
            <label class="mt-2">New Password <small style="color:var(--gray)">(blank = keep same)</small></label>
            <input id="fpa" type="password" placeholder="New password" class="mb-3">
            <button class="bb" onclick="savePro()">Save Changes</button>
          </div></div>
        </div></div>
      </div>
    </main>
  </div>
</div>

<!-- NOTE MODAL -->
<div id="NM" class="mo" onclick="closeMo('NM',event)">
  <div class="mb">
    <button class="xb" onclick="closeMo('NM')">x</button>
    <h5 id="NMT">New Note</h5>
    <input type="hidden" id="nid">
    <div class="mb-2"><label>Title</label><input id="ntt" placeholder="Note title..."></div>
    <div class="mb-2"><label>Category</label><select id="ncat"><option>Personal</option><option>Work</option><option>Ideas</option><option>Study</option><option>Other</option></select></div>
    <div class="mb-2"><label>Content</label><textarea id="nbdy" placeholder="Write your note..."></textarea></div>
    <div class="mb-3"><label>Color</label><div class="clrs">
      <div class="cl on" style="background:#2563EB" data-c="cb" onclick="pickC(this)"></div>
      <div class="cl" style="background:#22C55E" data-c="cg" onclick="pickC(this)"></div>
      <div class="cl" style="background:#F59E0B" data-c="cy" onclick="pickC(this)"></div>
      <div class="cl" style="background:#EF4444" data-c="cr" onclick="pickC(this)"></div>
    </div></div>
    <div style="display:flex;gap:8px"><button class="bb" onclick="saveN()">Save Note</button><button class="bg" onclick="closeMo('NM')">Cancel</button></div>
  </div>
</div>

<!-- USER MODAL -->
<div id="UM" class="mo" onclick="closeMo('UM',event)">
  <div class="mb">
    <button class="xb" onclick="closeMo('UM')">x</button>
    <h5 id="UMT">Add User</h5>
    <input type="hidden" id="uid2">
    <div class="mb-2"><label>Full Name</label><input id="uname" placeholder="Full name"></div>
    <div class="mb-2"><label>Email</label><input id="uemail" type="email" placeholder="email@example.com"></div>
    <div class="mb-2"><label>Password</label><input id="upass" type="password" placeholder="Password"></div>
    <div class="mb-3"><label>Role</label><select id="urole"><option>User</option><option>Admin</option></select></div>
    <div style="display:flex;gap:8px"><button class="bb" onclick="saveU()">Save User</button><button class="bg" onclick="closeMo('UM')">Cancel</button></div>
  </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div id="DM" class="mo" onclick="closeMo('DM',event)">
  <div class="mb" style="max-width:340px;text-align:center">
    <div style="font-size:36px;margin-bottom:10px">🗑️</div>
    <h5 id="DMT">Delete this?</h5>
    <p style="color:var(--gray);font-size:13px" id="DMM">This cannot be undone.</p>
    <div style="display:flex;gap:8px;justify-content:center;margin-top:14px">
      <button class="br" onclick="doDel()">Yes, Delete</button>
      <button class="bg" onclick="closeMo('DM')">Cancel</button>
    </div>
  </div>
</div>

<script>

const D = { me: null, cache: { notes: [], users: [] }, sc: 'cb', onDel: null, ch: {} };

// ── Helpers 
function g(id)   { return document.getElementById(id); }
function fd(iso) { return new Date(iso).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}); }
function ini(n)  { return (n||'?').split(' ').map(w=>w[0]).join('').slice(0,2).toUpperCase(); }
function isAdmin(){ return D.me && D.me.role === 'Admin'; }
function esc(str){
  return String(str??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
function toast(msg,type='ok'){
  const d=document.createElement('div');
  d.className='tm '+type;
  d.textContent=(type==='ok'?'✅ ':'❌ ')+msg;
  g('tb').appendChild(d);
  setTimeout(()=>{d.style.opacity='0';setTimeout(()=>d.remove(),400);},3000);
}
function loading(on){ g('ld').style.display=on?'flex':'none'; }

// ── API 
async function api(action,data=null){
  try{
    const opts={method:data!==null?'POST':'GET',headers:{}};
    if(data!==null){opts.headers['Content-Type']='application/json';opts.body=JSON.stringify(data);}
    const res=await fetch(`api.php?a=${action}`,opts);
    return await res.json();
  }catch(e){ return {error:'Network error. Is XAMPP running?'}; }
}

// ── Session check on load 
window.addEventListener('load',async()=>{
  loading(true);
  const r=await api('me');
  loading(false);
  if(r.user){ D.me=r.user; buildNav(); updateSB(); showApp(); go(isAdmin()?'D':'N'); }
});

function swap(id){
  ['LP','RP'].forEach(p=>g(p).style.display='none');
  g(id).style.display='flex';
}

async function reg(){
  const n=g('rn').value.trim(),e=g('re').value.trim(),p=g('rp').value;
  document.querySelectorAll('.em').forEach(x=>x.style.display='none');
  let ok=true;
  if(!n){g('rne').style.display='block';ok=false;}
  if(!e.includes('@')){g('ree').style.display='block';ok=false;}
  if(p.length<6){g('rpe').style.display='block';ok=false;}
  if(!ok)return;
  loading(true);
  const r=await api('register',{name:n,email:e,pass:p});
  loading(false);
  if(r.error){toast(r.error,'err');return;}
  toast('Account created! Sign in now.');
  setTimeout(()=>swap('LP'),1000);
}

async function login(){
  const e=g('le').value.trim(),p=g('lp').value;
  document.querySelectorAll('.em').forEach(x=>x.style.display='none');
  if(!e){g('lee').style.display='block';return;}
  loading(true);
  const r=await api('login',{email:e,pass:p});
  loading(false);
  if(r.error){g('lpe').textContent=r.error;g('lpe').style.display='block';return;}
  D.me=r.user;
  buildNav();
  updateSB();
  showApp();
  // Admin → Dashboard, User → Notes
  go(isAdmin()?'D':'N');
}

async function logout(){
  await api('logout',{});
  D.me=null;
  g('AP').style.display='none';
  g('snav').innerHTML='';
  swap('LP');
  g('le').value='';g('lp').value='';
}

function showApp(){
  g('LP').style.display='none';g('RP').style.display='none';g('AP').style.display='block';
}

// ── Build sidebar nav based on role
function buildNav(){
  const nav=g('snav');
  if(isAdmin()){
    nav.innerHTML=`
      <div class="nav-section">Admin</div>
      <a class="nl" data-pg="D" onclick="go('D')"><i class="bi bi-grid"></i> Dashboard</a>
      <a class="nl" data-pg="U" onclick="go('U')"><i class="bi bi-people"></i> Users</a>
      <div class="nav-section" style="margin-top:8px">General</div>
      <a class="nl" data-pg="N" onclick="go('N')">
        <i class="bi bi-journal-text"></i> My Notes
        <span id="bdg" style="margin-left:auto;background:var(--blue);color:#fff;border-radius:20px;padding:1px 7px;font-size:10px">0</span>
      </a>
      <a class="nl" data-pg="P" onclick="go('P')"><i class="bi bi-person-circle"></i> Profile</a>`;
  } else {
    nav.innerHTML=`
      <a class="nl" data-pg="N" onclick="go('N')">
        <i class="bi bi-journal-text"></i> My Notes
        <span id="bdg" style="margin-left:auto;background:var(--blue);color:#fff;border-radius:20px;padding:1px 7px;font-size:10px">0</span>
      </a>
      <a class="nl" data-pg="P" onclick="go('P')"><i class="bi bi-person-circle"></i> Profile</a>`;
  }
}

// ── Sidebar user info 
function updateSB(){
  const u=D.me;
  g('snm').textContent=u.name;
  g('sem').textContent=u.email;
  const av=g('sav');
  if(u.pic) av.innerHTML=`<img src="${u.pic}">`;
  else av.textContent=ini(u.name);
}

// ── Navigation
const PAGE_MAP={D:'DP',N:'NP',U:'UP',P:'PP'};
const ADMIN_ONLY=['D','U'];

function go(pg){
  // Guard: non-admins cannot access admin-only pages
  if(ADMIN_ONLY.includes(pg) && !isAdmin()){
    toast('Access restricted to admins.','err');
    go('N');
    return;
  }
  // Hide all panels
  Object.values(PAGE_MAP).forEach(id=>g(id).style.display='none');
  // Remove active state from all nav links
  document.querySelectorAll('.nl').forEach(n=>n.classList.remove('on'));
  // Show target panel
  g(PAGE_MAP[pg]).style.display='block';
  // Set active nav link
  const activeLink=document.querySelector(`.nl[data-pg="${pg}"]`);
  if(activeLink) activeLink.classList.add('on');
  // Load data for each page
  if(pg==='D') loadDash();
  if(pg==='N') showN();
  if(pg==='U') showU();
  if(pg==='P') loadPro();
}

// ── Dashboard (admin only) 
async function loadDash(){
  const [nr,ur]=await Promise.all([api('notes'),api('users')]);
  const notes=nr.notes||[];
  const users=ur.users||[];
  D.cache.notes=notes;D.cache.users=users;
  const cats=[...new Set(notes.map(n=>n.cat))];
  const todN=notes.filter(n=>new Date(n.date).toDateString()===new Date().toDateString());
  g('stN').textContent=notes.length;
  g('stU').textContent=users.length;
  g('stC').textContent=cats.length;
  g('stT').textContent=todN.length;
  const bdg=g('bdg');if(bdg)bdg.textContent=notes.length;
  g('rl').innerHTML=!notes.length
    ?'<div class="empty"><i class="bi bi-journal"></i>No notes yet.</div>'
    :notes.slice(0,3).map(n=>`
      <div style="display:flex;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid #F1F5F9">
        <div style="width:8px;height:8px;border-radius:50%;background:var(--blue);flex-shrink:0"></div>
        <div><strong style="font-size:13px">${esc(n.title)}</strong><br>
        <small style="color:var(--gray)">${esc(n.cat)} · ${fd(n.date)}</small></div>
      </div>`).join('');
  if(D.ch.c)D.ch.c.destroy();
  if(D.ch.u)D.ch.u.destroy();
  const cc={};notes.forEach(n=>{cc[n.cat]=(cc[n.cat]||0)+1;});
  D.ch.c=new Chart(g('cc'),{
    type:'bar',
    data:{labels:Object.keys(cc),datasets:[{label:'Notes',data:Object.values(cc),
      backgroundColor:['#2563EB','#22C55E','#F59E0B','#EF4444','#8B5CF6'],borderRadius:6,borderSkipped:false}]},
    options:{responsive:true,maintainAspectRatio:false,
      plugins:{legend:{display:false}},
      scales:{y:{beginAtZero:true,grid:{color:'#F1F5F9'}},x:{grid:{display:false}}}}
  });
  const adm=users.filter(u=>u.role==='Admin').length;
  D.ch.u=new Chart(g('uc'),{
    type:'doughnut',
    data:{labels:['Admins','Users'],datasets:[{data:[adm,users.length-adm],
      backgroundColor:['#2563EB','#22C55E'],borderWidth:0}]},
    options:{responsive:true,maintainAspectRatio:false,cutout:'65%',
      plugins:{legend:{position:'bottom'}}}
  });
}

// ── Notes
async function showN(){
  const q=(g('sr')?.value||'').toLowerCase();
  const r=await api('notes');
  const allNotes=r.notes||[];
  D.cache.notes=allNotes;
  const notes=allNotes.filter(n=>
    n.title.toLowerCase().includes(q)||
    n.body.toLowerCase().includes(q)||
    n.cat.toLowerCase().includes(q));
  const bdg=g('bdg');if(bdg)bdg.textContent=allNotes.length;
  g('ng').innerHTML=!notes.length
    ?'<div class="empty" style="grid-column:1/-1"><i class="bi bi-journal-plus"></i>No notes yet!</div>'
    :notes.map(n=>`
      <div class="nc ${n.clr}">
        <span class="ntag">${esc(n.cat)}</span>
        <div class="ntt">${esc(n.title)}</div>
        <div class="nb">${esc(n.body)}</div>
        <div class="nf"><span class="nd">${fd(n.date)}</span>
        <div class="nbs">
          <button class="ib e" onclick="openNM(${n.id})"><i class="bi bi-pencil-fill"></i></button>
          <button class="ib d" onclick="askDel('note',${n.id})"><i class="bi bi-trash-fill"></i></button>
        </div></div>
      </div>`).join('');
}

function openNM(id=null){
  g('nid').value='';g('ntt').value='';g('nbdy').value='';g('ncat').value='Personal';
  D.sc='cb';
  document.querySelectorAll('.cl').forEach(c=>c.classList.remove('on'));
  document.querySelector('.cl[data-c="cb"]').classList.add('on');
  if(id){
    const n=D.cache.notes.find(x=>x.id==id);
    if(!n){toast('Note not found','err');return;}
    g('NMT').textContent='Edit Note';
    g('nid').value=id;g('ntt').value=n.title;g('nbdy').value=n.body;g('ncat').value=n.cat;
    D.sc=n.clr;
    document.querySelectorAll('.cl').forEach(c=>c.classList.remove('on'));
    document.querySelector(`.cl[data-c="${n.clr}"]`)?.classList.add('on');
  } else { g('NMT').textContent='New Note'; }
  g('NM').style.display='flex';
}

async function saveN(){
  const t=g('ntt').value.trim(),b=g('nbdy').value.trim(),cat=g('ncat').value,id=g('nid').value;
  if(!t){toast('Enter a title!','err');return;}
  if(!b){toast('Write some content!','err');return;}
  const payload={title:t,body:b,cat,clr:D.sc};
  if(id)payload.id=id;
  loading(true);const r=await api('save_note',payload);loading(false);
  if(r.error){toast(r.error,'err');return;}
  toast(id?'Note updated! ✏️':'Note saved!');
  closeMo('NM');showN();
}

function pickC(el){
  document.querySelectorAll('.cl').forEach(c=>c.classList.remove('on'));
  el.classList.add('on');D.sc=el.dataset.c;
}

// ── Users (admin only)
async function showU(){
  if(!isAdmin()){toast('Admins only.','err');return;}
  const r=await api('users');
  const users=r.users||[];
  D.cache.users=users;
  g('utb').innerHTML=users.map(u=>`<tr>
    <td><strong>${esc(u.name)}</strong></td>
    <td style="color:var(--gray)">${esc(u.email)}</td>
    <td><span class="bd ${u.role==='Admin'?'ad':'us'}">${u.role}</span></td>
    <td style="font-size:12px;color:var(--gray)">${u.created}</td>
    <td style="display:flex;gap:5px">
      <button class="ib e" onclick="openUM(${u.id})"><i class="bi bi-pencil-fill"></i></button>
      <button class="ib d" onclick="askDel('user',${u.id})"><i class="bi bi-trash-fill"></i></button>
    </td></tr>`).join('');
}

function openUM(id=null){
  if(!isAdmin()){toast('Admins only.','err');return;}
  g('uid2').value='';g('uname').value='';g('uemail').value='';g('upass').value='';g('urole').value='User';
  if(id){
    const u=D.cache.users.find(x=>x.id==id);
    if(!u){toast('User not found','err');return;}
    g('UMT').textContent='Edit User';
    g('uid2').value=id;g('uname').value=u.name;g('uemail').value=u.email;g('urole').value=u.role;
  } else { g('UMT').textContent='Add User'; }
  g('UM').style.display='flex';
}

async function saveU(){
  if(!isAdmin()){toast('Admins only.','err');return;}
  const n=g('uname').value.trim(),e=g('uemail').value.trim(),p=g('upass').value,rol=g('urole').value,id=g('uid2').value;
  if(!n||!e){toast('Name and email required!','err');return;}
  const payload={name:n,email:e,pass:p,role:rol};
  if(id)payload.id=id;
  loading(true);const r=await api('save_user',payload);loading(false);
  if(r.error){toast(r.error,'err');return;}
  toast(id?'User updated!':'User added! 👤');
  closeMo('UM');showU();
}

// ── Delete
function askDel(type,id){
  g('DMT').textContent=type==='note'?'Delete this note?':'Delete this user?';
  g('DM').style.display='flex';
  D.onDel=async()=>{
    loading(true);const r=await api(type==='note'?'delete_note':'delete_user',{id});loading(false);
    if(r.error){toast(r.error,'err');return;}
    toast('Deleted.','err');
    if(type==='note')showN();else showU();
  };
}
function doDel(){if(D.onDel)D.onDel();closeMo('DM');}

// ── Profile
async function loadPro(){
  const r=await api('me');if(!r.user)return;
  D.me=r.user;const u=D.me;
  g('pnm').textContent=u.name;g('pem').textContent=u.email;
  g('fn').value=u.name;g('fe').value=u.email;g('fa').value=u.addr||'';g('fg').value=u.gender||'';g('fpa').value='';
  // Show role badge on profile card
  g('prole').innerHTML=`<span class="bd ${u.role==='Admin'?'ad':'us'}">${u.role}</span>`;
  const av=g('bav');
  if(u.pic){
    g('bl').style.display='none';
    let img=av.querySelector('img')||document.createElement('img');
    img.src=u.pic;av.insertBefore(img,av.firstChild);
  } else {
    g('bl').style.display='';g('bl').textContent=ini(u.name);
    const img=av.querySelector('img');if(img)img.remove();
  }
}

async function savePro(){
  const n=g('fn').value.trim(),e=g('fe').value.trim(),p=g('fpa').value;
  if(!n||!e){toast('Name and email required!','err');return;}
  loading(true);
  const r=await api('save_profile',{name:n,email:e,addr:g('fa').value,gender:g('fg').value,pass:p});
  loading(false);
  if(r.error){toast(r.error,'err');return;}
  D.me=r.user;updateSB();loadPro();toast('Profile saved! ✨');
}

function upPic(ev){
  const f=ev.target.files[0];if(!f)return;
  const reader=new FileReader();
  reader.onload=async e=>{
    loading(true);
    const r=await api('save_profile',{name:D.me.name,email:D.me.email,addr:D.me.addr||'',gender:D.me.gender||'',pass:'',pic:e.target.result});
    loading(false);
    if(r.error){toast(r.error,'err');return;}
    D.me=r.user;updateSB();loadPro();toast('Picture updated! 📸');
  };
  reader.readAsDataURL(f);
}

// ── Modals 
function closeMo(id,ev=null){
  const m=g(id);
  if(ev&&ev.target!==m)return;
  m.style.display='none';
}

</script>
</body>
</html>