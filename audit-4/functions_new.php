<?php
// Table for All - Custom Theme

// Stories CPT
add_action('init', function() {
    register_post_type('story', [
        'labels' => ['name' => 'Stories', 'singular_name' => 'Story'],
        'public' => true, 'has_archive' => true, 'show_in_rest' => true,
        'rest_base' => 'stories', 'supports' => ['title','editor','thumbnail','excerpt'],
        'menu_icon' => 'dashicons-book-alt', 'rewrite' => ['slug' => 'story-posts'],
    ]);
});

// Intercept these pages and serve our custom full-page PHP templates
add_action('template_redirect', function() {
    if (!is_main_query()) return;
    
    $id = get_queried_object_id();
    $map = [
        46906 => 'tpl-home.php',
        46519 => 'tpl-about.php',
        46521 => 'tpl-stories.php',
        46525 => 'tpl-donate.php',
        46523 => 'tpl-gallery.php',
        46908 => 'tpl-vbs.php',
        46529 => 'tpl-contact.php',
    ];
    
    if ($id && isset($map[$id])) {
        $file = __DIR__ . '/' . $map[$id];
        if (file_exists($file)) {
            // Kill any output buffering and output the file directly
            while (ob_get_level()) { ob_end_clean(); }
            include $file;
            exit;
        }
    }
}, -9999);
