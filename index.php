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
								<h2 class="tit-ult">Último artículo</h2>
								<div id="left-post-content">
																
								
							<?php 
							global $post;
 							$myposts = get_posts('numberposts=1');
 							foreach($myposts as $post) :
   								setup_postdata($post);
 								
								?>
							
									<div class="entry-meta">
										
										<div class="comments">
											<span class="comments-link"><a title="Comentarios" href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a></span>
										</div><!-- end comments -->
										
										<div id="author">
											<div class="author-photo">
												<?php userphoto_the_author_thumbnail(); ?>
											</div><!-- end author-photo -->
											<span rel="bookmark" title="fecha" href="<?php echo get_month_link('', ''); ?>" class="date-post">
												<span class="entry-date"><?php $date = get_the_date(); echo strtolower($date); ?></span>
											</span>
											<span class="meta-sep">Escrito por</span> <span class="author vcard"><?php the_author_posts_link(); ?></span>
										</div><!-- end author -->
										<br class="clear" />
										
									</div><!-- end entry-meta -->
									
									<div class="entry-content">
										
										<div id="attachment_8" class="wp-caption alignright" style="width: 200px;">
											<a href="<?php the_permalink(); ?>" title="Teclas">
												<?php the_post_thumbnail('medium'); ?>
											</a>
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
											
											<?php
												remove_filter('get_the_excerpt', 'wp_trim_excerpt');
												add_filter('get_the_excerpt', 'excerpt_50');
												echo get_the_excerpt();
												remove_filter('get_the_excerpt', 'excerpt_50');
												add_filter('get_the_excerpt', 'wp_trim_excerpt');
											?>
											
											<div class="read-more-div"><p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p></div>
											
											<br />
											
											<div class="entry-utility">
												<span class="cat-links">
													<span class="entry-utility-prep entry-utility-prep-cat-links">Categorías: </span><?php the_category(', '); ?>
												</span>
												<br />
												<span class="tag-links">
													<span class="entry-utility-prep entry-utility-prep-tag-links">Temas: </span><?php the_tags(' ',', ',' '); ?>
												</span>
											</div><!-- end entry-utility -->
										
										</div><!-- end entrada -->
										
										<?php show_social_icons(); ?>
									</div><!-- end entry-content -->
					
			<?php endforeach; ?>
									
									
			<br class="clear" />
								
			<div id="more-content" class="l-post-c">
				<div class="lmc">
											
					<div class="separator-h">
						<hr />
					</div><!-- end separator-h -->

					<h3 class="tit-art-ant">Artículos anteriores</h3>
											
					
					<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

					<?php 	if($paged == 1):
								query_posts('posts_per_page=8&offset=1&paged='.$paged);
							else:
								query_posts('posts_per_page=8&paged='.$paged);
							endif;
					?>
					
					<?php $i = 0; ?>
					
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						
						<?php if($i%2 == 0): ?>		
							<div class="box-content">
								<br class="clear" />
								<div class="cat-img">
									<a href="<?php the_permalink(); ?>" title="Imagen de la categoría">
										<?php 
											if(has_post_thumbnail()) {
												the_post_thumbnail('thumbnail');
											} else {
												echo '<img src="'.get_bloginfo("template_url").'/img/imagen-def-portada.jpg" />';
											}
										?>	
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
							</div><!-- box-content -->
							
						<?php elseif($i%2 != 0): ?>
						
							<div class="box-content last-r">
								<br class="clear" />
								<div class="cat-img">
									<a href="<?php the_permalink(); ?>" title="Imagen de la categoría">
										<?php 
											if(has_post_thumbnail()) {
												the_post_thumbnail('thumbnail');
											} else {
												echo '<img src="'.get_bloginfo("template_url").'/img/imagen-def-portada.jpg" />';
											}
										?>
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
							</div><!-- end box-content last-r -->
							
						<?php endif; ?>
							
						<?php $i++; ?>
					
					<?php endwhile; ?>
					
											<br class="clear" />
											
											<div class="separator-h">
												<hr />
											</div><!-- end separator-h -->
										<div id="div-paginacion"><?php wp_pagenavi(); ?></div>
											
											
										</div><!-- end lmc -->
									</div><!-- end more-content -->
								
								</div><!-- end left-post-content -->								
<?php get_sidebar(); ?>
<?php get_footer(); ?>