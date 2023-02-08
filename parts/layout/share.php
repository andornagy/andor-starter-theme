<?php

$id = get_the_id();
$hideshare = get_field('hide_share_buttons');
$postUrl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

if (!$hideshare == 'Yes') { ?>

   <section class="share-wrapper">
      <h2>Share this</h2>
      <ul class="menu share">
         <li><a target="_blank" class="share-button share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo $postUrl; ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta('twitter'); ?>" title="Tweet this"><?php echo getIcon('twitter'); ?></a></li>
         <li><a target="_blank" class="share-button share-linkedin" href="https://linkedin.com/shareArticle?mini=true&url=<?php echo $postUrl; ?>&title=<?php echo $title; ?>&source=<?php echo $sitename; ?>" title="Share on LinkedIn"><?php echo getIcon('linkedin'); ?></a></li>
      </ul>
   </section>

<?php } ?>