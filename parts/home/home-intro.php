<?php
$about = get_field('home_about');
if (isset($about['enable']) && $about['enable']) :
   $img = isset($about['image']) && $about['image'] ? wp_get_attachment_image($about['image'], 'large') : '';
?>
   <section class="section home-about section--gray section-shape--bottom section--big large-padding-bottom-0">
      <div class="grid-container">
         <div class="grid-x grid-margin-x">
            <div class="cell large-padding-bottom-3 large-margin-bottom-2 <?php echo $img ? 'large-5' : ''; ?>">
               <?php if (isset($about['title']) && $about['title']) : ?>
                  <h2 class="separator-left"><?php echo esc_html($about['title']); ?></h2>
               <?php endif; ?>
               <?php if (isset($about['text']) && $about['text']) : ?>
                  <?php echo wpautop(wp_kses_post($about['text'])); ?>
               <?php endif; ?>
            </div>
            <?php if ($img) : ?>
               <div class="cell large-offset-1 large-6 disable-medium">
                  <div class="section__img rectangle-img ie-object-fit">
                     <?php echo $img; ?>
                  </div>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </section>
<?php
endif;
?>