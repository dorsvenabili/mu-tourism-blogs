<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
//Mostramos el feed y el código de feedburner que hayan seleccionado en el panel de administración: RSS Opciones.
$url_feed_blog = get_option('valencia_blogs_rss');
$codigo_feedburner_suscrip_email = get_option('valencia_blogs_email_rss');

?>
		<div id="righ-post-content">
								
									<div class="col-box">
										<h4 class="rss-box">Suscripción</h4>
										<div id="rss-box">
											<p class="bottom-sep"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/icos/ico-rss-big.gif" alt="Suscripción RSS - Icono RSS" width="41" height="41" /> <a href="<?php echo $url_feed_blog; ?>" title="Suscripción RSS">Suscribirse RSS / Feed</a><br class="clear" /></p>
											
										
											<p style="font-size: 0.7em;">Suscríbete a través de tu dirección de correo electrónico.</p>
											
											<div id="mail-sus">
											<?php /*global $blog_id;
												if ($blog_id == 2){
													$uri = 'comunitatvalenciana/cAuE';
												}
												if ($blog_id == 3){
													$uri = 'comunitatvalenciana/pHyK';
												}
												if ($blog_id == 4){
													$uri = 'comunitatvalenciana/tdio';
												}
												if ($blog_id == 5){
													$uri = 'comunitatvalenciana/jyVn';
												}
												if ($blog_id == 6){
													$uri = 'comunitatvalenciana/Surf';
												}
												if ($blog_id == 7){
													$uri = 'comunitatvalenciana/btt';
												}*/
												
												?>
												<form method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?= $codigo_feedburner_suscrip_email; ?>' 'popupwindow', 'scrollbars=yes,width=550,height=400');return true">
													   						   
													   <label for="send" class="skip">Enviar</label>
													   <input id="send" type="text" name="email" class="inp-s-b" />
													   <input type="hidden" value="<?php echo $codigo_feedburner_suscrip_email; ?>" name="uri"/>
													   <input type="hidden" name="loc" value="es_ES"/>
													   <label for="sndbtn" class="skip">Ir a la búsqueda</label>
													   <input id="sndbtn" type="submit" name="sndbtn" value="Enviar" />
												</form>
											</div><!-- end mail-sus -->
										</div><!-- end rss-box -->
									</div><!-- end col-box -->
									

									<div class="col-box">
										<?php 
											$args = array('posts_per_page' => 1,'post__in'  => get_option('sticky_posts'),'caller_get_posts' => 1);
											query_posts($args);
										?>
										<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
											<h4 class="tit-author"><?php the_author(); ?></h4>
											<div class="aut-dat">
												<p id="texto-autor">
													<?php 
														userphoto_the_author_photo(); 
														$text = get_the_author_meta('description');

														echo excerpt_30($text); 
													?>
												</p>
												<p class="read-more"><a href="<?php bloginfo('home'); ?>/author/<?php the_author_meta('user_login'); ?>/" title="Leer más">leer más</a></p>
											</div><!-- end aut-dat -->
										<?php endwhile; ?>
									</div><!-- end col-box -->
								
									<div id="sidebar">
										<div id="primary" class="widget-area">
											<ul class="xoxo">
												<li id="archives" class="widget-container">
													<h3 class="widget-title">Archivos</h3>
													<br class="clear" />
													<ul>												
<?php
/*Calculamos el número de posts de ese año*/

$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) < YEAR (CURRENT_DATE)  ORDER BY post_date ASC");

