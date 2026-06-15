<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>{{ $seo->meta_title ?: 'ER Communication — PR & Strategic Communication Agency' }}</title>
@if($seo->meta_description)
<meta name="description" content="{{ $seo->meta_description }}"/>
@endif
@if($seo->keywords)
<meta name="keywords" content="{{ $seo->keywords }}"/>
@endif
@if($seo->og_image)
<meta property="og:image" content="{{ Storage::url($seo->og_image) }}"/>
@endif
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"/>
@if($seo->ga_tracking_id)
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->ga_tracking_id }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $seo->ga_tracking_id }}');
</script>
@endif
{!! $seo->custom_script_head !!}
<style>
/* ============================================================
   TOKENS
============================================================ */
:root{
  --bg:         #0A0D12;
  --bg2:        #0D1017;
  --bg3:        #111520;
  --card:       #13161E;
  --border:     rgba(255,255,255,0.08);
  --orange:     #E8622A;
  --orange2:    #F07840;
  --teal:       #00C2A8;
  --white:      #FFFFFF;
  --off:        #E8EAF0;
  --muted:      #7A7F92;
  --muted2:     #555A6E;
  --serif:      'DM Serif Display',serif;
  --sans:       'Plus Jakarta Sans',sans-serif;
  --r:          8px;
}

/* ============================================================
   RESET
============================================================ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
  background:var(--bg);
  color:var(--white);
  font-family:var(--sans);
  font-size:15px;
  line-height:1.6;
  overflow-x:hidden;
}
a{color:inherit;text-decoration:none}
img{display:block;max-width:100%}
ul{list-style:none}

/* ============================================================
   LAYOUT
============================================================ */
.wrap{width:100%;max-width:1160px;margin:0 auto;padding:0 40px}

/* ============================================================
   NAVBAR
============================================================ */
nav{
  position:fixed;top:0;left:0;right:0;
  z-index:200;
  transition:background .3s,backdrop-filter .3s;
}
nav.stuck{
  background:rgba(10,13,18,.9);
  backdrop-filter:blur(18px);
  border-bottom:1px solid var(--border);
}
.nav-inner{
  display:flex;align-items:center;
  height:64px;gap:32px;
}
.nav-logo{
  display:flex;align-items:center;gap:4px;
  font-family:var(--serif);font-size:26px;font-weight:400;
  flex-shrink:0;
}
.nav-logo .er{color:var(--white)}
.nav-logo .dot{
  display:inline-block;width:10px;height:10px;
  border-radius:50%;background:var(--teal);
  margin-left:2px;
}
.nav-links{
  display:flex;align-items:center;gap:28px;flex:1;
}
.nav-links a{
  font-size:13px;font-weight:500;color:var(--muted);
  transition:color .2s;white-space:nowrap;
}
.nav-links a:hover{color:var(--white)}
.nav-right{display:flex;align-items:center;gap:12px;margin-left:auto}
.nav-search{
  width:36px;height:36px;border-radius:50%;
  background:rgba(255,255,255,.07);
  border:none;cursor:pointer;color:var(--muted);
  display:flex;align-items:center;justify-content:center;
  font-size:15px;transition:background .2s;
}
.nav-search:hover{background:rgba(255,255,255,.12)}

