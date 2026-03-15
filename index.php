<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ORION — Weian</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
<style>
/* ═══════ DESIGN TOKENS — 5 THEMES ═══════ */
:root {
  --bg:#e6e6e6; --card:#f2f2f2; --pressed:#e8e8e8; --nav-bg:#1e1f23;
  --text-1:#2a2a2a; --text-2:#6b7280; --text-3:#9ca3af;
  --accent:#22c55e; --accent-dim:#16a34a;
  --badge:#d1d5db; --sh-d:#d1d1d1; --sh-l:#ffffff; --border:rgba(0,0,0,0.06);
  --neu-out:6px 6px 14px var(--sh-d),-6px -6px 14px var(--sh-l);
  --neu-in:inset 4px 4px 9px var(--sh-d),inset -4px -4px 9px var(--sh-l);
  --neu-sm:3px 3px 7px var(--sh-d),-3px -3px 7px var(--sh-l);
  --nav-w:62px; --side-w:260px; --ease:.32s cubic-bezier(.4,0,.2,1);
  --wp-overlay:rgba(230,230,230,0.88);
}
[data-theme="dark"] {
  --bg:#0a0b0c; --card:#111314; --pressed:#181a1c; --nav-bg:#0e0f11;
  --text-1:#f0f0f0; --text-2:#8a8d92; --text-3:#555a60;
  --accent:#b8ff3c; --accent-dim:#8fcc28;
  --badge:#2a2d30; --sh-d:rgba(0,0,0,0.5); --sh-l:rgba(255,255,255,0.04); --border:rgba(255,255,255,0.07);
  --neu-out:0 4px 16px rgba(0,0,0,0.4),0 1px 3px rgba(0,0,0,0.3);
  --neu-in:inset 2px 2px 8px rgba(0,0,0,0.5),inset -1px -1px 4px rgba(255,255,255,0.03);
  --neu-sm:0 2px 8px rgba(0,0,0,0.35),0 1px 2px rgba(0,0,0,0.25);
  --wp-overlay:rgba(10,11,12,0.88);
}
[data-theme="forest"] {
  --bg:#0d1a0d; --card:#111f11; --pressed:#162216; --nav-bg:#0a150a;
  --text-1:#e8f5e8; --text-2:#7fa47f; --text-3:#4a6a4a;
  --accent:#4ade80; --accent-dim:#22c55e;
  --badge:#1e3a1e; --sh-d:rgba(0,0,0,0.55); --sh-l:rgba(100,200,100,0.04); --border:rgba(100,200,100,0.1);
  --neu-out:0 4px 18px rgba(0,0,0,0.5),0 1px 4px rgba(0,0,0,0.4);
  --neu-in:inset 2px 2px 9px rgba(0,0,0,0.6),inset -1px -1px 4px rgba(100,200,100,0.04);
  --neu-sm:0 2px 10px rgba(0,0,0,0.4),0 1px 3px rgba(0,0,0,0.3);
  --wp-overlay:rgba(13,26,13,0.85);
}
[data-theme="ocean"] {
  --bg:#060d18; --card:#0a1525; --pressed:#0d1c30; --nav-bg:#04090f;
  --text-1:#e0f0ff; --text-2:#5a88b0; --text-3:#2e5070;
  --accent:#38bdf8; --accent-dim:#0ea5e9;
  --badge:#0e2040; --sh-d:rgba(0,0,0,0.6); --sh-l:rgba(56,189,248,0.04); --border:rgba(56,189,248,0.1);
  --neu-out:0 4px 20px rgba(0,0,0,0.55),0 1px 4px rgba(0,0,0,0.4);
  --neu-in:inset 2px 2px 10px rgba(0,0,0,0.65),inset -1px -1px 4px rgba(56,189,248,0.04);
  --neu-sm:0 2px 10px rgba(0,0,0,0.45),0 1px 3px rgba(0,0,0,0.35);
  --wp-overlay:rgba(6,13,24,0.85);
}
[data-theme="sunset"] {
  --bg:#1a0d06; --card:#231108; --pressed:#2c160a; --nav-bg:#110804;
  --text-1:#fff0e0; --text-2:#b07040; --text-3:#7a4a20;
  --accent:#fb923c; --accent-dim:#f97316;
  --badge:#3a1e08; --sh-d:rgba(0,0,0,0.6); --sh-l:rgba(251,146,60,0.04); --border:rgba(251,146,60,0.1);
  --neu-out:0 4px 20px rgba(0,0,0,0.55),0 1px 4px rgba(0,0,0,0.4);
  --neu-in:inset 2px 2px 10px rgba(0,0,0,0.65),inset -1px -1px 4px rgba(251,146,60,0.04);
  --neu-sm:0 2px 10px rgba(0,0,0,0.45),0 1px 3px rgba(0,0,0,0.35);
  --wp-overlay:rgba(26,13,6,0.85);
}

/* ═══════ BASE ═══════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
button{font-family:inherit;cursor:pointer;border:none;background:none}
input{font-family:inherit;outline:none;border:none}
html,body{height:100%;overflow:hidden;font-family:'Syne',sans-serif;background:var(--bg);color:var(--text-1);transition:background var(--ease),color var(--ease)}
.app{display:flex;height:100vh;width:100vw;overflow:hidden}

/* ═══════ WALLPAPER LAYER ═══════ */
.wp-layer{
  position:fixed;inset:0;z-index:0;pointer-events:none;
  background-size:cover;background-position:center;background-repeat:no-repeat;
  opacity:0;transition:opacity .6s ease,background-image .3s;
}
.wp-layer.active{opacity:1}
.wp-overlay{
  position:absolute;inset:0;
  background:var(--wp-overlay);
  backdrop-filter:blur(2px);
}
.app>*:not(.wp-layer){position:relative;z-index:1}

