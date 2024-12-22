<?php
namespace WP_Header_Customizer;

class Public_Frontend {
    private $options;

    public function __construct() {
        $this->options = get_option('whc_options');
        $this->init_hooks();
    }

    private function init_hooks() {
        if (!empty($this->options['hide_admin_bar'])) {
            add_filter('show_admin_bar', '__return_false');
        }

        add_action('wp_head', array($this, 'add_meta_tags'));
        add_action('wp_head', array($this, 'add_custom_css'));
        add_action('wp_footer', array($this, 'add_custom_footer_scripts'));
    }

    public function add_meta_tags() {
        if (!empty($this->options['theme_color'])) {
            echo '<meta name="theme-color" content="' . esc_attr($this->options['theme_color']) . '">' . "\n";
            echo '<meta name="apple-mobile-web-app-status-bar-style" content="' . esc_attr($this->options['theme_color']) . '">' . "\n";
            
            // Add Open Graph meta tags
            echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
            echo '<meta property="og:type" content="website">' . "\n";
        }
    }

    public function add_custom_css() {
        if (!empty($this->options['custom_css'])) {
            echo '<style type="text/css">' . "\n";
            echo wp_strip_all_tags($this->options['custom_css']) . "\n";
            echo '</style>' . "\n";
        }
    }

    public function add_custom_footer_scripts() {
        if (!empty($this->options['custom_footer_scripts'])) {
            echo wp_kses($this->options['custom_footer_scripts'], array(
                'script' => array(
                    'type' => array(),
                    'src' => array(),
                    'async' => array(),
                    'defer' => array()
                )
            ));
        }
    }
}
