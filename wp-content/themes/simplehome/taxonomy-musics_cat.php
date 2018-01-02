<?php get_header();?>

<?php 
$limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
$args = array(
	'post_type' => 'musics_mu',
    'orderby'   => date,
    'paged' => $paged,
	'posts_per_page'=>24,
); 
$loop=new WP_Query($args);

 ?>
 
<div class="container-mu con-mu">
 <div class="music">
 	<div class="heard">
    <ul>
		<?php
			$args = array(
				'taxonomy'   => 'musics_cat',
				'title_li'   => "0",
				'hide_empty' => 0
			);
  			wp_list_categories( $args );
		 ?>
      </ul>
         <div class="clear"></div>
	</div>

  <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="m_img">
            	<div class="mu_mask"></div>
                    <img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=280&w=280&q=75&zc=1&ct=1" alt="<?php the_title(); ?>">
             </div>
             <div class="mu_info">
             	<div class="mu_img">
                    <p><span>Artist</span>&nbsp;&nbsp;<?php echo get_post_meta( $post->ID, 'artist_value', true ); ?></p>
                    <h4><?php the_title(); ?></h4>
                    <!--<a class="mplay" href="#"></a>-->
                </div>
                <div class="music-wrapper">
                    <div class="me-wrap">
                    <audio class="wp-audio-shortcode" preload="none" style="width: 100%">
                    <source type="audio/mp3" src="<?php echo get_post_meta( $post->ID, 'music_url_mu_value', true ); ?>">
                    </audio>
                    </div>
                </div>
                
             </div>
        </article>

  <?php endwhile; ?>
  <div class="clear"></div>
 </div>
</div>




<?php get_footer(); ?>