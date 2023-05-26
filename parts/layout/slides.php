<?php
$id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();

$slides = get_field('slides', $id);

if (!empty($slides)) {

?>
   <section class="section home-featured section--gray section-shape--bottom section-shape--top section--big large-padding-top-0">
      <div class="orbit orbit--dark" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">
         <div class="orbit-wrapper">
            <ul class="orbit-container">
               <?php



               foreach ($slides as $i => $slide) {
                  // echo '<pre>';
                  // var_dump($slide);
                  // echo '</pre>';


                  $title = $slide['title'];
                  $subTitle = $slide['subtitle'];
                  $text = $slide['text'];
                  $img_id = $slide['image'];
                  $img = isset($img_id) && $img_id ? wp_get_attachment_image($img_id, 'large') : '';
                  $btn_label = $slide['button_label'];
                  $btn_link = $slide['button_link'];

                  if (!$title || !$img || !$text) continue;

                  $active_class = !$i ? 'is-active' : '';

                  echo '<li class="orbit-slide ' . esc_attr($active_class) . '">';
               ?>
                  <div class="grid-container">
                     <div class="grid-x grid-margin-x">
                        <div class="cell large-6">
                           <div class="section__img ie-object-fit medium-semi-square-img">
                              <?php echo $img; ?>
                           </div>
                        </div>
                        <div class="cell padding-top-3 large-margin-top-3 large-margin-bottom-3 large-padding-bottom-1 large-offset-1 large-5">
                           <h2 class="separator-left large-padding-top-1"><?php echo esc_html($title); ?></h2>
                           <div class="margin-bottom-2">
                              <?php echo wpautop(wp_kses_post($text)); ?>
                           </div>
                           <?php
                           if (isset($btn_label) && $btn_label && isset($btn_link) && $btn_link) {
                              echo '<a href="' . get_permalink($btn_link) . '" class="button primary smooth-scroll">' . esc_html($btn_label) . '</a>';
                           }
                           ?>
                        </div>
                     </div>
                  </div>
               <?php
                  echo '</li>';
               }
               ?>
            </ul>
            <?php
            if (count($slides) > 1) {
            ?>
               <div class="grid-container home-featured__bullets">
                  <div class="grid-x grid-margin-x">
                     <div class="cell large-5 large-offset-7">
                        <nav class="orbit-bullets">
                           <?php
                           foreach ($slides as $i => $slide) {
                              $active_class = !$i ? 'is-active' : '';
                              echo '<button class="' . esc_attr($active_class) . '" data-slide="' . esc_attr($i) . '"></button>';
                           }
                           ?>
                        </nav>
                     </div>
                  </div>
               </div>
            <?php
            }
            ?>
         </div>
      </div>
   </section>
<?php
}
