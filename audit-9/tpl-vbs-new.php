<?php /* Template Name: Vbs */ ?>
<?php
// Standalone: bypass CMSMasters theme wrapper entirely
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VBS 2026 — Table for All</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--white:#FFFFFF;--canvas:#FDFBF8;--black:#000000;--orange:#C4703B;--gold:#FFC20E;--brown:#8B5E3C;--tan:#D7B594;--dark:#1C1108;--text:#2C2C2C;--muted:#6B6B6B;--border:#E8E4DF}
html{scroll-behavior:smooth}
body{font-family:Inter,sans-serif;background:var(--canvas);color:var(--text);line-height:1.7;min-height:100vh;display:flex;flex-direction:column}
h1,h2,h3{font-family:"Playfair Display",Georgia,serif;color:var(--black);line-height:1.2}
a{color:inherit;text-decoration:none}
nav{flex-shrink:0;background:var(--white);padding:0 40px;display:flex;align-items:center;justify-content:space-between;height:74px;border-bottom:1px solid var(--border);box-shadow:0 2px 12px rgba(0,0,0,.05)}
nav .logo{height:52px;width:auto}
nav ul{display:flex;list-style:none;gap:32px}
nav ul a{color:var(--text);font-weight:500;font-size:.95rem;transition:color .2s}
nav ul a:hover{color:var(--orange)}
nav .donate-btn{background:var(--orange);color:var(--white);padding:10px 22px;border-radius:8px;font-weight:700;font-size:.9rem;transition:all .2s;display:inline-block}
nav .donate-btn:hover{background:var(--black);transform:translateY(-1px)}
nav .social-icons{display:flex;align-items:center;gap:10px;margin-left:16px}
nav .social-icons a{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:var(--orange);transition:all .2s}
nav .social-icons a:hover{background:var(--dark);transform:scale(1.1)}
nav .social-icons svg{width:24px;height:24px;fill:#fff}
.hero{flex:1;position:relative;min-height:80vh;display:flex;align-items:center;justify-content:center;overflow:hidden;background:var(--dark}
.hero .bg{position:absolute;inset:0;background-size:cover;background-position:center}
.hero .overlay{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.55) 0%,rgba(0,0,0,.75) 100%)}
.hero .content{position:relative;z-index:1;text-align:center;padding:100px 40px 80px;max-width:820px}
.hero .eyebrow{display:inline-block;background:var(--orange);color:var(--white);padding:7px 20px;border-radius:30px;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:24px}
.hero h1{color:var(--white);font-size:clamp(2.4rem,5.5vw,4.5rem);font-weight:700;letter-spacing:-.02em;margin-bottom:16px;text-shadow:0 4px 30px rgba(0,0,0,.7)}
.hero p{color:rgba(255,255,255,.9);font-size:1.1rem;max-width:520px;margin:0 auto 36px;text-shadow:0 1px 8px rgba(0,0,0,.4);font-weight:400}
.hero-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
.btn{display:inline-block;padding:14px 30px;border-radius:8px;font-weight:700;font-size:1rem;transition:all .2s;cursor:pointer;border:none}
.btn-orange{background:var(--orange);color:var(--white)}
.btn-orange:hover{background:var(--black);transform:translateY(-2px)}
.btn-outline{background:transparent;border:2px solid rgba(255,255,255,.7);color:var(--white)}
.btn-outline:hover{background:var(--white);color:var(--dark)}
.section{padding:80px 40px}
.section-white{background:var(--white)}
.section-cream{background:var(--canvas)}
.section-dark{background:var(--dark);color:var(--white)}
.section-dark h2{color:var(--white)}
.container{max-width:1080px;margin:0 auto}
.section-label{display:inline-block;text-transform:uppercase;letter-spacing:.12em;font-size:.72rem;font-weight:700;color:var(--orange);margin-bottom:14px}
.section h2{font-size:clamp(1.8rem,4vw,2.6rem);margin-bottom:12px}
.section-sub{font-size:1.05rem;color:var(--muted);max-width:620px;margin:16px auto 0;line-height:1.8}
.lead{font-size:1.08rem;max-width:700px;margin:20px 0 0;color:#555;line-height:1.8}
.cards-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:24px;margin-top:40px}
.card{background:var(--white);border-radius:16px;padding:28px;border:1px solid var(--border);transition:transform .2s,box-shadow .2s}
.card:hover{transform:translateY(-3px);box-shadow:0 8px 32px rgba(0,0,0,.09)}
.card h3{font-size:1.1rem;margin-bottom:8px;color:var(--black)}
.card p{font-size:.9rem;color:var(--muted);line-height:1.65}
.footer-cta{background:var(--dark);color:var(--white);padding:72px 40px;text-align:center}
.footer-cta h2{color:var(--white);font-size:clamp(1.8rem,4vw,2.5rem);margin-bottom:14px}
.footer-cta p{color:rgba(255,255,255,.75);max-width:520px;margin:0 auto 28px;font-size:1.05rem}
footer{flex-shrink:0;background:var(--dark);color:rgba(255,255,255,.6);padding:52px 40px 24px}
footer .container{display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:48px}
footer h4{color:var(--orange);font-size:.85rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;margin-bottom:14px;font-family:Inter,sans-serif}
footer p,footer a{font-size:.88rem;line-height:1.9}
footer a{color:rgba(255,255,255,.65)}
footer a:hover{color:var(--orange)}
footer .bottom{margin-top:44px;padding-top:18px;border-top:1px solid rgba(255,255,255,.1);text-align:center;font-size:.8rem}
@media(max-width:768px){
nav{padding:0 20px}
nav ul{gap:14px}
nav ul li:nth-child(n+5){display:none}
.hero{min-height:70vh}
.hero .content{padding:80px 20px 60px}
.section{padding:60px 20px}
.cards-grid{grid-template-columns:1fr}
.footer-cta{padding:60px 20px}
footer{padding:40px 20px 20px}
footer .container{grid-template-columns:1fr;gap:28px}
}
</style>
</head>
<body>
<nav>
  <a href="/"><img src="https://ernien.sg-host.com/wp-content/uploads/2026/03/TableForAllLogoHD-300x167.png" alt="Table for All" class="logo"></a>
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/stories">Stories</a></li>
    <li><a href="/gallery">Gallery</a></li>
    <li><a href="/vbs-2026" style="color:var(--orange);font-weight:700">VBS 2026</a></li>
    <li><a href="/contact">Contact</a></li>
  </ul>
  <a href="/donate" class="donate-btn">Donate</a>
  <div class="social-icons"><a href="https://facebook.com" target="_blank" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a><a href="https://instagram.com" target="_blank" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="transparent" stroke="#fff" stroke-width="2"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a></div>
