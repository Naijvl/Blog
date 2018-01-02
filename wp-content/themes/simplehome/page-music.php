<?php
/**
* Template Name: 音乐模板
*/
?>
<?php get_header(); ?>
<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.jplayer.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/scripts/jplayer.playlist.min.js" type="text/javascript"></script>
<script type="text/javascript">
 jQuery(document).ready(function() {  
   var musicName="";
	jQuery("#jquery_jplayer_1").jPlayer({
		ready: function () {	
		},
		play: function() { // To avoid multiple jPlayers playing together.
			jQuery(this).jPlayer("pauseOthers");
		},
		swfPath: "../../js",
		supplied: "mp3, oga",
		solution: "html,flash",
		wmode: "window",
		globalVolume: true,
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		cssSelector: { 
		 play: ".mi_play",  
         pause: ".mi_pause", 
		 }
		  
	});	 
	jQuery(".mi_play").click(function(){
		var tmpName = jQuery(this).attr("data-url");
		if(musicName == tmpName)
		{	
		jQuery(this).hide();
		jQuery(this).closest('.mlist').find('.mu_mask').animate({ opacity: "0" }, 200 );
		jQuery(this).parent().children(".mi_pause").show();
			jQuery("#jquery_jplayer_1").jPlayer("play");
		}else{
			musicName = tmpName;
			jQuery('.mu_mask').animate({ opacity: "0.35" }, 200 );
			jQuery(this).closest('.mlist').find('.mu_mask').animate({ opacity: "0" }, 200 );
			jQuery('.mi_play').show();
			jQuery(this).hide();
			jQuery('.mi_pause').hide();
			jQuery(this).parent().children(".mi_pause").show();
			jQuery("#jquery_jplayer_1").jPlayer("setMedia",{mp3:musicName}).jPlayer("play");
			}
	});
	jQuery(".mi_pause").click(function(){
			jQuery(this).closest('.mlist').find('.mu_mask').animate({ opacity: "0.35" }, 200 );
			jQuery(this).hide();
			jQuery(this).parent().children(".mi_play").show();
			jQuery("#jquery_jplayer_1").jPlayer("pause");
	});
});

</script>
<?php
$limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
$args = array(
	'post_type' => 'musics_mu',
    'orderby'   => date,
    'paged' => $paged,
	'posts_per_page'=>24,	
); query_posts($args);
//$loop = new WP_Query($args);
 ?>
<div class="container-mu con-mu">
 <div class="music">
 	<div class="heard">
    	<ul>
		<?php
			$args = array(
				'taxonomy'   => 'musics_cat',
				'title_li'   => "",
				'hide_empty' => 0
			);
			//$categories=get_categories($args);
  			wp_list_categories( $args );
		 ?>
     </ul>
         <div class="clear"></div>
	</div>
<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<?php while ( have_posts() ) : the_post();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mlist">
        <div class="mu_img">
        	<div class="mu_mask"></div>
           <img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=280&w=280&q=75&zc=1&ct=1" alt="<?php the_title(); ?>">
        </div>
        <div class="muatu">
            <p class="arts">Artist<span><?php echo get_post_meta( $post->ID, 'artist_value', true ); ?></span></p>
            <h4><?php the_title(); ?></h4>
            <div class="j-controls">
                <button class="mi_play" role="button" tabindex="0" data-url="<?php echo get_post_meta( $post->ID, 'music_url_mu_value', true ); ?>">play</button>
                <button class="mi_pause" role="button" tabindex="0">pause</button>
            </div>
        </div>
   </div>     
</article>
  <?php endwhile; 
  wp_reset_query();
  ?>
  <div class="clear"></div>
  <div class="pagenavi"><?php pagenavi(); ?></div>
 </div>
</div>
<?php get_footer(); ?>