<?php
define('WP_USE_THEMES', false);
require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');
global $wpdb;
$results = $wpdb->get_results("SELECT p.ID, p.post_name, p.post_title, pm.meta_value as template FROM $wpdb->posts p JOIN $wpdb->postmeta pm ON p.ID = pm.post_id WHERE p.post_type = 'page' AND p.post_status = 'publish' AND pm.meta_key = '_wp_page_template' ORDER BY p.menu_order", ARRAY_A);
foreach($results as $r) {
  echo "{$r['post_name']} | {$r['post_title']} | {$r['template']}\n";
}
