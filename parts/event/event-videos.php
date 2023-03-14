<?php
$id = get_the_ID();

$videos = get_field('videos', $id);
?>

<div class="cell video">
   <?php
   if ($videos) {

      echo '<h2>Watch the video</h2>';

      foreach ($videos as $video) {
         echo '<p>' . esc_html($video['video_text']) . '</p>';
         echo $video['video_embed'];
      }
   }
   ?>
</div>