/* ═══════ NAV RAIL ═══════ */
.nav-rail{
  width:var(--nav-w);height:100%;background:var(--nav-bg);
  display:flex;flex-direction:column;align-items:flex-start;
  padding:16px 0;z-index:30;flex-shrink:0;
  transition:width var(--ease);overflow:hidden;
}
.nav-rail.open{width:192px}
.nav-logo-row{display:flex;align-items:center;gap:10px;padding:0 14px;margin-bottom:14px;width:100%;flex-shrink:0;overflow:hidden}
.nav-logo-box{width:34px;height:34px;border-radius:10px;background:var(--accent);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background var(--ease)}
.nav-logo-box svg path,.nav-logo-box svg circle{stroke:#000!important}
.nav-logo-text{font-size:15px;font-weight:800;color:rgba(255,255,255,0.9);white-space:nowrap;opacity:0;transition:opacity var(--ease);letter-spacing:.05em}
.nav-rail.open .nav-logo-text{opacity:1}
.nav-toggle{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.35);flex-shrink:0;margin:0 14px 8px;transition:background .2s,color .2s}
.nav-toggle:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.8)}
.nav-btn{width:calc(100% - 16px);min-height:38px;border-radius:10px;display:flex;align-items:center;gap:10px;padding:0 12px;color:rgba(255,255,255,.35);transition:background .2s,color .2s;position:relative;flex-shrink:0;margin:1px 8px;white-space:nowrap;overflow:hidden}
.nav-btn:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.8)}
.nav-btn.active{background:rgba(184,255,60,.1);color:var(--accent)}
[data-theme="light"] .nav-btn.active{background:rgba(34,197,94,.12)}
[data-theme="forest"] .nav-btn.active{background:rgba(74,222,128,.1)}
[data-theme="ocean"] .nav-btn.active{background:rgba(56,189,248,.1)}
[data-theme="sunset"] .nav-btn.active{background:rgba(251,146,60,.1)}
.nav-btn.active::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:16px;background:var(--accent);border-radius:0 3px 3px 0}
.nav-btn svg{flex-shrink:0}
.nav-btn-label{font-size:11.5px;font-weight:600;white-space:nowrap;opacity:0;transition:opacity var(--ease)}
.nav-rail.open .nav-btn-label{opacity:1}
.nav-spacer{flex:1}
.nav-bottom{width:100%;padding:10px 8px 0;border-top:1px solid rgba(255,255,255,.07);display:flex;flex-direction:column;gap:4px}
.nav-profile-btn{width:calc(100% - 16px);min-height:40px;margin:1px 8px;border-radius:12px;display:flex;align-items:center;gap:10px;padding:0 8px;cursor:pointer;overflow:hidden;white-space:nowrap;transition:background .2s;position:relative}
.nav-profile-btn:hover{background:rgba(255,255,255,.06)}
.nav-profile-btn:hover .nav-avatar-ring{box-shadow:0 0 0 2px var(--accent),0 0 12px rgba(184,255,60,.3)}
[data-theme="light"] .nav-profile-btn:hover .nav-avatar-ring{box-shadow:0 0 0 2px var(--accent),0 0 10px rgba(34,197,94,.25)}
.nav-avatar-ring{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#3a5a2a,#1e3414);border:2px solid rgba(184,255,60,.35);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;color:var(--accent);flex-shrink:0;transition:box-shadow .25s,border-color .25s}
[data-theme="light"] .nav-avatar-ring{background:linear-gradient(135deg,rgba(34,197,94,.2),rgba(22,163,74,.3));border-color:rgba(34,197,94,.4)}
.nav-profile-info{opacity:0;transition:opacity var(--ease)}
.nav-rail.open .nav-profile-info{opacity:1}
.nav-profile-name{font-size:11.5px;font-weight:700;color:rgba(255,255,255,.75)}
.nav-profile-sub{font-size:9px;color:rgba(255,255,255,.3)}

/* ═══════ MUSIC PLAYER ═══════ */
.music-player{
  width:calc(100% - 16px);margin:8px 8px 0;
  background:rgba(255,255,255,.05);border-radius:13px;
  border:1px solid rgba(255,255,255,.07);
  overflow:hidden;transition:all .3s ease;flex-shrink:0;
}
.music-player.collapsed .mp-full{display:none}
.mp-mini{
  display:flex;align-items:center;gap:6px;padding:7px 9px;cursor:pointer;
}
.mp-disc{
  width:26px;height:26px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,var(--accent),var(--accent-dim));
  display:flex;align-items:center;justify-content:center;
  font-size:10px;color:#000;font-weight:800;
  animation:discSpin 3s linear infinite;animation-play-state:paused;
}
.music-player.playing .mp-disc{animation-play-state:running}
@keyframes discSpin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
.mp-info{flex:1;min-width:0;opacity:0;transition:opacity var(--ease)}
.nav-rail.open .mp-info{opacity:1}
.mp-title{font-size:10px;font-weight:700;color:rgba(255,255,255,.8);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.mp-artist{font-size:8.5px;color:rgba(255,255,255,.35)}
.mp-playbtn{
  width:22px;height:22px;border-radius:50%;flex-shrink:0;
  background:var(--accent);color:#000;font-size:9px;
  display:flex;align-items:center;justify-content:center;
  opacity:0;transition:opacity var(--ease);
}
.nav-rail.open .mp-playbtn{opacity:1}
.mp-full{padding:0 9px 9px}
.mp-prog-wrap{
  height:3px;background:rgba(255,255,255,.1);border-radius:3px;
  margin-bottom:8px;cursor:pointer;position:relative;
}
.mp-prog-fill{height:100%;background:var(--accent);border-radius:3px;transition:width .5s linear}
.mp-controls{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.mp-ctrl-btn{
  color:rgba(255,255,255,.4);font-size:11px;
  width:24px;height:24px;border-radius:6px;
  display:flex;align-items:center;justify-content:center;
  transition:color .2s,background .2s;
}
.mp-ctrl-btn:hover{color:rgba(255,255,255,.85);background:rgba(255,255,255,.07)}
.mp-ctrl-btn.mp-play-main{
  width:30px;height:30px;border-radius:50%;
  background:var(--accent);color:#000;font-size:12px;
}
.mp-ctrl-btn.mp-play-main:hover{filter:brightness(1.15)}
.mp-vol-row{display:flex;align-items:center;gap:6px}
.mp-vol-track{flex:1;height:3px;background:rgba(255,255,255,.1);border-radius:3px;cursor:pointer;position:relative}
.mp-vol-fill{height:100%;background:rgba(255,255,255,.3);border-radius:3px;width:65%}
.mp-vol-icon{color:rgba(255,255,255,.3);font-size:10px}
.mp-playlist-btn{
  width:100%;text-align:left;font-size:8.5px;font-weight:700;
  color:rgba(255,255,255,.3);letter-spacing:.06em;text-transform:uppercase;
  padding:6px 0 4px;border-top:1px solid rgba(255,255,255,.06);
  display:flex;align-items:center;justify-content:space-between;
}
.mp-playlist-btn:hover{color:rgba(255,255,255,.6)}
.mp-playlist{display:none;max-height:140px;overflow-y:auto}
.mp-playlist.show{display:block}
.mp-playlist::-webkit-scrollbar{width:2px}
.mp-playlist::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1)}
.mp-track{
  display:flex;align-items:center;gap:7px;padding:4px 0;
  cursor:pointer;border-radius:6px;padding:4px 6px;margin:1px 0;
  transition:background .15s;
}
.mp-track:hover{background:rgba(255,255,255,.06)}
.mp-track.active{color:var(--accent)}
.mp-track-num{font-size:9px;font-family:'DM Mono',monospace;color:rgba(255,255,255,.25);width:14px;text-align:right;flex-shrink:0}
.mp-track.active .mp-track-num{color:var(--accent)}
.mp-track-info{flex:1;min-width:0}
.mp-track-name{font-size:10px;font-weight:600;color:rgba(255,255,255,.7);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.mp-track.active .mp-track-name{color:var(--accent)}
.mp-track-dur{font-size:9px;font-family:'DM Mono',monospace;color:rgba(255,255,255,.25);flex-shrink:0}
.mp-upload-btn{
  display:flex;align-items:center;gap:6px;
  width:100%;padding:6px 6px;margin-top:4px;
  border-top:1px solid rgba(255,255,255,.06);
  font-size:9px;font-weight:600;color:rgba(255,255,255,.3);
  cursor:pointer;border-radius:6px;
  transition:color .2s,background .2s;
  letter-spacing:.03em;
}
.mp-upload-btn:hover{color:var(--accent);background:rgba(255,255,255,.05)}

/* ═══════ PROFILE POPUP ═══════ */
.profile-popup-overlay{position:fixed;inset:0;z-index:100;pointer-events:none}
.profile-popup-overlay.visible{pointer-events:all}
.profile-popup{
  position:fixed;left:calc(var(--nav-w) + 12px);bottom:12px;
  width:300px;
  background:var(--card);
  border-radius:22px;
  box-shadow:var(--neu-out),0 24px 64px rgba(0,0,0,0.22);
  overflow:hidden;z-index:101;
  transform:translateY(18px) scale(0.95);opacity:0;
  transform-origin:bottom left;
  transition:transform .36s cubic-bezier(.34,1.52,.64,1),opacity .26s ease;
  pointer-events:none;
  border:1px solid var(--border);
}
[data-theme="dark"] .profile-popup,[data-theme="forest"] .profile-popup,[data-theme="ocean"] .profile-popup,[data-theme="sunset"] .profile-popup{
  box-shadow:0 0 0 1px rgba(255,255,255,.07),0 28px 70px rgba(0,0,0,0.75),0 8px 24px rgba(0,0,0,0.5);
}
.profile-popup.show{transform:translateY(0) scale(1);opacity:1;pointer-events:all}

/* cover */
.pp-cover{position:relative;height:96px;overflow:hidden;flex-shrink:0}
.pp-cover img{width:100%;height:100%;object-fit:cover;filter:brightness(0.75) saturate(1.1);transition:filter .3s;display:block}
.pp-cover-overlay{position:absolute;inset:0;background:linear-gradient(160deg,rgba(0,0,0,.15) 0%,transparent 45%,var(--card) 100%)}
[data-theme="dark"] .pp-cover img,[data-theme="forest"] .pp-cover img,[data-theme="ocean"] .pp-cover img,[data-theme="sunset"] .pp-cover img{filter:brightness(0.5) saturate(0.6)}

.pp-close{
  position:absolute;top:9px;right:9px;
  width:26px;height:26px;border-radius:50%;
  background:rgba(0,0,0,.4);backdrop-filter:blur(8px);
  color:rgba(255,255,255,.85);
  display:flex;align-items:center;justify-content:center;
  transition:background .2s,transform .2s;z-index:2;
}
.pp-close:hover{background:rgba(0,0,0,.7);transform:scale(1.1) rotate(90deg)}

.pp-status-dot{
  position:absolute;top:9px;left:9px;
  display:flex;align-items:center;gap:5px;
  background:rgba(0,0,0,.38);backdrop-filter:blur(8px);
  padding:3px 9px;border-radius:20px;z-index:2;
}
.pp-dot{width:5px;height:5px;border-radius:50%;background:var(--accent);animation:ppPulse 2s infinite}
@keyframes ppPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.35;transform:scale(.6)}}
.pp-status-text{font-size:8px;font-weight:700;color:var(--accent);letter-spacing:.06em;text-transform:uppercase}

/* body */
.pp-body{padding:0 16px 16px;position:relative}

/* avatar — overlaps cover */
.pp-avatar{
  position:absolute;top:-34px;left:16px;
  width:72px;height:72px;border-radius:50%;
  border:3px solid var(--card);
  box-shadow:0 4px 18px rgba(0,0,0,.28);
  overflow:hidden;
  background:var(--pressed);
  display:flex;align-items:center;justify-content:center;
  font-size:20px;font-weight:800;color:var(--accent);
}
.pp-avatar img{width:100%;height:100%;object-fit:cover;display:block}

/* top row */
.pp-toprow{padding-top:44px;margin-bottom:12px}
.pp-name-row{display:flex;align-items:center;justify-content:space-between;gap:8px}
.pp-name{font-size:16px;font-weight:800;color:var(--text-1);line-height:1.1}
.pp-online{
  width:8px;height:8px;border-radius:50%;
  background:var(--accent);flex-shrink:0;
  box-shadow:0 0 0 2px var(--card),0 0 6px var(--accent);
}
.pp-role{font-size:10px;color:var(--text-2);margin-top:3px;display:flex;align-items:center;gap:5px}
.pp-location{font-size:9px;color:var(--text-3);margin-top:2px}

.pp-badge-row{display:flex;gap:5px;flex-wrap:wrap;margin-top:8px}
.pp-badge{
  display:inline-flex;align-items:center;gap:4px;
  background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.2);
  color:var(--accent);font-size:8px;font-weight:700;
  padding:2px 8px;border-radius:18px;white-space:nowrap;
}
[data-theme="dark"] .pp-badge,[data-theme="forest"] .pp-badge{background:rgba(184,255,60,.06);border-color:rgba(184,255,60,.18)}
[data-theme="ocean"] .pp-badge{background:rgba(56,189,248,.07);border-color:rgba(56,189,248,.18);color:var(--accent)}
[data-theme="sunset"] .pp-badge{background:rgba(251,146,60,.07);border-color:rgba(251,146,60,.18);color:var(--accent)}
.pp-badge-neutral{
  display:inline-flex;align-items:center;gap:4px;
  background:var(--pressed);border:1px solid var(--border);
  color:var(--text-2);font-size:8px;font-weight:600;
  padding:2px 8px;border-radius:18px;white-space:nowrap;
  box-shadow:var(--neu-in);
}

.pp-divider{height:1px;background:var(--border);margin:12px 0}

