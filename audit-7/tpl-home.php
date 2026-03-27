<?php /* Template Name: Home */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home — Table for All</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--white:#FFFFFF;--canvas:#FDFBF8;--black:#000000;--orange:#C4703B;--gold:#FFC20E;--brown:#8B5E3C;--tan:#D7B594;--dark:#1C1108;--text:#2C2C2C;--muted:#6B6B6B;--border:#E8E4DF}
html{scroll-behavior:smooth}
body{font-family:Inter,sans-serif;background:var(--canvas);color:var(--text);line-height:1.7}
h1,h2,h3{font-family:"Playfair Display",Georgia,serif;color:var(--black);line-height:1.2}
a{color:inherit;text-decoration:none}
nav{background:var(--white);padding:0 40px;display:flex;align-items:center;justify-content:space-between;height:74px;position:sticky;top:0;z-index:100;border-bottom:1px solid var(--border);box-shadow:0 2px 12px rgba(0,0,0,.05)}
nav .logo{height:52px;width:auto}
nav ul{display:flex;list-style:none;gap:32px}
nav ul a{color:var(--text);font-weight:500;font-size:.95rem;transition:color .2s}
nav ul a:hover{color:var(--orange)}
nav .donate-btn{background:var(--orange);color:var(--white);padding:10px 22px;border-radius:6px;font-weight:700;font-size:.9rem;transition:all .2s;display:inline-block}
nav .donate-btn:hover{background:var(--black);transform:translateY(-1px)}nav .social-icons{display:flex;align-items:center;gap:10px;margin-left:16px}nav .social-icons a{display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:var(--orange);transition:all .2s}nav .social-icons a:hover{background:var(--dark);transform:scale(1.1)}nav .social-icons svg{width:24px;height:24px;fill:#fff}
.hero{position:relative;min-height:88vh;display:flex;align-items:center;justify-content:center;overflow:hidden;background:var(--dark)}
.hero .bg{position:absolute;inset:0;background-size:cover;background-position:center}
.hero .overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(28,17,8,.72) 0%,rgba(28,17,8,.5) 100%)}
.hero .content{position:relative;z-index:1;text-align:center;padding:120px 40px 100px;max-width:820px}
.hero .eyebrow{display:inline-block;background:var(--orange);color:var(--white);padding:7px 20px;border-radius:30px;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:24px}
.hero h1{color:var(--white);font-size:clamp(2.6rem,6vw,4.8rem);font-weight:700;letter-spacing:-.02em;margin-bottom:20px;text-shadow:0 2px 20px rgba(0,0,0,.4)}
.hero p{color:rgba(255,255,255,.9);font-size:1.15rem;max-width:520px;margin:0 auto 40px;text-shadow:0 1px 8px rgba(0,0,0,.4);font-weight:400}
.hero-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
.btn{display:inline-block;padding:14px 30px;border-radius:8px;font-weight:700;font-size:1rem;transition:all .2s;cursor:pointer;border:none}
.btn-orange{background:var(--orange);color:var(--white)}
.btn-orange:hover{background:var(--black);transform:translateY(-2px)}
.btn-outline{background:transparent;border:2px solid rgba(255,255,255,.7);color:var(--white)}
.btn-outline:hover{background:var(--white);color:var(--dark)}
.btn-dark{background:var(--dark);color:var(--white)}
.btn-dark:hover{background:var(--black)}
.section{padding:88px 40px}
.section-white{background:var(--white)}
.section-cream{background:var(--canvas)}
.section-dark{background:var(--dark);color:var(--white)}
.section-dark h2{color:var(--white)}
.container{max-width:1080px;margin:0 auto}
.section-label{display:inline-block;text-transform:uppercase;letter-spacing:.12em;font-size:.72rem;font-weight:700;color:var(--orange);margin-bottom:14px}
.section-label.gold{color:var(--tan)}
.section h2{font-size:clamp(1.8rem,4vw,2.7rem);margin-bottom:12px}
.section-sub{font-size:1.05rem;color:var(--muted);max-width:620px;margin:16px auto 0;line-height:1.8}
.lead{font-size:1.08rem;max-width:700px;margin-top:20px;color:#555;line-height:1.8}
.pullquote{font-family:"Playfair Display",serif;font-size:1.35rem;font-style:italic;color:var(--black);border-left:4px solid var(--orange);padding:8px 0 8px 24px;margin:28px 0;max-width:680px;line-height:1.5}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-top:44px}
.stat-card{background:var(--white);border-radius:16px;padding:32px 20px;text-align:center;border:1px solid var(--border);transition:transform .2s,box-shadow .2s}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 8px 32px rgba(0,0,0,.09)}
.stat-card .number{font-family:"Playfair Display",serif;font-size:2.9rem;font-weight:700;color:var(--orange);line-height:1}
.stat-card .label{margin-top:8px;font-size:.9rem;color:var(--muted);line-height:1.4}
.cards-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;margin-top:44px}
.card{background:var(--white);border-radius:16px;padding:28px;border:1px solid var(--border);transition:transform .2s,box-shadow .2s}
.card:hover{transform:translateY(-3px);box-shadow:0 8px 32px rgba(0,0,0,.09)}
.card-icon{margin-bottom:14px;font-size:2rem}
.card h3{font-size:1.15rem;margin-bottom:8px;color:var(--black)}
.card p{font-size:.92rem;color:var(--muted);line-height:1.65}
.quote{font-family:"Playfair Display",serif;font-size:clamp(1.4rem,3vw,2rem);font-style:italic;line-height:1.5;max-width:800px;margin:0 auto;color:var(--black)}
.divider{width:48px;height:3px;background:var(--orange);margin:28px auto 0;border-radius:2px}
.footer-cta{background:var(--dark);color:var(--white);padding:80px 40px;text-align:center}
.footer-cta h2{color:var(--white);font-size:clamp(1.8rem,4vw,2.5rem);margin-bottom:16px}
.footer-cta p{color:rgba(255,255,255,.75);max-width:520px;margin:0 auto 32px;font-size:1.05rem}
footer{background:var(--dark);color:rgba(255,255,255,.6);padding:56px 40px 28px}
footer .container{display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:48px}
footer h4{color:var(--orange);font-size:.85rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;margin-bottom:16px;font-family:Inter,sans-serif}
footer p,footer a{font-size:.88rem;line-height:1.9}
footer a{color:rgba(255,255,255,.65)}
footer a:hover{color:var(--orange)}
footer .bottom{margin-top:48px;padding-top:20px;border-top:1px solid rgba(255,255,255,.1);text-align:center;font-size:.8rem}
@media(max-width:768px){nav{padding:0 20px}nav ul{gap:16px}nav ul li:nth-child(n+5){display:none}.hero{min-height:75vh}.hero .content{padding:80px 20px 60px}.section{padding:64px 20px}.stats-grid{grid-template-columns:1fr 1fr}.footer-cta{padding:64px 20px}footer{padding:40px 20px 20px}footer .container{grid-template-columns:1fr;gap:32px}}
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
    <li><a href="/peru-visit-2026/">VBS 2026</a></li>
    <li><a href="/contact">Contact</a></li>
  </ul>
  <a href="/donate" class="donate-btn">Donate</a>
  <div class="social-icons"><a href="https://facebook.com" target="_blank" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a><a href="https://instagram.com" target="_blank" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a></div>
