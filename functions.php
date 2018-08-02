<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/
add_post_type_support( 'team_members', 'page-attributes' );
if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
	add_image_size('xl', 1024, '', true);
    add_image_size('large', 700, '', true); // Large Thumbnail
	add_image_size('lg-med', 475, '', true); // Lg/Meg Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_filter('image_size_names_choose', 'my_image_sizes');
    function my_image_sizes($sizes) {
      $addsizes = array(
        "xl" => __( "XL"),
        "large" => __( "Large" ),
        "lg-med" => __( "Lg-Med" ),
        "medium" => __( "Medium" ),
        "small" => __( "Small" )
      );
      $newsizes = array_merge($sizes, $addsizes);
      return $newsizes;
    }

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

/**
 * Group ACF fields in WP Rest api endpoint
 */

function acfGroups($acf){
	$groups = array();

	$additional_information = array(
		'no_internal_page' => $acf['no_internal_page'],
		'headshot' => wp_get_attachment_image_src($acf['headshot'], 'full'),
		'headshot_alternate' => wp_get_attachment_image_src($acf['headshot_alternate'], 'full'),
		'short_description' => $acf['short_description'],
		'bio' => $acf['bio'],
		'title' => $acf['title'],
		'linkedin' => $acf['linkedin'],
		'sidebar_info' => $acf['sidebar_info']
	);
	if(strlen(implode($additional_information)) !== 0){
		$groups['additional_information'] = $additional_information;
	}

	$page_banner = array(
		'hero_header' => $acf['hero_header'],
		'hero_subheader' => $acf['hero_subheader'],
		'dark_background' => wp_get_attachment_image_src($acf['dark_background'], 'full'),
		'hero_image' => wp_get_attachment_image_src($acf['hero_image'], 'full'),
		'awards' => $acf['awards']
	);
	if(strlen(implode($page_banner)) !== 0){
		$groups['page_banner'] = $page_banner;
	}

	return $groups;
}

function acfFilterFields($data) {
	if ( method_exists( $data, 'get_data' ) ) {
        $data = $data->get_data();
    } else {
        $data = (array) $data;
    }

    if ( isset( $data['acf'] ) && ! empty( $data['acf'] ) ) {
		$data['acf'] = acfGroups($data['acf']);
    }

    return $data;
}

add_filter( 'acf/rest_api/page/get_fields', 'acfFilterFields');
add_filter( 'acf/rest_api/entrepreneurs/get_fields', 'acfFilterFields');

/**
 * Custom REST Endpoints
 */
function getEntrepreneurs($data) {
  $entrepreneurs = get_posts(array(
    'post_type' => 'entrepreneurs',
    'posts_per_page' => -1
  ));
  if(empty($entrepreneurs)) {
    return new WP_ERROR('no entrepreneurs', 'No Entrepreneurs', array('status' => 404));
  } else {
	  foreach($entrepreneurs as $key => $val) {
		  $fields = acfGroups(get_fields($val->ID));
		  $entrepreneurs[$key]->acf = $fields;
	  }
  }
  return $entrepreneurs;
}

add_action('rest_api_init', function() {
  register_rest_route('custom/v1', '/entrepreneurs', array(
    'method' => 'GET',
    'callback' => 'getEntrepreneurs'
  ));
});

function getMenu($data) {
  $menu = wp_get_nav_menu_items($data['slug']);
  if(empty(menus)) {
    return new WP_ERROR('no entrepreneurs', 'No Entrepreneurs', array('status' => 404));
  } else {
	  return $menu;
  }
}

add_action('rest_api_init', function() {
  register_rest_route('custom/v1', '/menu/(?P<slug>\D+)', array(
    'method' => 'GET',
    'callback' => 'getMenu'
  ));
});

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates in search results
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

/**
 * Filter search results
 *
 */
function ordering_post_title( $query ) {

    if ( $query->is_search && $query->is_main_query() ) {
		$query->set('post_type', array('post', 'investment', 'team_members', 'vp_sectors', 'featured_vp', 'entrepreneurs'));
        $query->set('orderby','type title');
        $query->set('order','ASC');
    }

    return $query;

}
add_filter('pre_get_posts', 'ordering_post_title');

// Defer Scripts After Loading
function custom_defer_scripts( $tag, $handle, $src ) {

	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array(
		'bxslider',
		'html5blankscripts'
	);

    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }

    return $tag;
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

		wp_register_script('modernizr-custom', get_template_directory_uri() . '/js/modernizr-custom.js', array(), '3.3.1'); // Modernizr Custom
        wp_enqueue_script('modernizr-custom'); // Enqueue it!

		wp_register_script('bootstrapscripts', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array(jquery), '2.7.1'); // Modernizr
        wp_enqueue_script('bootstrapscripts'); // Enqueue it!

		wp_register_script('bxslider', get_template_directory_uri() . '/js/lib/jquery.bxslider.min.js', array(jquery), '4.2.7'); // BXSlider
        wp_enqueue_script('bxslider'); // Enqueue it!

		wp_register_script('init', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('init');

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
	wp_register_style('bootstrap', get_template_directory_uri() . '/js/bootstrap-3.3.7-dist/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'main-nav' => __('Main Nav', 'html5blank'),
		'mobile-nav' => __('Mobile Nav', 'html5blank')
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom Excerpt Read More
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="read_more" href="' . get_permalink($post->ID) . '">' . __('Read More', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Add ACF Options Page
if( function_exists('acf_add_options_page') )
{
	acf_add_options_page();
}

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}

// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

add_action('admin_init', 'df_disable_comments_post_types_support');
add_action('admin_menu', 'df_disable_comments_admin_menu');
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
add_action('admin_init', 'df_disable_comments_dashboard');
add_action('init', 'df_disable_comments_admin_bar');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar

add_filter( 'script_loader_tag', 'custom_defer_scripts', 10, 3 );

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes

?>
