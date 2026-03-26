# Elementor Development — Skill

Treat Elementor as a **rendering engine and structured data system**, not a visual drag-and-drop tool. This unlocks programmatic editing via WP-CLI, PHP, and the REST API — no browser required.

---

## Core Philosophy

Elementor stores everything as structured data in WordPress post meta. To modify it reliably:

1. **Read the data** — `_elementor_data` (page content) and `_elementor_page_settings` (site-wide/kit settings)
2. **Modify the data** — inject CSS, alter widget settings, or regenerate templates via PHP
3. **Write back** — update post meta directly; Elementor re-renders on next page load

Browser control is for **viewing only**. All editing should be done via WP-CLI or PHP scripts.

---

## Key Data Locations

| What | Where |
|------|-------|
| Site-wide CSS (kit) | `_elementor_page_settings` on post ID = active kit (usually ID `52`) |
| Page content | `_elementor_data` on each page/post |
| Kit ID | `wp option get elementor_active_kit` |
| Kit settings key | `_elementor_page_settings` |

---

## Working with Site-Wide CSS (Kit Settings)

### Read current custom CSS
```bash
wp post meta get $KIT_ID _elementor_page_settings --format=json | python3 -c "
import sys, json
d = json.loads(sys.stdin.read())
print(d.get('custom_css', ''))
"
```

### Inject CSS via PHP script
```bash
# 1. Write CSS to /tmp/custom.css on the server
# 2. Write the injector PHP:
cat > /tmp/elementor-css.php << 'EOF'
<?php
require('/path/to/public_html/wp-load.php');
$kit_id = 52; // adjust to actual kit ID
$meta_key = '_elementor_page_settings';
$settings_raw = get_post_meta($kit_id, $meta_key, true);
$settings = $settings_raw ? @unserialize($settings_raw) : array();
if (!is_array($settings)) $settings = array();
$custom_css = trim(file_get_contents('/tmp/custom.css'));
$settings['custom_css'] = $custom_css;
update_post_meta($kit_id, $meta_key, $settings);
echo "Done. " . strlen($custom_css) . " bytes\n";
EOF
# 3. Run it
php /tmp/elementor-css.php
```

---

## Elementor REST API

Elementor Pro exposes endpoints at `/wp-json/elementor/v1/`:

```bash
# Get site settings
curl -s -H "Authorization: Bearer $TOKEN" \
  "https://example.com/wp-json/elementor/v1/site-settings"

# Import template
curl -s -X POST \
  -H "Authorization: Bearer $TOKEN" \
  -F "file=@template.json" \
  "https://example.com/wp-json/elementor/v1/templates/import"
```

For programmatic access, create an application password in WordPress and use it as the Bearer token:
```bash
curl -s -u "user:app_password" \
  "https://example.com/wp-json/elementor/v1/..."
```

---

## Page Data Structure

`_elementor_data` is a JSON array of elements:

```json
[
  {
    "id": "abc123",
    "elType": "section",
    "elements": [...],
    "settings": {
      "layout": "full_width",
      "content_position": "center"
    }
  },
  {
    "id": "def456",
    "elType": "widget",
    "widgetType": "heading",
    "settings": {
      "title": "Hello World",
      "size": "large"
    }
  }
]
```

### Common `elType` values
- `section` — outer container
- `column` — inside sections
- `widget` — individual elements

### Common `widgetType` values
- `heading`, `text-editor`, `image`, `button`, `icon`
- `text-editor`, `image-box`, `icon-list`
- WooCommerce widgets on e-commerce sites

---

## CSS Selector Strategy

Elementor outputs predictable classes. Use specificity-safe selectors:

```css
/* Target a specific widget type globally */
.elementor-widget-heading h2.elementor-heading-title {
  font-family: 'Playfair Display', serif;
}

/* Target a specific page */
.postid-42506 .elementor-button {
  border-radius: 8px;
}

/* Target section by its custom CSS class */
.elementor-section-my-custom-class .elementor-button {
  box-shadow: 0 4px 16px rgba(196,112,59,0.4);
}
```

---

## Manu's Exact Workflow (Reference)

From Manus's explanation of how he works with Elementor programmatically:

