#!/usr/bin/env python3
"""Push enhanced CSS to the Elementor global kit"""
import MySQLdb
import re

DB_NAME = 'dbfjyffxpyejpa'
DB_USER = 'uw7wam3vp6ghx'
with open('/home/customer/tmp/mysql.txt') as f:
    DB_PASS = f.read().strip()
DB_HOST = '127.0.0.1'

conn = MySQLdb.connect(host=DB_HOST, user=DB_USER, passwd=DB_PASS, db=DB_NAME)
cursor = conn.cursor()

cursor.execute("SELECT meta_value FROM tnf_postmeta WHERE post_id = 52 AND meta_key = '_elementor_page_settings'")
row = cursor.fetchone()
if not row:
    print("No kit found")
    exit(1)

meta = row[0]

# Find the custom_css section and replace it
# The format is: s:10:"custom_css";s:\d+:"CSS_CONTENT"
pattern = r'(s:10:"custom_css";s:)\d+:(".*?")(;|$)'

def replace_css(m):
    prefix = m.group(1)
    suffix = m.group(3)
    css_content = NEW_CSS.replace('\\', '\\\\').replace('"', '\\"')
    new_len = len(css_content)
    return f'{prefix}{new_len}:"{css_content}"{suffix}'

NEW_CSS = r"""/* ============================================
   Table for All — Global Design Fixes v7
   Enhanced by Jon (OpenClaw) - 2026-03-27
   ============================================ */

/* BUTTON CONSISTENCY — Global */
.elementor-button,
.elementor-button-wrapper .elementor-button,
a.elementor-button {
    border-radius: 8px !important;
    transition: all 0.2s ease !important;
    min-height: 48px !important;
    background-color: #C4703B !important;
    background: #C4703B !important;
    border-color: #C4703B !important;
    color: #FFFFFF !important;
    font-weight: 700 !important;
    padding: 14px 32px !important;
    box-shadow: 0 4px 16px rgba(196,112,59,0.4) !important;
}
.elementor-button:hover,
.elementor-button-wrapper .elementor-button:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(196,112,59,0.5) !important;
    background-color: #1C1108 !important;
    border-color: #1C1108 !important;
    color: #FFFFFF !important;
}

/* TEXT SHADOW — Hero white text on dark images */
.elementor-widget-heading h1.elementor-heading-title,
.elementor-widget-heading h2.elementor-heading-title,
.elementor-widget-heading h3.elementor-heading-title,
.elementor-widget-theme-post-content h1,
section.hero h1,
section.hero h2,
section.hero h3,
.elementor-type-builder section.hero h1 {
    text-shadow: 0 3px 16px rgba(0,0,0,0.7) !important;
}

/* STORIES PAGE — Narrower text for readability */
.postid-46521 .elementor-text-editor,
.elementor-page-46521 .elementor-text-editor {
    max-width: 680px !important;
    margin-left: auto !important;
    margin-right: auto !important;
}
.postid-46521 .elementor-text-editor p,
.elementor-page-46521 .elementor-text-editor p {
    font-size: 1.05rem !important;
    line-height: 1.8 !important;
}

/* ORANGE SQUARE FIX — bottom right CTA button */
.elementor-widget-button a.elementor-button {
    border-radius: 8px !important;
    min-width: 160px !important;
    text-align: center !important;
    font-weight: 700 !important;
    font-size: 0.95rem !important;
    padding: 14px 28px !important;
    box-shadow: 0 4px 16px rgba(196,112,59,0.4) !important;
}

/* NAV LINK HOVER — Orange on hover */
.elementor-nav-menu a:hover,
nav a:hover,
header a:hover {
    color: #C4703B !important;
}

/* ACTIVE NAV — Orange color + bottom border */
.elementor-nav-menu .current-menu-item > a,
nav .current-menu-item > a,
header .current-menu-item > a {
    color: #C4703B !important;
    border-bottom: 3px solid #C4703B !important;
}

/* SOCIAL ICONS IN HEADER — Orange circles, 42px, fully visible */
.cmsmasters-header-mid-social .cmsmasters-social-icon,
.cmsmasters-header-top-social .cmsmasters-social-icon,
.cmsmasters-header-bot-social .cmsmasters-social-icon,
.cmsmasters-header-mid-social__item-icon,
.cmsmasters-header-top-social__item-icon,
.cmsmasters-header-bot-social__item-icon,
.elementor-social-icon {
    background-color: #C4703B !important;
    color: #FFFFFF !important;
    opacity: 1 !important;
    width: 42px !important;
    height: 42px !important;
    min-width: 42px !important;
    min-height: 42px !important;
    border-radius: 50% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.cmsmasters-header-mid-social__item-icon i,
.cmsmasters-header-top-social__item-icon i,
.cmsmasters-header-bot-social__item-icon i,
.cmsmasters-header-mid-social__item-icon svg,
.cmsmasters-header-top-social__item-icon svg,
.cmsmasters-header-bot-social__item-icon svg,
.elementor-social-icon i:before,
.elementor-social-icon svg {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
    font-size: 20px !important;
    width: 20px !important;
    height: 20px !important;
}
.elementor-social-icon:hover,
.cmsmasters-social-icon:hover {
    background-color: #1C1108 !important;
    transform: scale(1.1) !important;
}

/* CONTACT FORM — Submit button full width, 52px, orange */
.elementor-46529 button[type=submit],
.elementor-46529 .elementor-button[type=submit],
form.elementor-form button[type=submit],
.elementor-form button[type=submit] {
    background-color: #C4703B !important;
    border-color: #C4703B !important;
    color: #FFFFFF !important;
    min-height: 52px !important;
    padding: 14px 40px !important;
    font-size: 1rem !important;
    font-weight: 700 !important;
    border-radius: 8px !important;
    border: none !important;
    width: 100% !important;
    display: block !important;
    text-align: center !important;
    cursor: pointer !important;
    box-shadow: 0 4px 16px rgba(196,112,59,0.4) !important;
}
.elementor-46529 button[type=submit]:hover,
form.elementor-form button[type=submit]:hover {
    background-color: #1C1108 !important;
    border-color: #1C1108 !important;
    transform: translateY(-2px) !important;
}

/* ABOUT PAGE — Hero container dark bg with proper overlay */
.elementor-page-46519 .elementor-element-overlay {
    background-color: #1C1108 !important;
}

/* GALLERY HERO — Ensure text has dark background behind it */
.elementor-page-46523 [data-id="e2982aa"] {
    background-color: rgba(0,0,0,0.55) !important;
}

/* VBS PAGE HERO — Ensure full coverage */
.elementor-page-46597 .elementor-section-wrap > .elementor-section:first-child {
    min-height: 60vh !important;
}

/* FIX: CMSMasters header social icons */
.cmsmasters-header-social-items .cmsmasters-social-icon {
    background-color: #C4703B !important;
    opacity: 1 !important;
    border-radius: 50% !important;
    width: 42px !important;
    height: 42px !important;
}

/* HERO SECTION DARK OVERLAY — force overlay on ALL hero sections */
.elementor-section-wrap > .elementor-section:first-child > .elementor-container {
    background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.6) 100%) !important;
}

/* REMOVE DROP SHADOWS FROM HEADINGS — modern clean look */
.elementor-widget-heading .elementor-heading-title {
    text-shadow: none !important;
    filter: none !important;
}

/* CMSMasters highlight title — ensure visibility */
.cmsmasters-highlight-title .highlight_title_text {
    text-shadow: 0 2px 12px rgba(0,0,0,0.6) !important;
}
"""

