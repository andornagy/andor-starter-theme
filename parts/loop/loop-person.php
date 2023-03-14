<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();
$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}

$thumb_url = sqeGetThumbnailURL($id, 'landscape');
?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>" class="posts-item <?php echo $columns ?>">
   <div class="posts-item__img rectangle-img">
      <img src="<?php echo $thumb_url; ?>" alt="<?php echo get_the_title($id); ?>" />
   </div>
   <h5 class="posts-item__title"><?php the_title(); ?></h5>
   <?php
   echo do_shortcode('[barrister_years class="barrister-years"]');
   ?>
</a>