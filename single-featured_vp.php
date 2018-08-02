<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <section id="team-member-banner">
    	<div class="wrapper">
        	<div class="inner">
            	<div class="row">
                    <div class="col-md-7 col-md-push-3 main-content">
    					          <img src="<?php echo $temp_dir ?>/img/team/TeamMember_Banner_1@2x.png" />
                    </div>
                </div>
            </div>
        </div>
        <img src="<?php echo $temp_dir ?>/img/venture-partner-internal/VP_Internal_hero@2x.png" class="bg-img" />
    </section>
    
    <section class="standard-content-layout">
    	<div class="wrapper">
        	<div class="row">
            	<div class="col-md-7 col-md-push-3 main-content">
                	<h1><?php the_title(); ?></h1>
                    <p class="title"><?php echo get_field('title'); ?></p>
                	<?php the_content(); ?>
                </div>
                <div class="col-md-2 col-md-push-3 sidebar sidebar-right">
                	<section>
                    	<header>Connect</header>
                        <a href="<?php echo get_field('linkedin'); ?>" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Linkedin@2x.png" width="22px" /></a>
                    </section>
                </div>
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
                </div>
            </div>
        </div>
    </section>

    <section class="standard-content-layout bio dark">
    	<div class="wrapper">
        	<div class="row">
            	<div class="col-md-7 col-md-push-3 content">
                	Content here
            	</div>
            </div>
        </div>
    </section>

    <section class="section-divider white">
        <p>More Venture Partners</p>
    </section>

    <?php include('inc/featured-venture-partners.php'); ?>

    <?php include('inc/vp-grid.php'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