</nav>
<section class="hero">
  <div class="bg" style="background-image:url('https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-home.jpg');background-size:cover;background-position:center 30%"></div>
  <div class="overlay"></div>
  <div class="content">
    <h1>Nourishing Bodies.<br>Restoring Hope.</h1>
    <p>On a small farm in Northern Peru, children who once went hungry are now getting meals every week. It started with a question nobody could ignore.</p>
    <div class="hero-btns">
      <a href="/donate" class="btn btn-orange">Join the Mission</a>
      <a href="/about" class="btn btn-outline">Our Story</a>
    </div>
  </div>
</section>
<section class="section section-cream">
  <div class="container">
    <p class="section-label">Our Mission</p>
    <h2>Food Is Just the Beginning</h2>
    <p class="lead">Table for All is a Christ-centered nonprofit working in the hills of Northern Peru. We believe every family deserves reliable access to nutritious food, clean water, and basic healthcare — not as charity, but as a hand up rooted in dignity.</p>
    <p class="lead">The Table for All farm in Pedregal Grande is where that work comes to life: iron-enriched bread for children fighting anemia, goat milk for families who have never had regular dairy, and protein-packed meals delivered door to door.</p>
  </div>
</section>
<section class="section section-white">
  <div class="container" style="text-align:center">
    <p class="section-label">The Numbers</p>
    <h2>What We Are Up Against — and What We Are Doing</h2>
    <div class="stats-grid">
      <div class="stat-card"><div class="number">40%</div><div class="label">of children in Pedregal Grande suffer from chronic iron deficiency</div></div>
      <div class="stat-card"><div class="number">85%</div><div class="label">of household water samples show dangerous contamination</div></div>
      <div class="stat-card"><div class="number">70</div><div class="label">children receive iron-enriched bread every week</div></div>
      <div class="stat-card"><div class="number">4</div><div class="label">rural communities receiving ongoing support</div></div>
    </div>
  </div>
