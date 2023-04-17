<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();
$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}
$thumb_url = sqeGetThumbnailURL($id, 'landscape');
?>

<div <?php post_class('posts-item ' . esc_attr($columns)); ?>>
   <a class="card" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>">
      <!--<div class="card-divider">Heading goes here</div>-->
      <div class="posts-item__img rectangle-img">
         <img src="<?php echo $thumb_url; ?>" alt="<?php echo get_the_title($id); ?>" />
      </div>
      <div class="card-section">
         <span class="name"><?php echo $name; ?></span>
         <span class="meta years"> <?php echo get_field('job_title', $id) ?></span>
      </div>
   </a>
</div>