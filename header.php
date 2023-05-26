<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   <?php do_action('wp_body_open') ?>
   <!-- off-canvas-wrapper: start (ends in footer.php) -->
   <div class="off-canvas-wrapper">
      <div class="off-canvas position-left" id="offCanvas" data-off-canvas>
         <button class="close-button" aria-label="<?php _e('Close menu', 'squareeye'); ?>" type="button" data-close>
            <span aria-hidden="true">&times;</span>
         </button>
         <nav class="nav nav--mobile margin-bottom-2">
            <?php
            wp_nav_menu(array(
               'theme_location' => 'main-menu',
               'items_wrap' => '<ul class="vertical menu drilldown" data-drilldown data-parent-link=true data-close-on-click=true data-auto-height=true data-animate-height=true>%3$s</ul>',
               'container' => '',
               'depth' => 2,
               'walker' => new Mobile_Menu_Walker()
            ));
            ?>
         </nav>
         <?php get_search_form(); ?>
      </div>
      <!-- off-canvas-content: start (end in footer.php) -->
      <div class="off-canvas-content" data-off-canvas-content>
         <div class="header__wrapper" data-sticky-container>
            <header class="header sticky" data-sticky data-margin-top="0" data-sticky-on="large" data-subnav="closed">
               <div class="header__inner">
                  <div class="grid-container">
                     <div class="grid-x">
                        <div class="cell header__logo small-6 large-3 flex-container align-middle">
                           <a id="logo" href="<?php echo site_url('/'); ?>" title="<?php echo get_bloginfo('name'); ?>">
                              <?php echo do_shortcode('[site_logo]'); ?>
                           </a>
                        </div>
                        <div class="cell header__nav small-6 large-9 text-right">
                           <div class="nav--desktop show-for-large">
                              <nav class="nav nav--main flex-container align-middle align-right">
                                 <?php
                                 // Main menu
                                 wp_nav_menu(array(
                                    'theme_location' => 'main-menu',
                                    'items_wrap' => '<ul class="menu align-right">%3$s</ul>',
                                    'container' => '',
                                    'depth' => 2,
                                    'walker' => new Desktop_Menu_Walker()
                                 ));
                                 ?>
                                 <div class="nav-search">
                                    <a href="<?php echo esc_url(site_url('/?s=')); ?>" aria-label="<?php _e('Open search', 'squareeye'); ?>" title="<?php _e('Search', 'squareeye'); ?>" class="nav-search__icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    <div class="sub-menu" id="header-search">
                                       <div class="sub-menu__arrow"></div>
                                       <div class="grid-container padding-vertical-2">
                                          <div class="grid-x">
                                             <div class="cell large-8 large-offset-2 search--light">
                                                <?php get_search_form(); ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </nav>
                           </div>
                           <button class="nav__burger hide-for-large" data-toggle="offCanvas">
                              <span class="show-for-sr"><?php _e('Open menu', 'squareeye'); ?></span>
                              <span class="nav__burger--1"></span>
                              <span class="nav__burger--2"></span>
                              <span class="nav__burger--3"></span>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </header>
         </div>