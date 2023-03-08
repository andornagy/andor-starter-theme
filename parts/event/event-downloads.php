<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$downloads = get_field('downloads', $id);

?>
<div class="cell event__downloads">
   <?php if ($downloads) {
      echo '<h2>Downloads</h2>';

      echo '<ul>';
      foreach ($downloads as $download) {

         echo '<li><a href="'  . $download['file']['url'] .  '">' . $download['file']['filename'] . '</a></li>';
      }
      echo '</ul>';
   } ?>
</div>