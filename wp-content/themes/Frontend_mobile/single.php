<?php get_header(); ?>
<div class="wrapper" id="main">
	<div class="single_body">
		<div id="content">
			<?php while (have_posts()) : the_post(); ?>
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


		<?php if (function_exists('wpfp_link')) { wpfp_link(); } ?>
		<?php comments_template( '', true ); ?>
		<div class="contextbtn">
			<?php previous_post_link('<div class="change_article previous-article">上一篇：%link</div>', '%title',$in_same_cat = true); ?>
			<?php next_post_link('<div class="change_article next-article">下一篇：%link</div>', '%title',$in_same_cat = true); ?>			
		</div>
		
		<?php endwhile; ?>
		</div>

	</div>
</div>