/* stats */
.pp-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:12px}
.pp-stat{
  background:var(--pressed);border-radius:11px;padding:9px 6px;
  text-align:center;box-shadow:var(--neu-in);
}
.pp-stat-val{font-size:13px;font-weight:800;color:var(--text-1);line-height:1}
.pp-stat-val.green{color:var(--accent)}
.pp-stat-lbl{font-size:7.5px;color:var(--text-3);margin-top:3px;letter-spacing:.04em}
.pp-stars{display:flex;justify-content:center;gap:1px;margin-bottom:3px}
.pp-star{font-size:9px;color:var(--accent)}
.pp-star.off{color:var(--badge)}

/* skills */
.pp-skills{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:13px}
.pp-skill{
  padding:3px 9px;border-radius:9px;
  background:var(--pressed);box-shadow:var(--neu-in);
  font-size:8.5px;font-weight:600;color:var(--text-2);
}

/* cta */
.pp-cta{display:flex;gap:7px}
.pp-btn-primary{
  flex:1;padding:9px;border-radius:13px;
  background:var(--text-1);color:var(--card);
  font-size:11px;font-weight:700;
  transition:all .2s;
  display:flex;align-items:center;justify-content:center;gap:5px;
  box-shadow:3px 3px 10px rgba(0,0,0,.18),-1px -1px 4px rgba(255,255,255,.4);
}
[data-theme="dark"] .pp-btn-primary,[data-theme="forest"] .pp-btn-primary,[data-theme="ocean"] .pp-btn-primary,[data-theme="sunset"] .pp-btn-primary{
  background:var(--accent);color:#000;
  box-shadow:0 4px 18px color-mix(in srgb,var(--accent) 35%,transparent);
}
.pp-btn-primary:hover{transform:translateY(-1px);filter:brightness(1.08)}
.pp-btn-secondary{
  width:38px;height:38px;border-radius:13px;
  background:var(--card);box-shadow:var(--neu-sm);
  color:var(--text-2);
  display:flex;align-items:center;justify-content:center;
  transition:box-shadow .2s,color .2s;flex-shrink:0;
}
.pp-btn-secondary:hover{box-shadow:var(--neu-in);color:var(--accent)}

/* ═══════ SIDEBAR ═══════ */
.sidebar{width:var(--side-w);height:100%;background:var(--card);box-shadow:var(--neu-out);display:flex;flex-direction:column;flex-shrink:0;overflow:hidden;transition:width var(--ease),opacity var(--ease);position:relative;z-index:10}
[data-theme="dark"] .sidebar,[data-theme="forest"] .sidebar,[data-theme="ocean"] .sidebar,[data-theme="sunset"] .sidebar{box-shadow:2px 0 20px rgba(0,0,0,.4)}
.sidebar.collapsed{width:0;opacity:0;pointer-events:none}
.sb-header{padding:16px 14px 12px;border-bottom:1px solid var(--border);position:relative}
.sb-user-row{display:flex;align-items:center;gap:9px;padding:7px 10px;border-radius:13px;cursor:pointer;transition:box-shadow .2s;box-shadow:var(--neu-sm)}
.sb-user-row:hover{box-shadow:var(--neu-in)}
.sb-user-ava{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,rgba(34,197,94,.2),rgba(22,163,74,.3));border:2px solid var(--accent);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:var(--accent);flex-shrink:0}
.sb-user-name{font-size:12.5px;font-weight:700;color:var(--text-1)}
.sb-user-tag{font-size:9px;color:var(--text-3);margin-top:1px}
.sb-close{position:absolute;top:14px;right:12px;width:26px;height:26px;border-radius:8px;background:var(--card);box-shadow:var(--neu-sm);color:var(--text-3);display:flex;align-items:center;justify-content:center;transition:box-shadow .2s,color .2s}
.sb-close:hover{box-shadow:var(--neu-in);color:#ef4444}
.sb-scroll{flex:1;overflow-y:auto;padding:12px 10px}
.sb-scroll::-webkit-scrollbar{width:3px}
.sb-scroll::-webkit-scrollbar-thumb{background:var(--badge);border-radius:3px}
.sb-section{margin-bottom:20px}
.sb-label{font-size:8.5px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text-3);padding:0 8px;margin-bottom:5px;display:flex;align-items:center;justify-content:space-between;padding-right:8px}
.sb-item{display:flex;align-items:center;gap:9px;padding:7px 10px;border-radius:12px;cursor:pointer;color:var(--text-2);font-size:12px;font-weight:600;transition:box-shadow .2s,color .2s,background .2s;margin-bottom:2px}
.sb-item:hover{box-shadow:var(--neu-in);color:var(--text-1)}
.sb-item.active{box-shadow:var(--neu-in);color:var(--accent)}
.sb-badge{margin-left:auto;background:var(--badge);color:var(--text-2);font-size:9px;font-family:'DM Mono',monospace;padding:1px 6px;border-radius:8px;min-width:18px;text-align:center}
.sb-item.active .sb-badge{background:rgba(34,197,94,.15);color:var(--accent)}
.sb-search{position:relative;margin-bottom:8px}
.sb-search input{width:100%;padding:7px 10px 7px 30px;background:var(--pressed);border-radius:10px;color:var(--text-1);font-size:11px;box-shadow:var(--neu-in)}
.sb-search input::placeholder{color:var(--text-3)}
.sb-search svg{position:absolute;left:9px;top:50%;transform:translateY(-50%);color:var(--text-3)}
.tree-row{display:flex;align-items:center;gap:7px;padding:5px 8px;border-radius:9px;cursor:pointer;font-size:11px;color:var(--text-2);transition:background .15s,color .15s}
.tree-row:hover{background:var(--pressed);color:var(--text-1)}
.tree-row.active{color:var(--accent);background:rgba(34,197,94,.07)}
[data-theme="forest"] .tree-row.active{background:rgba(74,222,128,.07)}
[data-theme="ocean"] .tree-row.active{background:rgba(56,189,248,.07)}
[data-theme="sunset"] .tree-row.active{background:rgba(251,146,60,.07)}
.tree-indent{padding-left:14px}
.tree-count{margin-left:auto;font-size:8.5px;color:var(--text-3);font-family:'DM Mono',monospace}

