<?php

$id = get_the_ID();

$related_barristers = get_post_meta($id, 'related_barristers');

if ($related_barristers) { ?>
   <div class="cell event__barristers">
      <h2>Related barristers</h2>
      <div class="related-items">
         <?php foreach ($related_barristers as $related_barrister) {
            if (isset($related_barrister)) {
               $args = array(
                  'id' => $related_barrister['ID'],
                  'columns' => 3
               );
               get_template_part('parts/related-loop/related', 'barrister', $args);
            }
         } ?>
      </div>
   </div>
<?php } ?>