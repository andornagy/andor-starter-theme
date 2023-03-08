<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$callyear = get_field('call_year', $id);
$silkyear = get_field('silk_year', $id);

$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}

$thumb_url = sqeGetThumbnailURL($id, 'square');

?>

<div <?php post_class('posts-item posts-item__related grid-x grid-margin-x grid-padding-y ' . esc_attr($columns)); ?>>
   <div class="cell small-4">
      <a class="posts-item__img square-img" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>">
         <img src="<?php echo $thumb_url; ?>" alt="<?php echo get_the_title($id); ?>" />
      </a>
   </div>
   <div class="cell small-8">
      <h3><a class="" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>"><span class="posts-item__name"><?php echo $name; ?></span></a></h3>
      <span class="meta years">
         <?php
         echo $callyear ? 'Call:' . $callyear : '';
         echo $silkyear ? ' | Silk: ' . $silkyear : '';
         ?>
      </span>
   </div>
</div>