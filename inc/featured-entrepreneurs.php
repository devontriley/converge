<?php

$args_light = array(
	'post_type' => 'entrepreneurs',
	'posts_per_page' => 2,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post__not_in' => array($post->ID),
	'tax_query' => array(
		array(
			'taxonomy' => 'color_section',
			'field' => 'slug',
			'terms' => 'light'
		)
	)
);

$args_dark = array(
	'post_type' => 'entrepreneurs',
	'posts_per_page' => 2,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post__not_in' => array($post->ID),
	'tax_query' => array(
		array(
			'taxonomy' => 'color_section',
			'field' => 'slug',
			'terms' => 'dark'
		)
	)
);

$light = new WP_Query( $args_light );
$dark = new WP_Query( $args_dark );

?>

<?php if($dark->posts[0]) : ?>
<section class="team-member-highlight dark" style="background-image: url(<?php echo $temp_dir ?>/img/home/Entrepreneur_2_Background@2x.png);">
    <div class="wrapper">
        <div class="row">
            <div class="row-height">
                <div class="col-md-7 col-md-height image">
                    <div class="inner">
                    	<?php
                    	$id = get_field('headshot_alternate', $dark->posts[0]->ID);
						$full = wp_get_attachment_image_src( $id, 'full' );
						$sm = wp_get_attachment_image_src( $id, 'large' );
						$srcset = wp_get_attachment_image_srcset( $id, 'full' );
						?>
                        <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 46vw, 100vw" />
                    </div>
                </div>
                <div class="col-md-5 col-md-height col-top content">
                    <div class="inner">
                        <h2><?php echo $dark->posts[0]->post_title; ?></h2>
                        <p class="title"><?php the_field('title', $dark->posts[0]->ID); ?></p>
                        <div class="separator"></div>
                        <?php the_field('short_description', $dark->posts[0]->ID); ?>
                        <!-- <a href="<?php echo get_the_permalink($dark->posts[0]->ID); ?>" class="btn btn-default">Read the Story</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if($light->posts[0]) : ?>
<section class="team-member-highlight image-first" style="background-image: url(<?php echo $temp_dir ?>/img/home/Entrepreneur_1_Background@2x.png);">
    <div class="wrapper">
        <div class="row">
            <div class="row-height">
                <div class="col-md-7 col-md-height image">
                    <div class="inner">
                    	<?php
                    	$id = get_field('headshot', $light->posts[0]->ID);
						$full = wp_get_attachment_image_src( $id, 'full' );
						$sm = wp_get_attachment_image_src( $id, 'large' );
						$srcset = wp_get_attachment_image_srcset( $id, 'full' );
						?>
                        <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 46vw, 100vw" />
                    </div>
                </div>
                <div class="col-md-5 col-md-height col-top content">
                    <div class="inner">
                        <h2><?php echo $light->posts[0]->post_title; ?></h2>
                        <p class="title"><?php the_field('title', $light->posts[0]->ID); ?></p>
                        <div class="separator"></div>
                        <?php the_field('short_description', $light->posts[0]->ID); ?>
                        <!-- <a href="<?php echo get_the_permalink($light->posts[0]->ID); ?>" class="btn btn-default">Read the Story</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if($dark->posts[1]) : ?>
<section class="team-member-highlight dark" style="background-image: url(<?php echo $temp_dir ?>/img/home/Entrepreneur_2_Background@2x.png);">
    <div class="wrapper">
        <div class="row">
            <div class="row-height">
                <div class="col-md-7 col-md-height image">
                    <div class="inner">
                        <?php
                    	$id = get_field('headshot_alternate', $dark->posts[1]->ID);
						$full = wp_get_attachment_image_src( $id, 'full' );
						$sm = wp_get_attachment_image_src( $id, 'large' );
						$srcset = wp_get_attachment_image_srcset( $id, 'full' );
						?>
                        <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 46vw, 100vw" />
                    </div>
                </div>
                <div class="col-md-5 col-md-height col-top content">
                    <div class="inner">
                        <h2><?php echo $dark->posts[1]->post_title; ?></h2>
                        <p class="title"><?php the_field('title', $dark->posts[1]->ID); ?></p>
                        <div class="separator"></div>
                        <?php the_field('short_description', $dark->posts[1]->ID); ?>
                        <!-- <a href="<?php echo get_the_permalink($dark->posts[1]->ID); ?>" class="btn btn-default">Read the Story</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if($light->posts[1]) : ?>
<section class="team-member-highlight image-first" style="background-image: url(<?php echo $temp_dir ?>/img/home/Entrepreneur_3_Background@2x.png);">
    <div class="wrapper">
        <div class="row">
            <div class="row-height">
                <div class="col-md-7 col-md-height image">
                    <div class="inner">
                        <?php
                    	$id = get_field('headshot', $light->posts[1]->ID);
						$full = wp_get_attachment_image_src( $id, 'full' );
						$sm = wp_get_attachment_image_src( $id, 'large' );
						$srcset = wp_get_attachment_image_srcset( $id, 'full' );
						?>
                        <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 46vw, 100vw" />
                    </div>
                </div>
                <div class="col-md-5 col-md-height col-top content">
                    <div class="inner">
                        <h2><?php echo $light->posts[1]->post_title; ?></h2>
                        <p class="title"><?php the_field('title', $light->posts[1]->ID); ?></p>
                        <div class="separator"></div>
                        <?php the_field('short_description', $light->posts[1]->ID); ?>
                        <!-- <a href="<?php echo get_the_permalink($light->posts[1]->ID); ?>" class="btn btn-default">Read the Story</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php wp_reset_query(); ?>