/* ═══════ MAIN ═══════ */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0}
.topbar{display:flex;align-items:center;gap:10px;padding:11px 20px;background:var(--card);box-shadow:0 2px 10px var(--sh-d);flex-shrink:0;z-index:5;transition:background var(--ease),box-shadow var(--ease)}
[data-theme="dark"] .topbar,[data-theme="forest"] .topbar,[data-theme="ocean"] .topbar,[data-theme="sunset"] .topbar{box-shadow:0 2px 16px rgba(0,0,0,.4)}
.search-wrap{display:flex;align-items:center;gap:6px;background:var(--pressed);box-shadow:var(--neu-in);border-radius:22px;padding:7px 14px;flex:1;max-width:360px;color:var(--text-2);font-size:12px;cursor:text}
.search-sep{width:1px;height:13px;background:var(--border);margin:0 4px}
.search-btn{background:var(--accent);color:#000;border-radius:22px;padding:7px 18px;font-size:12px;font-weight:700;box-shadow:3px 3px 10px rgba(34,197,94,.35);transition:all .2s}
.search-btn:hover{filter:brightness(1.1);transform:translateY(-1px)}
.tb-spacer{flex:1}

/* ═══════ THEME SWITCHER (5 themes) ═══════ */
.theme-switcher{
  display:flex;align-items:center;gap:3px;
  background:var(--pressed);box-shadow:var(--neu-in);
  border-radius:28px;padding:4px;
}
.theme-opt{
  width:28px;height:28px;border-radius:20px;
  display:flex;align-items:center;justify-content:center;
  font-size:13px;cursor:pointer;
  transition:all .25s;color:var(--text-3);
  flex-shrink:0;
}
.theme-opt.active{
  background:var(--card);box-shadow:var(--neu-sm);
  color:var(--text-1);
}
.theme-opt[data-t="forest"].active{color:#4ade80}
.theme-opt[data-t="ocean"].active{color:#38bdf8}
.theme-opt[data-t="sunset"].active{color:#fb923c}
.theme-opt[data-t="dark"].active{color:var(--text-1)}
.theme-opt[data-t="light"].active{color:#f59e0b}

/* ═══════ WALLPAPER BUTTON ═══════ */
.wp-btn{
  position:relative;
  width:33px;height:33px;border-radius:10px;
  background:var(--card);box-shadow:var(--neu-sm);
  color:var(--text-2);
  display:flex;align-items:center;justify-content:center;
  transition:box-shadow .2s,color .2s;
}
.wp-btn:hover{box-shadow:var(--neu-in);color:var(--text-1)}
.wp-btn.has-wp{color:var(--accent)}
.wp-panel{
  position:absolute;top:calc(100% + 8px);right:0;
  background:var(--card);border-radius:16px;padding:14px;
  box-shadow:var(--neu-out),0 12px 40px rgba(0,0,0,.25);
  width:240px;z-index:50;
  border:1px solid var(--border);
  display:none;
  animation:dropDown .25s both;
}
.wp-panel.open{display:block}
@keyframes dropDown{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
.wp-panel-title{font-size:9px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-3);margin-bottom:10px}
.wp-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}
.wp-swatch{
  aspect-ratio:16/9;border-radius:9px;cursor:pointer;overflow:hidden;
  border:2px solid transparent;transition:all .2s;position:relative;
}
.wp-swatch:hover{transform:scale(1.04)}
.wp-swatch.active{border-color:var(--accent);box-shadow:0 0 0 1px var(--accent)}
.wp-swatch img{width:100%;height:100%;object-fit:cover}
.wp-swatch.none-swatch{
  background:var(--pressed);box-shadow:var(--neu-in);
  display:flex;align-items:center;justify-content:center;
  color:var(--text-3);font-size:18px;
}
.wp-swatch-label{font-size:8px;color:var(--text-3);text-align:center;margin-top:3px}

.icon-btn{width:33px;height:33px;border-radius:10px;background:var(--card);box-shadow:var(--neu-sm);color:var(--text-2);display:flex;align-items:center;justify-content:center;transition:box-shadow .2s,color .2s}
.icon-btn:hover{box-shadow:var(--neu-in);color:var(--text-1)}

/* ═══════ MAIN SCROLL ═══════ */
.main-scroll{flex:1;overflow-y:auto}
.main-scroll::-webkit-scrollbar{width:4px}
.main-scroll::-webkit-scrollbar-thumb{background:var(--badge);border-radius:4px}

/* ═══════ HERO ═══════ */
.hero{background:var(--bg);display:flex;align-items:stretch;min-height:290px;position:relative;overflow:hidden;border-bottom:1px solid var(--border);transition:background var(--ease)}
.hero-glow{position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse 40% 60% at 55% 50%,rgba(34,197,94,.07) 0%,transparent 70%),radial-gradient(ellipse 20% 30% at 80% 20%,rgba(34,197,94,.05) 0%,transparent 60%);transition:opacity var(--ease)}
[data-theme="dark"] .hero-glow{background:radial-gradient(ellipse 60% 80% at 55% 50%,rgba(90,130,40,.18) 0%,transparent 70%),radial-gradient(ellipse 30% 40% at 75% 30%,rgba(184,255,60,.07) 0%,transparent 60%)}
[data-theme="forest"] .hero-glow{background:radial-gradient(ellipse 60% 80% at 55% 50%,rgba(40,100,40,.25) 0%,transparent 70%)}
[data-theme="ocean"] .hero-glow{background:radial-gradient(ellipse 60% 80% at 55% 50%,rgba(20,80,130,.3) 0%,transparent 70%)}
[data-theme="sunset"] .hero-glow{background:radial-gradient(ellipse 60% 80% at 55% 50%,rgba(180,80,20,.25) 0%,transparent 70%)}
.scan-line{position:absolute;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(34,197,94,.25),transparent);animation:scan 4s linear infinite;pointer-events:none}
@keyframes scan{0%{top:0}100%{top:100%}}
.hero-left{padding:24px 22px;display:flex;flex-direction:column;justify-content:center;min-width:240px;position:relative;z-index:2}
.ai-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:var(--accent);font-size:9px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:4px 10px;border-radius:20px;margin-bottom:10px;width:fit-content}
.pulse{width:6px;height:6px;border-radius:50%;background:var(--accent);animation:pulse 2s infinite}
.hero-title{font-size:40px;font-weight:800;line-height:.95;letter-spacing:-.03em;color:var(--text-1);margin-bottom:16px}
.hero-title span{display:block}
.hero-title em{color:var(--accent);font-style:normal}
.salary-card{background:var(--card);box-shadow:var(--neu-out);border-radius:18px;padding:14px 16px;max-width:210px;transition:background var(--ease)}
.card-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.card-ttl{font-size:10px;font-weight:700;color:var(--text-2)}
.mini-chart{position:relative;height:60px}
.mini-chart svg{width:100%;height:100%}
.chart-badge{position:absolute;top:4px;left:55%;background:var(--accent);color:#000;font-size:8px;font-weight:700;padding:2px 7px;border-radius:6px;box-shadow:0 2px 8px rgba(34,197,94,.4)}
.chart-months{display:flex;justify-content:space-between;margin-top:4px}
.chart-months span{font-size:7.5px;color:var(--text-3);font-family:'DM Mono',monospace}
.hero-3d{flex:1;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}
.iso-wrap{width:280px;height:200px;position:relative;transform:perspective(800px) rotateX(30deg) rotateZ(-18deg);transform-style:preserve-3d;animation:floatAnim 6s ease-in-out infinite}
@keyframes floatAnim{0%,100%{transform:perspective(800px) rotateX(30deg) rotateZ(-18deg) translateY(0)}50%{transform:perspective(800px) rotateX(30deg) rotateZ(-18deg) translateY(-10px)}}
.iso-block{position:absolute;border:1px solid rgba(34,197,94,.2);border-radius:3px}
.iso-b1{top:0;left:0;right:0;height:50%;background:rgba(34,197,94,.07)}
.iso-b2{top:28%;left:12%;right:8%;height:50%;background:rgba(34,197,94,.05)}
.iso-b3{top:52%;left:4%;right:18%;height:52%;background:rgba(34,197,94,.04)}
[data-theme="dark"] .iso-b1{background:rgba(60,80,30,.4)}
[data-theme="dark"] .iso-b2{background:rgba(30,50,15,.5)}
[data-theme="dark"] .iso-b3{background:rgba(20,35,10,.6)}
[data-theme="forest"] .iso-b1{background:rgba(50,120,50,.2)}
[data-theme="ocean"] .iso-b1{background:rgba(20,80,160,.2)}
[data-theme="sunset"] .iso-b1{background:rgba(180,80,20,.2)}
.iso-tree{position:absolute;top:-22px;left:45%;width:60px;height:80px;background:radial-gradient(ellipse,rgba(34,197,94,.4) 0%,transparent 70%);border-radius:50%}
.iso-glow{position:absolute;inset:-10px;background:radial-gradient(ellipse 70% 50% at 50% 60%,rgba(34,197,94,.1) 0%,transparent 70%)}
.hero-right{padding:20px 20px 20px 0;display:flex;flex-direction:column;gap:10px;justify-content:center;min-width:270px;z-index:2}
.widget{background:var(--card);box-shadow:var(--neu-out);border-radius:16px;padding:13px 15px;transition:background var(--ease)}
.cand-nums{display:flex;gap:14px;align-items:flex-end;margin-bottom:10px}
.cand-val{font-size:20px;font-weight:800;color:var(--text-1);line-height:1}
.cand-pct{font-size:8px;color:var(--text-3);font-family:'DM Mono',monospace}
.level-tabs{display:flex;gap:3px;background:var(--pressed);box-shadow:var(--neu-in);border-radius:20px;padding:3px}
.level-tab{flex:1;padding:4px 5px;border-radius:16px;font-size:9px;font-weight:700;text-align:center;cursor:pointer;color:var(--text-3);transition:all .2s}
.level-tab.active{background:var(--accent);color:#000;box-shadow:0 2px 8px rgba(34,197,94,.4)}
.stats-row{display:flex;gap:8px}
.stat-card{flex:1;background:var(--card);box-shadow:var(--neu-out);border-radius:14px;padding:11px 12px;transition:background var(--ease)}
.stat-val{font-size:19px;font-weight:800;color:var(--text-1)}
.stat-sup{font-size:9px;color:var(--accent);margin-left:2px}
.bar-chart{display:flex;align-items:flex-end;gap:3px;height:24px;margin-top:7px}
.bar{flex:1;border-radius:2px;background:var(--badge)}
.bar.hi{background:var(--accent);opacity:.7}
.bar.md{background:var(--accent);opacity:.35}
.progress-wrap{height:3px;background:var(--pressed);border-radius:3px;margin-top:7px;box-shadow:var(--neu-in)}
.progress-fill{height:100%;background:var(--accent);border-radius:3px}
.stat-row-lbl{display:flex;justify-content:space-between;margin-top:4px}
.stat-lbl{font-size:7.5px;color:var(--text-3);font-family:'DM Mono',monospace}
.filter-bar{display:flex;align-items:center;gap:7px;padding:10px 20px;background:var(--card);border-bottom:1px solid var(--border);overflow-x:auto;flex-shrink:0;transition:background var(--ease)}
.filter-bar::-webkit-scrollbar{display:none}
.f-pill{display:flex;align-items:center;gap:5px;padding:5px 11px;border-radius:20px;background:var(--card);box-shadow:var(--neu-sm);font-size:10.5px;color:var(--text-2);cursor:pointer;white-space:nowrap;transition:box-shadow .2s,color .2s;flex-shrink:0}
.f-pill:hover{box-shadow:var(--neu-in);color:var(--text-1)}
.f-dot{width:4px;height:4px;border-radius:50%;background:var(--badge);flex-shrink:0}
.f-spacer{flex:1}
.f-page{display:flex;align-items:center;gap:7px;font-size:11px;font-family:'DM Mono',monospace;color:var(--text-2);flex-shrink:0}
.pg-btn{width:27px;height:27px;border-radius:50%;background:var(--card);box-shadow:var(--neu-sm);color:var(--text-2);display:flex;align-items:center;justify-content:center;transition:box-shadow .2s}
.pg-btn:hover{box-shadow:var(--neu-in)}
.f-add{width:27px;height:27px;border-radius:50%;background:var(--accent);color:#000;font-size:16px;font-weight:700;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(34,197,94,.4)}
.section-title{font-size:11.5px;font-weight:700;color:var(--text-2);padding:0 20px;margin:18px 0 0;display:flex;align-items:center;gap:10px}
.section-title::after{content:'';flex:1;height:1px;background:var(--border)}
.jobs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(276px,1fr));gap:16px;padding:16px 20px 24px}
.job-card{background:var(--card);box-shadow:var(--neu-out);border-radius:20px;padding:17px;display:flex;flex-direction:column;gap:11px;cursor:pointer;transition:box-shadow .25s,transform .2s,background var(--ease);animation:fadeUp .5s both}
[data-theme="dark"] .job-card,[data-theme="forest"] .job-card,[data-theme="ocean"] .job-card,[data-theme="sunset"] .job-card{border:1px solid var(--border)}
.job-card:nth-child(1){animation-delay:.08s}.job-card:nth-child(2){animation-delay:.16s}.job-card:nth-child(3){animation-delay:.24s}.job-card:nth-child(4){animation-delay:.32s}.job-card:nth-child(5){animation-delay:.40s}.job-card:nth-child(6){animation-delay:.48s}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
.job-card:hover{box-shadow:var(--neu-in);transform:translateY(-2px)}
.job-hd{display:flex;align-items:center;gap:10px}
.co-logo{width:36px;height:36px;border-radius:11px;background:var(--pressed);box-shadow:var(--neu-sm);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:800;flex-shrink:0}
.jt-block{flex:1}
.jt-title{font-size:13.5px;font-weight:700;color:var(--text-1)}
.jt-co{font-size:10px;color:var(--text-3);margin-top:1px}
.jt-time{font-family:'DM Mono',monospace}
.j-acts{display:flex;gap:5px}
.j-act{width:27px;height:27px;border-radius:8px;background:var(--card);box-shadow:var(--neu-sm);color:var(--text-3);font-size:12px;display:flex;align-items:center;justify-content:center;transition:box-shadow .2s,color .2s}
.j-act:hover{box-shadow:var(--neu-in);color:var(--text-1)}
.j-act.heart:hover{color:#ef4444}
.j-tags{display:flex;flex-wrap:wrap;gap:5px}
.tag{padding:3px 9px;border-radius:10px;background:var(--pressed);box-shadow:var(--neu-in);font-size:9.5px;color:var(--text-2)}
.j-foot{display:flex;align-items:center;justify-content:space-between}
.j-applicants{font-size:9px;color:var(--text-3);display:flex;align-items:center;gap:5px}
.match-ring{position:relative;width:62px;height:62px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.match-ring svg{position:absolute;inset:0;transform:rotate(-90deg)}
.ring-track{fill:none;stroke:var(--pressed);stroke-width:5}
.ring-fill{fill:none;stroke:var(--accent);stroke-width:5;stroke-linecap:round}
.ring-fill.orange{stroke:#f97316}
.match-info{position:relative;z-index:1;text-align:center}
.match-pct{font-size:13px;font-weight:800;color:var(--text-1);line-height:1}
.match-lbl{font-size:7px;color:var(--text-3);margin-top:2px}
</style>
</head>
<body>
<!-- WALLPAPER LAYER -->
<div class="wp-layer" id="wpLayer"><div class="wp-overlay"></div></div>

<div class="app">

<!-- ═══════════ NAV RAIL ═══════════ -->
<nav class="nav-rail" id="navRail">
  <div class="nav-logo-row">
    <div class="nav-logo-box">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M9 2L16 6V12L9 16L2 12V6L9 2Z" stroke="#000" stroke-width="1.8" stroke-linejoin="round"/>
        <circle cx="9" cy="9" r="2" fill="#000"/>
      </svg>
    </div>
    <span class="nav-logo-text">ORION</span>
  </div>

  <button class="nav-toggle" id="navToggle" title="Toggle nav (\)">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
  </button>

  <button class="nav-btn active" onclick="setNavActive(this)">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
    <span class="nav-btn-label">Dashboard</span>
  </button>
  <button class="nav-btn" onclick="setNavActive(this)">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 3a9 9 0 0 1 0 18"/><path d="M3 12h18"/></svg>
    <span class="nav-btn-label">Explore</span>
  </button>
  <button class="nav-btn" onclick="setNavActive(this)">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
    <span class="nav-btn-label">AI Match</span>
  </button>
  <button class="nav-btn" onclick="setNavActive(this)">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.6 10.7l6.8-4.4M8.6 13.3l6.8 4.4"/></svg>
    <span class="nav-btn-label">Network</span>
  </button>
  <button class="nav-btn" onclick="setNavActive(this)">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
    <span class="nav-btn-label">Portfolio</span>
  </button>
  <button class="nav-btn" onclick="setNavActive(this)">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
    <span class="nav-btn-label">Resources</span>
  </button>

  <div class="nav-spacer"></div>

  <!-- ═══ MUSIC PLAYER ═══ -->
  <div class="music-player collapsed" id="musicPlayer">
    <div class="mp-mini" onclick="toggleMusicExpand()">
      <div class="mp-disc" id="mpDisc">♪</div>
      <div class="mp-info">
        <div class="mp-title" id="mpTitle">Midnight Pixels</div>
        <div class="mp-artist" id="mpArtist">Lo-fi Orion</div>
      </div>
      <button class="mp-playbtn" id="mpPlayMini" onclick="event.stopPropagation();togglePlay()">▶</button>
    </div>
    <div class="mp-full">
      <div class="mp-prog-wrap" id="mpProgWrap" onclick="seekTrack(event)">
        <div class="mp-prog-fill" id="mpProg" style="width:0%"></div>
      </div>
      <div class="mp-controls">
        <button class="mp-ctrl-btn" onclick="shuffleToggle(this)" title="Shuffle" id="shuffleBtn">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="4" y1="4" x2="9" y2="9"/></svg>
        </button>
        <button class="mp-ctrl-btn" onclick="prevTrack()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="19 20 9 12 19 4 19 20"/><line x1="5" y1="19" x2="5" y2="5"/></svg>
        </button>
        <button class="mp-ctrl-btn mp-play-main" id="mpPlayBtn" onclick="togglePlay()">▶</button>
        <button class="mp-ctrl-btn" onclick="nextTrack()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 4 15 12 5 20 5 4"/><line x1="19" y1="5" x2="19" y2="19"/></svg>
        </button>
        <button class="mp-ctrl-btn" onclick="repeatToggle(this)" title="Repeat" id="repeatBtn">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
        </button>
      </div>
      <div class="mp-vol-row">
        <span class="mp-vol-icon">🔈</span>
        <div class="mp-vol-track" onclick="setVolume(event)"><div class="mp-vol-fill" id="mpVolFill"></div></div>
        <span class="mp-vol-icon">🔊</span>
      </div>
      <button class="mp-playlist-btn" onclick="togglePlaylist()" id="plToggleBtn">
        <span>Playlist</span>
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="plChevron"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="mp-playlist" id="mpPlaylist">
        <div class="mp-track active" onclick="playTrack(0)"><span class="mp-track-num">01</span><div class="mp-track-info"><div class="mp-track-name">Midnight Pixels</div></div><span class="mp-track-dur">3:24</span></div>
        <div class="mp-track" onclick="playTrack(1)"><span class="mp-track-num">02</span><div class="mp-track-info"><div class="mp-track-name">Neural Drift</div></div><span class="mp-track-dur">2:58</span></div>
        <div class="mp-track" onclick="playTrack(2)"><span class="mp-track-num">03</span><div class="mp-track-info"><div class="mp-track-name">Rain on Glass</div></div><span class="mp-track-dur">4:12</span></div>
        <div class="mp-track" onclick="playTrack(3)"><span class="mp-track-num">04</span><div class="mp-track-info"><div class="mp-track-name">Orion Signal</div></div><span class="mp-track-dur">3:40</span></div>
        <div class="mp-track" onclick="playTrack(4)"><span class="mp-track-num">05</span><div class="mp-track-info"><div class="mp-track-name">Neon Corridors</div></div><span class="mp-track-dur">5:01</span></div>
        <div class="mp-track" onclick="playTrack(5)"><span class="mp-track-num">06</span><div class="mp-track-info"><div class="mp-track-name">Byte Garden</div></div><span class="mp-track-dur">3:17</span></div>
        <div class="mp-track" onclick="playTrack(6)"><span class="mp-track-num">07</span><div class="mp-track-info"><div class="mp-track-name">Late Loop</div></div><span class="mp-track-dur">2:46</span></div>
        <!-- Upload row -->
        <label class="mp-upload-btn" title="Upload MP3">
          <input type="file" accept="audio/*" multiple style="display:none" onchange="uploadTracks(this)">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Add your music
        </label>
      </div>
    </div>
  </div>

  <div class="nav-bottom">
    <button class="nav-btn" onclick="setNavActive(this)">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
      <span class="nav-btn-label">Settings</span>
    </button>
    <div class="nav-profile-btn" id="profileTrigger" tabindex="0" role="button">
      <div class="nav-avatar-ring" id="navAvatar" style="overflow:hidden;padding:0">
        <img src="picture/wuyan" alt="W" style="width:100%;height:100%;object-fit:cover;border-radius:50%" onerror="this.style.display='none';this.parentElement.textContent='W'">
      </div>
      <div class="nav-profile-info">
        <div class="nav-profile-name">Weian</div>
        <div class="nav-profile-sub">Year 3 · CS</div>
      </div>
    </div>
  </div>
</nav>


<!-- ═══════════ SIDEBAR ═══════════ -->
<aside class="sidebar" id="sidebar">
  <div class="sb-header">
    <div class="sb-user-row" id="sbProfileTrigger">
      <div class="sb-user-ava">W</div>
      <div><div class="sb-user-name">Weian</div><div class="sb-user-tag">Year 3 · CS Student</div></div>
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-3);margin-left:auto"><path d="M6 9l6 6 6-6"/></svg>
    </div>
    <button class="sb-close" id="sbClose">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
  </div>
  <div class="sb-scroll">
    <div class="sb-section">
      <div class="sb-label">Projects</div>
      <div class="sb-item active" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Dashboard <span class="sb-badge">0</span></div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>Library</div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>Shared Projects</div>
    </div>
    <div class="sb-section">
      <div class="sb-label">Status</div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>New <span class="sb-badge">3</span></div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Updates <span class="sb-badge">2</span></div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>Team Review</div>
    </div>
    <div class="sb-section">
      <div class="sb-label">History</div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Recently Edited</div>
      <div class="sb-item" onclick="setSbActive(this)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>Archive</div>
    </div>
    <div class="sb-section">
      <div class="sb-label">Documents <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div>
      <div class="sb-search"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg><input type="text" placeholder="Search docs…"></div>
      <div class="tree-row" onclick="toggleTree(this)"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>System Management's <span class="tree-count">12</span></div>
      <div class="tree-indent" id="tSM">
        <div class="tree-row" onclick="toggleTree(this)"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>2025 Update's <span class="tree-count">2</span></div>
        <div class="tree-indent" id="tUp">
          <div class="tree-row" style="font-size:10.5px" onclick="location.href='elicbill.php'"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>Elictricity bills <span class="tree-count">4</span></div>
          <div class="tree-row" style="font-size:10.5px" onclick="location.href='fortune.php'"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>Fortune number <span class="tree-count">3</span></div>
        </div>
        <div class="tree-row active"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>Fundamentals <span class="tree-count">4</span></div>
        <div class="tree-row"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>Off Grid Servers <span class="tree-count">5</span></div>
      </div>
    </div>
  </div>
</aside>

<!-- ═══════════ MAIN ═══════════ -->
<div class="main">
  <div class="topbar">
    <div class="search-wrap">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      <span>Internship, UX/UI</span>
      <div class="search-sep"></div>
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <span style="color:var(--text-3)">Remote / Hybrid</span>
    </div>
    <button class="search-btn">Search</button>
    <div class="tb-spacer"></div>

    <!-- ══ 5-THEME SWITCHER ══ -->
    <div class="theme-switcher" id="themeSwitcher">
      <div class="theme-opt active" data-t="light"  onclick="setTheme('light')"  title="Light">☀️</div>
      <div class="theme-opt"        data-t="dark"   onclick="setTheme('dark')"   title="Dark">🌙</div>
      <div class="theme-opt"        data-t="forest" onclick="setTheme('forest')" title="Forest">🌲</div>
      <div class="theme-opt"        data-t="ocean"  onclick="setTheme('ocean')"  title="Ocean">🌊</div>
      <div class="theme-opt"        data-t="sunset" onclick="setTheme('sunset')" title="Sunset">🌅</div>
    </div>

    <!-- ══ WALLPAPER BUTTON ══ -->
    <div style="position:relative">
      <button class="wp-btn" id="wpBtn" onclick="toggleWpPanel(event)" title="Wallpaper">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      </button>
      <div class="wp-panel" id="wpPanel">
        <div class="wp-panel-title">Wallpaper</div>
        <div class="wp-grid">
          <div>
            <div class="wp-swatch none-swatch active" id="wp-none" onclick="setWallpaper('none')">✕</div>
            <div class="wp-swatch-label">None</div>
          </div>
          <div>
            <div class="wp-swatch" id="wp-mountains" onclick="setWallpaper('mountains')">
              <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&q=70" alt="Mountains">
            </div>
            <div class="wp-swatch-label">Mountains</div>
          </div>
          <div>
            <div class="wp-swatch" id="wp-city" onclick="setWallpaper('city')">
              <img src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=400&q=70" alt="City">
            </div>
            <div class="wp-swatch-label">City</div>
          </div>
        </div>
      </div>
    </div>

    <button class="icon-btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
    </button>
    <div id="tbProfileTrigger" style="width:32px;height:32px;border-radius:50%;border:2px solid var(--accent);overflow:hidden;cursor:pointer;transition:box-shadow .25s;flex-shrink:0" onmouseenter="openProfile()" onclick="toggleProfile()">
      <img src="picture/wuyan" alt="W" style="width:100%;height:100%;object-fit:cover;display:block" onerror="this.style.display='none';this.parentElement.style.background='var(--accent)';this.parentElement.style.display='flex';this.parentElement.style.alignItems='center';this.parentElement.style.justifyContent='center';this.parentElement.textContent='W'">
    </div>
  </div>

  <div class="main-scroll">
    <!-- HERO -->
    <div class="hero">
      <div class="hero-glow"></div>
      <div class="scan-line"></div>
      <div class="hero-left">
        <div class="ai-badge"><div class="pulse"></div>AI+Plus_me-Powered</div>
        <div class="hero-title"><span>MY</span><span>JOB</span><span><em>MATCH</em></span></div>
        <div class="salary-card">
          <div class="card-hd"><span class="card-ttl">Salary expectations</span><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-3)"><path d="M7 17L17 7M7 7h10v10"/></svg></div>
          <div class="mini-chart">
            <svg viewBox="0 0 200 60" preserveAspectRatio="none">
              <defs>
                <linearGradient id="lg" x1="0" y1="0" x2="1" y2="0"><stop offset="0%" stop-color="var(--accent)" stop-opacity=".2"/><stop offset="100%" stop-color="var(--accent)"/></linearGradient>
              </defs>
              <path d="M0 50 C30 45 60 35 100 28 C140 20 160 18 200 10 L200 60 L0 60 Z" fill="rgba(34,197,94,.07)"/>
              <path d="M0 50 C30 45 60 35 100 28 C140 20 160 18 200 10" fill="none" stroke="url(#lg)" stroke-width="2"/>
              <circle cx="110" cy="27" r="3.5" fill="var(--accent)"/>
            </svg>
            <div class="chart-badge">48%</div>
          </div>
          <div class="chart-months"><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span><span>Aug</span></div>
        </div>
      </div>
      <div class="hero-3d">
        <div class="iso-wrap">
          <div class="iso-glow"></div>
          <div class="iso-tree"></div>
          <div class="iso-block iso-b1"></div>
          <div class="iso-block iso-b2"></div>
          <div class="iso-block iso-b3"></div>
        </div>
      </div>
      <div class="hero-right">
        <div class="widget">
          <div class="card-hd"><span class="card-ttl">Candidates Online</span><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-3)"><path d="M7 17L17 7M7 7h10v10"/></svg></div>
          <div class="cand-nums">
            <div><div class="cand-val">2 574</div><div class="cand-pct">32%</div></div>
            <div><div class="cand-val">4 131</div><div class="cand-pct">54%</div></div>
            <div><div class="cand-val">998</div><div class="cand-pct">14%</div></div>
          </div>
          <div class="level-tabs">
            <div class="level-tab" onclick="setTab(this)">Junior</div>
            <div class="level-tab active" onclick="setTab(this)">Middle</div>
            <div class="level-tab" onclick="setTab(this)">Senior</div>
          </div>
        </div>
        <div class="stats-row">
          <div class="stat-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px"><span style="font-size:9px;color:var(--text-3);font-weight:700">Orion Index</span><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-3)"><path d="M7 17L17 7M7 7h10v10"/></svg></div>
            <span class="stat-val">0.27</span><span class="stat-sup">+6</span>
            <div class="stat-row-lbl"><span class="stat-lbl">Offers</span><span class="stat-lbl">Responses</span></div>
            <div class="progress-wrap"><div class="progress-fill" style="width:27%"></div></div>
          </div>
          <div class="stat-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px"><span style="font-size:9px;color:var(--text-3);font-weight:700">Vacancies</span><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-3)"><path d="M7 17L17 7M7 7h10v10"/></svg></div>
            <span class="stat-val">8,574</span><span class="stat-sup">+37</span>
            <div class="bar-chart"><div class="bar" style="height:40%"></div><div class="bar" style="height:55%"></div><div class="bar md" style="height:50%"></div><div class="bar" style="height:35%"></div><div class="bar hi" style="height:80%"></div><div class="bar md" style="height:70%"></div><div class="bar" style="height:45%"></div><div class="bar hi" style="height:90%"></div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar">
      <div class="f-pill">This week <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></div>
      <div class="f-dot"></div>
      <div class="f-pill">Remote <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></div>
      <div class="f-dot"></div>
      <div class="f-pill">Internship / Entry <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></div>
      <div class="f-dot"></div>
      <div class="f-pill">Part / Full time <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></div>
      <div class="f-dot"></div>
      <div class="f-pill">Junior, Mid <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></div>
      <button class="f-add">+</button>
      <div class="f-spacer"></div>
      <div class="f-page"><button class="pg-btn">←</button><span style="color:var(--accent);font-weight:700">03</span><span style="color:var(--text-3)">/153</span><button class="pg-btn">→</button></div>
    </div>

    <!-- JOB CARDS -->
    <div class="section-title">Matched Opportunities</div>
    <div class="jobs-grid">
      <div class="job-card">
        <div class="job-hd" onclick="location.href='variable.php'">
          <div class="co-logo" style="color:#ff9900;font-size:18px;font-weight:900;">a</div>
          <div class="jt-block"><div class="jt-title">Variable</div><div class="jt-co">Lesson <span class="jt-time">· 6h ago</span></div></div>
          <div class="j-acts"><button class="j-act">↗</button><button class="j-act heart" onclick="toggleHeart(this)">♥</button></div>
        </div>
        <div class="j-tags"><span class="tag">$127k/yr</span><span class="tag">Full-time</span><span class="tag">Senior</span><span class="tag">LA, CA</span><span class="tag">Remote</span></div>
        <div class="j-foot">
          <div class="j-applicants"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>60+ applicants</div>
          <div class="match-ring"><svg viewBox="0 0 64 64"><circle class="ring-track" cx="32" cy="32" r="27"/><circle class="ring-fill" cx="32" cy="32" r="27" stroke-dasharray="169.6" stroke-dashoffset="35.6"/></svg><div class="match-info"><div class="match-pct">79%</div><div class="match-lbl">Strong</div></div></div>
        </div>
      </div>
      <div class="job-card">
        <div class="job-hd" onclick="location.href='datatype.php'">
          <div class="co-logo" style="font-size:7.5px;font-weight:900;letter-spacing:-.03em">BeReal</div>
          <div class="jt-block"><div class="jt-title">Datatype</div><div class="jt-co">BeReal <span class="jt-time">· 2d ago</span></div></div>
          <div class="j-acts"><button class="j-act">↗</button><button class="j-act heart" onclick="toggleHeart(this)">♥</button></div>
        </div>
        <div class="j-tags"><span class="tag">$115k/yr</span><span class="tag">Full-time</span><span class="tag">Middle</span><span class="tag">LA, CA</span><span class="tag">Remote</span></div>
        <div class="j-foot">
          <div class="j-applicants"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>40 applicants</div>
          <div class="match-ring"><svg viewBox="0 0 64 64"><circle class="ring-track" cx="32" cy="32" r="27"/><circle class="ring-fill" cx="32" cy="32" r="27" stroke-dasharray="169.6" stroke-dashoffset="23.7"/></svg><div class="match-info"><div class="match-pct">86%</div><div class="match-lbl">Strong</div></div></div>
        </div>
      </div>
      <div class="job-card">
        <div class="job-hd" onclick="location.href='elicbill.php'">
          <div class="co-logo" style="color:var(--accent);font-weight:900;font-size:15px;">W</div>
          <div class="jt-block"><div class="jt-title">Elictricity Bills Management</div><div class="jt-co">Wise <span class="jt-time">· 3d ago</span></div></div>
          <div class="j-acts"><button class="j-act">↗</button><button class="j-act heart" onclick="toggleHeart(this)">♥</button></div>
        </div>
        <div class="j-tags"><span class="tag">$120k/yr</span><span class="tag">Full-time</span><span class="tag">Senior</span><span class="tag">LA, CA</span><span class="tag">Remote</span></div>
        <div class="j-foot">
          <div class="j-applicants"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>30+ applicants</div>
          <div class="match-ring"><svg viewBox="0 0 64 64"><circle class="ring-track" cx="32" cy="32" r="27"/><circle class="ring-fill orange" cx="32" cy="32" r="27" stroke-dasharray="169.6" stroke-dashoffset="61.1"/></svg><div class="match-info"><div class="match-pct">64%</div><div class="match-lbl">Good</div></div></div>
        </div>
      </div>
      <div class="job-card">
        <div class="job-hd">
          <div class="co-logo" style="font-size:15px;color:#a259ff;">◈</div>
          <div class="jt-block"><div class="jt-title">Product Designer</div><div class="jt-co">Figma <span class="jt-time">· 1d ago</span></div></div>
          <div class="j-acts"><button class="j-act">↗</button><button class="j-act heart" onclick="toggleHeart(this)">♥</button></div>
        </div>
        <div class="j-tags"><span class="tag">$135k/yr</span><span class="tag">Full-time</span><span class="tag">Senior</span><span class="tag">SF, CA</span><span class="tag">Hybrid</span></div>
        <div class="j-foot">
          <div class="j-applicants"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>100+ applicants</div>
          <div class="match-ring"><svg viewBox="0 0 64 64"><circle class="ring-track" cx="32" cy="32" r="27"/><circle class="ring-fill" cx="32" cy="32" r="27" stroke-dasharray="169.6" stroke-dashoffset="15.3"/></svg><div class="match-info"><div class="match-pct">91%</div><div class="match-lbl">Top</div></div></div>
        </div>
      </div>
      <div class="job-card">
        <div class="job-hd">
          <div class="co-logo" style="color:#6f42c1;font-weight:900;font-size:15px;">S</div>
          <div class="jt-block"><div class="jt-title">UI Engineer</div><div class="jt-co">Stripe <span class="jt-time">· 4d ago</span></div></div>
          <div class="j-acts"><button class="j-act">↗</button><button class="j-act heart" onclick="toggleHeart(this)">♥</button></div>
        </div>
        <div class="j-tags"><span class="tag">$145k/yr</span><span class="tag">Full-time</span><span class="tag">Senior</span><span class="tag">NY</span><span class="tag">Remote</span></div>
        <div class="j-foot">
          <div class="j-applicants"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>20 applicants</div>
          <div class="match-ring"><svg viewBox="0 0 64 64"><circle class="ring-track" cx="32" cy="32" r="27"/><circle class="ring-fill orange" cx="32" cy="32" r="27" stroke-dasharray="169.6" stroke-dashoffset="44.1"/></svg><div class="match-info"><div class="match-pct">74%</div><div class="match-lbl">Good</div></div></div>
        </div>
      </div>
      <div class="job-card">
        <div class="job-hd">
          <div class="co-logo" style="color:#5e5ce6;font-weight:900;font-size:15px;">▲</div>
          <div class="jt-block"><div class="jt-title">Design Systems Lead</div><div class="jt-co">Linear <span class="jt-time">· 5d ago</span></div></div>
          <div class="j-acts"><button class="j-act">↗</button><button class="j-act heart" onclick="toggleHeart(this)">♥</button></div>
        </div>
        <div class="j-tags"><span class="tag">$160k/yr</span><span class="tag">Full-time</span><span class="tag">Staff</span><span class="tag">Remote</span></div>
        <div class="j-foot">
          <div class="j-applicants"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>&lt;10 applicants</div>
          <div class="match-ring"><svg viewBox="0 0 64 64"><circle class="ring-track" cx="32" cy="32" r="27"/><circle class="ring-fill" cx="32" cy="32" r="27" stroke-dasharray="169.6" stroke-dashoffset="30.5"/></svg><div class="match-info"><div class="match-pct">82%</div><div class="match-lbl">Strong</div></div></div>
        </div>
      </div>
    </div>
    <div style="height:24px"></div>
  </div>
