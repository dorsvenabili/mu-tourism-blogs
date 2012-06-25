<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<!--[if lt IE 7]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
		<![endif]--> 

		<!--[if lt IE 8]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
		<![endif]--> 
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" type="image/x-icon" /> 
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<?php 
	$url_blog_actual = get_bloginfo('url'); 
	$url_blog_principal = explode('/',$url_blog_actual);
	global $blog_id; 
?>
</head>

	<body>
		<div id="fondo<?php if ($blog_id < 8) echo '-'.$blog_id; ?>">
			<div id="wrapper">
				<div id="header" class="left-align">
					<div id="mainnav">
						<div class="head-box">
							<ul class="mainnavegation">
								<li><a href="<?php bloginfo('home'); ?>" title="Inicio" accesskey="0" <?php if (is_home()) echo 'class=" selected"'; ?>>Inicio</a></li>
								<li><a href="http://<?php echo $url_blog_principal[2]; ?>/" title="Inicio" accesskey="0">Red de blogs</a></li>
								<li><a href="<?php bloginfo('home'); ?>/contacto/" title="Contacto" accesskey="1"<?php if (is_page('28')) echo 'class="selected"'; ?>>Contacto</a></li>
								<li><a href="<?php bloginfo('home'); ?>/acerca-de/" title="Acerca de" accesskey="2"<?php if (is_page('2')) echo 'class="selected"'; ?>>Acerca de</a></li>
								<?php /*?><li><a href="<?php bloginfo('home'); ?>/crea-tu-blog/" title="Crea tu blog">Crea tu blog</a></li><?php */ ?>
							</ul>
						</div><!-- end head-box -->
						
						<div class="head-box fright">
							<ul class="metanav">
								<?php								
									if ( is_active_sidebar( 'second-header-widget-area' ) ) : // Nothing here by default and design
										dynamic_sidebar( 'second-header-widget-area' );	
									else:
									endif;								
								?>
								<?php /*
								<li><a href="http://www.comunidad-valenciana.org/" title="Consellería de Turisme" accesskey="3">Conselleria de Turisme</a></li>
								<li><a href="<?php bloginfo('home'); ?>/suscripcion/" title="Suscripción RSS" accesskey="4" class="rss-link" style="margin-left:5px;padding: 15px 18px 0;">Suscripción</a></li>
								*/ ?>
							</ul>
						</div><!-- end head-box -->
						
						<div class="searchform">
							<form role="search" method="get" id="searchform" action="<?php bloginfo('home'); ?>">
								 <fieldset>								  
									<label class="screen-reader-text" for="s"></label>
									<input type="text" value="" name="s" id="s" class="input-search-top" />
									<input id="imtbtn" type="submit" name="imtbtn" value="" />
								</fieldset>
							</form>
						</div><!-- end searchform -->
						
						<br class="clear" />
					</div><!-- end mainnav -->
					<h1 id="logo"><a href="<?php bloginfo('home'); ?>" title="Al inicio" accesskey="0">Blogs Comunitat Valenciana</a></h1>
					<?php if ($blog_id > 7): ?>
					<div class="title_cabecera"><?php bloginfo('name'); ?></div>
					<div class="image_cabecera"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /></div>
					<div class="image_sobrecabecera"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/head_base.png" /> </div>
					<?php endif; ?>
				</div><!-- end header -->