<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <section class="banner light align-center" style="background-image: url(<?php echo $temp_dir ?>/img/venture-partner-internal/VP_Internal_hero@2x.png);">
        <div class="wrapper">
            <div class="inner">
                <h2>Venture Partner with <?php the_title(); ?> experience</h2>
                <p class="pylon"><?php the_field('hero_subheader'); ?></p>
            </div>
        </div>
    </section>

    <?php

	$entrepreneurs = get_field('entrepreneurs');

	if( $entrepreneurs ) :

		$counter = 1;
		$total_counter = 1;
		$total = count($entrepreneurs);

		echo '<section id="team-grid" class="no-headshot">';
        echo '<div class="wrapper">';
   		echo '<div class="inner">';

		foreach( $entrepreneurs as $ent ) :

		if( $counter == 1 ){

		echo '<div class="row">';

		}

	?>

    	<div class="col-md-3 col-sm-6">
              <div class="inner">
                  <div class="content">
                      <div class="text">
                          <a href="<?php echo $ent['linkedin_url']; ?>" class="linkedin" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Linkedin@2x.png" width="22px" /></a>
                          <h3><?php echo $ent['name']; ?></h3>
                          <p class="desc"><?php echo $ent['description']; ?></p>
                      </div>
                  </div>
              </div>
          </div>

	<?php

		if( $counter == 4 || $total_counter == $total ){

		echo '</div><!-- .row -->';

		}

		$counter++;
		$total_counter++;

		if( $counter == 5 ){

			$counter = 1;

		}

		endforeach;

		echo '</div>';
		echo '</div>';
		echo '</section>';

	endif;

	?>

    <section class="section-divider white">
        <p>More Venture Partners</p>
    </section>

    <?php include('inc/vp-grid.php'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
