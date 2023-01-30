<?php

$id = get_the_id();
$sitename = get_bloginfo('name');
$twitter = get_field('twitter', 'option');

$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (function_exists('YoastSEO')) {
   $title = YoastSEO()->meta->for_post($id)->title;
} else {
   $title = get_the_title() . ' | ' . $sitename;
}

$title = urlencode($title);
$sitename = urlencode($sitename);

$share_disabled = get_field('disable_share');
if (!$share_disabled) {

?>


   <section class="share-wrapper">
      <h2>Share this</h2>
      <ul class="menu share">
         <li><a target="_blank" class="share-button share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo $postUrl; ?>&text=<?php echo the_title(); ?>&via=<?php echo $twitter; ?>" title="Tweet this"><i class="fa-brands fa-twitter-square"></i></a></li>
         <li><a target="_blank" class="share-button share-linkedin" href="https://linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>&source=<?php echo $sitename; ?>" title="Share on LinkedIn"><i class="fa-brands fa-linkedin"></i></a></li>
      </ul>
   </section>

<?php } ?>