/* ============================================================
   HERO
============================================================ */
#hero{
  position:relative;
  min-height:100vh;
  display:flex;align-items:flex-end;
  overflow:hidden;
}
.hero-bg{
  position:absolute;inset:0;
  background:
    linear-gradient(to bottom, rgba(10,13,18,0) 0%, rgba(10,13,18,.4) 50%, rgba(10,13,18,.95) 100%),
    linear-gradient(to right, rgba(10,13,18,.5) 0%, transparent 60%);
  z-index:1;
}
/* Simulated building photo background */
.hero-photo{
  position:absolute;inset:0;
  background:
    /* teal overlay top-right */
    radial-gradient(ellipse 60% 70% at 70% 20%, rgba(0,194,168,.15) 0%, transparent 70%),
    /* dark blue tint */
    linear-gradient(160deg, #0D1A2E 0%, #0A1220 40%, #060810 100%);
  z-index:0;
}
/* Building silhouette shapes */
.hero-photo::before{
  content:'';position:absolute;
  bottom:0;right:0;
  width:65%;height:100%;
  background:
    repeating-linear-gradient(
      0deg,
      transparent,
      transparent 28px,
      rgba(0,194,168,.04) 28px,
      rgba(0,194,168,.04) 29px
    ),
    repeating-linear-gradient(
      90deg,
      transparent,
      transparent 44px,
      rgba(0,194,168,.04) 44px,
      rgba(0,194,168,.04) 45px
    );
  clip-path:polygon(8% 0,100% 0,100% 100%,0 100%);
  opacity:.6;
}
/* Building blocks */
.hero-bld{position:absolute;bottom:0;right:0;width:65%;height:92%;display:flex;align-items:flex-end;gap:12px;padding-right:0;overflow:hidden;z-index:0}
.b1{width:18%;height:88%;background:linear-gradient(to top,#1a2a3a,#0e1824);border-top:2px solid rgba(0,194,168,.3);display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:repeat(18,1fr);gap:1px;padding:4px}
.b1 span{background:rgba(0,194,168,.1);border-radius:1px}
.b1 span:nth-child(3n){background:rgba(0,194,168,.18)}
.b2{width:22%;height:100%;background:linear-gradient(to top,#223040,#0f1e2e);border-top:2px solid rgba(0,194,168,.4);display:grid;grid-template-columns:1fr 1fr 1fr 1fr;grid-template-rows:repeat(24,1fr);gap:1px;padding:4px}
.b2 span{background:rgba(0,194,168,.08);border-radius:1px}
.b2 span:nth-child(4n+1){background:rgba(0,194,168,.2)}
.b2 span:nth-child(4n+2){background:rgba(255,255,255,.06)}
.b3{width:16%;height:75%;background:linear-gradient(to top,#182030,#0c1522);border-top:2px solid rgba(0,194,168,.2)}
.b4{width:14%;height:60%;background:linear-gradient(to top,#1e2c3e,#111e2c);border-top:1px solid rgba(0,194,168,.15)}

.hero-content{
  position:relative;z-index:2;
  width:100%;padding:0 40px 80px;
  max-width:1160px;margin:0 auto;
}
.hero-tag{
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:var(--teal);margin-bottom:24px;
}
.hero-h1{
  font-family:var(--serif);
  font-size:clamp(44px,5.5vw,76px);
  line-height:1.06;
  font-weight:400;
  max-width:680px;
  margin-bottom:20px;
}
.hero-h1 .trust{color:var(--orange)}
.hero-desc{
  font-size:14px;color:var(--muted);
  max-width:420px;line-height:1.75;margin-bottom:48px;
}
.hero-stats{display:flex;gap:64px}
.hstat-label{
  font-size:11px;font-weight:600;letter-spacing:.08em;
  text-transform:uppercase;color:var(--muted);margin-bottom:6px;
}
.hstat-num{
  font-family:var(--serif);
  font-size:clamp(36px,4vw,52px);
  font-weight:400;line-height:1;
}
.hstat-num .accent{color:var(--orange)}

/* ============================================================
   SECTION COMMONS
============================================================ */
section{padding:100px 0}
.s-tag{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.13em;
  text-transform:uppercase;color:var(--orange);
  margin-bottom:14px;
}
.s-tag::before{
  content:'';display:block;width:18px;height:2px;
  background:var(--orange);
}
.s-h2{
  font-family:var(--serif);
  font-size:clamp(28px,3.5vw,44px);
  font-weight:400;line-height:1.15;
}
.s-h2 em{font-style:italic;color:var(--orange)}
.s-body{
  font-size:14px;color:var(--muted);
  line-height:1.8;margin-top:14px;max-width:520px;
}

/* ============================================================
   ABOUT / SERVICES SECTION
============================================================ */
#about{padding:80px 0 100px;background:var(--bg)}
.about-grid{display:grid;grid-template-columns:1fr 1.6fr;gap:80px;align-items:start}
.about-left .s-h2{font-size:clamp(26px,3.2vw,40px);max-width:320px}

/* 3-column image grid */
.img-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:10px;
  margin-top:0;
}
.img-col{display:flex;flex-direction:column;gap:10px}
.img-thumb{
  border-radius:10px;overflow:hidden;
  background:var(--bg3);
  border:1px solid var(--border);
  position:relative;
}
.img-thumb.tall{aspect-ratio:3/4}
.img-thumb.wide{aspect-ratio:16/11}
.img-thumb.sq  {aspect-ratio:1/1}
/* gradient fills simulating photos */
.ph-1{background:linear-gradient(135deg,#1a2535 0%,#2a3a50 50%,#1a2535 100%)}
.ph-2{background:linear-gradient(135deg,#0e1825 0%,#1e3040 60%,#0e1825 100%)}
.ph-3{background:linear-gradient(155deg,#1a1e2a 0%,#2a2e3e 50%,#141820 100%)}
.ph-4{background:linear-gradient(135deg,#101820 0%,#182838 55%,#101820 100%)}
.ph-5{background:linear-gradient(145deg,#0c1520 0%,#162030 60%,#0c1520 100%)}
.ph-6{background:linear-gradient(135deg,#141822 0%,#1e2838 50%,#141822 100%)}
/* faint building-like grid inside each photo */
.img-thumb::after{
  content:'';position:absolute;inset:0;
  background:
    repeating-linear-gradient(0deg,transparent,transparent 18px,rgba(255,255,255,.03) 18px,rgba(255,255,255,.03) 19px),
    repeating-linear-gradient(90deg,transparent,transparent 18px,rgba(255,255,255,.03) 18px,rgba(255,255,255,.03) 19px);
  pointer-events:none;
}
.img-label{
  font-size:13px;font-weight:600;color:var(--off);
  margin-top:10px;text-align:center;
}
/* carousel dots */
.carousel-dots{
  display:flex;justify-content:center;align-items:center;
  gap:6px;margin-top:24px;
}
.carousel-dots span{
  width:8px;height:8px;border-radius:50%;
  background:rgba(255,255,255,.2);
  cursor:pointer;transition:all .2s;
}
.carousel-dots span.active{background:var(--orange);width:22px;border-radius:4px}
/* nav arrows */
.carousel-nav{display:flex;justify-content:flex-end;gap:8px;margin-top:16px}
.carr-btn{
  width:36px;height:36px;border-radius:50%;
  border:1px solid var(--border);background:transparent;
  color:var(--muted);cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:14px;transition:all .2s;
}
.carr-btn:hover{background:var(--orange);border-color:var(--orange);color:#fff}

/* ============================================================
   NARRATIVE + STATS
============================================================ */
#narrative{
  padding:80px 0;
  background:var(--bg2);
  border-top:1px solid var(--border);
  border-bottom:1px solid var(--border);
}
.narr-inner{
  display:grid;grid-template-columns:1fr 1fr;
  gap:80px;align-items:center;
}
.narr-text{
  font-family:var(--serif);
  font-size:clamp(18px,2.2vw,26px);
  line-height:1.6;color:var(--off);
  font-weight:400;
}
.narr-text strong{font-weight:400;color:var(--white)}
.narr-stats-row{
  display:grid;grid-template-columns:repeat(4,1fr);
  border-top:1px solid var(--border);
  border-left:1px solid var(--border);
  margin-top:40px;
  border-radius:10px;overflow:hidden;
}
/* colspan span entire width */
.narr-stats-full{
  grid-column:1/-1;
  display:grid;grid-template-columns:repeat(4,1fr);
}
.nstat{
  padding:28px 24px;
  border-right:1px solid var(--border);
  border-bottom:1px solid var(--border);
}
.nstat:last-child{border-right:none}
.nstat-num{
  font-family:var(--serif);
  font-size:clamp(30px,3.5vw,44px);
  font-weight:400;line-height:1;margin-bottom:6px;
}
.nstat-num .hl{color:var(--orange)}
.nstat-label{font-size:12px;color:var(--muted);line-height:1.5}
/* small avatars row in stat */
.nstat-avs{
  display:flex;margin-top:10px;
}
.nstat-av{
  width:26px;height:26px;border-radius:50%;
  border:2px solid var(--bg2);
  background:var(--card);
  margin-left:-8px;
  display:flex;align-items:center;justify-content:center;
  font-size:10px;font-weight:700;color:var(--muted);
  overflow:hidden;
}
.nstat-av:first-child{margin-left:0}
.av-a{background:linear-gradient(135deg,#e8622a,#c0392b)}
.av-b{background:linear-gradient(135deg,#3b82f6,#6366f1)}
.av-c{background:linear-gradient(135deg,#22c55e,#16a34a)}
.av-d{background:linear-gradient(135deg,#f59e0b,#d97706)}
.trusted-bar{
  text-align:center;
  font-size:12px;color:var(--muted);
  font-weight:500;letter-spacing:.05em;
  padding:16px 0 0;
  border-top:1px solid var(--border);
  margin-top:0;
}

/* ============================================================
   TESTIMONIAL
============================================================ */
#testimonial{
  padding:100px 0;
  background:var(--bg);
  text-align:center;
  position:relative;overflow:hidden;
}
.testi-glow{
  position:absolute;
  top:50%;left:50%;transform:translate(-50%,-50%);
  width:600px;height:600px;border-radius:50%;
  background:radial-gradient(circle,rgba(0,194,168,.06) 0%,transparent 70%);
  pointer-events:none;
}
.testi-quote-mark{
  font-family:var(--serif);font-size:80px;line-height:.8;
  color:var(--teal);opacity:.4;margin-bottom:8px;
}
.testi-text{
  font-family:var(--serif);font-size:clamp(20px,2.8vw,32px);
  font-weight:400;line-height:1.5;
  color:var(--off);max-width:760px;margin:0 auto 32px;
  position:relative;z-index:1;
}
.testi-author{
  display:inline-flex;align-items:center;gap:12px;
  position:relative;z-index:1;
}
.testi-av{
  width:44px;height:44px;border-radius:50%;
  background:linear-gradient(135deg,var(--teal),#0088aa);
  display:flex;align-items:center;justify-content:center;
  font-size:18px;
  overflow:hidden;
}
.testi-name{font-size:14px;font-weight:700}
.testi-role{font-size:12px;color:var(--muted)}
/* orbit dot decorations */
.orbit{
  position:absolute;border-radius:50%;
  border:1px solid rgba(0,194,168,.15);
  pointer-events:none;
}
.orbit-1{width:300px;height:300px;top:-60px;right:-60px}
.orbit-2{width:200px;height:200px;bottom:-40px;left:5%}

/* ============================================================
   PARTNERS
============================================================ */
#partners{
  padding:80px 0;
  background:var(--bg2);
  border-top:1px solid var(--border);
}
.partners-layout{
  display:grid;grid-template-columns:300px 1fr;gap:80px;
  align-items:start;
}
.partners-left .s-h2{font-size:clamp(22px,2.8vw,34px);margin-bottom:14px}
.partners-rate{
  display:flex;align-items:center;gap:8px;
  margin-top:24px;font-size:14px;font-weight:600;
  color:var(--teal);
}
.partners-rate svg{flex-shrink:0}
.logo-grid{
  display:grid;grid-template-columns:repeat(3,1fr);
  border-left:1px solid var(--border);
  border-top:1px solid var(--border);
}
.logo-cell{
  padding:24px 28px;
  border-right:1px solid var(--border);
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
}
.logo-name{
  font-size:14px;font-weight:700;
  color:var(--muted2);letter-spacing:.04em;
  transition:color .2s;
}
.logo-cell:hover .logo-name{color:var(--white)}

/* ============================================================
   TEAM
============================================================ */
#team{
  padding:100px 0;
  background:var(--bg);
  border-top:1px solid var(--border);
}
.team-tabs{
  display:flex;gap:8px;margin-bottom:48px;
  border-bottom:1px solid var(--border);padding-bottom:0;
}
.tab-btn{
  padding:10px 24px;
  border:none;background:transparent;
  font-family:var(--sans);font-size:13px;font-weight:600;
  color:var(--muted);cursor:pointer;
  border-bottom:2px solid transparent;
  margin-bottom:-1px;transition:all .2s;
}
.tab-btn.active{color:var(--white);border-bottom-color:var(--orange)}
.tab-btn:hover{color:var(--white)}
.team-layout{
  display:grid;grid-template-columns:280px 1fr;gap:60px;align-items:start;
}
.team-feature-photo{
  position:relative;
}
.team-photo-wrap{
  border-radius:16px;overflow:hidden;
  aspect-ratio:3/4;background:var(--card);
  border:1px solid var(--border);
  position:relative;
}
.team-photo-bg{
  width:100%;height:100%;
  /* Curly hair woman illustration */
  background:linear-gradient(180deg,#1e2a3a 0%,#2a3a50 40%,#1a2535 100%);
  display:flex;align-items:flex-end;justify-content:center;
  overflow:hidden;position:relative;
}
/* Circle glow behind person */
.team-photo-bg::before{
  content:'';position:absolute;
  bottom:20%;left:50%;transform:translateX(-50%);
  width:180px;height:180px;border-radius:50%;
  background:radial-gradient(circle,rgba(0,194,168,.2) 0%,transparent 70%);
}
.team-person-silhouette{
  position:relative;z-index:1;
  width:200px;height:260px;
  background:linear-gradient(to bottom,#4a3828,#2a2018);
  border-radius:50% 50% 0 0 / 60% 60% 0 0;
  overflow:hidden;
  margin-bottom:0;
}
.team-person-silhouette::before{
  content:'';position:absolute;
  top:-20px;left:50%;transform:translateX(-50%);
  width:80px;height:80px;border-radius:50%;
  background:linear-gradient(135deg,#6a4a38,#4a3028);
}
.team-photo-teal{
  position:absolute;bottom:-20px;right:-20px;
  width:120px;height:120px;border-radius:50%;
  background:radial-gradient(circle,rgba(0,194,168,.3) 0%,transparent 70%);
}
.team-feature-name{
  font-family:var(--serif);font-size:22px;color:var(--teal);
  font-weight:400;margin-top:20px;
}
.team-feature-role{font-size:13px;color:var(--muted);margin-bottom:20px}
.team-feature-desc{font-size:13px;color:var(--muted);line-height:1.7;margin-bottom:24px}
.team-avatars{display:flex;gap:8px;margin-top:16px;flex-wrap:wrap}
.t-av{
  width:40px;height:40px;border-radius:50%;
  border:2px solid var(--border);
  background:var(--card);overflow:hidden;cursor:pointer;
  transition:border-color .2s;
  display:flex;align-items:center;justify-content:center;
  font-size:12px;font-weight:700;color:var(--muted);
}
.t-av:hover,.t-av.active{border-color:var(--teal)}
.av-1c{background:linear-gradient(135deg,#3b82f6,#6366f1)}
.av-2c{background:linear-gradient(135deg,#e8622a,#c0392b)}
.av-3c{background:linear-gradient(135deg,#22c55e,#16a34a)}
.av-4c{background:linear-gradient(135deg,#f59e0b,#d97706)}
.team-right-title{font-size:18px;font-weight:700;margin-bottom:8px}
.team-right-sub{font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:28px;max-width:380px}
.btn-see-team{
  display:inline-flex;align-items:center;gap:8px;
  padding:10px 24px;border-radius:6px;
  background:transparent;border:1.5px solid var(--border);
  font-family:var(--sans);font-size:13px;font-weight:600;
  color:var(--white);cursor:pointer;transition:all .2s;
}
.btn-see-team:hover{border-color:var(--teal);color:var(--teal)}

/* ============================================================
   PORTFOLIO / SERVICES
============================================================ */
#portfolio{
  padding:80px 0 100px;
  background:var(--bg2);
  border-top:1px solid var(--border);
}
.port-header{margin-bottom:40px}
.port-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.port-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:14px;overflow:hidden;
  transition:transform .3s,border-color .3s;
  cursor:pointer;
}
.port-card:hover{transform:translateY(-4px);border-color:rgba(232,98,42,.3)}
.port-thumb{
  aspect-ratio:16/10;position:relative;overflow:hidden;
}
.pt-1{background:linear-gradient(135deg,#1a2535,#2a3a55)}
.pt-2{background:linear-gradient(135deg,#1e2530,#2a3040)}
.pt-3{background:linear-gradient(135deg,#151e2e,#1e2840)}
.port-thumb::after{
  content:'';position:absolute;inset:0;
  background:
    repeating-linear-gradient(0deg,transparent,transparent 22px,rgba(255,255,255,.03) 22px,rgba(255,255,255,.03) 23px),
    repeating-linear-gradient(90deg,transparent,transparent 22px,rgba(255,255,255,.03) 22px,rgba(255,255,255,.03) 23px);
}
.port-badge{
  position:absolute;top:14px;left:14px;
  padding:4px 10px;border-radius:100px;
  font-size:10px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  background:rgba(232,98,42,.9);color:#fff;
  z-index:2;
}
.port-body{padding:24px}
.port-title{font-size:16px;font-weight:700;margin-bottom:8px;line-height:1.4}
.port-desc{font-size:13px;color:var(--muted);line-height:1.65;margin-bottom:20px}
.port-link{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 18px;border-radius:6px;
  background:var(--orange);color:#fff;
  font-size:12px;font-weight:700;
  transition:background .2s;
}
.port-link:hover{background:var(--orange2)}
/* Decorative icons inside thumb */
.port-thumb-icon{
  position:absolute;inset:0;
  display:flex;align-items:center;justify-content:center;
  font-size:36px;opacity:.18;z-index:1;
}

/* ============================================================
   CONTACT
============================================================ */
#contact{
  padding:80px 0;
  background:var(--bg);
  border-top:1px solid var(--border);
}
.contact-grid{
  display:grid;grid-template-columns:1fr 1.2fr;gap:60px;align-items:start;
}
.contact-left .s-h2{font-size:clamp(22px,2.8vw,34px);margin-bottom:16px}
.contact-left p{font-size:14px;color:var(--muted);line-height:1.75;margin-bottom:32px}
.contact-map{
  border-radius:12px;overflow:hidden;
  border:1px solid var(--border);
  aspect-ratio:4/3;
  background:linear-gradient(135deg,#0e1824,#162030);
  position:relative;
  display:flex;align-items:center;justify-content:center;
}
/* Simple map grid */
.contact-map::before{
  content:'';position:absolute;inset:0;
  background:
    repeating-linear-gradient(0deg,transparent,transparent 30px,rgba(0,194,168,.05) 30px,rgba(0,194,168,.05) 31px),
    repeating-linear-gradient(90deg,transparent,transparent 30px,rgba(0,194,168,.05) 30px,rgba(0,194,168,.05) 31px);
}
.map-pin{
  position:relative;z-index:1;
  display:flex;flex-direction:column;align-items:center;
  gap:4px;
}
.map-pin-dot{
  width:14px;height:14px;border-radius:50%;
  background:var(--orange);
  box-shadow:0 0 0 6px rgba(232,98,42,.25);
}
.map-pin-label{
  background:var(--card);border:1px solid var(--border);
  padding:4px 10px;border-radius:6px;
  font-size:11px;font-weight:600;color:var(--white);
  white-space:nowrap;
}
.contact-right{}
.contact-title{font-size:18px;font-weight:700;margin-bottom:6px}
.contact-sub{font-size:13px;color:var(--muted);margin-bottom:28px}
.form-group{margin-bottom:16px}
.form-group label{
  display:block;font-size:12px;font-weight:600;
  color:var(--muted);margin-bottom:6px;letter-spacing:.05em;text-transform:uppercase;
}
.form-group input,
.form-group textarea{
  width:100%;
  background:var(--card);border:1px solid var(--border);
  border-radius:8px;padding:12px 16px;
  font-family:var(--sans);font-size:14px;color:var(--white);
  outline:none;transition:border-color .2s;resize:none;
}
.form-group input::placeholder,
.form-group textarea::placeholder{color:var(--muted2)}
.form-group input:focus,
.form-group textarea:focus{border-color:rgba(0,194,168,.4)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.btn-send{
  width:100%;padding:13px;border-radius:8px;
  background:var(--orange);border:none;
  font-family:var(--sans);font-size:14px;font-weight:700;
  color:#fff;cursor:pointer;
  display:flex;align-items:center;justify-content:center;gap:8px;
  transition:background .2s;margin-top:8px;
}
.btn-send:hover{background:var(--orange2)}
.contact-details{
  margin-top:28px;display:flex;flex-direction:column;gap:12px;
}
.cd-item{
  display:flex;align-items:center;gap:10px;
  font-size:13px;color:var(--muted);
}
.cd-icon{
  width:32px;height:32px;border-radius:8px;
  background:rgba(0,194,168,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:14px;flex-shrink:0;
}

/* ============================================================
   WHATSAPP FLOAT
============================================================ */
.wa-float{
  position:fixed;bottom:32px;right:32px;
  width:56px;height:56px;border-radius:50%;
  background:#25D366;
  display:flex;align-items:center;justify-content:center;
  font-size:26px;cursor:pointer;z-index:300;
  box-shadow:0 8px 32px rgba(37,211,102,.4);
  transition:transform .2s,box-shadow .2s;
}
.wa-float:hover{transform:scale(1.1);box-shadow:0 12px 40px rgba(37,211,102,.5)}

/* ============================================================
   FOOTER
============================================================ */
footer{
  background:var(--bg);
  border-top:1px solid var(--border);
  padding:64px 0 32px;
}
.footer-grid{
  display:grid;
  grid-template-columns:1.4fr 1fr 1fr 1fr;
  gap:48px;margin-bottom:48px;
}
.footer-logo{
  font-family:var(--serif);font-size:28px;
  display:flex;align-items:center;gap:4px;
  margin-bottom:14px;
}
.footer-logo .dot{
  display:inline-block;width:10px;height:10px;
  border-radius:50%;background:var(--teal);
  margin-left:2px;
}
.footer-desc{font-size:13px;color:var(--muted);line-height:1.75;max-width:240px}
.footer-socials{display:flex;gap:8px;margin-top:20px}
.fs-btn{
  width:34px;height:34px;border-radius:8px;
  border:1px solid var(--border);background:transparent;
  color:var(--muted);cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:13px;transition:all .2s;
}
.fs-btn:hover{border-color:var(--teal);color:var(--teal)}
.footer-col h4{
  font-size:13px;font-weight:700;letter-spacing:.06em;
  text-transform:uppercase;color:var(--white);margin-bottom:18px;
}
.footer-col ul li{margin-bottom:10px}
.footer-col ul li a{
  font-size:13px;color:var(--muted);transition:color .2s;
}
.footer-col ul li a:hover{color:var(--white)}
.footer-bottom{
  display:flex;justify-content:space-between;align-items:center;
  padding-top:28px;border-top:1px solid var(--border);
  font-size:12px;color:var(--muted);
}
.footer-socials-inline{display:flex;gap:12px}
.footer-socials-inline a{
  font-size:12px;color:var(--muted);transition:color .2s;
}
.footer-socials-inline a:hover{color:var(--white)}

/* ============================================================
   SCROLL REVEAL
============================================================ */
.rv{opacity:0;transform:translateY(28px);transition:opacity .55s ease,transform .55s ease}
.rv.in{opacity:1;transform:none}
.rv1{transition-delay:.1s}
.rv2{transition-delay:.2s}
.rv3{transition-delay:.3s}
.rv4{transition-delay:.4s}

/* ============================================================
   PREVIEW / CMS ADDITIONS
============================================================ */
.nav-cta{
  display:inline-flex;align-items:center;
  padding:9px 20px;border-radius:6px;
  background:var(--orange);color:#fff;
  font-size:13px;font-weight:700;white-space:nowrap;
  transition:background .2s;
}
.nav-cta:hover{background:var(--orange2)}
.hero-cta{
  display:inline-flex;align-items:center;gap:8px;
  margin-top:-20px;margin-bottom:48px;
  padding:13px 28px;border-radius:8px;
  background:var(--orange);color:#fff;
  font-size:14px;font-weight:700;
  transition:background .2s;
}
.hero-cta:hover{background:var(--orange2)}
.about-est{
  display:inline-flex;align-items:center;gap:8px;
  margin-top:18px;padding:8px 16px;border-radius:100px;
  border:1px solid var(--border);
  font-size:12px;font-weight:600;color:var(--teal);
}
.about-video-link{
  display:inline-flex;align-items:center;gap:8px;
  margin-top:18px;font-size:13px;font-weight:600;color:var(--teal);
  transition:color .2s;
}
.about-video-link:hover{color:var(--orange)}
.nstat-desc{font-size:11px;color:var(--muted2);line-height:1.5;margin-top:6px}
.logo-cell img{max-height:32px;max-width:120px;object-fit:contain;filter:grayscale(1) brightness(2);opacity:.6;transition:opacity .2s,filter .2s}
.logo-cell:hover img{opacity:1;filter:none}
.contact-map-link{display:block}
.team-photo-wrap img,
.t-av img,
.port-thumb img,
.testi-av img,
.nstat-av img,
.cta-av img{width:100%;height:100%;object-fit:cover}

/* CTA Banner */
#cta-banner{
  padding:80px 0;
  background:var(--bg2);
  border-top:1px solid var(--border);
  border-bottom:1px solid var(--border);
  position:relative;overflow:hidden;
}
.cta-banner-glow{
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  width:700px;height:700px;border-radius:50%;
  background:radial-gradient(circle,rgba(232,98,42,.08) 0%,transparent 70%);
  pointer-events:none;
}
.cta-banner-inner{
  position:relative;z-index:1;
  display:flex;align-items:center;justify-content:space-between;gap:48px;
  flex-wrap:wrap;
}
.cta-banner-left{flex:1;min-width:280px}
.cta-banner-status{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--teal);margin-bottom:16px;
}
.cta-banner-status::before{
  content:'';display:block;width:8px;height:8px;border-radius:50%;
  background:var(--teal);box-shadow:0 0 0 4px rgba(0,194,168,.2);
}
.cta-banner-sub{font-size:14px;color:var(--muted);line-height:1.8;margin-top:14px;max-width:460px}
.cta-banner-avatars{display:flex;margin-top:24px}
.cta-av{
  width:44px;height:44px;border-radius:50%;
  border:2px solid var(--bg2);
  background:var(--card);margin-left:-10px;
  display:flex;align-items:center;justify-content:center;
  font-size:13px;font-weight:700;color:var(--muted);
  overflow:hidden;
}
.cta-av:first-child{margin-left:0}
.cta-banner-right{flex-shrink:0}
.cta-banner-btn{
  display:inline-flex;align-items:center;gap:10px;
  padding:16px 32px;border-radius:8px;
  background:var(--orange);color:#fff;
  font-size:14px;font-weight:700;
  transition:background .2s;
}
.cta-banner-btn:hover{background:var(--orange2)}

/* ============================================================
   RESPONSIVE
============================================================ */
@media(max-width:1024px){
  .about-grid{grid-template-columns:1fr;gap:48px}
  .narr-inner{grid-template-columns:1fr;gap:40px}
  .narr-stats-row{grid-template-columns:repeat(2,1fr)}
  .partners-layout{grid-template-columns:1fr;gap:40px}
  .team-layout{grid-template-columns:1fr}
  .contact-grid{grid-template-columns:1fr;gap:48px}
  .footer-grid{grid-template-columns:1fr 1fr;gap:36px}
  .cta-banner-inner{flex-direction:column;align-items:flex-start;text-align:left}
}
@media(max-width:768px){
  .wrap{padding:0 20px}
  section{padding:64px 0}
  .hero-content{padding:0 20px 60px}
  .img-grid{grid-template-columns:repeat(2,1fr)}
  .logo-grid{grid-template-columns:repeat(2,1fr)}
  .port-grid{grid-template-columns:1fr}
  .footer-grid{grid-template-columns:1fr}
  .footer-bottom{flex-direction:column;gap:12px;text-align:center}
  nav{display:none} /* simplified mobile — show basic */
}
</style>
</head>
<body>

<!-- ===================== NAVBAR ===================== -->
<nav id="navbar" data-sticky="{{ $navbar->sticky_on_scroll ? '1' : '0' }}">
  <div class="wrap">
    <div class="nav-inner">
      <div class="nav-logo">
        @if($navbar->logo_light)
          <img src="{{ Storage::url($navbar->logo_light) }}" alt="Logo" style="height:32px;width:auto"/>
        @else
          <span class="er">ER</span><span class="dot"></span>
        @endif
      </div>
      <ul class="nav-links">
        @forelse(($navbar->menu_items ?? []) as $item)
          <li><a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a></li>
        @empty
          <li><a href="#about">About Us</a></li>
          <li><a href="#portfolio">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#partners">Partners</a></li>
          <li><a href="#contact">Contact</a></li>
        @endforelse
      </ul>
      <div class="nav-right">
        @if($navbar->cta_text)
          <a href="{{ $navbar->cta_url ?: '#contact' }}" class="nav-cta">{{ $navbar->cta_text }}</a>
        @endif
        <button class="nav-search">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- ===================== HERO ===================== -->
<section id="hero">
  <div class="hero-photo" @if($hero->background_image) style="background-image:url('{{ Storage::url($hero->background_image) }}');background-size:cover;background-position:center" @endif></div>
  @unless($hero->background_image)
  <!-- Building blocks visual -->
  <div class="hero-bld">
    <div class="b1">
      <!-- window lights -->
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
    </div>
    <div class="b2">
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span>
    </div>
    <div class="b3"></div>
    <div class="b4"></div>
  </div>
  @endunless
  <div class="hero-bg"></div>

  <div class="hero-content">
    <div class="hero-tag">PR &amp; Strategic Communication Agency</div>
    <h1 class="hero-h1">
      @php
        $heroHeadline = $hero->headline ?: "We are Building Trust.\nDriving Impact.";
        $heroHighlight = $hero->highlighted_word ?: ($hero->headline ? null : 'Trust.');
        $heroHeadlineHtml = nl2br(e($heroHeadline));
        if ($heroHighlight) {
            $escHighlight = e($heroHighlight);
            $heroHeadlineHtml = str_replace($escHighlight, '<span class="trust">'.$escHighlight.'</span>', $heroHeadlineHtml);
        }
      @endphp
      {!! $heroHeadlineHtml !!}
    </h1>
    <p class="hero-desc">
      {{ $hero->subheadline ?: 'We help businesses communicate with confidence through strategic PR and communication solutions. ER Communication partners with brands to strengthen reputation and drive meaningful impact.' }}
    </p>
    @if($hero->cta_text)
      <a href="{{ $hero->cta_url ?: '#contact' }}" class="hero-cta">
        {{ $hero->cta_text }}
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    @endif
    <div class="hero-stats">
      <div>
        <div class="hstat-label">Clients</div>
        <div class="hstat-num"><span class="counter" data-target="500">0</span><span class="accent">+</span></div>
      </div>
      <div>
        <div class="hstat-label">Achievements</div>
        <div class="hstat-num"><span class="counter" data-target="57">0</span><span class="accent">+</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== ABOUT ===================== -->
<section id="about">
  <div class="wrap">
    <div class="about-grid">
      <!-- left text -->
      <div class="rv">
        <div class="s-tag">About Us</div>
        <h2 class="s-h2">{{ $about->headline ?: "We're the pioneer of the PR automotive industry" }}</h2>
        <p class="s-body">{{ $about->description ?: 'ER Communication is one of leading agency in Indonesia and we specialize in consumer lifestyle. We combine strategy, creativity, and media intelligence to deliver campaigns that truly resonate.' }}</p>
        @if($about->year_established)
          <div class="about-est">Est. {{ $about->year_established }}</div>
        @endif
        @if($about->video_url)
          <a href="{{ $about->video_url }}" target="_blank" rel="noopener" class="about-video-link">
            &#9658; Watch our story
          </a>
        @endif
      </div>
      <!-- right image grid -->
      <div class="rv rv2">
        <div class="img-grid">
          <!-- col 1 -->
          <div class="img-col">
            <div class="img-thumb tall ph-1" @if($about->background_image) style="background-image:url('{{ Storage::url($about->background_image) }}');background-size:cover;background-position:center" @endif></div>
            <div class="img-thumb wide ph-2"></div>
          </div>
          <!-- col 2 -->
          <div class="img-col">
            <div class="img-thumb wide ph-3"></div>
            <div class="img-thumb tall ph-4"></div>
          </div>
          <!-- col 3 -->
          <div class="img-col">
            <div class="img-thumb tall ph-5" style="height:100%"></div>
          </div>
        </div>

        <!-- labels -->
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:12px">
          <div class="img-label">Media Relation</div>
          <div class="img-label">Media Relation</div>
          <div class="img-label">Media Relation</div>
        </div>

        <!-- dots + arrows -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:16px">
          <div class="carousel-dots">
            <span class="active"></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="carousel-nav">
            <button class="carr-btn">&#8592;</button>
            <button class="carr-btn">&#8594;</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== NARRATIVE + STATS ===================== -->
<section id="narrative">
  <div class="wrap">
    <div class="narr-inner">
      <!-- left text -->
      <div class="rv">
        <div class="s-tag">NOW</div>
        <p class="narr-text">
          Whether it's media relations, public communication or brand strategy, we help organizations communicate with <strong>clarity, trust, credibility, confidence</strong> in a fast-moving world.<br/><br/>
          And the results? The numbers speak for themselves:
        </p>
      </div>
      <!-- right stats grid -->
      <div class="rv rv2">
        <div style="background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;">
          <div style="display:grid;grid-template-columns:repeat(4,1fr);border-bottom:1px solid var(--border)">
            @forelse($stats as $i => $stat)
              <div class="nstat" @if($i > 0) style="border-left:1px solid var(--border)" @endif>
                <div class="nstat-num" @if(is_numeric($stat->stat_number)) style="display:flex;align-items:baseline;gap:4px" @endif>
                  @if(is_numeric($stat->stat_number))
                    <span class="counter2" data-target="{{ (int) $stat->stat_number }}">0</span>
                  @else
                    <span style="color:var(--white)">{{ $stat->stat_number }}</span>
                  @endif
                </div>
                <div class="nstat-label">{{ $stat->stat_label }}</div>
                @if($stat->description)
                  <div class="nstat-desc">{{ $stat->description }}</div>
                @endif
                @if(!empty($stat->avatar_images))
                  <div class="nstat-avs">
                    @foreach($stat->avatar_images as $avatar)
                      <div class="nstat-av"><img src="{{ Storage::url($avatar) }}" alt=""/></div>
                    @endforeach
                  </div>
                @endif
              </div>
            @empty
              <div class="nstat">
                <div class="nstat-num"><span style="color:var(--white)">1970</span></div>
                <div class="nstat-label">Years of establishment</div>
                <div class="nstat-avs">
                  <div class="nstat-av av-a">E</div>
                  <div class="nstat-av av-b">R</div>
                  <div class="nstat-av av-c">M</div>
                </div>
              </div>
              <div class="nstat" style="border-left:1px solid var(--border)">
                <div class="nstat-num" style="display:flex;align-items:baseline;gap:4px">
                  <span class="counter2" data-target="500">0</span>
                </div>
                <div class="nstat-label">Projects are launched</div>
                <div class="nstat-avs">
                  <div class="nstat-av av-a">A</div>
                  <div class="nstat-av av-b">B</div>
                  <div class="nstat-av av-c">C</div>
                  <div class="nstat-av av-d">D</div>
                </div>
              </div>
              <div class="nstat" style="border-left:1px solid var(--border)">
                <div class="nstat-num"><span class="counter2" data-target="50">0</span></div>
                <div class="nstat-label">Clients are satisfied</div>
                <div class="nstat-avs">
                  <div class="nstat-av av-b">X</div>
                  <div class="nstat-av av-c">Y</div>
                </div>
              </div>
              <div class="nstat" style="border-left:1px solid var(--border)">
                <div class="nstat-num"><span class="counter2" data-target="12">0</span></div>
                <div class="nstat-label">Projects in work</div>
                <div class="nstat-avs">
                  <div class="nstat-av av-a">P</div>
                  <div class="nstat-av av-d">Q</div>
                </div>
              </div>
            @endforelse
          </div>
          <div class="trusted-bar">
            Trusted by over 500+ clients at Indonesia's leading companies
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TESTIMONIAL ===================== -->
<section id="testimonial">
  <div class="orbit orbit-1"></div>
  <div class="orbit orbit-2"></div>
  <div class="testi-glow"></div>
  <div class="wrap">
    <div class="testi-quote-mark">"</div>
    <p class="testi-text rv">
      {{ $testimonial?->testimonial_text ?? "I imagine we can change the world, one head, one face or one body at a time. We think outside the lines of our craft." }}
    </p>
    <div class="testi-author rv rv1">
      <div class="testi-av">
        @if($testimonial?->photo)
          <img src="{{ Storage::url($testimonial->photo) }}" alt="{{ $testimonial->name }}"/>
        @else
          🌟
        @endif
      </div>
      <div>
        <div class="testi-name">{{ $testimonial?->name ?? 'Rini Kusuma' }}</div>
        <div class="testi-role">{{ $testimonial?->company_role ?? 'Brand Director' }}</div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== PARTNERS ===================== -->
<section id="partners">
  <div class="wrap">
    <div class="partners-layout">
      <!-- left -->
      <div class="rv">
        <div class="s-tag">Partners</div>
        <h2 class="s-h2">Partnering with Brands that Lead with Impact.</h2>
        <p class="s-body" style="max-width:260px">Always delivering top-quality services at all times. Deliver on our growing experience and skill-level.</p>
        <div class="partners-rate">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          66% attendance rate
        </div>
      </div>
      <!-- right logo grid -->
      <div class="logo-grid rv rv2">
        @forelse($partners as $partner)
          @if($partner->website_url)
            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener" class="logo-cell">
              <img src="{{ Storage::url($partner->logo_image) }}" alt="{{ $partner->name }}"/>
            </a>
          @else
            <div class="logo-cell">
              <img src="{{ Storage::url($partner->logo_image) }}" alt="{{ $partner->name }}"/>
            </div>
          @endif
        @empty
          <div class="logo-cell"><span class="logo-name">⬛ Adobe</span></div>
          <div class="logo-cell"><span class="logo-name">— Checkr</span></div>
          <div class="logo-cell"><span class="logo-name">◼ Square</span></div>
          <div class="logo-cell"><span class="logo-name">🐦 twitlio</span></div>
          <div class="logo-cell"><span class="logo-name">1Password</span></div>
          <div class="logo-cell"><span class="logo-name">BROADCOM</span></div>
          <div class="logo-cell"><span class="logo-name">🏀 NBA</span></div>
          <div class="logo-cell"><span class="logo-name">Simvoss</span></div>
          <div class="logo-cell"><span class="logo-name">⬛ Adobe</span></div>
          <div class="logo-cell"><span class="logo-name">⬜ Brex</span></div>
          <div class="logo-cell"><span class="logo-name">Motive</span></div>
          <div class="logo-cell"><span class="logo-name">univision</span></div>
        @endforelse
      </div>
    </div>
  </div>
</section>

<!-- ===================== TEAM ===================== -->
<section id="team">
  <div class="wrap">
    <!-- tabs -->
    <div class="team-tabs">
      <button class="tab-btn active" onclick="switchTab(this)">Clients</button>
      <button class="tab-btn" onclick="switchTab(this)">Teams</button>
      <button class="tab-btn" onclick="switchTab(this)">Experiences</button>
    </div>

    <div class="team-layout">
      <!-- featured person -->
      <div class="rv">
        @php
          $featured = $teamMembers->first();
          $teamRest = $teamMembers->slice(1, 4)->values();
          $teamExtra = max(0, $teamMembers->count() - 1 - $teamRest->count());
          $avClasses = ['av-1c', 'av-2c', 'av-3c', 'av-4c'];
        @endphp
        <div class="team-feature-photo">
          <div class="team-photo-wrap">
            @if($featured?->photo)
              <img src="{{ Storage::url($featured->photo) }}" alt="{{ $featured->name }}"/>
            @else
              <div class="team-photo-bg">
                <!-- Person silhouette -->
                <svg viewBox="0 0 280 380" width="100%" style="position:absolute;inset:0;z-index:1">
                  <!-- glow circle -->
                  <circle cx="140" cy="200" r="130" fill="rgba(0,194,168,0.08)"/>
                  <!-- body -->
                  <ellipse cx="140" cy="340" rx="100" ry="80" fill="#1a2535"/>
                  <!-- torso -->
                  <rect x="80" y="230" width="120" height="120" rx="20" fill="#263548"/>
                  <!-- head -->
                  <circle cx="140" cy="170" r="62" fill="#4a3828"/>
                  <!-- curly hair -->
                  <ellipse cx="140" cy="120" rx="72" ry="50" fill="#2a1e14"/>
                  <circle cx="88" cy="140" r="28" fill="#2a1e14"/>
                  <circle cx="192" cy="140" r="28" fill="#2a1e14"/>
                  <circle cx="110" cy="108" r="22" fill="#2a1e14"/>
                  <circle cx="170" cy="108" r="22" fill="#2a1e14"/>
                  <circle cx="140" cy="100" r="26" fill="#2a1e14"/>
                  <!-- glasses -->
                  <rect x="112" y="168" width="26" height="18" rx="8" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                  <rect x="142" y="168" width="26" height="18" rx="8" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                  <line x1="138" y1="177" x2="142" y2="177" stroke="rgba(255,255,255,0.4)" stroke-width="1.5"/>
                  <!-- smile -->
                  <path d="M 126 194 Q 140 206 154 194" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
            @endif
            <div class="team-photo-teal"></div>
          </div>
          <div class="team-feature-name">{{ $featured?->name ?? 'Ingga Mawardy' }}</div>
          <div class="team-feature-role">{{ $featured?->position ?? 'PR Strategy Consultant' }}</div>
          <div class="team-feature-desc">
            Always the perfect solution with the right team at your side at all times. Deliver on our growing experience and skill-set.
          </div>
          <div style="display:flex;gap:10px;margin-top:4px">
            <a href="#contact" style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:6px;background:var(--teal);color:#fff;font-size:13px;font-weight:700;transition:opacity .2s">
              Get in Touch
            </a>
          </div>
          <div class="team-avatars" style="margin-top:20px">
            @if($teamMembers->isEmpty())
              <div class="t-av active av-1c">RK</div>
              <div class="t-av av-2c">DS</div>
              <div class="t-av av-3c">MP</div>
              <div class="t-av av-4c">BA</div>
              <div class="t-av" style="background:var(--card)">+5</div>
            @else
              @foreach($teamRest as $i => $member)
                <div class="t-av @if($i === 0) active @endif @if(!$member->photo) {{ $avClasses[$i % 4] }} @endif">
                  @if($member->photo)
                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"/>
                  @else
                    @php
                      $initials = collect(explode(' ', $member->name))->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('');
                    @endphp
                    {{ $initials }}
                  @endif
                </div>
              @endforeach
              @if($teamExtra > 0)
                <div class="t-av" style="background:var(--card)">+{{ $teamExtra }}</div>
              @endif
            @endif
          </div>
        </div>
      </div>

      <!-- right side text -->
      <div class="rv rv2">
        <div style="padding-top:12px">
          <div class="s-tag">Team</div>
          <h2 class="s-h2" style="font-size:clamp(24px,3vw,38px);max-width:400px;margin-bottom:16px">
            {{ $teamSetting->headline ?: 'Meet the People Behind Every Great Project.' }}
          </h2>
          <p style="font-size:14px;color:var(--muted);line-height:1.75;max-width:380px;margin-bottom:28px">
            {{ $teamSetting->subtext ?: 'Always delivering the perfect solution with the right team at your side at all times. Every campaign is led by a dedicated expert who understands your brand and audience.' }}
          </p>
          <button class="btn-see-team">
            See All Team
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>

          <!-- stats below -->
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:40px;padding-top:40px;border-top:1px solid var(--border)">
            <div>
              <div style="font-family:var(--serif);font-size:36px;color:var(--white);line-height:1">24<span style="color:var(--orange)">+</span></div>
              <div style="font-size:13px;color:var(--muted);margin-top:4px">Expert Consultants</div>
            </div>
            <div>
              <div style="font-family:var(--serif);font-size:36px;color:var(--white);line-height:1">12<span style="color:var(--orange)">+</span></div>
              <div style="font-size:13px;color:var(--muted);margin-top:4px">Years Experience</div>
            </div>
            <div>
              <div style="font-family:var(--serif);font-size:36px;color:var(--white);line-height:1">500<span style="color:var(--orange)">+</span></div>
              <div style="font-size:13px;color:var(--muted);margin-top:4px">Projects Delivered</div>
            </div>
            <div>
              <div style="font-family:var(--serif);font-size:36px;color:var(--white);line-height:1">98<span style="color:var(--orange)">%</span></div>
              <div style="font-size:13px;color:var(--muted);margin-top:4px">Client Satisfaction</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== PORTFOLIO / SERVICES ===================== -->
<section id="portfolio">
  <div class="wrap">
    <div class="port-header rv">
      <div class="s-tag">Portfolio &amp; Services</div>
      <h2 class="s-h2">{{ $serviceSetting->headline ?: 'See our Portfolio and Services' }}</h2>
      @if($serviceSetting->subtext)
        <p class="s-body">{{ $serviceSetting->subtext }}</p>
      @endif
    </div>
    <div class="port-grid">
      @forelse($portfolios as $i => $portfolio)
        <div class="port-card rv {{ $i === 1 ? 'rv2' : ($i === 2 ? 'rv3' : '') }}">
          <div class="port-thumb pt-{{ ($i % 3) + 1 }}">
            @if($portfolio->cover_image)
              <img src="{{ Storage::url($portfolio->cover_image) }}" alt="{{ $portfolio->project_title }}" style="position:absolute;inset:0;width:100%;height:100%;z-index:0"/>
            @else
              <div class="port-thumb-icon">{{ ['📰','🎤','📱'][$i % 3] }}</div>
            @endif
            @if($portfolio->category)
              <div class="port-badge" @if($i === 1) style="background:rgba(59,130,246,.9)" @elseif($i === 2) style="background:rgba(0,194,168,.9)" @endif>{{ $portfolio->category->name }}</div>
            @endif
          </div>
          <div class="port-body">
            <div class="port-title">{{ $portfolio->project_title }}</div>
            @if($portfolio->description)
              <p class="port-desc">{{ \Illuminate\Support\Str::limit($portfolio->description, 110) }}</p>
            @endif
            <a href="{{ $portfolio->project_url ?: '#contact' }}" class="port-link" @if($portfolio->project_url) target="_blank" rel="noopener" @endif>
              See More
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      @empty
        <div class="port-card rv">
          <div class="port-thumb pt-1">
            <div class="port-badge">Media Relation</div>
            <div class="port-thumb-icon">📰</div>
          </div>
          <div class="port-body">
            <div class="port-title">Build relation for every need of your company</div>
            <p class="port-desc">We provide top-notch media relations and is usually personified by the client. Doing sound-strategy.</p>
            <a href="#contact" class="port-link">
              See More
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
        <div class="port-card rv rv2">
          <div class="port-thumb pt-2">
            <div class="port-badge" style="background:rgba(59,130,246,.9)">Media Events</div>
            <div class="port-thumb-icon">🎤</div>
          </div>
          <div class="port-body">
            <div class="port-title">All your conversations in one place</div>
            <p class="port-desc">We create, we opt how to strengthen client and communications with our clients.</p>
            <a href="#contact" class="port-link">
              See More
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
        <div class="port-card rv rv3">
          <div class="port-thumb pt-3">
            <div class="port-badge" style="background:rgba(0,194,168,.9)">Social &amp; Digital</div>
            <div class="port-thumb-icon">📱</div>
          </div>
          <div class="port-body">
            <div class="port-title">Truly automate your social media</div>
            <p class="port-desc">We push boundaries through a unique experience. We build a company that's true in communications.</p>
            <a href="#contact" class="port-link">
              See More
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- ===================== CTA BANNER ===================== -->
<section id="cta-banner">
  <div class="cta-banner-glow"></div>
  <div class="wrap">
    <div class="cta-banner-inner">
      <div class="cta-banner-left rv">
        @if($ctaBanner->available_status)
          <div class="cta-banner-status">{{ $ctaBanner->available_status }}</div>
        @endif
        <h2 class="s-h2">{{ $ctaBanner->headline ?: "Let's build a campaign that earns trust." }}</h2>
        <p class="cta-banner-sub">{{ $ctaBanner->subtext ?: 'Tell us about your brand and goals — our strategists will get back to you within one business day with a tailored approach.' }}</p>
        @if(!empty($ctaBanner->team_avatars))
          <div class="cta-banner-avatars">
            @foreach($ctaBanner->team_avatars as $avatar)
              <div class="cta-av"><img src="{{ Storage::url($avatar) }}" alt=""/></div>
            @endforeach
          </div>
        @endif
      </div>
      <div class="cta-banner-right rv rv2">
        <a href="{{ $ctaBanner->button_url ?: '#contact' }}" class="cta-banner-btn">
          {{ $ctaBanner->button_text ?: 'Start a Conversation' }}
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ===================== CONTACT ===================== -->
<section id="contact">
  <div class="wrap">
    <div class="contact-grid">
      <!-- left -->
      <div class="rv">
        <div class="s-tag">Contact</div>
        <h2 class="s-h2" style="font-size:clamp(22px,2.8vw,32px);margin-bottom:16px">
          {{ $footer->cta_headline ?: 'Ready to contact us for professional PR support?' }}
        </h2>
        <p>If you require assistance with PR matters but would like to speak with the appropriate team, please do not hesitate to fill this form and check stocks and company details.</p>

        <!-- Map -->
        @if($footer->google_maps_url)
          <a href="{{ $footer->google_maps_url }}" target="_blank" rel="noopener" class="contact-map-link">
        @endif
        <div class="contact-map">
          <svg style="position:absolute;inset:0;width:100%;height:100%;opacity:.2" viewBox="0 0 400 300">
            <line x1="0" y1="150" x2="400" y2="150" stroke="#00c2a8" stroke-width="1.5"/>
            <line x1="200" y1="0" x2="200" y2="300" stroke="#00c2a8" stroke-width="1.5"/>
            <line x1="0" y1="80" x2="400" y2="80" stroke="#00c2a8" stroke-width=".8" stroke-dasharray="8,6"/>
            <line x1="0" y1="220" x2="400" y2="220" stroke="#00c2a8" stroke-width=".8" stroke-dasharray="8,6"/>
            <line x1="100" y1="0" x2="100" y2="300" stroke="#00c2a8" stroke-width=".8" stroke-dasharray="8,6"/>
            <line x1="300" y1="0" x2="300" y2="300" stroke="#00c2a8" stroke-width=".8" stroke-dasharray="8,6"/>
          </svg>
          <div class="map-pin">
            <div class="map-pin-dot"></div>
            <div class="map-pin-label">{{ $footer->address ? \Illuminate\Support\Str::limit($footer->address, 30) : 'ER Communication, Jakarta' }}</div>
          </div>
        </div>
        @if($footer->google_maps_url)
          </a>
        @endif

        <div class="contact-details">
          <div class="cd-item">
            <div class="cd-icon">📍</div>
            <span>{{ $footer->address ?: 'Jl. Sudirman No.88, Jakarta Pusat, 10220' }}</span>
          </div>
          <div class="cd-item">
            <div class="cd-icon">✉️</div>
            <span>{{ $footer->email ?: 'hello@ercommunication.id' }}</span>
          </div>
          <div class="cd-item">
            <div class="cd-icon">📞</div>
            <span>{{ $footer->phone_number ?: '+62 21 5000 8888' }}</span>
          </div>
        </div>
      </div>

      <!-- right form -->
      <div class="rv rv2">
        <div class="contact-title">GET IN TOUCH</div>
        <div class="contact-sub">We're available 24/7</div>

        <div class="form-row">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" placeholder="John"/>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" placeholder="Doe"/>
          </div>
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" placeholder="john@example.com"/>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="tel" placeholder="+62 8xx xxxx xxxx"/>
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea rows="4" placeholder="Tell us about your project or inquiry..."></textarea>
        </div>
        <button class="btn-send" type="button">
          REQUEST CALLBACK
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ===================== FOOTER ===================== -->
<footer>
  <div class="wrap">
    <div class="footer-grid">
      <!-- brand -->
      <div>
        <div class="footer-logo">
          @if($navbar->logo_light || $navbar->logo_dark)
            <img src="{{ Storage::url($navbar->logo_light ?: $navbar->logo_dark) }}" alt="Logo" style="height:32px;width:auto"/>
          @else
            ER<span class="dot"></span>
          @endif
        </div>
        <p class="footer-desc">PR &amp; Strategic Communication Agency that helps brands speak with clarity, trust, and lasting impact.</p>
        <div class="footer-socials">
          @forelse(($footer->social_media ?? []) as $social)
            <a href="{{ $social['url'] ?? '#' }}" target="_blank" rel="noopener" class="fs-btn">{{ $social['icon'] ?? ($social['label'] ?? '🔗') }}</a>
          @empty
            <div class="fs-btn">𝕏</div>
            <div class="fs-btn">in</div>
            <div class="fs-btn">📷</div>
            <div class="fs-btn">▶</div>
          @endforelse
        </div>
      </div>
      <!-- useful links -->
      <div class="footer-col">
        <h4>Useful Links</h4>
        <ul>
          @forelse(($footer->useful_links ?? []) as $link)
            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
          @empty
            <li><a href="#about">About</a></li>
            <li><a href="#portfolio">Services</a></li>
            <li><a href="#team">Team</a></li>
          @endforelse
        </ul>
      </div>
      <!-- help -->
      <div class="footer-col">
        <h4>Help</h4>
        <ul>
          @forelse(($footer->help_links ?? []) as $link)
            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
          @empty
            <li><a href="#contact">Customer Support</a></li>
            <li><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">Contact Us</a></li>
          @endforelse
        </ul>
      </div>
      <!-- connect -->
      <div class="footer-col">
        <h4>Connect With Us</h4>
        <ul>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">LinkedIn</a></li>
          <li><a href="#">Twitter / X</a></li>
          <li><a href="mailto:{{ $footer->email ?: 'hello@ercommunication.id' }}">{{ $footer->email ?: 'hello@ercommunication.id' }}</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <span>{{ $footer->copyright_text ?: '© '.now()->year.' All Rights Reserved.' }}</span>
      <div class="footer-socials-inline">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Sitemap</a>
      </div>
    </div>
  </div>
</footer>

<!-- WhatsApp Float -->
@php
  $waNumber = $navbar->whatsapp_number ? preg_replace('/[^0-9]/', '', $navbar->whatsapp_number) : '6282150008888';
@endphp
<a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="wa-float" title="Chat via WhatsApp">💬</a>

<!-- ===================== JS ===================== -->
<script>
  /* --- Navbar scroll --- */
  const nav = document.getElementById('navbar');
  if (nav.dataset.sticky === '1') {
    window.addEventListener('scroll', () => {
      nav.classList.toggle('stuck', window.scrollY > 50);
    });
  }

  /* --- Scroll reveal --- */
  const rvEls = document.querySelectorAll('.rv');
  const rvObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); } });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
  rvEls.forEach(el => rvObs.observe(el));

  /* --- Counter (hero) --- */
  function animCount(el) {
    const t   = parseInt(el.dataset.target);
    const dur = 1600, step = 16;
    const inc = t / (dur / step);
    let cur   = 0;
    const id  = setInterval(() => {
      cur += inc;
      if (cur >= t) { cur = t; clearInterval(id); }
      el.textContent = Math.floor(cur).toLocaleString();
    }, step);
  }
  const heroObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.counter').forEach(animCount);
        heroObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.5 });
  const heroS = document.getElementById('hero');
  if (heroS) heroObs.observe(heroS);

  /* --- Counter (narrative) --- */
  const narrObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.counter2').forEach(animCount);
        narrObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.4 });
  const narrS = document.getElementById('narrative');
  if (narrS) narrObs.observe(narrS);

  /* --- Team tabs --- */
  function switchTab(btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
  }

  /* --- Smooth scroll --- */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const t = document.querySelector(a.getAttribute('href'));
      if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
    });
  });
</script>
@if($seo->custom_script_body)
{!! $seo->custom_script_body !!}
@endif
</body>
</html>