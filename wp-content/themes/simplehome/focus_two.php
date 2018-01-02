<script type='text/javascript' src="<?php bloginfo('template_url'); ?>/scripts/jquery.flexslider-min.js"></script>
<script type="text/javascript">
   
    jQuery(window).load(function(){
      jQuery('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){	
				jQuery('.flexslider').animate({'opacity':'1'},600)
			
        }
      });
	  window.onresize = function(){
			  //var flhr=jQuery('.flexslider img').height();	
			  //jQuery('.flexslider').height(flhr)
		 
	  };
	
	  
    });
  </script>
<?php
				global $wpdb;
				$table_name = $wpdb->prefix;
				$blogUrl = 'http://'.$_SERVER['HTTP_HOST'];
				//$term_id = $wpdb->get_var("SELECT term_id FROM ".$table_name."terms WHERE name = 'post-format-image'");
		 		//$term_taxonomy_id = $wpdb->get_var("SELECT term_taxonomy_id FROM ".$table_name."term_taxonomy WHERE term_id = $term_id");
		  		$object_id = select_postmeta_key('flag','f');
          		query_posts( array ( 'post__in' => $object_id ,'cat'=>show_category_id()) ); ?>

     	
       <div class="flexslider">
          <ul class="slides">
          <?php if($object_id[0]){while(have_posts()) : the_post(); ?> 
            <li>
  	    	   <a href="<?php the_permalink(); ?>">
			  
               <img src="<?php echo str_replace($blogUrl,'',get_bloginfo("template_url"))?>/timthumb.php?src=<?php echo get_post_meta($post->ID, 'flashPic', true);?>&amp;h=438&amp;w=1200&amp;zc=1" alt="<?php the_title()?>" /></a>
               <p class="flex-caption"><?php the_title(); ?></p>
  	    		</li>
  	    		
                
  <?php endwhile; wp_reset_query();}?>
          </ul>
        </div>
     
    

   
   
   
    

  
