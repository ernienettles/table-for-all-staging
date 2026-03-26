<?php
/**
 * Theme functions and definitions.
 */
function faithconnect_child_enqueue_styles() {
wp_enqueue_style( 'faith-connect-child-style',
get_stylesheet_directory_uri() . '/style.css',
array(),
wp_get_theme()->get('Version')
);
}

add_action( 'wp_enqueue_scripts', 'faithconnect_child_enqueue_styles', 11 );

/**
 * Custom JS for Table for All site - High priority to override Elementor
 */
function tfa_custom_js() {
echo '<script>
jQuery(document).ready(function($) {
    // Contact form submit button - change to "Send Message"
    $(".elementor-46529 button[type=submit], form.elementor-form button[type=submit]").each(function() {
        $(this).text("Send Message");
    });
    
    // Force button colors
    $(".elementor-button, a.elementor-button, button.elementor-button").css({
        "background-color": "#C4703B",
        "background": "#C4703B",
        "border-color": "#C4703B"
    });
    
    // Force social icon colors
    $(".elementor-social-icon i, .elementor-social-icon svg").css({
        "color": "#C4703B"
    });
    $(".elementor-social-icon").css({
        "opacity": "1"
    });
});
</script>';
}
add_action('wp_head', 'tfa_custom_js', 999);
