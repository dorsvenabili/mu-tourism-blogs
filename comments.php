<div id="comments">

	<?php if ( post_password_required() ) : ?>
				<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></div>
			</div><!-- .comments -->
	<?php
		return;
	endif;
	?>

	<?php
	// You can start editing here -- including this comment!
	?>

	<?php if ( have_comments() ) : ?>
			

	<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?></div>
			</div>
	<?php endif; // check for comment navigation ?>

			<ol id="l-comets">
				<?php wp_list_comments( array( 'callback' => 'valencia_comment') ); ?>
			</ol>

	<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyten' ) ); ?></div>
			</div>
	<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

	<?php else : // if comments are closed ?>

		<p class="nocomments"><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>

	<?php endif; ?>
	<?php endif; ?>


<!-- Aquí comienza el formulario de comentarios -->
	<br />
	<h3 class="tit-dejar-com">Comentarios</h3>
									
	<div id="post-com-w">
		<p class="info-xhtml-tags"><strong>Puedes utilizar las etiquetas más habituales de XHTML en tu comentario.</strong></p>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
			<?php if ( $user_ID ) : ?>
				<p>Estás logueado como: <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Desloguearme &raquo;</a></p>

			<?php else : ?>
			<fieldset>
				<legend class="skip">Formulario para comentar</legend>						   
				
				<div id="comment-user-details"> <?php do_action('alt_comment_login'); ?>								   
					<label for="name" class="skip">Nombre</label>
					<input id="author" type="text" name="author" class="input-name-c" value="<?php echo $comment_author; ?>" /> <strong>Nombre</strong><br />
													   
					<label for="email" class="skip">Email</label>
					<input id="email" type="text" name="email" class="input-mail-c" value="<?php echo $comment_author_email; ?>" /> <strong>Email</strong> (no será publicado)<br />
													   
					<label for="website" class="skip">Sitio web</label>
					<input id="url" type="text" name="website" class="input-webs-c" value="<?php echo $comment_author_url; ?>" /> <strong>Sitio web</strong><br />
				</div>
				<?php endif; ?>
													   
				<label for="coment-area" class="skip">Comentario</label>
				<strong>Comentario</strong><br />
													   
				<textarea id="area-comentario" name="comment" rows="5"></textarea>
													   
				<br />
													   
				<label for="snd-com" class="skip">Enviar comentario</label>
				<p class="btn-snd-wrap">
					<input id="snd-com" type="submit" name="submit" value="Enviar" class="btn-snd-com" />
					<?php comment_id_fields(); ?>
				</p>

				<?php do_action('comment_form', $post->ID); ?>
			</fieldset>
		</form>
		
		<?php /*
		<h4>Previsualización</h4>
			<div id="preview-post">
				<p>...</p>
			</div><!-- end preview-post -->
			
			*/ ?>
			<p class="com-sus"><a href="#" title="Suscripción a comentarios">Suscribirse a la los comentarios</a> (recibirás un mail cada vez que alguien responda).</p>
			<br class="clear" />
		
	</div><!-- end post-com-w -->
	
	<?php /*
	<h1>Escribe tu comentario</h1>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>

		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

	<?php else : ?>

		<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
		<label for="author"><small>Nombre <?php if ($req) echo "(obligatorio)"; ?></small></label></p>

		<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
		<label for="email"><small>Correo electrónico (no será publicado) <?php if ($req) echo "(obligatorio)"; ?></small></label></p>

		<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		<label for="url"><small>Web</small></label></p>

	<?php endif; ?>

	<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
	<br />
	<p><textarea name="comment" id="comment" cols="45%" rows="10" tabindex="4"></textarea>
	<label for="comment"><small>Texto del comentario</small></label></p>
	
	<p id="tags-permitidas">
		<a href="#" id="a-tags-permitidas"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/ayuda.jpg" />
			<span>Puedes usar las siguientes etiquetas y atributos HTML: 
				<code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt;
				</code>
			</span>
		</a>
	</p>

	<p><input name="submit" type="submit" id="submit" tabindex="5" value="Enviar" />
		<?php comment_id_fields(); ?>
	</p>
	<?php do_action('comment_form', $post->ID); ?>
	*/ ?>

</form>

<!-- Aquí termina el formulario de comentarios -->

</div><!-- #comments -->