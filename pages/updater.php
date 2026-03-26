<?php
/**
 * Page Content Updater for Table for All
 * Run: wp eval-file updater.php
 */

$pages = array(
    42506 => '/home/customer/www/staging2.ernien.sg-host.com/public_html/home.html',
    46519 => '/home/customer/www/staging2.ernien.sg-host.com/public_html/about.html',
    46521 => '/home/customer/www/staging2.ernien.sg-host.com/public_html/stories.html',
    46523 => '/home/customer/www/staging2.ernien.sg-host.com/public_html/gallery.html',
    46525 => '/home/customer/www/staging2.ernien.sg-host.com/public_html/donate.html',
    46529 => '/home/customer/www/staging2.ernien.sg-host.com/public_html/contact.html',
);

foreach ($pages as $post_id => $file_path) {
    if (!file_exists($file_path)) {
        WP_CLI::warning("File not found: $file_path");
        continue;
    }
    
    $content = file_get_contents($file_path);
    $result = wp_update_post(array(
        'ID' => (int) $post_id,
        'post_content' => $content,
        'post_content_filtered' => '',
    ), true);
    
    if (is_wp_error($result)) {
        WP_CLI::warning("Error updating post $post_id: " . $result->get_error_message());
    } else {
        WP_CLI::success("Updated post $post_id from $file_path");
    }
}

// Create VBS 2026 page if it doesn't exist
$vbs_page = get_page_by_path('vbs-2026');
if (!$vbs_page) {
    $result = wp_insert_post(array(
        'post_title' => 'VBS 2026',
        'post_name' => 'vbs-2026',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => file_get_contents('/home/customer/www/staging2.ernien.sg-host.com/public_html/vbs.html'),
    ));
    if (is_wp_error($result)) {
        WP_CLI::warning("Error creating VBS page: " . $result->get_error_message());
    } else {
        WP_CLI::success("Created VBS 2026 page with ID: $result");
    }
} else {
    WP_CLI::success("VBS 2026 page already exists with ID: " . $vbs_page->ID);
}

WP_CLI::success("All pages updated!");
