<?php get_header(); ?>
<div class="wrapper" id="main">
	<section class="left">
		<div id="content" class="search_result">
			<?php 
			$allsearch = new WP_Query("s=$s&showposts=-1");
			$count = $allsearch->post_count;
			$keywords = wp_specialchars($s, 1);
			?>
			<?php if ($count==0) : ?>
			<h1>搜索结果</h1>
			<div class="error">
				<p>很遗憾，未找到相关内容，您可以尝试重新搜索或者发送邮件至<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a>。</p>
				<p><?php echo get_the_author_meta('nickname',1); ?>在收到您的来邮后会第一时间回复，非常感谢您的支持！</p>
			</div>
			<?php else : ?>
			<div class="header">
				<h1>搜索结果</h1>
				<p><?php echo '共找到含有“' . $keywords . '”的文章' . $count . '篇'; ?></p>
			</div>
			<?php get_template_part( 'content', '' ); ?>
			<?php endif; ?>
		</div>		
	</section>

	<section class="right">
		<?php get_sidebar(); ?>
	</section>
	
</div>
<?php get_footer(); ?>
