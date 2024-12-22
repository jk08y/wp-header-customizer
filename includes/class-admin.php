<?php
namespace WP_Header_Customizer;

class Admin {
    private $options;

    public function __construct() {
        $this->options = get_option('whc_options');
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_filter('plugin_action_links_' . WHC_PLUGIN_BASENAME, array($this, 'add_action_links'));
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Header Customizer', 'wp-header-customizer'),
            __('Header Customizer', 'wp-header-customizer'),
            'manage_options',
            'wp-header-customizer',
            array($this, 'render_settings_page'),
            'dashicons-admin-customizer'
        );
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        require_once WHC_PLUGIN_DIR . 'templates/admin/settings-page.php';
    }
}