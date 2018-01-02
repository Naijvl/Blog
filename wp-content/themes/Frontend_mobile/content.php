
<div class="post">
<?php if ( have_posts() ) : ?>
<?php while( have_posts() ) : the_post(); ?>

	

<div class="article_box">
	<div class="article_left">
		<div class="author_photo">
			<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '70' ); }?>
		</div>
	</div>
	<div class="article_body">
		<div class="authorname"><?php the_author_posts_link(); ?></div>
		<h2 class="title<?php if( is_sticky() ) echo " sticky"; ?>"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title_attribute(); ?></a></h2>
		<div class="content">
			<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<p class="summary"><?php echo content_excerpt(100); ?></p>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="article_pic">
						<?php the_post_thumbnail( array(80,80) ); ?>
					</div>
					
				<?php else : ?>	
					<ul class="atcbglist">	
						<?php catch_all_bg(); ?>					
					</ul>
				<?php endif; ?>
					
			<?php endif; ?>
		</div>
		<div class="article_foot">			
			<span class="category"><i class="ico ico-category"></i><?php the_category(' ', ''); ?></span> 
			<span class="date"><i class="ico ico-time"></i><?php the_time('Y-m-d'); ?></span>
			<?php comments_popup_link('0', '1', '%','replynum'); ?>
		</div>		
	</div>	
</div>
<?php endwhile; ?>

<?php else : ?>
<?php endif; wp_reset_query(); ?>
</div>
<div id="pagination"><?php next_posts_link(__('LOAD MORE')); ?></div>


<div class="displaybox">

</div>
