<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();
$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}
$thumb_url = sqeGetThumbnailURL($id, 'landscape');
?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('posts-item ' . esc_attr($columns)); ?>>
   <div class="posts-item__img rectangle-img">
      <img src="<?php echo $thumb_url; ?>" alt="<?php echo $name; ?>" />
   </div>
   <div class="posts-item__content">
      <h3 class="posts-item__title">
         <?php the_title(); ?>
      </h3>
      <div class="posts-item__meta margin-bottom-1"><?php echo get_the_time(get_option('date_format'), $id); ?></div>
      <?php echo has_excerpt() ? wpautop(get_the_excerpt()) : wpautop(wp_trim_words(get_the_content(), 24, '...')); ?>
   </div>
</a>