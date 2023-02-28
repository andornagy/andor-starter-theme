<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();
$name = get_the_title($id);
$title = get_field('job_title', $id) ? get_field('job_title', $id) : '';
$phone = get_field('phone', $id) ? get_field('phone', $id) : '';
$email = get_field('email', $id) ? get_field('email', $id) : '';


$columns = 'cell large-4 medium-6';
if (isset($args['columns'])) {
   $columns = getColumns($args['columns'], $columns); // see helpers.php
}

$thumb_url = sqeGetThumbnailURL($id, 'square');

?>

<div <?php post_class('posts-item posts-item__related grid-x grid-margin-x grid-padding-y ' . esc_attr($columns)); ?>>
   <div class="cell small-4">
      <a class="posts-item__img square-img" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>">
         <img src="<?php echo $thumb_url; ?>" alt="<?php echo $name; ?>" />
      </a>
   </div>
   <div class="cell small-8">
      <a class="" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>"><span class="posts-item__name"><?php echo $name; ?></span></a>
      <ul>
         <li class="posts-item__job-title"><i class="fa-solid fa-user"></i><?php echo $title ?></li>
         <li class="posts-item__phone"><i class="fa-solid fa-phone"></i><?php echo $phone ?></li>
         <li class="posts-item__email"><i class="fa-solid fa-envelope"></i></i><?php echo $email ?></li>
      </ul>
   </div>
</div>