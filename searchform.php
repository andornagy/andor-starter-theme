<form method="get" class="search-form" action="<?php echo esc_url(site_url('/')); ?>">
    <div class="input-theme">
        <label for="s"><?php _e('Search our site', 'squareeye'); ?></label>
        <input placeholder="<?php _e('Click Enter to proceed', 'squareeue'); ?>" id="s" type="search" name="s" value="<?php echo isset($_GET['s']) && $_GET['s'] ? $_GET['s'] : ''; ?>">
    </div>
</form>