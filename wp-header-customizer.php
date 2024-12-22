# File: wp-header-customizer.php
<?php
/**
 * Plugin Name: WP Header Customizer Pro
 * Plugin URI: https://github.com/jk08y/wp-header-customizer
 * Description: Professional WordPress header customization with advanced optimization features
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Kimutai Joel
 * Author URI: https://github.com/jk08y
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-header-customizer
 * Domain Path: /languages
 *
 * @package WP_Header_Customizer
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WHC_VERSION', '1.0.0');
define('WHC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WHC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WHC_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'WP_Header_Customizer\\';
    $base_dir = WHC_PLUGIN_DIR . 'includes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . 'class-' . str_replace('\\', '/', strtolower($relative_class)) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Initialize plugin
require_once WHC_PLUGIN_DIR . 'includes/class-plugin.php';
WP_Header_Customizer\Plugin::get_instance();