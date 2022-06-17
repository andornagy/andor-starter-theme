<?php
	
	if( have_rows('boxes') ): ?>
	
	<section class="grid-container featured-boxes">
		<div class="grid-x grid-padding-x grid-padding-y">
			
			<?php
		
		    while( have_rows('boxes') ) : the_row();
	
		        $heading = get_sub_field('heading');
		        $image = get_sub_field('image');
		        $text = get_sub_field('text');
		        $internal_link = get_sub_field('internal_link');
		        $external_link = get_sub_field('external_link');
		        
		    ?>
		    
		    <div class="cell medium-4">
		    <div class="card">
			  <div class="card-divider">
			    Tags go here
			  </div>
			  <?php 
				  if ($image) { echo '<img src="'.$image['sizes']['medium'].'" alt="'.$heading.'" />'; }
			  ?>
			  <div class="card-section">
			    <h4><?php echo $heading; ?></h4>
			    <?php echo wpautop($text); ?>
			  </div>
			</div>
		    </div>
		    
		    <?php endwhile; ?>
		    
		</div>
	</section>
	
	<?php endif; ?>