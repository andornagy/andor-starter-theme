<?php

$id = get_the_id();
$sitename = get_bloginfo('name');
$hideshare = get_field('hide_share_buttons');

$title = get_the_title($id);
$postUrl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

if (!$hideshare == 'Yes') { ?>

   <section class="share-wrapper">
      <h2>Share this</h2>
      <ul class="menu share">
         <li><a target="_blank" class="share-button share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo $postUrl; ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta('twitter'); ?>" title="Tweet this"><i class="fa-brands fa-twitter"></i></a></li>
         <li><a target="_blank" class="share-button share-linkedin" href="https://linkedin.com/shareArticle?mini=true&url=<?php echo $postUrl; ?>&title=<?php echo $title; ?>&source=<?php echo $sitename; ?>" title="Share on LinkedIn"><i class="fa-brands fa-linkedin"></i></a></li>
         <li><a target="_blank" class="share-button share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" title="Share on facebook"><i class="fa-brands fa-facebook"></i></a></li>
      </ul>
   </section>

<?php } ?>