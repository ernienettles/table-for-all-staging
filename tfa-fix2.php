<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');

$kit_id = 52;
$meta_key = '_elementor_page_settings';

// Stronger kit CSS with very specific overrides
$new_css = <<<'CSS'
/* ============================================
   Table for All — Global Design Fixes
   ============================================ */

/* BUTTON CONSISTENCY — Global (hover lift removed) */
.elementor-button,
.elementor-button-wrapper .elementor-button,
a.elementor-button {
    border-radius: 6px !important;
    transition: all 0.2s ease !important;
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

/* ABOUT PAGE HERO — FORCE solid dark background, override any image/color */
body.postid-46519 .elementor-container.elementor-element-a1bcabc,
body.postid-46519 .elementor-element-a1bcabc,
.postid-46519 .elementor-section-wrap > .elementor-container,
.postid-46519 .elementor-container {
    background-image: none !important;
    background-color: #1a1a1a !important;
    background-repeat: no-repeat !important;
    background-size: auto !important;
    background-position: center center !important;
}

/* Also target by ID if Elementor uses data-element-id */
[data-elementor-type="wp-page"][data-elementor-id="46519"] .elementor-container:first-child,
#elementor-element-a1bcabc {
    background-image: none !important;
    background-color: #1a1a1a !important;
}

/* STORIES PAGE — clean (max-width removed) */
.postid-46521 .elementor-text-editor p,
.elementor-page-46521 .elementor-text-editor p {
    font-size: 1.05rem !important;
    line-height: 1.8 !important;
}
CSS;

$settings_raw = get_post_meta($kit_id, $meta_key, true);
if (is_array($settings_raw)) {
    $settings = $settings_raw;
} else {
    $settings = $settings_raw ? @unserialize($settings_raw) : array();
}
if (!is_array($settings)) $settings = array();
$settings['custom_css'] = $new_css;
update_post_meta($kit_id, $meta_key, $settings);
echo "Kit CSS updated: " . strlen($new_css) . " bytes\n";
echo "Done!\n";
