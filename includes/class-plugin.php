<?php
namespace WP_Header_Customizer;

class Plugin {
    private static $instance = null;
    private $admin;
    private $public;
    private $optimization;
    private $assets;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->load_dependencies();
        $this->set_locale();
        $this->init_hooks();
    }

    private function load_dependencies() {
        $this->admin = new Admin();
        $this->public = new Public_Frontend();
        $this->optimization = new Optimization();
        $this->assets = new Assets();
    }

    private function set_locale() {
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
    }

    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'wp-header-customizer',
            false,
            dirname(WHC_PLUGIN_BASENAME) . '/languages/'
        );
    }

    private function init_hooks() {
        register_activation_hook(WHC_PLUGIN_BASENAME, array($this, 'activate'));
        register_deactivation_hook(WHC_PLUGIN_BASENAME, array($this, 'deactivate'));
    }

    public function activate() {
        // Set default options
        $default_options = array(
            'hide_admin_bar' => true,
            'theme_color' => '#ffffff',
            'enable_optimization' => true,
            'lazy_load_images' => true,
            'minify_html' => true,
            'defer_js' => true,
            'custom_css' => '',
            'preload_fonts' => true,
            'remove_emoji_scripts' => true
        );
        
        if (!get_option('whc_options')) {
            add_option('whc_options', $default_options);
        }

        // Create custom tables if needed
        $this->create_tables();
        
        // Clear permalinks
        flush_rewrite_rules();
    }

    private function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        // Create tables if needed
    }

    public function deactivate() {
        flush_rewrite_rules();
    }
}