# WordPress Header Customizer

A WordPress plugin for customizing header elements, optimizing performance, and enhancing your website's appearance.

## Description

WordPress Header Customizer is a powerful plugin that allows you to:
- Hide the WordPress admin bar
- Add meta color headers for browser themes
- Optimize website performance
- Add custom CSS
- Implement lazy loading for images
- Minify HTML output
- Defer JavaScript loading
- Manage font preloading
- Remove unnecessary emoji scripts

## Features

### Header Customization
- Toggle admin bar visibility
- Customize theme colors for browsers
- Add custom meta tags
- Manage Open Graph meta data

### Performance Optimization
- Image lazy loading
- HTML minification
- JavaScript optimization
- Font preloading
- Emoji script removal
- Resource hints optimization

### Developer Features
- Clean, object-oriented code
- WordPress coding standards compliant
- Extensible architecture
- Translation ready
- Comprehensive hooks and filters

## Requirements

- WordPress 5.2 or higher
- PHP 7.2 or higher
- Modern web browser

## Installation

1. Download the plugin
2. Upload the `wp-header-customizer` directory to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Configure the plugin settings under 'Header Customizer' in your WordPress admin panel

## Usage

### Basic Configuration

1. Navigate to 'Header Customizer' in your WordPress admin menu
2. Configure your desired settings:
   - Toggle admin bar visibility
   - Set theme colors
   - Enable/disable optimization features
   - Add custom CSS
3. Save your changes

### Advanced Usage

```php
// Filter to modify theme color
add_filter('whc_theme_color', function($color) {
    return '#your-color-hex';
});

// Action before optimization
add_action('whc_before_optimization', function() {
    // Your custom code
});
```

## File Structure

```
wp-header-customizer/
├── assets/                  # Frontend assets
│   ├── css/                # Stylesheet files
│   │   ├── admin.css      # Admin interface styles
│   │   └── public.css     # Public-facing styles
│   ├── js/                 # JavaScript files
│   │   ├── admin.js       # Admin interface scripts
│   │   └── public.js      # Public-facing scripts
│   └── images/            # Image assets
│       └── icon.svg       # Plugin icon
├── includes/              # PHP classes
│   ├── class-admin.php    # Admin functionality
│   ├── class-public.php   # Public functionality
│   ├── class-optimization.php # Optimization features
│   ├── class-assets.php   # Asset management
│   └── class-helpers.php  # Helper functions
├── languages/            # Translation files
│   └── wp-header-customizer.pot # Translation template
├── templates/            # Template files
│   └── admin/           # Admin templates
│       └── settings-page.php # Settings page template
├── index.php            # Directory protection
├── uninstall.php        # Cleanup on uninstall
└── wp-header-customizer.php # Main plugin file
```

## Hooks and Filters

### Actions
- `whc_before_optimization`: Fires before optimization processes
- `whc_after_optimization`: Fires after optimization processes
- `whc_settings_saved`: Fires after settings are saved

### Filters
- `whc_theme_color`: Modify the theme color
- `whc_optimization_options`: Modify optimization settings
- `whc_custom_css`: Filter custom CSS before output

## Frequently Asked Questions

### Will this plugin slow down my website?
No, the plugin is designed with performance in mind. The optimization features actually help improve your website's performance.

### Is this plugin compatible with my theme?
The plugin is designed to work with any WordPress theme that follows WordPress coding standards.

### Can I customize the optimization settings?
Yes, all optimization features can be enabled or disabled individually through the plugin settings.

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## License

This plugin is licensed under the GPL v2 or later.

## Author

Kimutai Joel
- GitHub: [JK](https://github.com/jk08y)

## Changelog

### 1.0.0
- Initial release
- Added admin bar visibility control
- Added theme color customization
- Added performance optimization features
- Added custom CSS management
- Added translation support

## Support

For support, please create an issue in the GitHub repository or contact the author.

## Acknowledgments

Thanks to all contributors and the WordPress community for inspiration and support.