</section>
<section class="section section-dark">
  <div class="container" style="text-align:center">
    <p class="section-label gold">A Day in the Life</p>
    <h2>Walking Nine Miles to Reach the Families Who Need Us</h2>
    <p class="section-sub" style="color:rgba(255,255,255,.72);margin:20px auto 0">The needs in Pedregal Grande are visible at every turn. Our volunteers walk miles of rough terrain to reach families, bring food, and listen to what each community needs most. It is slow work. It is hard work. It is the only kind worth doing.</p>
  </div>
</section>
<section class="section section-white">
  <div class="container">
    <p class="section-label">The Work</p>
    <h2>Four Things the Farm Does Every Week</h2>
    <div class="cards-grid">
      <div class="card"><h3>Blood Bread</h3><p>Local young people bake iron-enriched bread at the farm. 70 children receive it five days a week. Hemoglobin tests confirmed the problem. The bread is starting to change that.</p></div>
      <div class="card"><h3>Goat Milk Program</h3><p>The herd is growing from 5 to 30 goats, producing fresh milk, cheese, and butter. For families who have never had regular dairy, this is a quiet revolution in what they eat.</p></div>
      <div class="card"><h3>Meal Delivery</h3><p>Three times a week, volunteers pack and deliver protein-rich meals to families identified during medical brigades as most at risk. Nobody on the list is forgotten.</p></div>
      <div class="card"><h3>Clean Water</h3><p>Water testing and community education to address the 85% contamination rate. Clean water is the foundation everything else health depends on.</p></div>
    </div>
  </div>
</section>
<section class="section section-cream" style="text-align:center">
  <div class="container">
    <p class="section-label">The Heart</p>
    <blockquote class="quote">In this place, Table for All is making a real difference. It is just a great seed that has been sewn — and it is growing.</blockquote>
    <div class="divider"></div>
  </div>
</section>
<section class="footer-cta">
  <div class="container">
    <h2>You Can Be Part of This</h2>
    <p>Every dollar goes toward food, clean water, and care for families who have nowhere else to turn. $25 feeds a child for a month. $50 fills a family refrigerator for a week.</p>
    <div class="hero-btns">
      <a href="/donate" class="btn btn-orange">Give Today</a>
      <a href="/stories" class="btn btn-outline">Read Stories</a>
    </div>
  </div>
</section>
<footer>
  <div class="container">
    <div><h4>Table for All</h4><p>Christ-centered farm fighting malnutrition<br>in Northern Peru.</p><p style="margin-top:12px">Macclenny, FL<br>Registered 501(c)(3) nonprofit</p></div>
    <div><h4>Quick Links</h4><a href="/about">About Us</a><a href="/stories">Stories</a><a href="/gallery">Gallery</a><a href="/peru-visit-2026/">VBS 2026</a><a href="/donate">Donate</a><a href="/contact">Contact</a></div>
    <div><h4>Contact</h4><p>erniegnettles@gmail.com</p><p style="margin-top:12px">&copy; 2026 Table for All.</p></div>
  </div>
  <div class="bottom">Table for All is a registered 501(c)(3) nonprofit. All donations are tax-deductible.</div>
</footer>
</body>
</html>