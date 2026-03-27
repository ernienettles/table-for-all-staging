<?php
define('WP_USE_THEMES', false);
require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');
global $wpdb;

// Check About page content
$about = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = 'about' AND post_type = 'page' LIMIT 1");
echo "About page content length: " . strlen($about->post_content) . " chars\n";
echo "About first 200 chars: " . substr(strip_tags($about->post_content), 0, 200) . "\n---\n";

// Check Contact page content
$contact = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = 'contact' AND post_type = 'page' LIMIT 1");
echo "Contact page content length: " . strlen($contact->post_content) . " chars\n";
echo "Contact first 200 chars: " . substr(strip_tags($contact->post_content), 0, 200) . "\n---\n";

// Check Gallery page content
$gallery = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = 'gallery' AND post_type = 'page' LIMIT 1");
echo "Gallery page content length: " . strlen($gallery->post_content) . " chars\n";
echo "Gallery first 200 chars: " . substr(strip_tags($gallery->post_content), 0, 200) . "\n";
