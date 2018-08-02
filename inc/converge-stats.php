<section class="section-divider white">
	<p>Converge Statistics</p>
</section>

<?php

$stats = get_field('statistics', 'options');

if( $stats ) :

?>

<section class="stats">
	<div class="row">
    	<div class="col-md-12 large">
        	<div class="inner">
            	<div class="content">
                    <div class="num">
                        <?php echo $stats[0]['value']; ?>
                    </div>
                    <div class="desc">
                        <h4><?php echo $stats[0]['header']; ?></h4>
                        <p><?php echo $stats[0]['description']; ?></p>
                    </div>
                </div>

								<?php
								$id = 78;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="100vw" class="bg-img" />
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="inner">
            	<div class="content">
                	<div class="num"><?php echo $stats[1]['value']; ?></div>
                    <div class="desc"><?php echo $stats[1]['header']; ?></div>
                </div>

								<?php
								$id = 79;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992) 25vw, 100vw" class="bg-img" />
            </div>
        </div>
        <div class="col-md-3">
        	<div class="inner">
            	<div class="content">
                	<div class="num"><?php echo $stats[2]['value']; ?></div>
                    <div class="desc"><?php echo $stats[2]['header']; ?></div>
                </div>

								<?php
								$id = 80;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992) 25vw, 100vw" class="bg-img" />
            </div>
        </div>
        <div class="col-md-3">
        	<div class="inner">
            	<div class="content">
                	<div class="num"><?php echo $stats[3]['value']; ?></div>
                    <div class="desc"><?php echo $stats[3]['header']; ?></div>
                </div>

								<?php
								$id = 81;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992) 25vw, 100vw" class="bg-img" />
            </div>
        </div>
        <div class="col-md-3">
        	<div class="inner">
            	<div class="content">
                	<div class="num"><?php echo $stats[4]['value']; ?></div>
                    <div class="desc"><?php echo $stats[4]['header']; ?></div>
                </div>

								<?php
								$id = 82;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992) 25vw, 100vw" class="bg-img" />
            </div>
        </div>
    </div>
    <!--
    <div class="row">
    	<div class="col-md-6 medium">
        	<div class="inner">
            	<div class="content">
                	<div class="num"><?php echo $stats[5]['value']; ?></div>
                    <div class="desc"><?php echo $stats[5]['header']; ?></div>
                </div>

								<?php
								$id = 83;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992) 50vw, 100vw" class="bg-img" />
            </div>
        </div>
        <div class="col-md-6 medium">
        	<div class="inner">
            	<div class="content">
                	<div class="num"><?php echo $stats[6]['value']; ?></div>
                    <div class="desc"><?php echo $stats[6]['header']; ?></div>
                </div>

								<?php
								$id = 84;
								$med = wp_get_attachment_image_src( $id, 'medium' );
								$srcset = wp_get_attachment_image_srcset( $id, 'full' );
								?>

								<img src="<?php echo $med[0]; ?>" srcset="<?php echo $srcset ?>" sizes="(min-width: 992) 50vw, 100vw" class="bg-img" />
            </div>
        </div>
    </div>
    -->
</section>

<?php endif; ?>
