<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');

$kit_id = 52;
$meta_key = '_elementor_page_settings';

// New kit CSS — reverted unwanted rules
$new_css = <<<'CSS'
/* ============================================
   Table for All — Global Design Fixes
   Injected via Elementor kit settings
   ============================================ */

/* BUTTON CONSISTENCY — Global (hover effects removed) */
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

/* ABOUT PAGE HERO — solid dark background, no photo overlay */
.elementor-page-46519 .elementor-section-wrap > .elementor-section:first-child,
.elementor-page-46519 .elementor-section-hero,
.postid-46519 .elementor-section-wrap > .elementor-section:first-child {
    background-image: none !important;
    background-color: #1a1a1a !important;
    background-repeat: no-repeat !important;
    background-size: auto !important;
    background-position: center center !important;
}

/* STORIES PAGE — clean (max-width removed) */
.postid-46521 .elementor-text-editor p,
.elementor-page-46521 .elementor-text-editor p {
    font-size: 1.05rem !important;
    line-height: 1.8 !important;
}
CSS;

// Update kit CSS
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

// Fix About page hero — change background_image to solid dark
$about_id = 46519;
$about_data_raw = get_post_meta($about_id, '_elementor_data', true);
$about_data = json_decode($about_data_raw, true);

if ($about_data && is_array($about_data)) {
    $changed = 0;
    foreach ($about_data as &$section) {
        if (isset($section['elType']) && $section['elType'] === 'container') {
            $section['settings']['background_background'] = 'classic';
            $section['settings']['background_image'] = array('url' => '');
            $section['settings']['background_color'] = '#1a1a1a';
            $section['settings']['background_repeat'] = 'no-repeat';
            $section['settings']['background_size'] = 'cover';
            $section['settings']['background_position'] = 'center center';
            $changed++;
            break;
        }
    }
    if ($changed > 0) {
        $new_about_data = json_encode($about_data, JSON_UNESCAPED_UNICODE);
        update_post_meta($about_id, '_elementor_data', $new_about_data);
        echo "About hero background updated to solid #1a1a1a and saved\n";
    } else {
        echo "WARNING: No container found in About page data\n";
    }
} else {
    echo "ERROR: Could not parse About page elementor data\n";
}

echo "Done!\n";
