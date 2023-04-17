<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$postType = get_post_type($id);

$articles = ['post', 'publication', 'newsletter'];

$meta = null;
if (in_array($postType, $articles)) {
   $meta = get_the_time(get_option('date_format'), $id);
} elseif ($postType === 'event') {
   $meta = get_field('start_date') ? get_field('start_date') : '';
}

?>
<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title($id); ?>" id="post-<?php the_ID(); ?>" class="cell posts-item__list">
   <div class="posts-item__content">
      <h3 class="posts-item__title">
         <?php echo get_the_title($id); ?>
      </h3>
      <?php echo $meta ? '<span class="posts-item__meta">' .  $meta . '</span>' : ''; ?>
   </div>
</a>