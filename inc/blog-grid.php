<?php

$current_post = $post->ID;

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 20, //( $posts_per_page ? $posts_per_page : -1),
	'post__not_in' => array( $current_post ),
	'order' => 'DESC',
	'orderby' => 'date'
);

$posts = new WP_Query( $args );

if( $posts->have_posts() ) :

	$counter = 1;
	$total_counter = 1;
	$total = $posts->post_count;

	echo '<section id="blog-grid" class="item-grid blog">';

	while( $posts->have_posts() ) : $posts->the_post();

	if( $counter == 1 ){

		echo '<div class="row">';

	}

	// Image
	$id = get_field('thumbnail');
	$full = wp_get_attachment_image_src( $id, 'full' );
	$sm = wp_get_attachment_image_src( $id, 'small' );
	$srcset = wp_get_attachment_image_srcset( $id, 'full' );

	//Date
	$unix = get_post_time( 'U', 'EST', $post->post_id);
	$month = date('M', $unix);
	$day = date('j', $unix);

?>

    <div class="col-md-4">
        <div class="inner">
            <a href="<?php the_permalink(); ?>" class="cover-link"></a>
            <div class="content">
                <h3><?php the_title(); ?></h3>
                <p class="date">
                    <span class="month"><?php echo $month; ?></span>
                    <span class="day"><?php echo $day; ?></span>
                </p>
            </div>
            <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992px) 33vw, 100vw" class="bg-img" />
        </div>
    </div>

<?php

	if( $counter == 3 || $total_counter == $total ){

		echo '</div><!-- .row -->';

	}

	$counter++;
	$total_counter++;

	if( $counter == 4 ){ $counter = 1; }

	endwhile;

	echo '</div><!-- #blog-grid -->';

endif;

?>
