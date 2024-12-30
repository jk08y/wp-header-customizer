<?php
// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// delete & update options 
delete_option('whc_options');

// Clear any cached data
wp_cache_flush();

// Remove custom tables if they exist
global $wpdb;
$tables = array(
    $wpdb->prefix . 'whc_performance_logs'
);

foreach ($tables as $table) {
    $wpdb->query("DROP TABLE IF EXISTS {$table}");
}

