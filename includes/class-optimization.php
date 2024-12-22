<?php
namespace WP_Header_Customizer;

class Optimization {
    private $options;

    public function __construct() {
        $this->options = get_option('whc_options');
        $this->init_hooks();
    }

    private function init_hooks() {
        if (!empty($this->options['enable_optimization'])) {
            if (!empty($this->options['lazy_load_images'])) {
                add_filter('the_content', array($this, 'add_lazy_loading'));
            }
            
            if (!empty($this->options['minify_html'])) {
                add_action('template_redirect', array($this, 'start_html_minification'));
            }
            
            if (!empty($this->options['defer_js'])) {
                add_filter('script_loader_tag', array($this, 'defer_parsing_of_js'), 10, 3);
            }

            if (!empty($this->options['preload_fonts'])) {
                add_action('wp_head', array($this, 'add_preload_fonts'), 1);
            }

            if (!empty($this->options['remove_emoji_scripts'])) {
                $this->disable_emojis();
            }
        }
    }

    public function add_lazy_loading($content) {
        return preg_replace_callback('/<img([^>]+)>/i', function($matches) {
            if (strpos($matches[1], 'data-src') !== false) {
                return $matches[0];
            }
            
            $img = $matches[0];
            $img = preg_replace('/src=/i', 'data-src=', $img);
            $img = str_replace('<img', '<img loading="lazy"', $img);
            
            return $img;
        }, $content);
    }

    public function start_html_minification() {
        ob_start(array($this, 'minify_html'));
    }

    public function minify_html($buffer) {
        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags
            '/[^\S ]+\</s',     // strip whitespaces before tags
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }

    public function defer_parsing_of_js($tag, $handle, $src) {
        if (is_admin()) {
            return $tag;
        }

        // Add defer attribute
        if (strpos($tag, 'defer') === false) {
            $tag = str_replace(' src', ' defer src', $tag);
        }

        return $tag;
    }

    public function add_preload_fonts() {
        $fonts = array(
            'font-awesome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.woff2',
            'google-fonts' => 'https://fonts.gstatic.com'
        );

        foreach ($fonts as $font) {
            echo '<link rel="preload" href="' . esc_url($font) . '" as="font" type="font/woff2" crossorigin>' . "\n";
        }
    }

    private function disable_emojis() {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }
}