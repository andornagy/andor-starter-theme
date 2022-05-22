<?php
$page_id = get_the_ID();

if (is_home())  $page_id = get_option('page_for_posts', true);

$title = '';

if (isset($args['title']) && $args['title']) {
    $title = $args['title'];
} else {
    if (is_home()) {
        $title = get_the_title(get_option('page_for_posts', true));
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }
}
?>
<div class="section">
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell">
                <h1>
                    <?php
                    echo esc_html($title);
                    ?>
                </h1>
            </div>
        </div>
    </div>
</div>