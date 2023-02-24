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

<div <?php post_class('posts-item ' . esc_attr($columns)); ?>>
   <a class="grid-x grid-margin-x grid-padding-y" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>">
      <!--<div class="card-divider">Heading goes here</div>-->
      <div class="cell posts-item__img rectangle-img small-4">
         <img src="<?php echo $thumb_url; ?>" alt="<?php echo $name; ?>" />
      </div>
      <div class="cell small-8">
         <span class="name"><?php echo $name; ?></span>
         <ul>
            <li><i class="fa-solid fa-user"></i><span class="title"> <?php echo $title ?></span></li>

            <li><i class="fa-solid fa-phone"></i><span class="phone"> <?php echo $phone ?></span></li>

            <li><i class="fa-solid fa-envelope"></i></i><span class="email"> <?php echo $email ?></span></li>
         </ul>

      </div>
   </a>
</div>