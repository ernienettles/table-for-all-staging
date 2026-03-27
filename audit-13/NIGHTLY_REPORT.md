# Table for All Nightly Polish — Audit Report #13
**Date:** March 27, 2026, 1:49 AM ET
**Assessor:** Jon (Senior Web Designer/Developer agent)

---

## 🚨 CRITICAL BLOCKER: SSH Access Completely Broken

**I cannot make any fixes tonight.** SSH authentication is failing — the RSA key (`~/.ssh/id_rsa`) is rejected with "Permission denied (publickey)". The server accepts the connection but refuses the key.

This has now failed **17 consecutive cron runs**. Something on SiteGround's end is resetting or rotating the authorized_keys.

**Server status:**
- HTTP: ✅ Working (site loads fine)
- SSH: ❌ Permission denied (publickey)
- WordPress admin: 403 (requires login)

**Verbose SSH debug output:**
```
Authentications that can continue: publickey
Offering public key: /home/ernie/.ssh/id_rsa RSA SHA256:M9cdU2v...
No more authentication methods to try.
u2837-wmvfpoaafjg8@ssh.ernien.sg-host.com: Permission denied (publickey).
```

---

## 📊 CURRENT SCORES (this audit)

| Page | Score | Trend | Key Issue |
|------|-------|-------|-----------|
| Home | 4/10 | ⬇️ | Cramped text, poor contrast, black overlay cuts off people |
| About | 4/10 | ➡️ | Black video placeholder (broken video) |
| Contact | 4/10 | ⬇️ | Submit button is cut off/tiny orange square |
| Gallery | 4/10 | ⬇️ | Hero is just black void with text — no photos |
| Stories | 4.5/10 | ⬇️ | Hero background too busy, white text nearly illegible |
| Donate | 4/10 | ➡️ | White text on bright orange = vibration, hard to read |
| VBS 2026 | N/A | — | **404 — Page does not exist** |

**Average: ~4.1/10** — worst score recorded for this site.

---

## What Went Wrong (Again)

### Root Cause
The site runs on **Faith Connect + Elementor** (CMSMasters). The site uses Elementor's Theme Builder for header/footer and Elementor page builder for content. The custom PHP templates in `/wp-content/themes/table-for-all/tpl-*.php` are **NOT being used** — they're dead code from earlier attempts.

Previous agents (audit-4 through audit-11) successfully applied fixes via:
1. SSH access (now broken — 17 consecutive failures)
2. Direct database manipulation via `wp-load.php` + PHP scripts
3. Elementor CSS injection via `post-52.css`

### What Broke
- **SSH key authorization** — the key that worked before is no longer accepted by the server
- **VBS 2026 page** — appears to have been deleted from WordPress
- **Hero image JavaScript injection** — the `audit-11/functions-final.php` injected CSS/JS that added hero images via JavaScript. Without SSH to re-inject it, the site fell back to bare Elementor output

### The Decay Pattern
Elementor's cached CSS/JS is being served. The hero images that were applied via JS (`audit-11`) are gone. The video placeholder on About is back. The site looks progressively worse with each passing night.

---

## What Was Working (Before SSH Broke)

From audit-4's NIGHTLY_REPORT.md:
- ALL green (#404F40, #2D5A3D) removed
- Orange #C4703B applied to buttons
- Hero images set via JavaScript injection
- "Send Message" button text on Contact

All of these fixes are **still partially in the Elementor CSS** (post-52.css was cached) but the JavaScript injection from audit-11 is gone, so hero images are missing.

---

## Screenshot Analysis

### Home (4/10)
- Hero section: text massive, competing with busy background image
- No dark overlay on photo — white text vibrates against busy background
- "GIVE" button excessively large vertically, weird proportions
- Nav: all-caps text small and hard to scan
- Social icons: tiny, low contrast, easily missed
- Three different warm tones competing (orange, yellow, gold)

### About (4/10)
- **Big black video placeholder** dominates the hero area
- White text floats in vast black void
- No emotional imagery — feels cold and corporate
- Paragraph text too wide, long line lengths

### Contact (4/10)
- Submit button: tiny orange square, no visible "Send Message" text
- Hero: black background, same void problem as About
- Social icons: tiny and low contrast

### Gallery (4/10)
- **Hero is a black void with text** — no photos at all
- Text-heavy above fold — users see nothing visual until they scroll
- Active nav "GALLERY" in yellow on white has poor contrast

### Stories (4.5/10)
- "STORIES FROM THE FARM" text positioned directly over faces in photo
- Hero subtext barely readable against busy background
- Active nav "STORIES" in yellow on white = accessibility fail
- No clear CTA in hero section

### Donate (4/10)
- Hero: flat high-saturation orange block — no photo
- "SUPPORT TABLE FOR ALL" massive, subtext tiny
- White text on bright orange vibrates
- Abrupt transition between orange hero and white section below

### VBS 2026 (N/A)
- **404 Error** — page does not exist
- The page was apparently deleted from WordPress

---

## Fixes Needed (Requires SSH)

### Quick wins (CSS only, no DB changes)
1. **Social icons** — They're white SVGs on white header background. Need `color: #C4703B !important` on the Elementor social icons widget
2. **Contact submit button** — Need button text "Send Message" + `min-height: 48px`
3. **Donate page contrast** — White text on orange needs darker orange or white bg

### Medium effort (Elementor JSON data)
4. **About: black video** — Replace video widget with image background using `hero-about.jpg`
5. **Gallery: hero** — Replace black void with `gallery-4.jpg` as background
6. **Stories: text readability** — Add dark gradient overlay to hero section

### Large effort (requires WP admin)
7. **Navigation visibility** — Elementor header template needs editing
8. **VBS 2026 page** — Need to recreate (was deleted)
9. **Home: text cramped** — Elementor hero text needs re-spacing

---

## 📁 Useful Files in Workspace

- `/home/ernie/.openclaw/workspace/audit-9/` — Complete PHP fix scripts + templates with hero images hardcoded
- `/home/ernie/.openclaw/workspace/audit-11/functions-final.php` — WordPress functions.php with CSS/JS injection
- `/home/ernie/.openclaw/workspace/tfa-fix.php` — Main CSS fix script
- `/home/ernie/.openclaw/workspace/inject_final_css.php` — CSS injection script
- `/home/ernie/.openclaw/workspace/audit-12/` — Previous audit screenshots + report

---

## SSH Fix Instructions for Ernie

The public key that needs to be authorized is:

```
cat ~/.ssh/id_rsa.pub
```

This will output something like:
```
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQD... user@hostname
```

Go to **SiteGround → Websites → ernien.sg-host.com → SSH Keys** and paste this key.

Once SSH is restored, run the following test command:
```
ssh -o StrictHostKeyChecking=no -p 18765 -i ~/.ssh/id_rsa u2837-wmvfpoaafjg8@ssh.ernien.sg-host.com "echo connected"
```