</div>
</div>

<!-- ═══════════ PROFILE POPUP ═══════════ -->
<div class="profile-popup-overlay" id="profileOverlay">
  <div class="profile-popup" id="profilePopup">

    <!-- Cover photo -->
    <div class="pp-cover">
      <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800&q=80" alt="cover">
      <div class="pp-cover-overlay"></div>
      <button class="pp-close" id="ppClose">
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
      <div class="pp-status-dot">
        <div class="pp-dot"></div>
        <span class="pp-status-text">Open to work</span>
      </div>
    </div>

    <!-- Body -->
    <div class="pp-body">
      <!-- Avatar (overlaps cover) -->
      <div class="pp-avatar">
        <img
          src="picture/wuyan"
          alt="Weian"
          onerror="this.style.display='none'"
        >
      </div>

      <!-- Name + role -->
      <div class="pp-toprow">
        <div class="pp-name-row">
          <div class="pp-name">Weian</div>
          <div class="pp-online" title="Online"></div>
        </div>
        <div class="pp-role">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
          Web &amp; UX/UI Designer
        </div>
        <div class="pp-location">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:3px"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Phnom Penh, Cambodia
        </div>
        <div class="pp-badge-row">
          <div class="pp-badge">
            <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg>
            Year 3 · CS
          </div>
          <div class="pp-badge-neutral">
            <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
            Top Match
          </div>
        </div>
      </div>

      <div class="pp-divider"></div>

      <!-- Stats -->
      <div class="pp-stats">
        <div class="pp-stat">
          <div class="pp-stars">
            <span class="pp-star">★</span><span class="pp-star">★</span>
            <span class="pp-star">★</span><span class="pp-star">★</span>
            <span class="pp-star off">★</span>
          </div>
          <div class="pp-stat-lbl">Rating</div>
        </div>
        <div class="pp-stat">
          <div class="pp-stat-val">$40<span style="font-size:8px;color:var(--text-3)">/hr</span></div>
          <div class="pp-stat-lbl">Rate</div>
        </div>
        <div class="pp-stat">
          <div class="pp-stat-val green">12</div>
          <div class="pp-stat-lbl">Applied</div>
        </div>
      </div>

      <!-- Skills -->
      <div class="pp-skills">
        <span class="pp-skill">Figma</span>
        <span class="pp-skill">React</span>
        <span class="pp-skill">UI/UX</span>
        <span class="pp-skill">Tailwind</span>
        <span class="pp-skill">CSS</span>
        <span class="pp-skill">PHP</span>
      </div>

      <!-- CTA -->
      <div class="pp-cta">
        <button class="pp-btn-primary">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          Get in touch
        </button>
        <button class="pp-btn-secondary" title="Bookmark">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
        </button>
        <button class="pp-btn-secondary" title="Share">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.6 10.7l6.8-4.4M8.6 13.3l6.8 4.4"/></svg>
        </button>
      </div>
    </div>

  </div>
