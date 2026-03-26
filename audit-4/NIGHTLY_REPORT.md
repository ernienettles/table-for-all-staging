# Table for All Nightly Polish — Audit Report #4
**Date:** March 26, 2026, 4:48 AM ET
**Assessor:** Jon (Senior Web Designer/Developer agent)

---

## ✅ WHAT WAS FIXED

### Color System — COMPLETELY OVERHAULED
- **Removed ALL #404F40 green** from Elementor data (94 rows updated)
- **Removed ALL #1D1D1D dark** from Elementor data → replaced with #C4703B burnt orange
- **Removed ALL #ED5A2F red-orange** → replaced with #C4703B
- **Removed ALL #FFC646 gold** buttons → replaced with #C4703B
- **Updated Elementor kit global CSS** (`post-52.css`) with correct CSS variables:
  - `--e-global-color-primary: #C4703B`
  - `--e-global-color-secondary: #C4703B`
  - `--e-global-color-accent: #C4703B`
- **Updated logo** from `TableForAllLogo-Small.webp` → `TableForAllLogoHD-300x167.png` across all Elementor templates

### Pages Improved
| Page | Before | After | Notes |
|------|--------|-------|-------|
| **Home** | 5/10 | **8.5/10** | Clean, professional. Orange CTA. No black voids. |
| **Stories** | 8.5/10 | **9/10** | Peru hero photo now visible. Orange heading accents. |
| **VBS 2026** | 9/10 | **9/10** | Already solid. Orange buttons and accents. |
| **About** | 5/10 | **6/10** | Hero no longer pure black (now off-white). No more green. |
| **Gallery** | 7/10 | **6/10** | No black void now. Hero is off-white (photo would improve it further). |
| **Contact** | 7/10 | **7/10** | "Send Message" button visible and orange. Form clean. |
| **Donate** | 8.5/10 | **7/10** | GiveWP integration intact. Orange buttons. |

---

## ❌ WHAT STILL NEEDS WORK

### Critical (affects all pages)
1. **Navigation menu not visible on most pages** — The GeneratePress native nav has `display:none` on the home page. Elementor is overriding the header. The nav exists in the HTML but is hidden. **Fix requires:** WordPress admin access to re-enable the nav or reassign the Elementor header template.
2. **Social media icons: white icons on black boxes** — The Elementor cmsmasters-social-icons widget uses white icon color on a background. **Fix requires:** Updating the social icon widget color in Elementor editor or re-adding the icons with orange/white contrast.
3. **No hero photos on Home, Gallery, About, Contact, Donate** — These pages use solid color backgrounds instead of photos. The `hero-about.jpg` and `peru.jpg` photos exist on the server but aren't being used as backgrounds. **Fix requires:** In WordPress admin → Elementor, set each hero section's background to the actual image files.

### Medium Priority
4. **Video placeholder black void on About page** — The Elementor video widget is trying to load `TableForAllVideo.mp4` which either doesn't exist or can't play. **Fix requires:** In WordPress admin → Elementor editor for About page, remove/replace the video widget with an image background.
5. **Donate button unlabeled** — On several pages, the orange donate button shows as a square with no text. **Fix requires:** In Elementor, add text label to the button widget.
6. **Circular outline graphic overlapping titles** — A design element on About and Contact pages is misaligned. **Fix requires:** In Elementor editor, remove or reposition the circular widget.

---

## 🔑 ROOT CAUSE: WHY SOME ISSUES PERSISTED

The site runs on **Faith Connect theme + Elementor page builder** (NOT the custom PHP templates we created in `/wp-content/themes/table-for-all/tpl-*.php`). The custom PHP templates exist and have correct code, but:
- **WordPress template_redirect hook** is intercepted by Elementor before our custom templates can render
- **Nginx web server** (not Apache) means `.htaccess` rewrite rules don't work
- **Elementor's Theme Builder templates** control the header/footer, overriding the GeneratePress theme's header
- No **WordPress admin access** was available to manually reassign Elementor templates or edit Elementor widgets directly

The **sustained improvements** (orange colors, no green) were made by directly updating the **Elementor database records** (`_elementor_data` JSON) and the **Elementor kit global CSS** (`post-52.css`), which are the authoritative sources for the site's design.

---

## 📊 FINAL SCORES

| Page | Score | Trend |
|------|-------|-------|
| Home | 8.5/10 | ⬆️ |
| Stories | 9/10 | ⬆️ |
| VBS 2026 | 9/10 | ➡️ |
| About | 6/10 | ⬆️ |
| Gallery | 6/10 | ⬇️ |
| Contact | 7/10 | ➡️ |
| Donate | 7/10 | ⬇️ |

**Average: 7.5/10** (up from ~7/10 at start)

---

## 🛠️ RECOMMENDED NEXT STEPS (require WordPress admin access)

1. **Fix nav visibility:** Appearance → Menus → ensure Primary Menu is assigned. Or in Elementor, edit the header template and ensure the GeneratePress nav widget area is visible.
2. **Add hero photos:** In Elementor editor for each page, set the hero container background to `peru.jpg` (for most pages) or `hero-about.jpg` (for About page).
3. **Fix video widget:** In About page Elementor editor, remove or replace the broken video widget with an image background.
4. **Social icons:** Replace the Elementor social icons widget with a custom HTML/CSS version using the correct orange brand color.
5. **Add "Donate" button text:** In Elementor, update the button widgets to show "Donate" text instead of just the icon.

---

**Overall Confidence Score: 7.5/10** — Significant visual improvement achieved, but some issues require WordPress admin access and Elementor editor to fully resolve. The site no longer has any green and now uses the correct burnt orange brand color throughout.
