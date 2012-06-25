<?php global $blog_id; ?>
	
<?php if ($related_query->have_posts()):?>
	
	<?php $i = 0; ?>
	
	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
	
		<?php if($i == 0): ?>
			<div class="minibox f-left">
			<p><a href="<?php the_permalink(); ?>" title="Foto de la entrada" class="img-rpa">
			<?php 
				if(has_post_thumbnail()) {
					the_post_thumbnail(array(180,115));
				} else {
					echo '<img src="'.get_bloginfo("template_url").'/img/imagen-por-defecto.jpg" />';
				}
			?></a><br class="clear" /></p>
			<h4><a href="<?php the_permalink(); ?>" title="Título de la entrada"><?php the_title(); ?></a></h4>
			<p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p>
			<br class="clear" />
			</div><!-- end minibox -->
	
		<?php elseif($i == 1): ?>
			<div class="minibox">
			<p><a href="<?php the_permalink(); ?>" title="Foto de la entrada" class="img-rpa">
			<?php 
				if(has_post_thumbnail()) {
					the_post_thumbnail(array(180,115));
				} else {
					echo '<img src="'.get_bloginfo("template_url").'/img/imagen-por-defecto.jpg" />';
				}
			?>
			</a><br class="clear" /></p>
			<h4><a href="<?php the_permalink(); ?>" title="Título de la entrada"><?php the_title(); ?></a></h4>
			<p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p>
			<br class="clear" />
			</div><!-- end minibox -->
	
		<?php elseif($i == 2): ?>
			<div class="minibox last-r">
			<p><a href="<?php the_permalink(); ?>" title="Foto de la entrada" class="img-rpa">
			<?php 
				if(has_post_thumbnail()) {
					the_post_thumbnail(array(180,115));
				} else {
					echo '<img src="'.get_bloginfo("template_url").'/img/imagen-por-defecto.jpg" />';
				}
			?>
			</a><br class="clear" /></p>
			<h4><a href="<?php the_permalink(); ?>" title="Título de la entrada"><?php the_title(); ?></a></h4>
			<p class="read-more"><a href="<?php the_permalink(); ?>" title="Leer más">leer más</a></p>
			<br class="clear" />
			</div><!-- end minibox -->
		<?php endif; ?>
		
		<?php $i++; ?>
	
	<?php endwhile; ?>

<?php else: ?>

	<p><?php echo 'No hay artículos relacionados';?></p>

<?php endif; ?>