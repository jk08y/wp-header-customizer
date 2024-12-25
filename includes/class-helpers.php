<?php
namespace WP_Header_Customizer;

class Helpers {
    public static function get_plugin_info() {
        if (!function_exists('get_plugin_data')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        return get_plugin_data(WHC_PLUGIN_DIR . 'wp-header-customizer.php');
    }

    public static function sanitize_css($css) {
        // Remove potentially harmful content
        $css = wp_strip_all_tags($css);
        
        if (strpos($css, '{') === false || strpos($css, '}') === false) {
            return '';
        }
        
        return $css;
    }

    public static function get_system_info() {
        global $wpdb;
        
        $info = array(
            'php_version' => phpversion(),
            'wp_version' => get_bloginfo('version'),
            'wp_memory_limit' => WP_MEMORY_LIMIT,
            'wp_debug' => defined('WP_DEBUG') && WP_DEBUG,
            'mysql_version' => $wpdb->db_version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        );
        
        return $info;
    }
}
