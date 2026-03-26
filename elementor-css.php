<?php
require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');

$kit_id = 52;
$meta_key = '_elementor_page_settings';

$settings_raw = get_post_meta($kit_id, $meta_key, true);
if ($settings_raw) {
    $settings = @unserialize($settings_raw);
} else {
    $settings = array();
}
if (!is_array($settings)) $settings = array();

$custom_css = trim(file_get_contents('/tmp/custom.css'));

if (empty($custom_css)) {
    echo "No CSS found\n";
    exit(1);
}

$settings['custom_css'] = $custom_css;
update_post_meta($kit_id, $meta_key, $settings);

echo "Done. CSS length: " . strlen($custom_css) . " bytes\n";
