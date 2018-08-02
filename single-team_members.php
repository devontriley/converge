<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php
	$id = get_field('headshot');
	$full = wp_get_attachment_image_src( $id, 'full' );
	$sm = wp_get_attachment_image_src( $id, 'small' );
	$srcset = wp_get_attachment_image_srcset( $id, 'full' );
	?>

    <section id="team-member-banner" style="background-image: url(<?php echo $temp_dir ?>/img/home/Entrepreneur_1_Background@2x.png);">
    	<div class="wrapper">
        	<div class="inner">
            	<div class="row">
                    <div class="col-md-7 col-md-push-3 main-content">
                        <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 40vw, 80vw" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="standard-content-layout">
    	<div class="wrapper">
        	<div class="row">
            	<div class="col-md-7 col-md-push-3 main-content">
                	<h1><?php the_title(); ?></h1>
                    <p class="title"><?php echo get_field('title'); ?></p>
                	<?php the_content(); ?>
              </div>
              <div class="col-md-2 col-md-push-3"></div>
              <div class="col-md-2 col-md-pull-8 sidebar">
				<?php
                $sidebar_info = get_field('sidebar_info');
                if( $sidebar_info ) :
                    foreach( $sidebar_info as $info ) :
                ?>
                    <section>
                        <header><?php echo $info['header']; ?></header>
                        <?php echo $info['text']; ?>
                    </section>
                <?php
                    endforeach;
                endif;
                ?>
				<?php if(get_field('linkedin')) { ?>
                    <section>
                    <header>Connect</header>
                    	<a href="<?php echo get_field('linkedin'); ?>" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Linkedin@2x.png" width="22px" /></a>
                    </section>
				<?php } ?>
              </div>
            </div>
        </div>
    </section>

    <?php

	$currentID = $post->ID;

	$args = array(
		'post_type' => 'team_members',
		'posts_per_page' => -1,
		'post__not_in' => array( $currentID ),
		'order' => 'ASC'
	);

	$team = new WP_Query( $args );

	if( $team->have_posts() ) :

		$counter = 1;
		$total_counter = 1;
		$total = $team->post_count;

		echo '<section id="team-grid" class="no-headshot has-header dark" style="background-image: url('. $temp_dir .'/img/investments/Investment_Hero@2x.png);">';
        echo '<div class="wrapper">';
   		echo '<div class="inner">';

		echo '<header>';
		echo '<p>More Team Members</p>';
		echo '</header>';

		while( $team->have_posts() ) : $team->the_post();

		$no_internal = get_field('no_internal_page');

		if( $counter == 1 ){

		echo '<div class="row">';

		}

	?>

    	<div class="col-md-4">
            <div class="inner">
                <div class="content">
                    <div class="text">
                    	<?php if(!$no_internal){?><a href="<?php the_permalink(); ?>" class="cover-link"></a><?php } ?>
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_field('title'); ?></p>
                    </div>
                </div>
            </div>
        </div>

	<?php

		if( $counter == 3 || $total_counter == $total ){

		echo '</div><!-- .row -->';

		}

		$counter++;
		$total_counter++;

		if( $counter == 4 ){

			$counter = 1;

		}

		endwhile;

		echo '</div>';
		echo '</div>';
		echo '</section>';

	endif;

	?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
