<?php
/*
Template Name:ucenter
*/
?>
<?php 
    global $current_user; 
?>
<header class="uchead">
    <div class="meta">   
    <?php if( current_user_can( 'manage_options' ) || (current_user_can( 'publish_pages' ) && !current_user_can( 'manage_options' )) ){ ?>     
        <a href="<?php echo bloginfo('siteurl'); ?>/wp-admin/" class="setbtn"><i class="ico ico-set"></i></a>
    <?php  }  ?>
    </div>
    <div class="userinfo">


        <div class="user-photo">
        <?php echo get_avatar($current_user->ID,60);
        ?>
        </div>
        <div class="user-info-text">
        <?php               
            echo "<span class='username' >".$current_user->display_name."</span> " ;
            if( current_user_can( 'manage_options' ) ) {
                echo '<span class="idlevel">[ 管理员 ]</span>';
            }
            if( current_user_can( 'publish_pages' ) && !current_user_can( 'manage_options' ) ) {
                echo '<span class="idlevel">[ 编辑 ]</span>';
            }
            if( current_user_can( 'publish_posts' ) && !current_user_can( 'publish_pages' ) ) {
                echo '<span class="idlevel">[ 作者 ]</span>';
            }
            if( current_user_can( 'edit_posts' ) && !current_user_can( 'publish_posts' ) ) {
                echo '<span class="idlevel">[ 投稿者 ]</span>';
            }
            if( current_user_can( 'read' ) && !current_user_can( 'edit_posts' ) ) {
                echo '<span class="idlevel">[ 订阅者 ]</span>';
            }
            
        ?>
        <p>文章：<?php echo count_user_posts( $current_user->ID ) ?></p>   
        </div>
    </div>
</header>
<!-- <a class="collect" href="<?php echo getfootlocation("collect","page") ?>">
收藏
</a> -->
<div class="ucbody">
    <div class="udynamic">
        <h2 class="tit">我的动态</h2>
        <div class="udynamic-box">
        <?php 
            $myposts = new WP_Query();
            $myposts->query('author='.$current_user->ID);
        ?>

        <?php while ($myposts->have_posts()&&$i < 5) : $myposts->the_post(); ?>
            <div class="article_con">
                
                <?php if ( post_password_required() ) : ?>
                    <?php the_content(); ?>
                <?php else : ?>    
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                <div class="article_img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( array(90,90) ); ?>                 
                    <?php else : ?>                      
                        <?php catch_all_lazy_image_mobile(1); ?>                  
                    <?php endif; ?>                    
                </div>            
                <div class="content">
                    <h2 class="title"><?php the_title_attribute(); ?></h2>
                    <p class="summary"><?php echo content_excerpt(100); ?></p>
                    <span class="date"><i class="ico ico-time"></i>&nbsp;<?php the_time('Y-m-d'); ?></span>
                        
                <?php endif; ?>
                </div>
                

                <?php $i++; ?>  
 
                </a>
            </div>  
        <?php endwhile; ?>
        </div>
    </div>


    
        
    <div class="logout">
        <a href="<?php echo wp_logout_url(getfootlocation("my","page")); ?>" class="loginout-btn"><i class="ico ico-loginout"></i>&nbsp;退出</a>
    </div>  
       

</div>

