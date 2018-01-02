<?php 
get_header();
$limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<?php

 ?>
    <!-- main container -->
    <div class="container">
    	<div class="article-list">
        <?php
		global $query_string;
		query_posts($query_string.'&orderby=id');
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			if (get_post_format() == 'aside') {
				//日志型文章
				include('article-aside.php');
			} else {
				//普通类型文章
				include('article-normal.php');
			}
			//当页面类型为Single或者Page时显示评论
			if (is_single() || is_page()) {
		?>
        <section class="comments">
			<h1>评论</h1>
			<div class="content">
			<?php
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
			else 
				echo "<p>评论关闭</p>";
			?>
			</div>
		</section>
        <?php
			}
			endwhile; else:
		?>
           <article class="article">
                <h1>Sorry, 没有文章</h1>
                <div class="aside">
                   没有文章
                </div>  
            </article>
		<?php
			endif;
			wp_reset_query();
		?>
			<div class="pagenavi"><?php pagenavi(); ?></div>
            <div class="clear"></div>
            <div class="footer">COPYRIGHT &copy;
             <?php  if(get_option('mytheme_mi_banq')){ 
				$banq=get_option('mytheme_mi_banq');
			?>
			<a href="<?php bloginfo('url'); ?>" target="_blank"><?php echo $banq; ?></a>
			<?php }else{ ?>
			<a href="<?php $my_theme = wp_get_theme();echo $my_theme->get( 'ThemeURI' );?>" target="_blank"><?php echo wp_get_theme();?></a>
			<?php }?>
            | <?=(get_option('mytheme_mi_beian')!='' ? stripslashes(get_option('mytheme_mi_beian')) : ' 闽ICP备 12002971号-1')?> | THEME DESIGN BY &nbsp;<a target="_blank" href="<?php $my_theme = wp_get_theme();echo $my_theme->get( 'AuthorURI' );?>"><?php $my_themew = wp_get_theme();echo $my_themew->get( 'Author' );?></a>
            
            </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>