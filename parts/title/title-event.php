<?php
$id = get_the_ID();

$title = null;
if (isset($args['title']) && $args['title']) {
   $title = $args['title'];
} else {
   $title = get_the_title();
}


?>

<section class="section banner banner__event">
   <div class="grid-container">
      <div class="grid-x grid-padding-x grid-padding-y">
         <div class="cell title">
            <h1><?php echo esc_html($title); ?></h1>
         </div>

      </div>
   </div>
</section>