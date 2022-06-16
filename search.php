<?php get_header(); ?>

<?php get_template_part('parts/banners/banner'); ?>


<main class="section grid-container">
	
	<?php get_template_part('parts/page/breadcrumbs'); ?>
        
    <section class="grid-x grid-padding-x grid-padding-y main">
	    
	    <div class="cell small-12 medium-2 large-3">
	        <?php get_sidebar('left'); ?>
        </div>
	    
        <div class="cell small-12 medium-8 large-6 content">
	        
			<?php get_search_form(); ?>
			
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('parts/search-loop/search', $type);
                }
            } else {
                echo '<h2>' . __('No results match that search.', 'squareeye') . '</h2>';
            }
            ?>
            
        </div>
        
        <div class="cell small-12 medium-2 large-3">
	        <?php get_sidebar('right'); ?>
        </div>
        
    </section>   
    
</main>

<?php get_footer(); ?>