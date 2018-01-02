<?php if ( have_posts() ) : ?>
<?php while( have_posts() ) : the_post(); ?>
<div class="article_box">
	<div class="article_left">
		<div class="article_cover">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="article_pic">
						<?php the_post_thumbnail( array(80,80) ); ?>
					</div>
				<?php else : ?>											
					<?php catch_that_image(); ?>			
				<?php endif; ?>					
		</div>

		<span class="category"><?php the_category(' ', ''); ?></span>
		
	</div>
	<div class="article_body">
		<h2 class="title<?php if( is_sticky() ) echo " sticky"; ?>"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title_attribute(); ?></a></h2>
		<div class="content">
			<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<p class="summary"><?php echo content_excerpt(200); ?></p>

				
			<?php endif; ?>
		</div>
			<div class="article_meta">
				<?php the_tags('<span class="tag" title="标签">', ',', '</span>'); ?>

				<span class="date">发表时间：<?php the_time('Y-m-d'); ?></span>
				<span class="reply">
					回复：<?php comments_popup_link('0', '1', '%','replynum'); ?>
				</span>
				
		
	</div>		
	</div>	

	



</div>
<?php endwhile; ?>
<?php page_navigation(10); ?>
<?php else : ?>
<?php endif; wp_reset_query(); ?>