</div>



<script>
/* ════ PROFILE POPUP ════ */
const overlay=document.getElementById('profileOverlay'),popup=document.getElementById('profilePopup'),trigger=document.getElementById('profileTrigger'),sbTrig=document.getElementById('sbProfileTrigger'),tbTrig=document.getElementById('tbProfileTrigger'),ppClose=document.getElementById('ppClose');
let popupOpen=false,hoverTimer=null;
function openProfile(){clearTimeout(hoverTimer);if(popupOpen)return;popupOpen=true;overlay.classList.add('visible');requestAnimationFrame(()=>popup.classList.add('show'))}
function closeProfile(){if(!popupOpen)return;popupOpen=false;popup.classList.remove('show');setTimeout(()=>overlay.classList.remove('visible'),340)}
function toggleProfile(){popupOpen?closeProfile():openProfile()}
trigger.addEventListener('mouseenter',()=>{hoverTimer=setTimeout(openProfile,160)});
trigger.addEventListener('mouseleave',()=>clearTimeout(hoverTimer));
trigger.addEventListener('click',toggleProfile);
sbTrig.addEventListener('click',toggleProfile);
tbTrig.addEventListener('click',toggleProfile);
ppClose.addEventListener('click',closeProfile);
overlay.addEventListener('click',(e)=>{if(e.target===overlay)closeProfile()});
document.querySelector('.main-scroll').addEventListener('click',closeProfile);
document.querySelectorAll('.nav-btn').forEach(b=>b.addEventListener('click',closeProfile));
document.querySelectorAll('.sb-item').forEach(b=>b.addEventListener('click',closeProfile));

