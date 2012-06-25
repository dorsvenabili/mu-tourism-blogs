<?php 

get_header();

global $post;
?>				
				
				
				
				<div id="main" class="left-align">
					<div id="container">
						
						<div id="content">
							<div class="navigation skip" id="nav-above">
								<div class="nav-previous"><?php previous_post_link('<strong>%link</strong>'); ?></div>
								<div class="nav-next"><?php next_post_link('<strong>%link</strong>'); ?> </div>
							</div><!-- end nav-above -->
							
							<div class="post" id="post">

								<div id="left-post-content">
								
							 <?php $counter = 1; // truquito para mostrar el primero en grande y después los posteriores ?>
				
								<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
								<?php if ($counter == 1): ?>

									<div class="entry-meta">
										
										<div class="comments">
											<span class="comments-link"><a title="Comentarios" href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a></span>
										</div><!-- end comments -->
										
										<div id="author">
											<div class="author-photo">
												<?php userphoto_the_author_thumbnail(); ?>
											</div><!-- end author-photo -->
											<a rel="bookmark" title="fecha" href="<?php echo get_month_link('', ''); ?>" class="date-post">
												<span class="entry-date"><?php echo get_the_date(); ?></span>
											</a>
											<span class="meta-sep">Escrito por</span> <span class="author vcard"><?php the_author_posts_link(); ?></span>
										</div><!-- end author -->
										<br class="clear" />
										
									</div><!-- end entry-meta -->
									
									<div class="entry-content">
										
										<div id="attachment_8" class="wp-caption alignright" style="width: 550px;">
											<?php the_post_thumbnail(); ?>
											<p class="wp-caption-text">
												<?php //Ahora vamos a mostrar la leyenda de la imagen si la tiene
															 $post_thumbnail_id = get_post_thumbnail_id();
															 $post_thumbanil = get_post($post_thumbnail_id);
															 echo $post_thumbanil->post_excerpt;
												?>
											</p>
										</div>
										
										
										<div id="entrada">
		
											<h3 class="entry-title">
												<a rel="bookmark" title="Permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											
											<?php the_content('leer más'); ?>
											
											<div class="entry-utility">
												<span class="tag-links">
													<span class="entry-utility-prep entry-utility-prep-tag-links">Temas: </span><?php the_tags(' ',', ',' '); ?>
												</span>
											</div><!-- end entry-utility -->
										
										</div><!-- end entrada -->
										
										<div class="social">
											<ul>
												<li><a href="http://twitter.com/mecusprueba" title="Twitter"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-tt-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Twitter</span></a></span></li>
												<li><a href="http://delicious.com/mecus" title="Delicious"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-del-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Delicious</a></span></li>
												<li><a href="http://www.facebook.com/turismovalencia" title="Facebook"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-fb-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Facebook</a></span></li>
												<li><a href="#" title="Email"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-mail-small.gif" alt="Icono" width="16" height="16" /> <span class="skip">Email</span></a></li>
											</ul>
										</div><!-- end social -->
									</div><!-- end entry-content -->
									
									
									
											<?php $counter++; ?>
		<?php else: ?>

		<?php if ($counter == 2): ?>
				<h2 class="recent-entries">Artículos anteriores </h2>			
		<?php endif; ?>
		
		<?php $counter++; ?>

			<div class="otras_noticias">
			<p style="padding-left:20px;"><a href="<?php the_permalink(); ?>" title="Foto de la entrada" class="img-rpa"><?php the_post_thumbnail('thumbnail'); ?></a><br class="clear" /></p>
			<h4><a href="<?php the_permalink(); ?>" title="Título de la entrada"><?php the_title(); ?></a></h4>
			<p><?php the_excerpt(' '); ?></p>
			<p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p>
			<br class="clear" />
			</div><!-- .otras_noticias -->


		<?php endif; ?>									
									
					<?php endwhile; ?>
									<br class="clear" />
								
									<div id="more-content" class="l-post-c">
										<div class="lmc">
											
											<div class="separator-h">
												<hr />
											</div><!-- end separator-h -->
											
											<?php 
													//Entradas Relacionadas
													//related_posts(); 
											?>
											
											<br class="clear" />
											
											<div class="separator-h">
												<hr />
											</div><!-- end separator-h -->
											
									
											<?php 
											//	$args = array('posts_per_page' => 1,'post__in'  => get_option('sticky_posts'),'caller_get_posts' => 1);
											//	query_posts($args);
											?>
											<!--<h3 class="tit-coments">Comentarios</h3>-->
											<?php //if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
												<?php //$withcomments = 1; ?>
												<?php //comments_template( '', true ); ?>
												
											<?php// endwhile; ?>
											
											
											
										</div><!-- end lmc -->
									</div><!-- end more-content -->
								
								</div><!-- end left-post-content -->								
<?php get_sidebar(); ?>
<?php get_footer(); ?>