<?php
/**
 * Main Theme Functions
 */

define( 'CMSMASTERS_THEME_VERSION', '1.1.2' );

// CMSMasters API
define( 'CMSMASTERS_API_ROUTES_URL', 'http://api.cmsmasters.net/wp-json/cmsmasters-api/v1/' );

// Theme options
define( 'CMSMASTERS_THEME_NAME', 'faith-connect' );
define( 'CMSMASTERS_OPTIONS_PREFIX', 'cmsmasters_faith-connect_' );
define( 'CMSMASTERS_OPTIONS_NAME', 'cmsmasters_faith-connect_options' );
define( 'CMSMASTERS_FRAMEWORK_COMPATIBILITY', true );

/*
 * Register Elementor Locations
 */
if ( ! function_exists( 'cmsmasters_register_elementor_locations' ) ) {
	function cmsmasters_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'cmsmasters_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}

add_action( 'elementor/theme/register_locations', 'cmsmasters_register_elementor_locations' );

// require files
require_once get_parent_theme_file_path( '/core/starter.php' );

// Table for All - Custom CSS overrides - highest priority
function tfa_custom_styles() {
    echo '<style>
    /* FORCE ALL BUTTONS TO #C4703B */
    .elementor-button, a.elementor-button, button.elementor-button,
    .elementor-widget-button .elementor-button,
    [type=submit] {
        background-color: #C4703B !important;
        background: #C4703B !important;
        border-color: #C4703B !important;
        color: #FFFFFF !important;
        min-height: 48px !important;
        padding: 14px 32px !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
    }
    .elementor-button:hover, a.elementor-button:hover, button.elementor-button:hover {
        background-color: #1C1108 !important;
        background: #1C1108 !important;
    }
    
    /* Social Icons - Visible orange */
    .elementor-social-icon {
        color: #C4703B !important;
        opacity: 1 !important;
    }
    .elementor-social-icon i:before {
        color: #C4703B !important;
    }
    .elementor-social-icon:hover {
        color: #1C1108 !important;
    }
    
    /* HERO IMAGES */
    .elementor-element-a1bcabc,
    .elementor-46519 .elementor-element-a1bcabc {
        background-image: url("https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-about.jpg") !important;
        background-size: cover !important;
        background-position: center center !important;
        position: relative;
    }
    .elementor-element-a1bcabc::before,
    .elementor-46519 .elementor-element-a1bcabc::before {
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        background: rgba(28,17,8,0.55) !important;
        z-index: 0 !important;
    }
    
    .elementor-element-a964ff9,
    .elementor-46529 .elementor-element-a964ff9 {
        background-image: url("https://ernien.sg-host.com/wp-content/uploads/2026/03/peru.jpg") !important;
        background-size: cover !important;
        background-position: center center !important;
        position: relative;
    }
    .elementor-element-a964ff9::before,
    .elementor-46529 .elementor-element-a964ff9::before {
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        background: rgba(28,17,8,0.55) !important;
        z-index: 0 !important;
    }
    
    .elementor-element-72f5dc2,
    .elementor-46523 .elementor-element-72f5dc2 {
        background-image: url("https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-peru.jpg") !important;
        background-size: cover !important;
        background-position: center center !important;
        position: relative;
    }
    .elementor-element-72f5dc2::before,
    .elementor-46523 .elementor-element-72f5dc2::before {
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        background: rgba(28,17,8,0.55) !important;
        z-index: 0 !important;
    }
    
    .elementor-element-f8c95f2,
    .elementor-46521 .elementor-element-f8c95f2 {
        background-image: url("https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-stories.jpg") !important;
        background-size: cover !important;
        background-position: center center !important;
        position: relative;
    }
    .elementor-element-f8c95f2::before,
    .elementor-46521 .elementor-element-f8c95f2::before {
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        background: rgba(28,17,8,0.55) !important;
        z-index: 0 !important;
    }
    
    .elementor-element-8b4f9ef,
    .elementor-46525 .elementor-element-8b4f9ef {
        background-image: url("https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-donate.jpg") !important;
        background-size: cover !important;
        background-position: center center !important;
        position: relative;
    }
    .elementor-element-8b4f9ef::before,
    .elementor-46525 .elementor-element-8b4f9ef::before {
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        background: rgba(28,17,8,0.55) !important;
        z-index: 0 !important;
    }
    
    /* Ensure z-index for content above overlay */
    .elementor-element-a1bcabc > .e-con-inner,
    .elementor-element-a964ff9 > .e-con-inner,
    .elementor-element-72f5dc2 > .e-con-inner,
    .elementor-element-f8c95f2 > .e-con-inner,
    .elementor-element-8b4f9ef > .e-con-inner {
        position: relative !important;
        z-index: 1 !important;
    }
    </style>';
}
add_action('wp_head', 'tfa_custom_styles', 9999);

// Table for All - Custom JS
function tfa_custom_js() {
    echo '<script>
    jQuery(document).ready(function($) {
        // Contact form submit button - change to "Send Message"
        setTimeout(function() {
            $(".elementor-46529 button[type=submit], form.elementor-form button[type=submit]").each(function() {
                $(this).text("Send Message");
            });
        }, 500);
    });
    </script>';
}
add_action('wp_head', 'tfa_custom_js', 10000);
