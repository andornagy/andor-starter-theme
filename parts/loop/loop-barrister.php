<?php
$id = get_the_id();
$name = get_the_title($id);

$fallbackimg = get_field('barrister_fallback');
if ($fallbackimg) {
   $fallbackimgurl = $fallbackimg['sizes']['square'];
} else {
   $fallbackimgurl = 'https://via.placeholder.com/600x533/CCC?text=?';
}

$imgurl = get_the_post_thumbnail_url($id, 'square');
if (!$imgurl) {
   $imgurl = $fallbackimgurl;
}

?>

<div class="cell small-6 medium-4 large-3">
   <a class="card" href="<?php echo get_the_permalink($id); ?>" title="<?php echo $name; ?>">
      <!--<div class="card-divider">Heading goes here</div>-->
      <img src="<?php echo $imgurl; ?>" alt="<?php echo $name; ?>" />
      <div class="card-section">
         <span class="name"><?php echo $name; ?></span>
         <span class="meta years"> <?php echo do_shortcode('[barrister_years]'); ?></span>
      </div>
   </a>
</div>