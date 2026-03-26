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

// Table for All - Custom CSS overrides
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
    
    /* Hero overlay for text readability */
    .elementor-element-a1bcabc::before,
    .elementor-element-a964ff9::before,
    .elementor-element-72f5dc2::before,
    .elementor-element-f8c95f2::before,
    .elementor-element-8b4f9ef::before {
        content: "" !important;
        position: absolute !important;
        inset: 0 !important;
        background: rgba(28,17,8,0.55) !important;
        z-index: 0 !important;
    }
    
    .elementor-element-a1bcabc > *,
    .elementor-element-a964ff9 > *,
    .elementor-element-72f5dc2 > *,
    .elementor-element-f8c95f2 > *,
    .elementor-element-8b4f9ef > * {
        position: relative !important;
        z-index: 1 !important;
    }
    </style>';
}
add_action('wp_head', 'tfa_custom_styles', 9999);

// Table for All - Custom JS to set hero backgrounds directly
function tfa_custom_js() {
    echo '<script>
    (function() {
        // Hero images mapping
        var heroImages = {
            "a1bcabc": "https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-about.jpg",
            "a964ff9": "https://ernien.sg-host.com/wp-content/uploads/2026/03/peru.jpg",
            "72f5dc2": "https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-peru.jpg",
            "f8c95f2": "https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-stories.jpg",
            "8b4f9ef": "https://ernien.sg-host.com/wp-content/uploads/2026/03/tfa/hero-donate.jpg"
        };
        
        function applyHeroImages() {
            for (var id in heroImages) {
                var els = document.querySelectorAll(".elementor-element-" + id);
                if (els.length === 0) {
                    els = document.querySelectorAll("[data-id=" + id + "]");
                }
                els.forEach(function(el) {
                    el.style.backgroundImage = "url(" + heroImages[id] + ")";
                    el.style.backgroundSize = "cover";
                    el.style.backgroundPosition = "center center";
                    el.style.backgroundRepeat = "no-repeat";
                });
            }
        }
        
        function applyButtonColors() {
            var buttons = document.querySelectorAll(".elementor-button, a.elementor-button, button.elementor-button, [type=submit]");
            buttons.forEach(function(btn) {
                btn.style.backgroundColor = "#C4703B";
                btn.style.background = "#C4703B";
                btn.style.borderColor = "#C4703B";
            });
        }
        
        function applySocialIconColors() {
            var icons = document.querySelectorAll(".elementor-social-icon i");
            icons.forEach(function(icon) {
                icon.style.color = "#C4703B";
            });
            var iconLinks = document.querySelectorAll(".elementor-social-icon");
            iconLinks.forEach(function(link) {
                link.style.color = "#C4703B";
                link.style.opacity = "1";
            });
        }
        
        function changeSubmitButtonText() {
            var submitBtns = document.querySelectorAll(".elementor-46529 button[type=submit]");
            submitBtns.forEach(function(btn) {
                btn.textContent = "Send Message";
            });
        }
        
        // Apply on DOM ready
        document.addEventListener("DOMContentLoaded", function() {
            applyHeroImages();
            applyButtonColors();
            applySocialIconColors();
            changeSubmitButtonText();
        });
        
        // Also apply after a short delay to catch any late-loading elements
        setTimeout(function() {
            applyHeroImages();
            applyButtonColors();
            applySocialIconColors();
            changeSubmitButtonText();
        }, 1000);
    })();
    </script>';
}
add_action('wp_head', 'tfa_custom_js', 10000);
