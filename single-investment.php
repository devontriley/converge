<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <section class="banner light fill-vh align-center" style="background-image: url(<?php echo $temp_dir ?>/img/investments-internal/Investment_Internal_Hero@2x.png);">
        <div class="wrapper">
            <div class="inner">
                <h2><?php the_title(); ?></h2>
                <p class="pylon subhead"><strong>INVESTMENTS</strong></p>
                <div class="next-section">
                View
                </div>
            </div>
        </div>
    </section>

    <?php

	$investments = get_field('investments');

	if( $investments ) :

		$total = count($investments);
		$counter = 1;
		$total_counter = 1;
    $bg_counter = 1;
		$row_counter = 0;
		$dark = false;

		echo '<section id="investment-single-grid">';

		foreach( $investments as $investment ) :

		if( $row_counter != 1 ){ $dark = true; } else { $dark = false; }

		if( $counter == 1 ){
			$row_counter++;
			$row_counter == 3 ? $row_counter = 1 : null;
			echo '<div class="row '. ($dark === true ? 'dark' : null) .'">';
        	echo '<div class="row-height">';
		}

	?>

		<div class="col-md-6 col-md-height col-top">
              <div class="inner">
                  <div class="content">
                      <h2><?php echo $investment['name']; ?></h2>
                      <p class="title"><?php echo $investment['entrepreneur']; ?></p>
                      <?php echo $investment['description']; ?>
                      <div class="btns">
                          <?php if($investment['site_url']){ ?><a href="<?php echo $investment['site_url']; ?>" target="_blank" class="btn btn-default wide">Visit Site</a><?php } ?>
                          <?php if($investment['jobs_url']){ ?><a href="<?php echo $investment['jobs_url']; ?>" target="_blank" class="btn btn-default wide">See Jobs</a><?php } ?>
                      </div>
                      <?php if($investment['note']){ ?><p class="note"><?php echo $investment['note']; ?></p><?php } ?>
                  </div>
                  <img src="<?php echo $temp_dir ?>/img/investments-internal/IntInv_Block_<?php echo $bg_counter ?>@1x.jpg" srcset="<?php echo $temp_dir ?>/img/investments-internal/IntInv_Block_<?php echo $bg_counter ?>@1x.jpg 420w, <?php echo $temp_dir ?>/img/investments-internal/IntInv_Block_<?php echo $bg_counter ?>@2x.jpg 840w" sizes="(min-width:992px) 33vw, 100vw" class="bg-img" />
              </div>
          </div>

	<?php

		if( $counter == 2 || $total_counter == $total ){
			echo '</div>';
			echo '</div>';
		}

		$counter++;
		$total_counter++;
    $bg_counter == 12 ? $bg_counter = 1 : $bg_counter++ ;

		$counter == 3 ? $counter = 1 : null;

		endforeach;

		echo '</section>';

	endif;

	?>

    <section class="section-divider white">
        <p>More Investments</p>
    </section>

    <?php include('inc/investment-grid.php'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
