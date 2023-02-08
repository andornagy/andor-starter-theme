<?php
$id = get_the_id();
$name = get_the_title($id);

$thumb_url = sqeGetThumbnailURL($id, 'landscape');

?>

<div class="cell small-6 medium-4 large-3">
   <a class="card" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>">
      <!--<div class="card-divider">Heading goes here</div>-->
      <div class="posts-item__img rectangle-img">
         <img src="<?php echo $thumb_url; ?>" alt="<?php echo $name; ?>" />
      </div>
      <div class="card-section">
         <span class="name"><?php echo $name; ?></span>
         <span class="meta years"> <?php echo do_shortcode('[barrister_years]'); ?></span>
      </div>
   </a>
</div>