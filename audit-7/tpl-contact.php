<?php /* Template Name: Contact */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — Table for All</title>
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
.hero .bg{position:absolute;inset:0;background-color:var(--dark);background-size:cover;background-position:center}
.hero .overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(28,17,8,.60) 0%,rgba(28,17,8,.35) 100%)}
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
.hero-sm{min-height:55vh;background:transparent}
@media(max-width:768px){nav{padding:0 20px}nav ul{gap:16px}nav ul li:nth-child(n+5){display:none}.hero{min-height:75vh}.hero-sm{min-height:75vh}.hero .content{padding:80px 20px 60px}.section{padding:64px 20px}.stats-grid{grid-template-columns:1fr 1fr}.footer-cta{padding:64px 20px}footer{padding:40px 20px 20px}footer .container{grid-template-columns:1fr;gap:32px}}
</style>
<style>
.contact-grid{display:grid;grid-template-columns:1fr 1.2fr;gap:60px;margin-top:40px}
.contact-info p{font-size:.95rem;color:var(--muted);line-height:1.8}
.contact-info strong{color:var(--black)}
.contact-info a{color:var(--orange);font-weight:500}
.contact-info .detail{margin-top:20px}
.form{display:flex;flex-direction:column;gap:16px}
.form input,.form textarea{width:100%;padding:12px 16px;border:1px solid var(--border);border-radius:8px;font-size:1rem;font-family:Inter,sans-serif;background:var(--white);transition:border-color .2s,box-shadow .2s}
.form input:focus,.form textarea:focus{outline:none;border-color:var(--orange);box-shadow:0 0 0 3px rgba(196,112,59,.1)}
.form textarea{resize:vertical;min-height:140px}
.form button{background:var(--orange);color:var(--white);padding:14px 28px;border-radius:8px;font-weight:700;font-size:1rem;border:none;cursor:pointer;transition:background .2s,transform .2s;align-self:flex-start}
.form button:hover{background:var(--black);transform:translateY(-2px)}
@media(max-width:768px){.contact-grid{grid-template-columns:1fr;gap:40px}}
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
<section class="hero hero-sm">
  <div class="bg" style="background-image:url('https://ernien.sg-host.com/wp-content/uploads/2026/03/peru.jpg');background-size:cover;background-position:center"></div>
  <div class="overlay"></div>
  <div class="content">
    <h1>We Would Love to Hear From You</h1>
    <p>Whether you want to volunteer, partner, or just learn more — we would love to connect.</p>
  </div>
</section>
<section class="section section-white">
  <div class="container">
    <div class="contact-grid">
      <div>
        <p class="section-label">Get in Touch</p>
        <h2>Reach Out</h2>
        <p style="color:var(--muted);font-size:.95rem;margin-top:8px">Whether you want to volunteer, partner with us, share photos from the farm, or just learn more — we would love to connect.</p>
        <div class="contact-info">
          <div class="detail"><strong>Email</strong><br><a href="mailto:erniegnettles@gmail.com">erniegnettles@gmail.com</a></div>
          <div class="detail"><strong>Mailing Address</strong><br>Macclenny, FL<br>United States</div>
          <div class="detail"><strong>Registered 501(c)(3)</strong><br>All donations are tax-deductible</div>
        </div>
      </div>
      <div>
        <p class="section-label">Send a Message</p>
        <form class="form" method="post" action="">
          <input type="text" name="name" placeholder="Your Name" required>
          <input type="email" name="email" placeholder="Your Email" required>
          <textarea name="message" placeholder="Your Message — tell us about yourself or how you would like to get involved" required></textarea>
          <button type="submit">Send Message</button>
        </form>
      </div>
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