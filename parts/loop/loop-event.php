<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();
$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}

$thumb_url = sqeGetThumbnailURL($id, 'landscape');

$start_date = get_field('start_date', get_the_ID());
$event_date = sqe_date_format($start_date);

$start_time = get_field('start_time', get_the_ID());
$event_time = sqe_time_format($start_time);
?>
<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title($id); ?>" <?php post_class('posts-item ' . esc_attr($columns)); ?>>
   <div class="posts-item__img rectangle-img">
      <img src="<?php echo $thumb_url; ?>" alt="<?php echo get_the_title($id); ?>" />
   </div>
   <div class="posts-item__content">
      <h3 class="posts-item__title">
         <?php echo get_the_title($id); ?>
      </h3>
      <div class="posts-item__meta margin-bottom-1">Date: <?php echo $event_date . ' ' . $event_time ?></div>
      <?php echo has_excerpt($id) ? wpautop(get_the_excerpt($id)) : wpautop(wp_trim_words(get_the_content(), 24, '...')); ?>
   </div>
</a>