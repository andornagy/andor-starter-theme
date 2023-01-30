<?php
$id = get_the_ID();
$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}
?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('posts-item ' . esc_attr($columns)); ?>>
   <?php
   if (has_post_thumbnail() && (!isset($args['no_img']) || !$args['no_img'])) {
      echo '<div class="posts-item__img rectangle-img">';
      the_post_thumbnail();
      echo '</div>';
   }
   ?>
   <div class="posts-item__content">
      <h3 class="posts-item__title">
         <?php the_title(); ?>
      </h3>
      <div class="posts-item__meta margin-bottom-1"><?php the_date(); ?></div>
      <?php echo has_excerpt() ? wpautop(get_the_excerpt()) : wpautop(wp_trim_words(get_the_content(), 24, '...')); ?>
   </div>
</a>