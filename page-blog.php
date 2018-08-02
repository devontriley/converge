<?php // Template Name: Blog ?>

<?php get_header(); ?>

<?php
$id = get_field('hero_image');
$img = wp_get_attachment_image_src( $id, 'full' );
?>

<section class="banner align-center" style="background-image: url(<?php echo $img[0]; ?>);">
    <div class="wrapper">
        <div class="inner" style="padding-bottom:0;">
        	<h2><?php the_field('hero_header'); ?></h2>
            <p style="margin-bottom:20px;" class="pylon"><?php the_field('hero_subheader'); ?></p>
        </div>
    </div>

    <div style="padding-bottom: 5vw;max-width: 400px;margin: 0 auto;width: 100%;">
        <!-- Begin MailChimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            input[type="email"] {
            color: #000 !important;
            border: 1px solid #5dd486 !important;
            width:100% !important;
            height:40px !important;
            }
            input[type="submit"] {
            background: #5dd4a6 !important;
            font-size: 16px !important;
            font-weight: bold !important;
            width:100% !important;
            height:40px !important;
            }
        </style>
        <div id="mc_embed_signup">
            <h3 style="font-weight:normal;">Subscribe to receive our blog updates</h3>
            <form action="//converge.us15.list-manage.com/subscribe/post?u=dd2481470c8faf09102d1b837&amp;id=72d5692b1e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dd2481470c8faf09102d1b837_72d5692b1e" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Sign Up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>
    </div>
    <!--End mc_embed_signup-->

</section>

<?php include('inc/blog-grid.php'); ?>

<?php get_footer(); ?>
