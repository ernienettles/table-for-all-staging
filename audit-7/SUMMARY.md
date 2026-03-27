# Table for All Website Audit - March 27, 2026

## Critical Finding

**The site is built with Elementor page builder, NOT PHP templates.** The tpl-*.php files I edited are unused by the actual pages. This means:
- About page hero (black) → Requires Elementor UI to add background image
- Gallery page hero (text-only) → Requires Elementor UI to add background image
- Contact submit button → Requires Elementor UI to adjust

## What I Fixed

1. **CSS improvements to tpl-*.php templates** (prepared but unused):
   - Removed background-color interference from .hero .bg
   - Strengthened overlays for better text contrast
   - Added min-height:48px to contact submit button
   
2. **Attempted CSS injection via Elementor custom CSS** (did not override Elementor CSS)

3. **Verified**: No green #2D5A3D found anywhere on the site

## Current Page Scores (from screenshots)

| Page | Score | Issue |
|------|-------|-------|
| Home | 7.5/10 | Hero photo visible, social icons faint |
| VBS 2026 | ~9/10 | Working well |
| About | ~5/10 | Black hero, no photo |
| Gallery | 7/10 | Text-only hero, no photo |
| Contact | ~7/10 | Submit button below fold, form OK |
| Stories | ~7.5/10 | Hero photo visible |
| Donate | ~7/10 | Accent colors may be off |

## What Requires Manual Elementor Editing

1. **About page**: Set background image on hero section (currently has `background-image: none`)
2. **Gallery page**: Set background image on hero section  
3. **Social icons**: Current styling is faint - needs re-styling in Elementor
4. **Submit button**: Size/styling controlled by Elementor form widget

## Confidence Score

**4/10** - I cannot improve the critical issues (hero images) without Elementor UI access. The PHP template approach was based on incorrect assumptions about how the site is built.

## Next Steps for Ernie

To fix the remaining issues, someone with WordPress/Elementor admin access needs to:
1. Go to the About page in Elementor editor
2. Select the hero section → Style → Background → Choose image
3. Same for Gallery page
4. Social icons: Edit the social icons widget in the header
