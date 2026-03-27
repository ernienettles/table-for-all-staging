# Table for All Nightly Polish — Audit Report #12
**Date:** March 27, 2026, 12:25 AM ET
**Assessor:** Jon (Senior Web Designer/Developer agent)

---

## 🚨 CRITICAL BLOCKER: SSH Access Completely Broken

**I cannot make any fixes tonight.** SSH authentication is failing — neither the RSA key (`ernie@tableforall`) nor the ED25519 key (`jon@openclaw`) is authorized on the server. This has been broken for multiple consecutive runs (16 consecutive errors).

**Ernie needs to:**
1. Log into SiteGround hosting panel (ernien.sg-host.com)
2. Go to SSH Keys or Security settings
3. Add this public key to authorized_keys:
```
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQD...
```
(Get the full key with: `cat ~/.ssh/id_rsa.pub`)
4. Or reset SSH password and share it securely

**Alternative:** Give me WordPress admin credentials so I can use Elementor directly.

---

## 📊 CURRENT SCORES (this audit)

| Page | Score | Trend | Key Issue |
|------|-------|-------|-----------|
| Home | 6/10 | ⬇️ | Cramped text, poor contrast, black overlay cuts off people |
| About | 5/10 | ➡️ | Black video placeholder (broken video) |
| Contact | 5/10 | ⬇️ | Submit button is cut off/tiny orange square |
| Gallery | 4/10 | ⬇️ | Hero is just black void with text — no photos |
| Stories | 5/10 | ⬇️ | Hero background too busy, white text nearly illegible |
| Donate | 5/10 | ⬇️ | White text on bright orange = vibration, hard to read |
| VBS 2026 | N/A | — | **404 — Page does not exist** |

**Average: ~5.2/10** (down from 7.5/10 in audit-4)

---

## What Went Wrong

### Root Cause
The site runs on **Faith Connect + Elementor** (CMSMasters). The site uses Elementor's Theme Builder for header/footer and Elementor page builder for content. The custom PHP templates in `/wp-content/themes/table-for-all/tpl-*.php` are **NOT being used** — they're dead code from earlier attempts.

Previous agents (audit-4 through audit-11) successfully applied fixes via:
1. SSH access (now broken)
2. Direct database manipulation via `wp-load.php` + PHP scripts
3. Elementor CSS injection via `post-52.css`

### What Broke
- **SSH key authorization** — the key that worked before is no longer accepted
- **VBS 2026 page** — appears to have been deleted from WordPress
- **Client-side JS fixes** — the `audit-11/functions-final.php` injected CSS/JS that adds hero images via JavaScript. Without SSH to re-inject it, the site fell back to bare Elementor output

### The Decay Pattern
Elementor's cached CSS/JS is being served. The hero images that were applied via JS (`audit-11`) are gone. The video placeholder on About is back. The site looks worse than it did after audit-4.

---

## What Was Working (Before SSH Broke)

From audit-4's NIGHTLY_REPORT.md:
- ALL green (#404F40, #2D5A3D) removed
- Orange #C4703B applied to buttons
- Hero images set via JavaScript injection
- "Send Message" button text on Contact

All of these fixes are **still partially in the Elementor CSS** (post-52.css was cached) but the JavaScript injection from audit-11 is gone, so hero images are missing.

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

---

## Recommended Next Steps for Ernie

1. **Fix SSH access** — this is the #1 priority. Without it, I can only observe, not fix
2. **Recreate VBS 2026 page** — it was likely removed accidentally
3. **Consider migrating to custom PHP templates** — the `table-for-all` theme templates in `/wp-content/themes/table-for-all/` are clean and work well, but WordPress/Elementor intercepts them. This needs a serious redirect setup

**Overall Confidence: 2/10** — Cannot make fixes without SSH. Site is decaying.
