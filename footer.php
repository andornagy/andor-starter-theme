<footer class="footer">
   <section class="footer-top">
      <div class=" grid-container">
         <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell medium-2 footer-menu-wrapper">
               <?php
               // Main menu

               if (has_nav_menu('footer-menu')) {
                  wp_nav_menu(array(
                     'theme_location' => 'footer-menu',
                     'items_wrap' => '<ul>%3$s</ul>',
                     'container' => '',
                     'depth' => 1,
                  ));
               }
               ?>
            </div>
            <div class="cell medium-4 footer-contacts-wrapper">
               <h3>Contact</h3>
               <?php get_template_part('parts/components/contact-details') ?>
            </div>
            <div class="cell medium-3 footer-social">
               <h3>Follow us</h3>
               <?php get_template_part('parts/components/socials') ?>
            </div>
            <div class="cell medium-3 footer-signup">

               <?php
               get_template_part('parts/footer/newsletter');
               ?>
            </div>
         </div>
      </div>
   </section>
   <section class="footer-bottom">
      <div class=" grid-container">
         <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell medium-6 footer-copyright">
               <p>Client Name regulated by the <a href="https://barstandardsboard.org.uk">Bar Standards Board.</a></p>
            </div>
            <div class="cell medium-6 footer-credits text-right">
               <p>&copy; Client Name <?php echo date('Y'); ?>. All rights reserved.</p>
               <p><a href="https://squareeye.com/">Websites for barristers</a> by Square Eye.</p>
            </div>
         </div>
      </div>
   </section>
</footer>


</div><!-- off-canvas-content: close (started in header.php) -->
</div><!-- off-canvas-wrapper: close (started in header.php) -->

<?php wp_footer(); ?>

</body>

</html>