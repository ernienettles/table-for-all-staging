<?php
define('WP_USE_THEMES', false);
require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');

$page = get_page_by_path('about');
if ($page) {
    echo "About page ID: " . $page->ID . "\n";
    echo "Current content length: " . strlen($page->post_content) . "\n";
    echo "Elementor data: " . strlen(get_post_meta($page->ID, "_elementor_data", true)) . " chars\n";
    echo "Elementor edit mode: " . get_post_meta($page->ID, "_elementor_edit_mode", true) . "\n";
    echo "Page template: " . get_post_meta($page->ID, "_wp_page_template", true) . "\n";
    
    // Read the about.html content
    $path = '/home/customer/www/staging2.ernien.sg-host.com/public_html/about.html';
    if (file_exists($path)) {
        $content = file_get_contents($path);
        echo "New content length: " . strlen($content) . "\n";
        
        // Check if content starts with Gutenberg markup
        if (strpos($content, '<!-- wp:') === 0) {
            echo "Content is Gutenberg blocks - safe to insert\n";
        } else {
            echo "Content starts with: " . substr($content, 0, 100) . "\n";
        }
    }
} else {
    echo "About page not found\n";
}
