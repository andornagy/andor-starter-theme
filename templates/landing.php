<?php
/*
* Template name: Landing page
*/
get_header();

get_template_part('parts/banners/banner');
?>

<main class="section grid-container-narrow main">
    <div class="grid-x grid-margin-x grid-padding-y">
     	<div class="cell">
	     	
	        <h1><?php the_title(); ?></h1>
	        
	        <?php get_template_part('parts/layout/breadcrumbs'); ?>
	        
            <?php the_content(); ?>
            
            <?php get_template_part('parts/layout/featured-boxes'); ?>        
            
        </div>
    </div>
</main>

<?php get_footer(); ?>