</nav>
<section class="hero">
  <div class="bg" style="background-image:url('https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-vbs.jpg');background-size:cover;background-position:center"></div>
  <div class="overlay"></div>
  <div class="content">
    <span class="eyebrow">July 18–21, 2026</span>
    <h1>Vacation Bible School 2026</h1>
    <p>Table for All Farm, Pedregal Grande, Peru — A week of faith, food, and community for 185 children.</p>
    <div class="hero-btns"><a href="/contact" class="btn btn-orange">Register Your Child</a><a href="/contact" class="btn btn-outline">Volunteer With Us</a></div>
  </div>
</section>
<section class="section section-white">
  <div class="container">
    <p class="section-label">An Invitation</p>
    <h2>185 Children. 25 Volunteers. One Week.</h2>
    <p class="lead">In July 2026, Table for All will host its first major community event at the farm in Pedregal Grande — a four-day Vacation Bible School. We are expecting 185 children from the surrounding communities and 25 adult volunteers coming together for a week of learning, fun, and connection.</p>
    <p class="lead" style="margin-top:16px">This is what the farm was built for: a place where the community gathers, grows, and experiences care.</p>
    <div class="cards-grid">
      <div class="card"><h3>Bible Teaching Stations</h3><p>Four interactive stations each day — puppet lessons, joyful singing, and hands-on Bible activities centered on the love of God in action.</p></div>
      <div class="card"><h3>Sports Camp</h3><p>Afternoons on the field — soccer, games, and recreational activities in a safe, joyful environment. Most of these kids have never had access to organized sports.</p></div>
      <div class="card"><h3>Hot Meals</h3><p>Every child goes home with a full stomach. We provide breakfast and lunch each day — the most important thing we can do.</p></div>
      <div class="card"><h3>Medical Partnership</h3><p>Conducted alongside Olive Branch Ministries, combining medical outreach with faith-based programming for a whole-person week of impact.</p></div>
    </div>
  </div>
</section>
<section class="section section-dark" style="text-align:center">
  <div class="container">
    <h2>Want to Be Part of It?</h2>
    <p>Whether as a volunteer, donor, or prayer partner — there is a place for you in this mission.</p>
    <div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="/contact" class="btn btn-orange">Get in Touch</a>
      <a href="/donate" class="btn btn-outline">Support This Work</a>
    </div>
  </div>
</section>
<footer>
  <div class="container">
    <div><h4>Table for All</h4><p>Christ-centered farm fighting malnutrition<br>in Northern Peru.</p><p style="margin-top:12px">Macclenny, FL<br>Registered 501(c)(3) nonprofit</p></div>
    <div><h4>Quick Links</h4><a href="/about">About Us</a><a href="/stories">Stories</a><a href="/gallery">Gallery</a><a href="/vbs-2026">VBS 2026</a><a href="/donate">Donate</a><a href="/contact">Contact</a></div>
    <div><h4>Contact</h4><p>erniegnettles@gmail.com</p><p style="margin-top:12px">&copy; 2026 Table for All.</p></div>
  </div>
  <div class="bottom">Table for All is a registered 501(c)(3) nonprofit. All donations are tax-deductible.</div>
</footer>
</body>
</html>
<?php
// Prevent CMSMasters theme wrapper from being output
if ( defined('REST_REQUEST') && REST_REQUEST ) {
    echo ob_get_clean();
    return;
}
// If accessed directly as a page template, output our content and stop WordPress
$standalone_content = ob_get_clean();
echo $standalone_content;
exit();
