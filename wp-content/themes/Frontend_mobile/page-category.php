<?php get_header(); ?>
<div class="wrapper" id="main">
<?php if (is_active_sidebar( 'widget_default') && wp_is_mobile() ) : ?>
	<?php dynamic_sidebar( 'widget_default' ); ?>
<?php endif; ?>
	
</div>
<?php get_footer(); ?>