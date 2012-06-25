<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 551 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 255 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'twentyten' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'twentyten' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'twentyten' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'twentyten' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'twentyten' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'twentyten' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'twentyten' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function twentyten_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return __( '', 'twentyten' );
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	
	// Area 1 de la cabecera.
	register_sidebar( array(
		'name' => __( 'Enlaces de la cabecera', 'twentyten' ),
		'id' => 'second-header-widget-area',
		'description' => __( 'Zona de la cabecera donde van los enlaces: Conselleria de Turisme y Suscripción', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Sidebar: Debajo de Flickr', 'twentyten' ),
		'id' => 'debajo-flickr-widget-area',
		'description' => __( 'Área de widgets en el sidebar debajo de Flickr.', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Sidebar: Debajo de + Comentado', 'twentyten' ),
		'id' => 'debajo-mas-comentado-widget-area',
		'description' => __( 'Área de widgets en el sidebar debajo de Lo más comentado.', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Columna 1 de enlaces', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Columna 2 de enlaces', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Columna 3 de enlaces', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


if ( ! function_exists( 'valencia_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function valencia_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentNum; ?>
  	<?php $mostrar = $commentNum+1; 
  			if ($mostrar < 10) $mostrar = '0'.$mostrar;
  	
  	?>
   <li>
   		<span class="n-com"><?php echo $mostrar; ?></span>
   		<span class="n-com"><?php echo get_avatar( $comment, 40 ); ?></span>
   		<span class="data-com"><?php comment_date(); ?></span>
   		
		<span class="name-com"> | <?php /* ?><a href="<?php comment_author_link(); ?>" title="Al autor"><?php */ ?><?php comment_author(); ?><?php /* ?></a><?php */ ?> | <?php edit_comment_link(__('(Edit)'),'  ','') ?></span>

		<div class="comentario">
			<?php if ($comment->comment_approved == '0') : ?>
         		<em><?php _e('Your comment is awaiting moderation.') ?></em>
         		<br />
      		<?php endif; ?>
			<p> <?php comment_text() ?></p>
			
		</div><!-- end comentario -->
		<div class="reply">
         	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      	</div>
		<br class="clear" />
<?php $commentNum = $commentNum + 1; ?>
<?php
}
endif;



//Función que muestra los cuadritos de la portada con los últimos artículos de los blogs
function mostrar_articulo_portada($idblog,$ult_penult_antepenult){ ?>
	
	<?php global $switched; ?>
	<div class="box-content">
		<?php
    			switch_to_blog($idblog);
		?> 
		<?php 
				$cont = 1;
				$args = array('posts_per_page' => $ult_penult_antepenult,'orderby'  => date,'order' => DESC);
				query_posts($args);
								
				if ( have_posts() ) while ( have_posts() ) : the_post();
								
					if($ult_penult_antepenult == $cont): ?>
								
								<h4><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name');?></a></h4>
								<br class="clear" />
								<div class="cat-img">
									<a href="<?php the_permalink(); ?>" title="Imagen de la categoría">
										<?php the_post_thumbnail('thumbnail'); ?>
									</a>
								</div><!-- end cat-img -->
								<br class="clear" />
								<div class="entry-meta">
																				
										<div id="author">
											<div class="author-photo">
												<?php userphoto_the_author_thumbnail(); ?>
											</div><!-- end author-photo -->
											<span rel="bookmark" title="fecha" href="<?php echo get_month_link('', ''); ?>" class="date-post">
												<span class="entry-date"><?php $date = get_the_date(); echo strtolower($date); ?></span>
											</span>
											<span class="meta-sep">Escrito por</span> <span class="author vcard"><?php the_author_posts_link(); ?></span>
										</div><!-- end author -->
										
									</div><!-- end entry-meta -->
									
								<div class="separator-h">
									<hr />
								</div><!-- end separator-h -->
								<br class="clear" />
								<div class="last-cat-post">
									<h5 class="entry-title">
										<a rel="bookmark" title="Permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>
									<?php the_excerpt(); ?>
									<p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p>
								</div><!-- end last-cat-post -->
					
					<?php 
						endif; 
						$cont++;	
					?>
					
							
				<?php endwhile; ?>
				<?php restore_current_blog(); ?>						
		</div><!-- box-content -->

<?php	
}

//Función que muestra los cuadritos de la portada (los terceros de cada fila) con los últimos artículos de los blogs
function mostrar_articulo_portada_tercero_fila($idblog,$ult_penult_antepenult){ ?>
	
	<?php global $switched; ?>
	<div class="box-content last-r">
		<?php
    			switch_to_blog($idblog);
		?> 
		<?php 
				$cont = 1;
				$args = array('posts_per_page' => $ult_penult_antepenult,'orderby'  => date,'order' => DESC);
				query_posts($args);
								
				if ( have_posts() ) while ( have_posts() ) : the_post();
								
					if($ult_penult_antepenult == $cont): ?>
								
								<h4><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name');?></a></h4>
								<br class="clear" />
								<div class="cat-img">
									<a href="<?php the_permalink(); ?>" title="Imagen de la categoría">
										<?php the_post_thumbnail('thumbnail'); ?>
									</a>
								</div><!-- end cat-img -->
								<br class="clear" />
								<div class="entry-meta">
																				
										<div id="author">
											<div class="author-photo">
												<?php userphoto_the_author_thumbnail(); ?>
											</div><!-- end author-photo -->
											<span rel="bookmark" title="fecha" href="<?php echo get_month_link('', ''); ?>" class="date-post">
												<span class="entry-date"><?php $date = get_the_date(); echo strtolower($date); ?></span>
											</span>
											<span class="meta-sep">Escrito por</span> <span class="author vcard"><?php the_author_posts_link(); ?></span>
										</div><!-- end author -->
										
									</div><!-- end entry-meta -->
									
								<div class="separator-h">
									<hr />
								</div><!-- end separator-h -->
								<br class="clear" />
								<div class="last-cat-post">
									<h5 class="entry-title">
										<a rel="bookmark" title="Permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>
									<?php the_excerpt(); ?>
									<p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p>
								</div><!-- end last-cat-post -->
							
					<?php 
						endif; 
						$cont++;	
					?>
					
							
				<?php endwhile; ?>
				<?php restore_current_blog(); ?>						
		</div><!-- box-content -->

<?php	
}

function excerpt_200($content = false) {
			global $post;
			
			if($post->post_excerpt != ''):
				$mycontent = $post->post_excerpt;
			else:
				$mycontent = $post->post_content;
			endif;

			
			$mycontent = str_replace(']]>', ']]&gt;', $mycontent);
			$mycontent = strip_tags($mycontent);
			$excerpt_length = 200;
			$words = explode(' ', $mycontent, $excerpt_length + 1);
			if(count($words) > $excerpt_length) :
				array_pop($words);
				array_push($words, '...');
				$mycontent = implode(' ', $words);
			endif;
			$mycontent = apply_filters('the_content', $mycontent);
			$mycontent = '<p>' . $mycontent . '</p>';
// Make sure to return the content
	return $mycontent;
}

function excerpt_50($content = false) {
			global $post;
			
			if($post->post_excerpt != ''):
				$mycontent = $post->post_excerpt;
			else:
				$mycontent = $post->post_content;
			endif;

			
			$mycontent = str_replace(']]>', ']]&gt;', $mycontent);
			$mycontent = strip_tags($mycontent);
			$excerpt_length = 50;
			$words = explode(' ', $mycontent, $excerpt_length + 1);
			if(count($words) > $excerpt_length) :
				array_pop($words);
				array_push($words, '...');
				$mycontent = implode(' ', $words);
			endif;
			$mycontent = apply_filters('the_content', $mycontent);
			$mycontent = '<p>' . $mycontent . '</p>';
// Make sure to return the content
	return $mycontent;
}



//Función de nuestro excerpt personalizado de 100 caracteres, sin contar código.
function excerpt_20($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
	
		$text = strip_tags($text, '<strong><a><p><i><em><br><br /></br>');
		$excerpt_length = 20;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	else{
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text, '<strong><a><p><i><em><br><br /></br>');
		$excerpt_length = 20;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	nl2br($text);
	
	return $text;
}

//Función de nuestro excerpt personalizado de 100 caracteres, sin contar código.
function excerpt_30($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
	
		$text = strip_tags($text, '<strong><a><p><i><em><br><br /></br>');
		$excerpt_length = 30;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	else{
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text, '<strong><a><p><i><em><br><br /></br>');
		$excerpt_length = 30;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	nl2br($text);
	
	return $text;
}

function mes($mes)
{
  $res = "";
  if(date( 'F', mktime(0, 0, 0, $mes, 1, 2000) ) == "January")
    $res = "Enero";
  else if(date( 'F', mktime(0, 0, 0, $mes, 2, 2000) ) == "February")
    $res = "Febrero";
  else if(date( 'F', mktime(0, 0, 0, $mes, 3, 2000) ) == "March")
    $res = "Marzo";
  else if(date( 'F', mktime(0, 0, 0, $mes, 4, 2000) ) == "April")
    $res = "Abril";
  else if(date( 'F', mktime(0, 0, 0, $mes, 5, 2000) ) == "May")
    $res = "Mayo";
  else if(date( 'F', mktime(0, 0, 0, $mes, 6, 2000) ) == "June")
    $res = "Junio";
  else if(date( 'F', mktime(0, 0, 0, $mes, 7, 2000) ) == "July")
    $res = "Julio";
  else if(date( 'F', mktime(0, 0, 0, $mes, 8, 2000) ) == "August")
    $res = "Agosto";
  else if(date( 'F', mktime(0, 0, 0, $mes, 9, 2000) ) == "September")
    $res = "Septiembre";
  else if(date( 'F', mktime(0, 0, 0, $mes, 10, 2000) ) == "October")
    $res = "Octubre";
  else if(date( 'F', mktime(0, 0, 0, $mes, 11, 2000) ) == "November")
    $res = "Noviembre";
  else if(date( 'F', mktime(0, 0, 0, $mes, 12, 2000) ) == "December")
    $res = "Diciembre";
  return $res;
}

function lomasleido(){
	$instance = array(
													'title' => 'Lo más leido',
													'limit' => 5,
													'range' => 'weekly',
													'order_by' => 'views',
													'pages' => flase,
													'shorten_title' => array(
													'active' => false,
													'length' => 25,
													'keep_format' => false
												),
													'post-excerpt' => array(
													'active' => false,
													'length' => 55
												),
													'exclude-cats' => array(
													'active' => false,
													'cats' => ''
												),
													'thumbnail' => array(
													'active' => false,
													'width' => 15,
													'height' => 15
												),
													'rating' => false,
													'stats_tag' => array(
													'comment_count' => false,
													'views' => false,
													'author' => false,
													'date' => array(
														'active' => false,
														'format' => 'F j, Y'
													)
												),
													'markup' => array(
													'custom_html' => false,
													'wpp-start' => '&lt;ul&gt;',
													'wpp-end' => '&lt;/ul&gt;',
													'post-start' => '&lt;li&gt;',
													'post-end' => '&lt;/li&gt;',
													'title-start' => '&lt;h2&gt;',
													'title-end' => '&lt;/h2&gt;',
													'pattern' => array(
														'active' => false,
														'form' => '{image} {title}: {summary} {stats}'
													)
												)
												); 
												
	return $instance;
}

function lomascomentado(){
	$instance2 = array(
													'title' => 'Lo más comentado',
													'limit' => 5,
													'range' => 'all',
													'order_by' => 'comments',
													'pages' => flase,
													'shorten_title' => array(
													'active' => false,
													'length' => 25,
													'keep_format' => false
												),
													'post-excerpt' => array(
													'active' => false,
													'length' => 55
												),
													'exclude-cats' => array(
													'active' => false,
													'cats' => ''
												),
													'thumbnail' => array(
													'active' => false,
													'width' => 15,
													'height' => 15
												),
													'rating' => false,
													'stats_tag' => array(
													'comment_count' => true,
													'views' => false,
													'author' => false,
													'date' => array(
														'active' => false,
														'format' => 'F j, Y'
													)
												),
													'markup' => array(
													'custom_html' => false,
													'wpp-start' => '&lt;ul&gt;',
													'wpp-end' => '&lt;/ul&gt;',
													'post-start' => '&lt;li&gt;',
													'post-end' => '&lt;/li&gt;',
													'title-start' => '&lt;h2&gt;',
													'title-end' => '&lt;/h2&gt;',
													'pattern' => array(
														'active' => false,
														'form' => '{image} {title}: {summary} {stats}'
													)
												)
												); 
	return $instance2;
}

function show_social_icons(){ 
	$titulo_con_espacios = get_the_title();
	$titulo_sin_espacios = str_replace(" ", "+", $titulo_con_espacios);	
	$simbolos = array("á","é", "í", "ó", "ú", "Á", "É","Í", "Ó", "Ú", "$", "%", "&", "?", "¿", "¡", "!", "|", "@", "#", ",", ".", ":", ";", "_", "ç", "Ç", "{", "}", "´", "^", "[", "]", "*", "`", "¨", "<", ">");
	$titulo_para_tumblr = str_replace($simbolos, "", $titulo_sin_espacios);
	
	$enlace = get_permalink();
	$enlace_para_tumblr = str_replace("http://", "http%3A%2F%2F", $enlace);	
?>
	<div class="social">
											<ul>
												<li><a href="http://twitter.com/home?status=<?php the_permalink(); ?>" title="Click para enviar a Twitter!" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-tt-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Twitter</span></a></span></li>
												<li><a href="http://delicious.com/post?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="Delicious" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-del-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Delicious</span></a></li>
												<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="blank" title="Facebook"><img src="<?php bloginfo('template_directory'); ?>/img/icos/ico-fb-small.gif" alt="Comparte en Facebook" width="16" height="16" /><span class="skip">Facebook</span></a></li>
												<li><a href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_permalink(); ?>" title="Email" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-mail-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Email</span></a></li>
												<li><a href="http://meneame.net/submit.php?ur<?php the_permalink(); ?>" title="Menéame" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-meneame.jpg" alt="Icono" width="16" height="16" /> <span class="skip">Menéame</span></a></li>
												<li><a href="http://digg.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="Digg" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-digg.jpg" alt="Icono" width="16" height="16" /> <span class="skip">Digg</span></a></li>
												<li><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="Stumbleupon" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-stumbleupon.jpg" alt="Icono" width="16" height="16" /> <span class="skip">Stumbleupon</span></a></li>
												<li><a href="http://www.tumblr.com/share?v=3&u=<?php echo $enlace_para_tumblr; ?>&t=<?php echo $titulo_para_tumblr; ?>" title="Tumblr" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-tumblr.jpg" alt="Icono" width="16" height="16" /> <span class="skip">Tumblr</span></a></li>
												<li class="add-to-any"><?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?></li>
												<?php 
												/* Quitamos los iconos de youtube y flickr por petición del cliente ?>
												<li><a href="http://www.youtube.com/comunitatvalenciana" title="Youtube" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico-youtube.jpg" alt="Icono" width="16" height="16" /> <span class="skip">Youtube</span></a></li>
												<li><a href="http://www.flickr.com/photos/comunitatvalenciana" title="Flickr" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/ico-flickr.jpg" alt="Icono" width="16" height="16" /> <span class="skip">Flickr</span></a></li>
												<?php 
												*/ ?>
											</ul>
	</div><!-- end social --> 
<?php
}



/*************************************************************************************************************************************************
// Menú en el panel de administración para que puedan elegir algunas opciones del blog
*************************************************************************************************************************************************/


function valencia_blogs_admin_head() { ?>

<?php }

// VARIABLES

$themename = "RSS";
$shortname = "valencia_blogs";
$manualurl = get_bloginfo('home');
$options = array();

add_option("valencia_blogs_settings",$options);

$template_path = get_bloginfo('template_directory');

$layout_path = TEMPLATEPATH . '/layouts/'; 
$layouts = array();

$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

$functions_path = TEMPLATEPATH . '/functions/';

$user_id = 1;
$user_blogs = get_blogs_of_user( $user_id );
$i=0;




// THESE ARE THE DIFFERENT FIELDS

$options = array (

				array(	"name" => "Opciones para editar el módulo de RSS del sidebar de este blog",
						"type" => "heading"),
	
				array(	"name" => "Enlace Suscripción: ",
						"desc" => "El enlace que pongas aquí será el del icono del RSS que hay en el sidebar.<br /><br />",
						"id" => $shortname."_rss",
						"std" => "",
						"type" => "text"),
					
					
				array(	"name" => "Código para el formulario de suscripción: ",
						"desc" => "Aquí debes poner el código de feedburner para el formulario de suscripción por email (uri).<br /><br />",
						"id" => $shortname."_email_rss",
						"std" => "",
						"type" => "text")
				);


// ADMIN PANEL

function valencia_blogs_add_admin() {

	 global $themename, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {	
        if ( 'save' == $_REQUEST['action'] ) {
	
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							update_option($up_opt, $_REQUEST[$up_opt] );
						}
					}
				}

                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;						
							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 
						}
					}
				}
						
				header("Location: admin.php?page=functions.php&saved=true");								
			
			die;

		} else if ( 'reset' == $_REQUEST['action'] ) {
			delete_option('sandbox_logo');
			
			header("Location: admin.php?page=functions.php&reset=true");
			die;
		}

	}

add_menu_page($themename." Opciones", $themename." Opciones", 'edit_themes', basename(__FILE__), 'valencia_blogs_page');
}


