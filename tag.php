<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="main" class="left-align">
					<div id="container">
						
						<div id="content">
							
							<div class="post" id="post">

								<div id="left-post-content">
									<h2 class="titulo-archivo">
										<?php printf( __( 'Artículos sobre: %s', 'twentyten' ), '<span>' . strtolower(single_tag_title( '', false )) . '</span>' ); ?>
									</h2>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'archive' );
?>
					<div id="div-paginacion-archivo">
									<div class="separator-h">
										<hr />
									</div><!-- end separator-h -->
							
									<div id="div-paginacion-archive"><?php wp_pagenavi(); ?></div>
					</div>
			
			</div><!-- end left-post-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
