<?php

$args = array(
	'post_type' => 'team_members',
	'posts_per_page' => -1,
    'orderby' => 'menu_order',
	'order' => 'ASC'
);

$the_query = new WP_Query( $args );

if( $the_query->have_posts() ) :

	$counter = 1;
	$total_counter = 1;
	$total = $the_query->post_count;
	
?>
	
	<section id="team-grid">
		<div class="wrapper">
    		<div class="inner">
                <header>
                	<p>Our Team</p>
                </header>
                    
                <?php
                
                    while( $the_query->have_posts() ) : $the_query->the_post();
					
					$no_internal = get_field('no_internal_page');
					
					$id = get_field('thumbnail');
					$full = wp_get_attachment_image_src( $id, 'full' );
					$med = wp_get_attachment_image_src( $id, 'medium' );
					$srcset = wp_get_attachment_image_srcset( $id, 'full' );
                    
                    if( $counter == 1 ){
                    
                        echo '<div class="row">';
                        
                    }
                    
                ?>
                
                    <div class="col-md-4">
                        <div class="inner">
                            <div class="content">
                            	<div class="headshot">
                            	<?php if($no_internal){ ?>
                                    	<img src="<?php echo $med[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 33vw, 100vw" />
                                    <?php } else { ?>
                                    	<a href="<?php the_permalink(); ?>"><img src="<?php echo $med[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 33vw, 100vw" /></a>
                                    <?php } ?>
                                </div>
                                <div class="text">
                                	<a href="<?php echo get_field('linkedin'); ?>" class="linkedin" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Linkedin@2x.png" width="22px" /></a>
                                    <?php if($no_internal){?>
                                    	<h3><?php the_title(); ?></h3>
                                    <?php } else { ?>
                                    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php } ?>
                                    <p><?php the_field('title'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php
                
                    if( $counter == 3 || $total_counter == $total ){
                        
                        echo '</div>';
                        
                    }
                
                    $counter++;
                    $total_counter++;
                    
                    if( $counter == 4 ){ $counter = 1; }
                
                    endwhile;
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</section>';
                    
                endif;
                
                ?>