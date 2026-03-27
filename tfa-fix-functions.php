<?php
function faithconnect_child_enqueue_styles() {
    wp_enqueue_style( "faith-connect-child-style", get_stylesheet_directory_uri() . "/style.css", array(), "2026032701" );
}
add_action( "wp_enqueue_scripts", "faithconnect_child_enqueue_styles", 11 );

function tfa_custom_js() {
echo "<script>
jQuery(document).ready(function($) {
    // Contact form submit button - set text to Send Message
    $(\".elementor-46529 button[type=submit], form.elementor-form button[type=submit]\").each(function() {
        $(this).text(\"Send Message\").addClass(\"tfa-send-btn\");
    });

    // Force button colors via JS (backup for CSS)
    $(\".elementor-button, a.elementor-button, button.elementor-button\").css({
        \"background-color\": \"#C4703B\",
        \"background\": \"#C4703B\",
        \"border-color\": \"#C4703B\",
        \"min-height\": \"48px\"
    });

    // Force social icon visibility
    $(\".elementor-social-icon\").css({
        \"opacity\": \"1\",
        \"color\": \"#C4703B\",
        \"background-color\": \"#C4703B\",
        \"width\": \"42px\",
        \"height\": \"42px\",
        \"border-radius\": \"50%\"
    });
    $(\".elementor-social-icon i, .elementor-social-icon svg\").css({
        \"color\": \"#FFFFFF\",
        \"fill\": \"#FFFFFF\",
        \"width\": \"22px\",
        \"height\": \"22px\"
    });
});
</script>";
}
add_action("wp_head", "tfa_custom_js", 999);

function tfa_custom_css() {
    // About page hero - solid dark background
    echo '<style id="tfa-about-hero">
    .elementor-element-a1bcabc::before { display: none !important; }
    .elementor-element-a1bcabc,
    body.postid-46519 .elementor-element-a1bcabc,
    body.postid-46519 .elementor-section-wrap > .elementor-container:first-child,
    .postid-46519 .elementor-section-wrap > .elementor-container:first-child {
        background-image: none !important;
        background-color: #1a1a1a !important;
    }
    </style>';
    // Global - remove unwanted rules that are CDN-cached
    echo '<style id="tfa-global-css">
    /* Remove button hover lift */
    .elementor-button:hover {
        transform: none !important;
        box-shadow: none !important;
    }
    /* Remove hero text shadow */
    .elementor-widget-heading h1.elementor-heading-title,
    .elementor-widget-heading h2.elementor-heading-title {
        text-shadow: none !important;
    }
    /* Remove stories max-width */
    .postid-46521 .elementor-text-editor,
    .elementor-page-46521 .elementor-text-editor {
        max-width: none !important;
    }
    </style>';
}
add_action('wp_head', 'tfa_custom_css', 1);