/* ════ KEYBOARD SHORTCUTS ════ */
document.addEventListener('keydown',e=>{
  if(e.key==='Escape')closeProfile();
  if(e.key==='[')toggleSidebar();
  if(e.key==='\\')toggleNav();
  if(e.key===' '&&e.target.tagName!=='INPUT'){e.preventDefault();togglePlay()}
  if(e.key==='ArrowRight'&&e.target.tagName!=='INPUT')nextTrack();
  if(e.key==='ArrowLeft'&&e.target.tagName!=='INPUT')prevTrack();
});

/* ════ 5-THEME SWITCHER ════ */
function setTheme(t){
  document.documentElement.setAttribute('data-theme',t);
  document.querySelectorAll('.theme-opt').forEach(o=>{
    o.classList.toggle('active',o.dataset.t===t);
  });
}

/* ════ NAV TOGGLE ════ */
const rail=document.getElementById('navRail');
let navOpen=false;
function toggleNav(){navOpen=!navOpen;rail.classList.toggle('open',navOpen);if(navOpen)document.getElementById('musicPlayer').classList.remove('collapsed')}
document.getElementById('navToggle').addEventListener('click',toggleNav);

/* ════ SIDEBAR TOGGLE ════ */
const sidebar=document.getElementById('sidebar');
let sbOpen=true;
function toggleSidebar(){sbOpen=!sbOpen;sidebar.classList.toggle('collapsed',!sbOpen)}
document.getElementById('sbClose').addEventListener('click',()=>{sbOpen=false;sidebar.classList.add('collapsed')});
rail.addEventListener('dblclick',()=>{sbOpen=!sbOpen;sidebar.classList.toggle('collapsed',!sbOpen)});