### 1. Structural Logic & JSON Mapping
Think in terms of:
- Sections and Columns — outer wrappers and layout properties
- Widgets — specific elements and their unique settings
- Settings Objects — key-value pairs for margins, padding, colors, typography

### 2. Dynamic Content & Shortcodes
Instead of hard-coding content:
- Write custom PHP functions that register new shortcodes
- Inject shortcodes into Elementor widgets so content updates from external data/logic
- Use Elementor's Query Filter hooks to alter post/product display programmatically

### 3. Custom CSS & Control Injection
Use the Custom CSS area of the widget or section. Write precise selectors using the `selector:` keyword to override defaults without CSS specificity wars:

```css
selector {
  .elementor-button {
    border-radius: 6px;
  }
}
```

### 4. Programmatic Template Creation
Generate Elementor Template (JSON) files directly — importable to any WordPress site, instantly recreating layout, styling, and widget configuration.

### 5. The Developer Layer — Beyond Drag-and-Drop
Use the Elementor API:
- **Hooks** (Actions/Filters): Add new controls to existing widgets
- **Custom Widgets**: Write a PHP class to register a brand-new Elementor widget from scratch

### Key Hooks
- `elementor/widgets/register` — register new widgets
- `elementor/controls/register` — register custom controls
- `elementor/dynamic_tags/register` — register dynamic tags
- `elementor_pro/forms/actions/register` — register form actions
- `elementor_pro/forms/fields/register` — register form fields
- `elementor/finder/register` — register finder categories

### JavaScript Frontend Hooks
```javascript
// Action: Runs on every element when ready
elementorFrontend.hooks.addAction('frontend/element_ready/global', function($scope) {
  // $scope is the jQuery-wrapped element
});

// Action: Runs on specific widget type
elementorFrontend.hooks.addAction('frontend/element_ready/heading.default', function($scope) {
  // Customize heading widget behavior
});

// Filter: Modify menu anchor scroll distance
elementorFrontend.hooks.addFilter('frontend/handlers/menu_anchor/scroll_top_distance', function(scrollTop) {
  return scrollTop - 30;
});
```

### Widget Class Structure
```php
class My_Custom_Widget extends \Elementor\Widget_Base {
  public function get_name(): string { return 'my-widget'; }
  public function get_title(): string { return esc_html__('My Widget', 'text-domain'); }
  public function get_icon(): string { return 'eicon-code'; }
  public function get_categories(): array { return [\Elementor\Widget_Base::BASIC]; }
  protected function register_controls(): void {
    $this->start_controls_section('content', ['label' => esc_html__('Content', 'text-domain')]);
    $this->add_control('title', ['label' => esc_html__('Title', 'text-domain'), 'type' => \Elementor\Controls_Manager::TEXT]);
    $this->end_controls_section();
  }
  protected function render(): void {
    $settings = $this->get_settings_for_display();
    echo '<div class="my-widget">' . esc_html($settings['title']) . '</div>';
  }
}
```

### Registering Custom Controls
```php
// In a plugin's main file:
function register_currency_control($controls_manager) {
  require_once(__DIR__ . '/controls/currency.php');
  $controls_manager->register(new \Elementor_Currency_Control());
}
add_action('elementor/controls/register', 'register_currency_control');
```

---

## WP-CLI Commands for Elementor

```bash
# List pages with Elementor data
wp post list --post_type=page --fields=ID,post_title --format=table

# Export kit settings
wp elementor kit export /tmp/kit.zip --include=site-settings

# Check active kit
wp option get elementor_active_kit

# Inspect page data (via PHP eval)
wp eval 'print_r(get_post_meta(YOUR_POST_ID, "_elementor_data", true));'
```

---

## Best Practices

1. **Always work on staging first** — never push CSS changes directly to production
2. **Use specific page IDs in selectors** — `.postid-42506 .elementor-button` beats `.elementor-button`
3. **Put global CSS in kit settings** — gets applied site-wide without touching page templates
4. **Use Elementor's own `selector:` wrapper** in kit CSS — avoids specificity conflicts with Elementor's internal styles
5. **Test with a hard refresh** — `Ctrl+Shift+R` — Elementor's CSS is heavily cached
