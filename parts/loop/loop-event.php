<?php
$id = get_the_ID();
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
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('posts-item ' . esc_attr($columns)); ?>>
   <div class="posts-item__img rectangle-img">
      <img src="<?php echo $thumb_url; ?>" alt="<?php echo $name; ?>" />
   </div>
   <div class="posts-item__content">
      <h3 class="posts-item__title">
         <?php the_title(); ?>
      </h3>
      <div class="posts-item__meta margin-bottom-1"><?php echo $event_date . ' ' . $event_time ?></div>
      <?php echo has_excerpt() ? wpautop(get_the_excerpt()) : wpautop(wp_trim_words(get_the_content(), 24, '...')); ?>
   </div>
</a>