foreach($years as $year):
{
$num_ano = $wpdb->get_col("SELECT DISTINCT COUNT(YEAR(post_date)) AS num_ano FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."'");
?>
	<li><a href="<?php echo get_year_link($year); ?>" id="enlace_ano_actual1" OnMouseOver="document.getElementById('archivo-desplegable1').className = 'archivo-desplegado1'"><?php echo $year; ?> (<?=$num_ano[0] ?>)</a></li>

	<ul id="archivo-desplegable1" class="archivo-sin-desplegar1">
		<?	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ORDER BY post_date ASC");
			foreach($months as $month) :
			{
				$num_mes = $wpdb->get_var("SELECT COUNT(ID) as num_mes FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND MONTH(post_date) = '".$month."' AND YEAR(post_date) = '".$year."'");
				?>
				<li><a href="<?php echo get_month_link($year, $month); ?>" OnMouseOver="document.getElementById('archivo-desplegable1').className = 'archivo-desplegado1'"><?php echo mes($month); ?></a><?php echo " (".$num_mes.")"; ?></li>
			<?php }endforeach;?>
	</ul>
<?php }
endforeach; ?>
<?php
/**/
$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = YEAR (CURRENT_DATE)  ORDER BY post_date ASC");
foreach($years as $year):
{ 
$num_ano = $wpdb->get_col("SELECT DISTINCT COUNT(YEAR(post_date)) AS num_ano FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."'");
?>
	<li><a href="<?php echo get_year_link($year); ?>" id="enlace_ano_actual2" OnMouseOver="document.getElementById('archivo-desplegable2').className = 'archivo-desplegado2'"><?php echo $year; ?> (<?=$num_ano[0] ?>)</a></li>

	<ul id="archivo-desplegable2" class="archivo-sin-desplegar2">
		<?	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ORDER BY post_date ASC");
			
			foreach($months as $month)
			{
				$num_mes = $wpdb->get_var("SELECT COUNT(ID) as num_mes FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND MONTH(post_date) = '".$month."' AND YEAR(post_date) = '".$year."'");
				?>
				<li><a href="<?php echo get_month_link($year, $month); ?>" OnMouseOver="document.getElementById('archivo-desplegable2').className = 'archivo-desplegado2'"><?php echo mes($month); ?></a><?php echo " (".$num_mes[0].")"; ?></li>
				
				
			<?php }?>
	</ul>
<?php }
endforeach; ?>
												
												
												
													</ul>
												</li>

												<li id="flicker-w" class="widget-container">
													<h3 class="widget-title">Flickr</h3>
													<ul>
														<?php get_flickrRSS(); ?>
													</ul>

													<br class="clear" />
													<p class="flickr-link"><a href="#" title="A Flickr"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/flickr-logo.jpg" alt="A Flickr" width="57" height="16" /></a></p>													
												</li>
												
												<?php								
															if ( is_active_sidebar( 'debajo-flickr-widget-area' ) ) : // Nothing here by default and design
																
															?><li id="archives" class="widget-container"><?php	
																dynamic_sidebar( 'debajo-flickr-widget-area' );	
																
															?></li><?php
															else:
															endif;								
												?>
												
												<!-- Lo más leido y lo más comentado -->
												<li id="archives" class="widget-container">
         				 								<?php
												
												//Variables para mostrar Lo más leído
												$instance = lomasleido();		
												
												//Variables para mostrar Lo más comentado
												$instance2 = lomascomentado();		
												
												$lomas = new WordpressPopularPosts(); 
													?>
														<h3 id="lo-mas-leido" class="widget-title-lo-mas titulo-arriba"><a href="<?php the_permalink(); ?>#lo-mas-leido" 
														OnMouseOver="document.getElementById('ul-lo-mas-leido').className = 'mostrar-ul'; 
																	document.getElementById('ul-lo-mas-comentado').className = 'no-mostrar-ul';
																	document.getElementById('ul-lo-mas-votado').className = 'no-mostrar-ul';
																	document.getElementById('lo-mas-leido').className = 'widget-title-lo-mas titulo-arriba'; 
																	document.getElementById('lo-mas-comentado').className = 'widget-title-lo-mas titulo-abajo'; 
																	document.getElementById('lo-mas-votado').className = 'widget-title-lo-mas titulo-abajo'">Lo más leído</a>
														</h3>	
														<h3 id="lo-mas-comentado" class="widget-title-lo-mas titulo-abajo" style="margin-left:6px; margin-right:6px;"><a href="<?php the_permalink(); ?>#lo-mas-leido" 
														OnMouseOver="document.getElementById('ul-lo-mas-leido').className = 'no-mostrar-ul'; 
																	document.getElementById('ul-lo-mas-comentado').className = 'mostrar-ul';
																	document.getElementById('ul-lo-mas-votado').className = 'no-mostrar-ul';
																	document.getElementById('lo-mas-leido').className = 'widget-title-lo-mas titulo-abajo'; 
																	document.getElementById('lo-mas-comentado').className = 'widget-title-lo-mas titulo-arriba'; 
																	document.getElementById('lo-mas-votado').className = 'widget-title-lo-mas titulo-abajo'">...comentado</a>
														</h3>
														<h3 id="lo-mas-votado" class="widget-title-lo-mas titulo-abajo"><a href="<?php the_permalink(); ?>#lo-mas-leido" 
														OnMouseOver="document.getElementById('ul-lo-mas-leido').className = 'no-mostrar-ul'; 
																	document.getElementById('ul-lo-mas-comentado').className = 'no-mostrar-ul';
																	document.getElementById('ul-lo-mas-votado').className = 'mostrar-ul';
																	document.getElementById('lo-mas-leido').className = 'widget-title-lo-mas titulo-abajo'; 
																	document.getElementById('lo-mas-comentado').className = 'widget-title-lo-mas titulo-abajo'; 
																	document.getElementById('lo-mas-votado').className = 'widget-title-lo-mas titulo-arriba'">...votado</a>
														</h3>		
													<?php	
													
														//Muestra los más leídos
														echo $lomas->get_popular_posts($instance, false);
														//Muestra los más comentados
														echo $lomas->get_popular_posts_mas_comentado($instance2, false);
															
															
														//Vamos a hacer una consulta en la BD para saber cuales son los más votados
														global $wpdb, $blog_id;
														$votaciones = $wpdb->get_results("SELECT post_id, user_voters, user_votes FROM wp_".$blog_id."_gdsr_data_article WHERE user_votes <> 0.0 ORDER BY user_votes DESC LIMIT 8");													
													?>
														<ul id="ul-lo-mas-votado" class="no-mostrar-ul">
															<?php 
																if($votaciones){
																
																	$i = 0;
																
																	foreach($votaciones as $voto){ 																		
																			$media[$i] = ($voto->user_votes)/($voto->user_voters);
																			$post_id[$i] = $voto->post_id;
																			$i++;																		
																	}
																	
																	$algo = $media;
																	
																	for ($h=0;$h<count($algo);$h++){
   																		for($j=0;$j<count($algo);$j++){
          																	if ($algo[$h]> $algo[$j]){
                  																$temp = $algo[$h];
                  																$algo[$h]=$algo[$j];
                  																$algo[$j]=$temp;
           																	}
   																		}
																	}
																	
																	for ($h=0;$h<5;$h++){
																		
																			for($k=0;$k<5;$k++){
																				if($algo[$h] == $media[$k]){
																					$id = $post_id[$k];
																				}
																			}
																			
																			if($id){
																				//Si la votación está vacía no se muestra
																				if($algo[$h] != ''){
																					echo '<li>';
																					//Obtenemos el título y el enlace del post
																					$datos_post = $wpdb->get_row("SELECT * FROM wp_".$blog_id."_posts WHERE ID = ".$id."");
																																						
																					echo '<a href="'.$datos_post->guid.'">'.$datos_post->post_title.' <span class="post-stats"><span class="wpp-comments">(Valoración: '.$algo[$h].')</span></span></a>';
																					echo '</li>';
																				}
																			}
																	}
																	 
																
																}//if($votaciones)
															?>
														</ul>
													</li>
													<br />
													
													<?php
															
															if ( is_active_sidebar( 'debajo-mas-comentado-widget-area' ) ) : // Nothing here by default and design
																?><li id="archives" class="widget-container"><?php
																
																dynamic_sidebar( 'debajo-mas-comentado-widget-area' );
																
																?></li><?php
															else:
															endif;								
													?>
												
												<li id="archives" class="widget-container">
													<h3 class="widget-title">Enlaces de interés</h3>
													<br class="clear" />												
													<ul>
														<?php wp_list_bookmarks('title_li=&categorize=2&title_before=<li>&title_after=</li>'); ?>
													</ul>
												</li>
												
												<li id="tags-w" class="widget-container">
													<h3 class="widget-title">Flickr</h3>
													<br class="clear" />
													<div class="tags-wrap">
														<?php wp_tag_cloud('smallest=9&largest=22&number=18'); ?>
													</div><!-- end tags-wrap -->
												</li>
												
												<li>
													<?php if ( is_active_sidebar( 'tercer-widget-area' ) ) : // Nothing here by default and design ?>

													<div class="box-content-b">
														<h4 class="tit-lmv">Lo más valorado</h4>
														<div class="content-bcb">
										
															<?php dynamic_sidebar( 'tercer-widget-area' ); ?>
										
														</div><!-- end content-bcb -->
													</div><!-- end box-content-b -->
													<?php else: ?>
													<?php endif; ?>

												</li>
												
											</ul>
										</div><!-- end primary -->
									</div><!-- end sidebar -->
								
								</div><!-- righ-post-content -->
																<br class="clear" />
							</div><!-- end post -->
							
						</div><!-- end content -->
						
					</div><!-- end container -->
