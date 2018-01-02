<?php?>
<!DOCTYPE html>
<html  <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="UTF-8">
        <title><?php echo trim(wp_title('',0)); if(!is_home()) echo ' - '; bloginfo( 'name' ); ?></title>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font/font.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/404.css" type="text/css" media="screen" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="allheader">
            <div class="head_content">
                <div class="wrapper">
                    <div id="logo">
                        <a href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt=""></a>
                        <span id="logoline"></span>
                    </div>
                    <div class="head_action">

                        <?php if ( is_user_logged_in() ) : ?>
                        <div class="logined">
                            <?php 
                                global $current_user;                                
                                echo "<span class='username' ><i class='ico ico-user'  title='用户'></i>&nbsp;".$current_user->display_name."</span> " ; 
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
                                if( current_user_can( 'manage_options' ) || (current_user_can( 'publish_pages' ) && !current_user_can( 'manage_options' )) ){
                            ?>
                            <span class="setbtn"><i class="ico ico-set"></i></span>
                            <div class="setting">
                                <ul>
                                    <li>
                                        <a href="<?php echo bloginfo('siteurl'); ?>/wp-admin/">管理后台</a> 
                                    </li>
                                
                                    <li>
                                        <a href="<?php echo wp_logout_url(get_permalink()); ?>">退出</a>
                                    </li>
                                </ul>                                                              
                            </div>


                            <?php        
                                    
                                } 
                            ?>
                        </div>
                        <?php else : ?>
                        <div class="unlogined">
                            <a href="<?php echo wp_login_url(get_bloginfo('url')); ?>" class="loginbtn">登录</a> |
                            <a href="" class="registerbtn">注册</a>
                        </div>
                        <?php endif; ?>
                    </div>                    
                </div>

            </div>
            <div class="poster">
            	<div class="logobox">
            		<div id="logotext"></div>
            	</div>
                <div class="gsearch">
                    <?php dynamic_sidebar( 'widget_default2' ); ?>
                  <form method="get" action="<?php bloginfo('home'); ?>">
                        <input type="text" class="input-search" name="s" value="<?php echo wp_specialchars($s, 1); ?>" size="20" />
                        <input type="submit" class="submit-search" value="搜索" />
                    </form>           
                </div>
            </div>
            <div class="navcon">
	            <div class="navbox wrapper">
	                <?php  wp_nav_menu($args = array("menu_class" => "nav","container" => "nav","depth" => 1,"walker" => new description_walker()));?>

	            </div>           	
            </div>


        </div>