/* ════ ACTIVE STATES ════ */
function setNavActive(btn){document.querySelectorAll('.nav-btn').forEach(b=>b.classList.remove('active'));btn.classList.add('active')}
function setSbActive(item){document.querySelectorAll('.sb-item').forEach(i=>i.classList.remove('active'));item.classList.add('active')}
function setTab(tab){tab.closest('.level-tabs').querySelectorAll('.level-tab').forEach(t=>t.classList.remove('active'));tab.classList.add('active')}
function toggleTree(el){const sub=el.parentElement.querySelector('.tree-indent');if(sub)sub.style.display=sub.style.display==='none'?'':'none';el.classList.toggle('active')}
function toggleHeart(btn){const on=btn.dataset.on==='1';btn.dataset.on=on?'0':'1';btn.style.color=!on?'#ef4444':'';btn.style.boxShadow=!on?'inset 2px 2px 5px var(--sh-d),inset -2px -2px 5px var(--sh-l)':''}

/* ════ WALLPAPER SYSTEM ════ */
const wallpapers={
  none:null,
  mountains:'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=80',
  city:'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=1920&q=80'
};
let currentWp='none';
function setWallpaper(key){
  const layer=document.getElementById('wpLayer');
  const btn=document.getElementById('wpBtn');
  document.querySelectorAll('.wp-swatch').forEach(s=>s.classList.remove('active'));
  document.getElementById('wp-'+key).classList.add('active');
  currentWp=key;
  if(key==='none'){layer.classList.remove('active');layer.style.backgroundImage='';btn.classList.remove('has-wp')}
  else{layer.style.backgroundImage=`url(${wallpapers[key]})`;layer.classList.add('active');btn.classList.add('has-wp')}
  document.getElementById('wpPanel').classList.remove('open');
}
function toggleWpPanel(e){e.stopPropagation();document.getElementById('wpPanel').classList.toggle('open')}
document.addEventListener('click',()=>document.getElementById('wpPanel').classList.remove('open'));

/* ════ MUSIC PLAYER ════ */
const tracks=[
  {title:'Song 1',  artist:'SoundHelix',  dur:'--:--', emoji:'🎹', url:'https://www.youtube.com/watch?v=c9uNtLe-I3M&list=RDGMEMQ1dJ7wXfLlqCjwV0xfSNbAVMc9uNtLe-I3M&start_radio=1'},
  {title:'Song 2',  artist:'SoundHelix',  dur:'--:--', emoji:'🌐', url:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3'},
  {title:'Song 3',  artist:'SoundHelix',  dur:'--:--', emoji:'🌧️', url:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3'},
  {title:'Song 4',  artist:'SoundHelix',  dur:'--:--', emoji:'📡', url:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3'},
  {title:'Song 5',  artist:'SoundHelix',  dur:'--:--', emoji:'🌃', url:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3'},
  {title:'Song 6',  artist:'SoundHelix',  dur:'--:--', emoji:'🌿', url:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3'},
  {title:'Song 7',  artist:'SoundHelix',  dur:'--:--', emoji:'🔁', url:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-7.mp3'},
];
let currentTrack=0,isPlaying=false,shuffle=false,repeat=false;
let audioEl=new Audio();
audioEl.volume=0.65;

/* format seconds → m:ss */
function fmtTime(s){if(!isFinite(s))return'--:--';const m=Math.floor(s/60),sec=Math.floor(s%60);return m+':'+(sec<10?'0':'')+sec}

/* build playlist DOM from tracks array */
function renderPlaylist(){
  const pl=document.getElementById('mpPlaylist');
  const uploadRow=pl.querySelector('.mp-upload-btn')?.parentElement||null;
  // keep only upload label
  const uploadLabel=pl.querySelector('label.mp-upload-btn');
  pl.innerHTML='';
  tracks.forEach((t,i)=>{
    const div=document.createElement('div');
    div.className='mp-track'+(i===currentTrack?' active':'');
    div.innerHTML=`<span class="mp-track-num">${String(i+1).padStart(2,'0')}</span><div class="mp-track-info"><div class="mp-track-name">${t.title}</div></div><span class="mp-track-dur">${t.dur}</span>`;
    div.onclick=()=>playTrack(i);
    pl.appendChild(div);
  });
  if(uploadLabel) pl.appendChild(uploadLabel);
  else{
    const lbl=document.createElement('label');
    lbl.className='mp-upload-btn';
    lbl.title='Upload MP3';
    lbl.innerHTML=`<input type="file" accept="audio/*" multiple style="display:none" onchange="uploadTracks(this)"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Add your music`;
    pl.appendChild(lbl);
  }
}
Billing
function loadTrack(i){
  const t=tracks[i];
  document.getElementById('mpTitle').textContent=t.title;
  document.getElementById('mpArtist').textContent=t.artist;
  document.getElementById('mpDisc').textContent=t.emoji||'🎵';
  document.getElementById('mpProg').style.width='0%';
  audioEl.src=t.url;
  // read real duration once metadata loads
  audioEl.onloadedmetadata=()=>{
    const d=fmtTime(audioEl.duration);
    tracks[i].dur=d;
    renderPlaylist();
  };
  renderPlaylist();
}

audioEl.addEventListener('timeupdate',()=>{
  if(!audioEl.duration) return;
  const pct=(audioEl.currentTime/audioEl.duration)*100;
  document.getElementById('mpProg').style.width=pct+'%';
});
audioEl.addEventListener('ended',()=>{
  if(repeat){audioEl.currentTime=0;audioEl.play();}
  else nextTrack();
});

function togglePlay(){
  if(isPlaying){audioEl.pause();}
  else{audioEl.play().catch(()=>{});}
  isPlaying=!isPlaying;
  const mp=document.getElementById('musicPlayer');
  mp.classList.toggle('playing',isPlaying);
  const icon=isPlaying?'⏸':'▶';
  document.getElementById('mpPlayBtn').textContent=icon;
  document.getElementById('mpPlayMini').textContent=icon;
}

function nextTrack(){
  const next=shuffle?Math.floor(Math.random()*tracks.length):(currentTrack+1)%tracks.length;
  currentTrack=next;
  loadTrack(next);
  if(isPlaying) audioEl.play().catch(()=>{});
}
function prevTrack(){
  if(audioEl.currentTime>3){audioEl.currentTime=0;return;}
  currentTrack=(currentTrack-1+tracks.length)%tracks.length;
  loadTrack(currentTrack);
  if(isPlaying) audioEl.play().catch(()=>{});
}
function playTrack(i){
  if(isPlaying){audioEl.pause();isPlaying=false;}
  currentTrack=i;loadTrack(i);
  isPlaying=true;
  document.getElementById('musicPlayer').classList.add('playing');
  document.getElementById('mpPlayBtn').textContent='⏸';
  document.getElementById('mpPlayMini').textContent='⏸';
  if(tracks[i].url) audioEl.play().catch(()=>{});
}
function seekTrack(e){
  const r=e.currentTarget.getBoundingClientRect();
  const pct=(e.clientX-r.left)/r.width;
  if(tracks[currentTrack].url && audioEl.duration){
    audioEl.currentTime=pct*audioEl.duration;
  }
  document.getElementById('mpProg').style.width=(pct*100)+'%';
}
function setVolume(e){
  const r=e.currentTarget.getBoundingClientRect();
  const v=Math.max(0,Math.min(1,(e.clientX-r.left)/r.width));
  audioEl.volume=v;
  document.getElementById('mpVolFill').style.width=(v*100)+'%';
}
function shuffleToggle(btn){shuffle=!shuffle;btn.style.color=shuffle?'var(--accent)':''}
function repeatToggle(btn){repeat=!repeat;audioEl.loop=repeat;btn.style.color=repeat?'var(--accent)':''}
function toggleMusicExpand(){
  if(!navOpen){toggleNav();return;}
  document.getElementById('musicPlayer').classList.toggle('collapsed');
}
function togglePlaylist(){
  const pl=document.getElementById('mpPlaylist');
  const ch=document.getElementById('plChevron');
  pl.classList.toggle('show');
  ch.style.transform=pl.classList.contains('show')?'rotate(180deg)':'';
}

/* ══ MP3 UPLOAD ══ */
function uploadTracks(input){
  const files=Array.from(input.files);
  if(!files.length) return;
  files.forEach(file=>{
    const url=URL.createObjectURL(file);
    const name=file.name.replace(/\.(mp3|wav|ogg|flac|aac|m4a)$/i,'').replace(/_/g,' ');
    // get duration via temp audio
    const tmp=new Audio(url);
    tmp.addEventListener('loadedmetadata',()=>{
      const dur=fmtTime(tmp.duration);
      tracks.push({title:name,artist:'My Music',dur:dur,emoji:'🎵',url:url});
      renderPlaylist();
      // auto-play first upload
      if(tracks.length===files.indexOf(file)+8){
        playTrack(tracks.length-files.length);
      }
    });
  });
  input.value=''; // reset so same file can be re-uploaded
}

renderPlaylist();
</script>

</body>
</html>