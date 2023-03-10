<?php get_header(); ?>

<?php get_template_part('parts/banners/banner'); ?>

<main class="section grid-container">
	
	<?php get_template_part('parts/page/breadcrumbs'); ?>
        
    <section class="grid-x grid-padding-x grid-padding-y main">
	    
	    <div class="cell small-12 medium-2 large-3">
	        <?php get_sidebar('left'); ?>
        </div>
	    
        <div class="cell small-12 medium-8 large-6 content">
	        
	        <?php the_post_thumbnail('landscape'); ?>
	        
            <?php the_content(); ?>
            
            <?php get_template_part('/parts/layout/accordion'); ?> 
            
            <?php get_template_part('/parts/layout/share'); ?>
            
            <?php get_template_part('parts/layout/cta'); ?>
            
        </div>
        
        <div class="cell small-12 medium-2 large-3">
	        <?php get_sidebar('right'); ?>
        </div>
        
    </section>   
    
</main>

<?php get_footer(); ?>