<?php // Template Name: Home ?>

<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<?php
$id = get_field('hero_image');
$img = wp_get_attachment_image_src( $id, 'full' );
?>
    
<section id="home-banner-1" class="banner fill-vh align-center" style="background-image: url(<?php echo $img[0]; ?>);">
    <div class="wrapper">
        <div class="inner">
        	<h2><img src="<?php echo $temp_dir ?>/img/Hero_Mark_Sm@2x.png" id="home-logo" /></h2>
            <p class="pylon"><?php the_field('hero_subheader'); ?></p>
        </div>
    </div>
    <div id="scroll-down"><img src="<?php echo $temp_dir ?>/img/Scroll_Icon@2x.png" /></div>
</section>

<section class="section-divider white">
	<p>Entrepreneur Features</p>
</section>

<?php include('inc/featured-entrepreneurs.php'); ?>

<?php //include('inc/converge-stats.php'); ?>

<section class="content-cta fill-vh align-center" style="background-image: url(<?php the_field('content_cta_background_image'); ?>);">
	<div class="wrapper">
    	<div class="inner">
            <header>
                <h2><?php the_field('content_cta_header'); ?></h2>
            </header>
            <p><?php the_field('content_cta_subheader'); ?></p>
            <a href="<?php the_field('content_cta_link_url'); ?>" class="btn btn-default"><?php the_field('content_cta_link_text'); ?></a>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
