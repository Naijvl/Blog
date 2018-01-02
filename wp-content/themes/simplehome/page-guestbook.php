<?php
/**
* Template Name: Guestbook
*/
?>
<?php 
get_header();
?>
    <!-- main container -->
    <div class="container">
    	<div class="article-list">
        <?php
		global $query_string;
		query_posts($query_string.'&orderby=id');
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		?>
        <article class="article">
        <?php $_thumbnail=true;if(post_thumbnail_src()==false){$_thumbnail=false;} ?>
        		<?php
                if (get_post_meta($post->ID, "music_url_value", true)) {
                ?>
                <div class="post-format-audio">
                    <div class="feature-img audio">
                    <?php if ( $_thumbnail == true ) { ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=450&w=1310&q=88&zc=1&ct=1" alt="<?php the_title(); ?>"></a>
                      <?php } ?>  
                       <div class="audio-wrapper">
                                <div class="me-wrap">
                                <audio class="wp-audio-shortcode" preload="none" style="width: 100%">
                                <source type="audio/mp3" src="<?php echo get_post_meta( $post->ID, 'music_url_value', true ); ?>">
                                </audio>
                                </div>
                            </div>	
                </div>
                </div>
                <?php
				} else {?>
            	<?php if ( $_thumbnail == true ) { ?>
                <div class="feature-img">
                	<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=450&w=1310&q=88&zc=1&ct=1" alt="<?php the_title(); ?>" ></a>
                </div>
				<?php }
				}?>
			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?></a></h1>
            <div class="content">
                <?php
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
                else 
                    echo "<p>评论关闭</p>";
                ?>
            </div>
        </article>
            <?php
                endwhile; else:
            ?>
               <article class="article">
                    <h1>404</h1>
                    <div class="aside">
                       I'm so Sorry.
                    </div>  
                </article>
            <?php
                endif;
                wp_reset_query();
            ?>
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
            </div>
            <?php get_sidebar(); ?>
        </div>
<?php get_footer(); ?>