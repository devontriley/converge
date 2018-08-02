<?php // Template Name: Team ?>

<?php get_header(); ?>

<section class="banner overlay fill-vh align-center">
    <div class="wrapper">
        <div class="inner">
        	<h2 class="half-margin"><?php the_field('hero_header'); ?></h2>
            <p><?php the_field('hero_subheader'); ?></p>
        </div>
    </div>
    <?php
	$id = get_field('hero_image');
	$sm = wp_get_attachment_image_src( $id, 'medium' );
	$lg = wp_get_attachment_image_src( $id, 'full' );
	$srcset = wp_get_attachment_image_srcset( $id, 'full' );
	?>
	<img src="<?php echo $lg[0] ?>" srcset="<?php echo $srcset ?>" sizes="100vw" class="bg-img" />
</section>

<?php include('inc/converge-stats.php'); ?>

<?php include('inc/team-grid.php'); ?>

<?php get_footer(); ?>
