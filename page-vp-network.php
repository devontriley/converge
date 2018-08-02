<?php // Template Name: VP Network ?>

<?php get_header(); ?>

<section class="banner fill-vh align-center" style="background-image: url(<?php echo $temp_dir ?>/img/investments/Investment_Hero@2x.png);">
    <div class="wrapper">
        <div class="inner">
        	<h2><?php the_field('hero_header'); ?></h2>
            <p class="pylon"><?php the_field('hero_subheader'); ?></p>
            <div class="next-section">
            View Our Network
            </div>
        </div>
    </div>
</section>

<?php include('inc/vp-stats.php'); ?>

<?php include('inc/featured-venture-partners.php'); ?>

<section class="section-divider white">
	<p>View More Partners</p>
</section>

<?php include('inc/vp-grid.php'); ?>

<?php get_footer(); ?>
