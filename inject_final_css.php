<?php
// Inject critical CSS directly into Elementor page settings via MySQL
$mysqli = new mysqli('127.0.0.1', 'uw7wam3vp6ghx', trim(file_get_contents('/home/customer/tmp/mysql.txt')), 'dbfjyffxpyejpa');
if ($mysqli->connect_errno) {
    die('Conn failed: ' . $mysqli->connect_error);
}
echo "Connected\n";

// Critical CSS to inject - covers ALL known issues
$critical_css = '
/* FORCE SOCIAL ICONS - Orange circles with white icons */
body .elementor-social-icon,
.elementor-widget-social-icons .elementor-social-icon,
footer .elementor-social-icon,
header .elementor-social-icon {
    background-color: #C4703B !important;
    background: #C4703B !important;
    opacity: 1 !important;
    width: 42px !important;
    height: 42px !important;
    min-width: 42px !important;
    min-height: 42px !important;
    border-radius: 50% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
body .elementor-social-icon i,
.elementor-social-icon i:before,
body .elementor-social-icon svg,
.elementor-social-icon svg {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
    width: 20px !important;
    height: 20px !important;
    font-size: 20px !important;
}
body .elementor-social-icon:hover {
    background-color: #1C1108 !important;
    transform: scale(1.1) !important;
}
/* CMSMasters Header Social Icons */
.cmsmasters-header-mid-social .cmsmasters-social-icon,
.cmsmasters-header-top-social .cmsmasters-social-icon {
    background-color: #C4703B !important;
    opacity: 1 !important;
    width: 42px !important;
    height: 42px !important;
    border-radius: 50% !important;
    color: #FFFFFF !important;
}
/* CMSMasters social icon inner elements */
.cmsmasters-header-mid-social__item-icon,
.cmsmasters-header-top-social__item-icon {
    background-color: #C4703B !important;
    color: #FFFFFF !important;
    opacity: 1 !important;
}
.cmsmasters-header-mid-social__item-icon i,
.cmsmasters-header-top-social__item-icon i,
.cmsmasters-header-mid-social__item-icon svg,
.cmsmasters-header-top-social__item-icon svg {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
}
/* Contact form submit button - Send Message */
form.elementor-form button[type="submit"] {
    background-color: #C4703B !important;
    background: #C4703B !important;
    color: #FFFFFF !important;
    min-height: 52px !important;
    padding: 14px 40px !important;
    font-weight: 700 !important;
    border-radius: 8px !important;
    border: none !important;
    font-size: 1rem !important;
    width: 100% !important;
    display: block !important;
    text-align: center !important;
}
/* Remove green borders site-wide */
*, *::before, *::after {
    border-color: #C4703B !important;
}
/* Header nav link colors */
.elementor-nav-menu a,
nav a,
header a {
    color: #1C1108 !important;
}
.elementor-nav-menu a:hover,
nav a:hover,
header a:hover {
    color: #C4703B !important;
}
/* Active nav - orange underline */
.cmsmasters-header-mid .cmsmasters-menu__list > li.current-menu-item > a span.cmsmasters-menu__item,
.elementor-nav-menu .current-menu-item > a,
nav .current-menu-item > a,
header .current-menu-item > a {
    color: #C4703B !important;
    border-bottom: 3px solid #C4703B !important;
}
/* Header white background */
#cmsmasters-scroll-top {
    background-color: #FFFFFF !important;
}
';

$kit_id = 52;

// Get current meta
$stmt = $mysqli->prepare("SELECT meta_value FROM tnf_postmeta WHERE post_id = ? AND meta_key = '_elementor_page_settings'");
$stmt->bind_param('i', $kit_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if ($row) {
    $meta = @unserialize($row['meta_value']);
    if (!is_array($meta)) $meta = array();
    echo "Existing meta found, custom_css bytes: " . (isset($meta['custom_css']) ? strlen($meta['custom_css']) : 0) . "\n";
} else {
    $meta = array();
    echo "No existing meta, creating new\n";
}

// Append our critical CSS to existing custom_css
if (isset($meta['custom_css']) && !empty($meta['custom_css'])) {
    $meta['custom_css'] .= "\n" . $critical_css;
} else {
    $meta['custom_css'] = $critical_css;
}

$serialized = serialize($meta);

// Update or insert
$stmt = $mysqli->prepare("UPDATE tnf_postmeta SET meta_value = ? WHERE post_id = ? AND meta_key = '_elementor_page_settings'");
$stmt->bind_param('si', $serialized, $kit_id);
$stmt->execute();
if ($stmt->affected_rows === 0) {
    $stmt->close();
    $stmt = $mysqli->prepare("INSERT INTO tnf_postmeta (post_id, meta_key, meta_value) VALUES (?, '_elementor_page_settings', ?)");
    $stmt->bind_param('is', $kit_id, $serialized);
    $stmt->execute();
    echo "Inserted new meta row\n";
} else {
    echo "Updated existing meta row (" . strlen($serialized) . " bytes)\n";
}
$stmt->close();

// Clear Elementor CSS cache files
$css_dir = '/home/customer/www/ernien.sg-host.com/public_html/wp-content/uploads/elementor/css';
if (is_dir($css_dir)) {
    $files = glob("$css_dir/post-52*.css");
    foreach ($files as $f) {
        if (unlink($f)) echo "Deleted cache: $f\n";
    }
}

// Also trigger OPcache clear
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache reset\n";
}

$mysqli->close();
echo "Done! Critical CSS injected into Elementor kit.\n";
