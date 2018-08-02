<?php

$currentID = $post->ID;

$args = array(
	'post_type' => 'vp_sectors',
	'posts_per_page' => -1,
	'post__not_in' => array( $currentID ),
	'orderby' => 'name',
	'order' => 'ASC'
);

$sectors = new WP_Query( $args );

if( $sectors->have_posts() ) :

	$counter = 1;
	$total_counter = 1;
	$total = $sectors->post_count;

	echo '<section id="investments-grid" class="item-grid">';

	while( $sectors->have_posts() ) : $sectors->the_post();

	if( $counter == 1 ){

		echo '<div class="row">';

	}

?>

	<div class="col-md-4">
        <div class="inner <?php if( $post->ID == $currentID ){ echo 'current'; } ?>">
            <?php if( $post->ID !== $currentID ){ ?><a href="<?php the_permalink(); ?>" class="cover-link"></a><?php } ?>
            <div class="content">
                <h3><?php the_title(); ?></h3>
            </div>
            <img src="<?php echo $temp_dir ?>/img/vp-network/VP_PartnerTiles_<?php echo $total_counter ?>@1x.jpg" srcset="<?php echo $temp_dir ?>/img/vp-network/VP_PartnerTiles_<?php echo $total_counter ?>@1x.jpg 420w, <?php echo $temp_dir ?>/img/vp-network/VP_PartnerTiles_<?php echo $total_counter ?>@2x.jpg 840w" sizes="(min-width:992px) 33vw, 100vw" class="bg-img" />
        </div>
    </div>

<?php

	if( $counter == 3 || $total_counter == $total ){

		echo '</div>';

	}

	$counter++;
	$total_counter++;

	if( $counter == 4 ){ $counter = 1; }

	endwhile;

	echo '</div>';

endif;

?>
