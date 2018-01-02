<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/images/css/style.css" />
<script type='text/javascript' src="<?php bloginfo('template_url'); ?>/images/js/modernizr.min.js"></script>
<script type='text/javascript'>
/* <![CDATA[ */
var CSSettings = {"pluginPath":"images"};
/* ]]> */
</script>
<script type='text/javascript' src="<?php bloginfo('template_url'); ?>/images/js/cute.slider.js"></script>
<script type='text/javascript' src="<?php bloginfo('template_url'); ?>/images/js/cute.transitions.all.js"></script>

 <?php
				global $wpdb;
				$table_name = $wpdb->prefix;
				$blogUrl = 'http://'.$_SERVER['HTTP_HOST'];
				//$term_id = $wpdb->get_var("SELECT term_id FROM ".$table_name."terms WHERE name = 'post-format-image'");
		 		//$term_taxonomy_id = $wpdb->get_var("SELECT term_taxonomy_id FROM ".$table_name."term_taxonomy WHERE term_id = $term_id");
		  		$object_id = select_postmeta_key('flag','f');
          		query_posts( array ( 'post__in' => $object_id ,'cat'=>show_category_id()) ); ?>
   <div class="c-860 c-demoslider">
  <div id="cuteslider_3_wrapper" class="cs-circleslight">
    <div id="cuteslider_3" class="cute-slider" data-width="1200" data-height="438" data-overpause="true">
      <ul data-type="slides">
     <?php if($object_id[0]){while(have_posts()) : the_post(); ?> 
       <li data-delay="5" data-src="5" data-trans3d="tr6,tr17,tr22,tr23,tr26,tr27,tr29,tr32,tr34,tr35,tr53,tr54,tr62,tr63,tr4,tr13" data-trans2d="tr3,tr8,tr12,tr19,tr22,tr25,tr27,tr29,tr31,tr34,tr35,tr38,tr39,tr41">
        <img  src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo get_post_meta(get_the_ID(),'flashPic',true);?>&h=438&w=1200&q=90&zc=1&ct=1" data-src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo get_post_meta(get_the_ID(),'flashPic',true);?>&h=438&w=1200&q=90&zc=1&ct=1" data-thumb="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo get_post_meta(get_the_ID(),'flashPic',true);?>&h=60&w=60&q=70&zc=1&ct=1" alt="<?php the_title(); ?>">
        <a data-type="link" href="<?php the_permalink(); ?>" target="_blank"></a></li>
  <?php endwhile; wp_reset_query();}?>
     
     
      </ul>
      <ul data-type="controls">
        <li data-type="captions"></li>
        <li data-type="link"></li>
        <li data-type="video"></li>
        <li data-type="slideinfo"></li>
        <li data-type="circletimer"></li>
        <li data-type="previous"></li>
        <li data-type="next"> </li>
        <li data-type="bartimer"></li>
        <li data-type="slidecontrol" data-thumb="true" data-thumbalign="up"></li>
      </ul>
    </div>
    <div class="cute-shadow"><img src="<?php bloginfo('template_url'); ?>/images/bg/shadow.png" alt="shadow"></div>
  </div>
  <p><script type="text/javascript">var cuteslider3 = new Cute.Slider();cuteslider3.setup("cuteslider_3" , "cuteslider_3_wrapper", "<?php bloginfo('template_url'); ?>/images/css/slider-style.css");cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_START, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_END, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.WATING, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, function(event) { });cuteslider3.api.addEventListener(Cute.SliderEvent.WATING_FOR_NEXT, function(event) { });</script> 
</div>
   
   
   
   
    

  
