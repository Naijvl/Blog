
<?php if (is_active_sidebar( 'widget_default')&&wp_is_mobile() ) : ?>
	<?php dynamic_sidebar( 'widget_default' ); ?>
<?php else: ?>
<div class="rightbox" id="most_commented">
	<h3>热评文章</h3>
	<ul>
		<?php most_commented_post(5, 36, 365, 'DESC'); ?>
	</ul>
	
</div>
<div class="rightbox" id="recent_commented">
	<h3>最新评论</h3>
	<ul>
		<?php recent_comments(6, 32, 32); ?>
	</ul>
	
</div>





<div class="rightbox tags">
	<h3>标签</h3>
	<div class="tagsbox">
	<?php wp_tag_cloud('smallest=12&largest=12&unit=px&number=45'); ?>
	</div>
</div>

<?php endif; ?>




