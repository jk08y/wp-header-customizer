<div class="wrap whc-admin-wrap">
    <div class="whc-admin-header">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div class="whc-admin-version">
            <?php printf(esc_html__('Version %s', 'wp-header-customizer'), WHC_VERSION); ?>
        </div>
    </div>

    <div class="whc-admin-tabs">
        <div class="whc-admin-tab active" data-target="general">
            <?php esc_html_e('General', 'wp-header-customizer'); ?>
        </div>
        <div class="whc-admin-tab" data-target="optimization">
            <?php esc_html_e('Optimization', 'wp-header-customizer'); ?>
        </div>
        <div class="whc-admin-tab" data-target="custom-css">
            <?php esc_html_e('Custom CSS', 'wp-header-customizer'); ?>
        </div>
    </div>

    <form method="post" action="options.php" id="whc-settings-form">
        <?php
        settings_fields('whc_options');
        do_settings_sections('wp-header-customizer');
        submit_button();
        ?>
    </form>
</div>