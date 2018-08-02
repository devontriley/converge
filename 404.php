<?php get_header(); ?>
    
    <section class="banner fill-vh align-center">
        <div class="wrapper">
            <div class="inner">
                <h2 class="half-margin lg">404</h2> 
                <p class="pylon">//Error//</p>
                <p class="caps">The page you were looking for<br />appears to have been moved, deleted<br />or does not exist.</p>
                <p class="caps">You could head to our <a href="<?php echo $blog_url ?>">home page</a><br /> or <button onclick="window.history.back();">back</button> to where you were.</p>
            </div>
        </div>
        <?php
        $id = 292;
        $sm = wp_get_attachment_image_src( $id, 'medium' );
        $srcset = wp_get_attachment_image_srcset( $id, 'full' );
        ?>
        <img src="<?php echo $sm[0] ?>" srcset="<?php echo $srcset ?>" sizes="100vw" class="bg-img" />
    </section>

<?php get_footer(); ?>