# Simple string replacement approach
old_css_match = re.search(r'(s:10:"custom_css";s:)\d+:(".*?")(;|\}\$)', meta, re.DOTALL)
if old_css_match:
    # Find where custom_css value ends
    start = meta.find('custom_css";s:')
    if start != -1:
        # Find the opening quote after the length
        q1 = meta.index('"', start)
        q2 = meta.index('"', q1 + 1)
        # q2 is end of content string's opening quote
        # Now find the matching close quote (accounting for escaped chars)
        content_start = q2 + 1
        # Find the ; that closes this string (before next key)
        search_from = content_start
        while True:
            next_quote = meta.index('"', search_from)
            # Check what's between last quote and this quote
            segment = meta[content_start:next_quote]
            # Count escaped quotes
            num_escapes = segment.count('\\"')
            if num_escapes % 2 == 0:
                # Not escaped - this is the end
                content_end = next_quote
                break
            search_from = next_quote + 1
        
        old_section = meta[content_start-1:content_end+1]
        print(f"Old CSS length: {len(segment)} chars")
        
        # Build new meta
        new_segment = NEW_CSS.replace('\\', '\\\\').replace('"', '\\"')
        new_meta = meta[:content_start-1] + '"' + new_segment + '"' + meta[content_end+1:]
        
        cursor.execute("UPDATE tnf_postmeta SET meta_value = %s WHERE post_id = 52 AND meta_key = '_elementor_page_settings'", (new_meta,))
        conn.commit()
        print(f"New CSS pushed: {len(new_segment)} chars")
    else:
        print("Could not find custom_css section")
else:
    print("Pattern not found, trying alternate approach")

conn.close()
print("Done.")
