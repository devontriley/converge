<?php
global $temp_dir;
?>

<?php if(!is_404()){ ?>
<footer id="main-footer">
	<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $temp_dir ?>/img/converge_footer_mark@2x.png" id="footer-logo" /></a>
	<div id="footer-address">
	    101 Main St. Cambridge, MA 02142
	</div>
</footer>
<?php } ?>

<!-- Search Modal -->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <?php include('searchform.php'); ?>
                <a href="#" class="modal-close cancel" data-dismiss="modal">Close</a>

            </div>
        </div>
    </div>
</div>

<!-- Mobile Nav Modal -->
<div class="modal fade" id="mobile-nav-modal" tabindex="-1" role="dialog" aria-labelledby="mobile-nav-modal">
	<a href="#" class="modal-close" data-dismiss="modal"><img src="<?php echo $temp_dir; ?>/img/CloseButtonSimple@2x.png" /></a>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">

				<?php wp_nav_menu(array( 'menu' => 'mobile-nav' )); ?>
                <?php include('searchform.php'); ?>

            </div>
        </div>
    </div>
    <div class="bg-img"><img src="<?php echo $temp_dir ?>/img/mobile_nav_watermark.png" /></div>
</div>

<?php $top_image = $temp_dir.'/img/Top_Green@2x.png'; ?>

</div><!-- #site-wrapper -->

<div id="footer-border"><a href="#" class="back-top disable" id="footer-back-top"><img src="<?php echo $top_image; ?>" width="13px" /></a></div>

<?php wp_footer(); ?>

<!-- analytics -->
<script>
(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-98342302-1', 'converge.vc');
ga('send', 'pageview');
</script>

</body>
</html>
