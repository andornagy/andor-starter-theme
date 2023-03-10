<?php

add_action('init', function () {
    // Add custom intervals here
    //...

    // Launch cron
    if (!wp_next_scheduled('sqe_cron_daily')) {
        wp_schedule_event(time(), 'daily', 'sqe_cron_daily');
    }

    // Hook function
    add_action('sqe_cron_daily', 'sqe_resave_permalinks', 10, 0);

    function sqe_resave_permalinks()
    {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        flush_rewrite_rules(true);
    }
});
