<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<?php

$tags = get_the_tags();

?>
    
    <section class="banner blog">
    	<div class="wrapper">
        	<div class="inner">
            	<?php
				$id = get_field('featured_image');
				if(!$id){ $id = 130; }
				$full = wp_get_attachment_image_src( $id, 'full' );
				$sm = wp_get_attachment_image_src( $id, 'small' );
				$srcset = wp_get_attachment_image_srcset( $id, 'full' );
				?>
    			<img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="100vw" />
            </div>
        </div>
    </section>
    
    <section class="standard-content-layout blog">
    	<div class="wrapper">
        	<div class="row">
            	<div class="col-md-7 col-md-push-3 main-content">
                	<h1><?php the_title(); ?></h1>
                	<?php the_content(); ?>
                </div>
                <div class="col-md-2 col-md-push-3 sidebar sidebar-right">
                	<section>
                    	<header>Share</header>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>
" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Linkedin@1x.png" srcset="<?php echo $temp_dir ?>/img/blog-internal/Linkedin@1x.png 1x, <?php echo $temp_dir ?>/img/blog-internal/Linkedin@2x.png 2x" width="23px" /></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Tweet@1x.png" srcset="<?php echo $temp_dir ?>/img/blog-internal/Tweet@1x.png 1x, <?php echo $temp_dir ?>/img/blog-internal/Tweet@2x.png 2x" width="23px" /></a>
                        <a href="#" id="fbShareBtn" target="_blank"><img src="<?php echo $temp_dir ?>/img/blog-internal/Facebook@1x.png" srcset="<?php echo $temp_dir ?>/img/blog-internal/Facebook@1x.png 1x, <?php echo $temp_dir ?>/img/blog-internal/Facebook@2x.png 2x" width="23px" /></a>
                    </section>
                </div>
                <script>
				document.getElementById('fbShareBtn').onclick = function() {
					FB.ui({
						method: 'share',
						display: 'popup',
						href: '<?php the_permalink(); ?>'
					}, function(response){});
				}
				</script>
            	<div class="col-md-2 col-md-pull-8 sidebar">
                    <section>
                    	<header>Date Posted</header>
                        <p><?php echo the_time('m/j/Y'); ?></p>
                    </section>
                    <?php if( $tags ) : ?>
                    <section>
                    	<header>Tags</header>
                        <p>
						<?php foreach( $tags as $key=>$value ) : 
						if ( $key !== 0 ){ echo ', '; }
						echo $value->name;
						endforeach ?>
                        </p>
                    </section>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
<?php endwhile; endif; ?>

	<section class="section-divider">
        <p>Read More</p>
    </section>
    
    
    <?php 
	
	$posts_per_page = 6;
	
	include('inc/blog-grid.php');
	
	?>
    
<?php get_footer(); ?>