function valencia_blogs_page (){

		global $options, $themename, $manualurl;
		
		?>

<div class="wrap">

    			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

						<h2><?php echo $themename; ?> Opciones</h2>

						<?php if ( $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?> se ha actualizado</div><?php } ?>
						<?php if ( $_REQUEST['reset'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?> se ha reseteado</div><?php } ?>						
						
						<div style="clear:both;height:20px;"></div>  			
						
						<!--START: GENERAL SETTINGS-->
     						
     						<table class="maintable">
     							
							<?php foreach ($options as $value) { ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<tr class="mainrow">
										<td class="titledesc" style="margin: -5px 0 0 0;vertical-align:text-top;"><?php echo $value['name']; ?></td>
										<td class="forminp">
		
									<?php } ?>		 
	
									<?php
										
										switch ( $value['type'] ) {
										
										case 'select':?>
										
											<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width: 300px">
	                						<?php $i=0; ?>
	                						<?php foreach ($value['options'] as $option) { ?>
	                							<?php $ids = $value['ids']; ?>
	                							<option<?php if ( get_settings( $value['id'] ) == $ids[$i]) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $ids[$i]; ?>"><?php echo $option; ?></option>
	                							<?php $i++; ?>
	                						<?php } ?>
	            							</select><?php
		
										break;
										
										case 'text': 
										?>
											<input size="80" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
										
										<?php
										break;
										
										case "checkbox":
										
											if(get_settings($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }?>
		            				
		            							<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /> Actívalo si deseas mostrar los bloques 3, 6 y 9, es decir, los de la columna derecha.<?php
		
										break;
										
									
										
										case "heading":

									?>
									
										</table> 
		    							
		    									<h3 class="title"><?php echo $value['name']; ?></h3>
										
										<table class="maintable">
		
									<?php
										
										break;
										default:
										break;
									
									} ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<?php if ( $value['type'] <> "checkbox" ) { ?><br/><br /><?php } ?><span><?php echo $value['desc']; ?></span>
										</td></tr>
	
									<?php } ?>		
									
							<?php } ?>	
							
							</table>	


							<p class="submit">
								<input name="save" type="submit" value="Guardar cambios" />    
								<input type="hidden" name="action" value="save" />
							</p>							
							
							<div style="clear:both;"></div>		
						
						<!--END: GENERAL SETTINGS-->						
             
            </form>



</div><!--wrap-->

<div style="clear:both;height:20px;"></div>
 
 <?php

};

add_action('admin_menu', 'valencia_blogs_add_admin');
add_action('admin_head', 'valencia_blogs_admin_head');


?>