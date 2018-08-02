<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<?php

global $temp_dir;
global $blog_url;
$temp_dir = get_bloginfo('template_directory');
$blog_url = get_bloginfo('url');

?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
    
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>
    
    <?php if(is_singular('post')) : ?>
    <script type="text/javascript" src="//platform.linkedin.com/in.js">
		api_key: 77occrr3giu40h
	</script>
	<?php endif; ?>
    
	<?php if(is_page('25')) { ?>
    <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us15.list-manage.com","uuid":"dd2481470c8faf09102d1b837","lid":"72d5692b1e"}) })</script>
    <?php } ?>
    
</head>

<body <?php body_class(); ?>>
    
    <script>
    window.fbAsyncInit = function() {
		FB.init({
			appId      : '1769804199999210',
			xfbml      : true,
			version    : 'v2.8'
		});
		FB.AppEvents.logPageView();
    };
    
    (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    
    <div id="site-wrapper">
        
        <header id="main-header">
        
            <div id="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo $temp_dir; ?>/img/Converge_Logo_Black@2x.png" width="146" /></a></div>
            
            <?php if(!is_front_page()){ ?>
            	<?php if( is_page_template('page-investments.php') || is_page_template('page-vp-network.php') || is_page_template('page-blog.php') || is_page_template('page-team.php') || is_404() ){ ?>
            		<div id="mobile-logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo $temp_dir; ?>/img/mobile_logo@2x.png" /></a></div>
                <?php } else { ?>
                	<div id="mobile-logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo $temp_dir; ?>/img/mobile_logo_dark@2x.png" /></a></div>
                <?php } ?>
            <?php } ?>
            
            <nav id="main-nav">
                <?php wp_nav_menu(array( 'menu' => 'main-nav' )); ?>
                <?php if( !is_search() ){ ?>
                <a href="#" class="search"><img src="<?php echo $temp_dir; ?>/img/home/Search_Icon@2x.png" data-toggle="modal" data-target="#search-modal" width="15px" /></a>
                <?php } else { ?>
                <a href="#" class="search" onclick="window.history.back();"><img src="<?php echo $temp_dir; ?>/img/Back_Arrow@2x.png" data-toggle="modal" data-target="#search-modal" width="15px" /></a>
                <?php } ?>
                <a href="#" class="mobile-nav-btn" data-toggle="modal" data-target="#mobile-nav-modal"><img src="<?php echo $temp_dir ?>/img/Hamburger@2x.png" /></a>
            </nav>
            
        </header>