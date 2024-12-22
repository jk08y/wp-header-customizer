<?php
namespace WP_Header_Customizer;

class Assets {
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_public_assets'));
    }

    public function enqueue_admin_assets($hook) {
        if ('toplevel_page_wp-header-customizer' !== $hook) {
            return;
        }

        wp_enqueue_style(
            'whc-admin-style',
            WHC_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            WHC_VERSION
        );

        wp_enqueue_script(
            'whc-admin-script',
            WHC_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery', 'wp-color-picker'),
            WHC_VERSION,
            true
        );

        wp_localize_script('whc-admin-script', 'whcAdmin', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('whc_nonce'),
            'strings' => array(
                'saveSuccess' => __('Settings saved successfully!', 'wp-header-customizer'),
                'saveError' => __('Error saving settings.', 'wp-header-customizer')
            )
        ));

        wp_enqueue_style('wp-color-picker');
    }

    public function enqueue_public_assets() {
        wp_enqueue_style(
            'whc-public-style',
            WHC_PLUGIN_URL . 'assets/css/public.css',
            array(),
            WHC_VERSION
        );

        if (!empty(get_option('whc_options')['enable_optimization'])) {
            wp_enqueue_script(
                'whc-public-script',
                WHC_PLUGIN_URL . 'assets/js/public.js',
                array(),
                WHC_VERSION,
                true
            );
        }
    }
}