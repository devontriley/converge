<?php get_header(); ?>
    
    <?php include('searchform.php'); ?>
    
		<section id="search-results">
        	<div class="wrapper">

			<?php 
			
			$found = $wp_query->found_posts;
			echo '<p class="results align-center">'. $found . ' results</p>';
			
			if (have_posts()):
			
			$counter = 1;
			$total_counter = 1;
			$total = $wp_query->post_count;
			$type_tracker = '';
			
			while (have_posts()) : the_post();
			
			$type = $post->post_type;
			
			if( $type !== $type_tracker ){
				
				$type_tracker = $type;
				$type_name = get_post_type_object( $type_tracker );
				$type_label = $type_name->label;
				
				if( $total_counter !== 1 ){ echo '</section><!-- .cat_group -->'; }
				
				echo '<section class="cat_group">';
				
				echo '<header class="post-type">'. $type_label .'</header>';
				
				$counter = 1;
				
			}
			
			if( $counter == 1 ){
				
				echo '<div class="row">';
				
			}
			
			?>
            
            	<div class="col-md-3">
                	<div class="inner">
                    	<a href="<?php the_permalink(); ?>" class="cover-link"></a>
                    	<p class="title"><?php the_title(); ?></p>
                    </div>
                </div>
        
        	<?php
			
			if( $counter == 4 || $total_counter == $total ){
			
				echo '</div><!-- .row -->';
				
			}
			
			if( $total_counter == $total ){
				
				echo '</section><!-- .cat_group -->';
				
			}
			
			$counter++;
			$total_counter++;
			
			if( $counter == 5 ){ $counter = 1; }
			
			endwhile;
            
			endif;
			
			?>

			<?php //get_template_part('pagination'); ?>
			
            </div>
		</section>

<?php get_footer(); ?>
