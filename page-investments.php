<?php // Template Name: Investments ?>

<?php get_header(); ?>

<?php
$id = get_field('hero_image');
$img = wp_get_attachment_image_src( $id, 'full' );
?>

<section class="banner fill-vh align-center" style="background-image: url(<?php echo $img[0]; ?>);">
    <div class="wrapper">
        <div class="inner">
        	<h2><?php the_field('hero_header'); ?></h2>
            <p class="pylon"><?php the_field('hero_subheader'); ?></p>
            <?php
			$awards = get_field('awards');
			if($awards){
				echo '<div class="awards"><ul>';
				foreach($awards as $award){ ?>
					<li>
                    	<div class="award">
                            <p>
                            <?php echo $award['text']; ?>
                            </p>
                        </div>
                    </li>
				<?php }
				echo '</ul></div>';
			}
			?>
            <div class="next-section">
            View By Industry
            </div>
        </div>
    </div>
</section>

<?php include('inc/investment-grid.php'); ?>

<?php get_footer(); ?>
