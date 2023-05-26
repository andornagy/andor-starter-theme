<?php
$id = wp_unique_id('search-input-');
?>
<form method="get" class="search-form" action="<?php echo esc_url(site_url('/')); ?>">
    <div class="input-theme">
        <label for="<?php echo $id; ?>"><?php _e('Search our site', 'squareeye'); ?></label>
        <input placeholder="<?php _e('Enter keywords', 'squareeye'); ?>" id="<?php echo $id; ?>" type="search" name="s" value="<?php echo isset($_GET['s']) && $_GET['s'] ? $_GET['s'] : ''; ?>">
    </div>
</form>
