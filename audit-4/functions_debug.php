<?php
// Table for All - Custom Theme
file_put_contents("/tmp/fn_loaded.txt", "functions.php LOADED __DIR__=" . __DIR__ . PHP_EOL, FILE_APPEND);

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
    $id = get_queried_object_id();
    file_put_contents("/tmp/tr_fired.txt", "TR fired, id=$id, url=" . $_SERVER['REQUEST_URI'] . PHP_EOL, FILE_APPEND);
    
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
        file_put_contents("/tmp/tr_fired.txt", "TR matched id=$id, file=$file, exists=" . (file_exists($file)?1:0) . PHP_EOL, FILE_APPEND);
        if (file_exists($file)) {
            file_put_contents("/tmp/tr_fired.txt", "TR including file\n", FILE_APPEND);
            include $file;
            exit;
        }
    }
}, -9999);
