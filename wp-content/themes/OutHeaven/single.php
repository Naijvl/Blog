<?php get_header(); ?>
<div class="wrapper" id="main">
	<div class="left">
		<div id="content">
			<?php while (have_posts()) : the_post(); ?>
			<?php current_path(); ?>
			<div class="article_content">
				<div class="header">
					<h1 title="<?php the_title_attribute(); ?>"><?php the_title_attribute(); ?></h1>
					<div class="meta-data">
						<p class="fn"><i class="ico ico-author"></i>&nbsp;<?php the_author_posts_link(); ?></p>
						<span class="category"><i class="ico ico-category"></i>&nbsp;<?php the_category(' ', ''); ?></span>
						<?php the_tags('<span class="tag"><i class="ico ico-tag"></i>&nbsp;', ',', '</span>'); ?>				
						<span class="date"><i class="ico ico-time"></i>&nbsp;<?php the_time('Y-m-d'); ?></span>	
						<span class="comments"><i class="ico ico-reply"></i>&nbsp;<?php comments_popup_link('0', '1', '%'); ?>个回复</span>	
							
						<?php if ( !post_password_required() && comments_open() ) : ?>							
							<?php edit_post_link('编辑', '<span class="edit"><i class="ico ico-edit"></i>&nbsp;', '</span>'); ?>
						<?php endif; ?>	
					</div>					
				</div>
				<div class="content-inner">
					<?php the_content(); ?>
				</div>
			</div>


		
		<?php comments_template( '', true ); ?>
		<div class="contextbtn">
			<?php previous_post_link('<div class="change_article previous-article">上一篇：%link</div>', '%title',$in_same_cat = true); ?>
			<?php next_post_link('<div class="change_article next-article">下一篇：%link</div>', '%title',$in_same_cat = true); ?>			
		</div>


		<?php 
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$first_tag = $tags[0]->term_id;
				$args=array(
					'tag__in' => array($first_tag),
					'showposts' => 10,
					'caller_get_posts' => 1,
				);
				$related_query = new WP_Query($args);
				if( $related_query->have_posts() ) {
					echo '<div class="related-posts"><h3>相关文章</h3><ul>';
					while ($related_query->have_posts() ) : $related_query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
					<?php endwhile;
					echo '</ul></div>';
				} else {
					echo '<div class="random-articles"><h3>随机文章</h3><ul>';
					random_posts(10, 48);
					echo '</ul></div>';
				}
				wp_reset_query();
			} else {
				echo '<div class="random-articles"><h3>随机文章</h3><ul>';
				random_posts(10, 48);
				echo '</ul></div>';
			}
		?>


		
		<?php endwhile; ?>
		</div>

	</div>
	<div class="right">
		<?php get_sidebar(); ?>
	</div>	
</div>

<?php get_footer(); ?>