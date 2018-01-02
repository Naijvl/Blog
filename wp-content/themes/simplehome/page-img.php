<?php 
/*
	template name: 图片模板
	description: mixianji 
*/
get_header(); ?>

<?php
$str = get_option('category_img'); 
$display_categories = explode(",",$str);

$limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
$args = array(
    'orderby'   => date,
    'paged' => $paged,
	'category__in'=>$display_categories,
	 'showposts' => 16,
); 
query_posts($args);
 ?>
<div class="container">
	<div class="content-wrap bugt">
      <?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      
      	
              <article class="excerpt buguat">
                
         			<div class="focus">
                    	<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=250&w=400&q=75&zc=1&ct=1" alt="<?php the_title(); ?>"></a>
                    </div>
      			<header class="img_tit">
                  <h2><a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?></a>
                  </h2>
                </header>
        <div class="article-info">
                    <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?> &nbsp; 
                    <?php if(function_exists('the_views')) {
						echo '&nbsp;<i class="fa fa-eye"></i> ';
						 the_views(); 
						 } ?>
					<!--<i class="fa fa-map-marker"></i> -->
					<?php
						//the_category(',');
					?>
                </div>
              </article>
         
      <?php endwhile;  else:?>
         <article class="article">
                <h1>Sorry, 没有内容(请设置分类)</h1>
                <div class="aside">
                   请在后台主题显示设置的--（图片模板）显示分类的内容中设置分类ID；
                </div>  
         </article>
      <?php endif; //wp_reset_query(); ?>
      <div class="clear"></div>
      </div>
     
     <div class="pagenavi"><?php pagenavi(); ?></div>
     <div class="clear"></div>
     </div>
    </div>

<?php get_footer(); ?>
