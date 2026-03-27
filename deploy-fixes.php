<?php
/**
 * Table for All — Deploy Fixes via Database Update
 * 
 * Since Elementor overrides page templates via template_include filter,
 * we update the WordPress page content directly.
 * 
 * Strategy: update page content, set page templates, and ensure Elementor doesn't override.
 */
define('WP_USE_THEMES', false);
require('/home/customer/www/ernien.sg-host.com/public_html/wp-load.php');

$staging_base = '/home/customer/www/staging2.ernien.sg-host.com/public_html';

// Check if staging files exist
if (!is_dir($staging_base)) {
    die("Staging directory not found: $staging_base\n");
}

// Map: URL slug => [staging_file, page_template]
$pages = [
    'about'   => ['about.html',   'tpl-about.php'],
    'stories' => ['stories.html', 'tpl-stories.php'],
    'gallery' => ['gallery.html', 'tpl-gallery.php'],
    'donate'  => ['donate.html',  'tpl-donate.php'],
    'contact' => ['contact.html', 'tpl-contact.php'],
];

// Also update home (even though it's working)
$home_file = $staging_base . '/home.html';

$results = [];

foreach ($pages as $slug => $info) {
    list($file, $template) = $info;
    $path = $staging_base . '/' . $file;
    
    if (!file_exists($path)) {
        $results[] = "SKIP $slug: $path not found";
        continue;
    }
    
    $new_content = file_get_contents($path);
    if ($new_content === false || strlen($new_content) < 100) {
        $results[] = "SKIP $slug: file empty or unreadable";
        continue;
    }
    
    $page = get_page_by_path($slug);
    if (!$page) {
        $results[] = "SKIP $slug: WordPress page not found";
        continue;
    }
    
    // Update post content
    $update = wp_update_post([
        'ID' => $page->ID,
        'post_content' => $new_content,
    ], true);
    
    if (is_wp_error($update)) {
        $results[] = "ERROR $slug: " . $update->get_error_message();
    } else {
        $results[] = "OK $slug: content updated ({$update})";
    }
    
    // Update page template
    update_post_meta($page->ID, '_wp_page_template', $template);
    $results[] = "OK $slug: template set to $template";
    
    // Disable Elementor for this page (set elementor data to empty)
    update_post_meta($page->ID, '_elementor_edit_mode', '');
    update_post_meta($page->ID, '_elementor_data', '');
    $results[] = "OK $slug: Elementor disabled";
}

// Handle home page
if (file_exists($home_file)) {
    $home_content = file_get_contents($home_file);
    $home = get_page_by_path('/');
    if (!$home) $home = get_page_by_path('home');
    if ($home) {
        wp_update_post(['ID' => $home->ID, 'post_content' => $home_content], true);
        update_post_meta($home->ID, '_elementor_edit_mode', '');
        update_post_meta($home->ID, '_elementor_data', '');
        $results[] = "OK home: content updated, Elementor disabled";
    }
}

// Handle VBS page (try both slugs)
$vbs_slugs = ['vbs-2026', 'vbs26', 'peru-visit-2026', 'vbs'];
$vbs_updated = false;
foreach ($vbs_slugs as $vbs_slug) {
    $vbs = get_page_by_path($vbs_slug);
    if ($vbs) {
        $vbs_file = $staging_base . '/vbs.html';
        if (file_exists($vbs_file)) {
            $vbs_content = file_get_contents($vbs_file);
            wp_update_post(['ID' => $vbs->ID, 'post_content' => $vbs_content], true);
            update_post_meta($vbs->ID, '_elementor_edit_mode', '');
            update_post_meta($vbs->ID, '_elementor_data', '');
            $results[] = "OK vbs: content updated ($vbs_slug)";
        }
        $vbs_updated = true;
        break;
    }
}
if (!$vbs_updated) {
    $results[] = "SKIP vbs: page not found";
}

foreach ($results as $r) {
    echo "$r\n";
}

// Clear all caches
if (function_exists('wp_cache_flush')) wp_cache_flush();
delete_transient('elementor_cache');
delete_transient('elementor_docs_cache');
delete_option('elementor_cache');

// Clear OPcache if available
if (function_exists('opcache_reset')) {
    opcache_reset();
}

echo "Done. All caches cleared.\n";
