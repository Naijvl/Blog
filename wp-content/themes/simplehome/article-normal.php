			<article class="article">
                <?php $_thumbnail=true;if(post_thumbnail_src()==false){$_thumbnail=false;} ?>
				<?php 
                if (get_post_meta($post->ID, "music_url_value", true)) {
                ?>
                <!-- music format -->
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
				} else if (get_post_meta($post->ID, "video_url_value", true)) {?>
                <!-- video format -->
                <div class="post-format-video">
                    	<div class="mejs-mediaelement">
                        <?php
							if (strpos(get_post_meta($post->ID, "video_url_value", true), '.swf') !== strlen(get_post_meta($post->ID, "video_url_value", true))-4) {
						?>
							<video class="wp-video-shortcode" style="width:100%;height:100%;" controls="controls" >
							<source src="<?=(get_post_meta($post->ID, "video_url_value", true))?>" type="video/mp4" />
							</video>
                        <?php
							} else {
						?>
                        	<embed src="<?=(get_post_meta($post->ID, "video_url_value", true))?>" quality="high" width="100%" height="100%" align="middle" allowScriptAccess="always" allowFullScreen="true" mode="transparent" type="application/x-shockwave-flash"></embed>
                        <?php
							}
						?>
						</div>
                </div>
				<?php } else { ?>
            	<?php if ( $_thumbnail == true ) { ?>
                	
                    <?php if(get_post_meta($post->ID, "dis_url_thumb_value", true)=="1"){ ?>
                       <!--设置了不显示缩略图--> 
                        
				<?php }else{?>
					<div class="feature-img">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=450&w=1310&q=88&zc=1&ct=1" alt="<?php the_title(); ?>"></a>
                        </div>
				
				<?php }
					}
					}?>
                <h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?></a></h1>
                
                <div class="content">
                <?php 
					if (is_single() || is_page()) {
				?>
					<?php the_content(); ?>
                    <?php simplehome_link_pages(); ?>
					<div class="article-copyright"><i class="fa fa-share-alt"></i> 码字很辛苦，转载请注明来自<b><a href="<?php bloginfo('wpurl');?>"><?php bloginfo('name') ?></a></b>的<a href="<?php the_permalink();?>">《<?php the_title();?>》</a></div>
                <?php
					} else { the_excerpt(); }
				?>
                </div>
                <div class="article-info">
                    <i class="fa fa-calendar"></i>
                     <?php the_time("Y-m-d");?> &nbsp; 
                    <i class="fa fa-map-marker"></i>
					<?php the_category(','); ?> 
                    <?php if(function_exists('the_views')) {
						echo '&nbsp;<i class="fa fa-eye"></i> ';
						 the_views(); 
						 } ?>
                </div>
                <?php if (!is_single() && !is_page()) { ?><div class="readmore"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>">+ 阅读全文</a></div><?php } ?>
            </article>