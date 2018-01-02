<?php?>
<!DOCTYPE html>
<html  <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="UTF-8">
        <title><?php echo trim(wp_title('',0)); if(!is_home()) echo ' - '; bloginfo( 'name' ); ?></title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">  
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font/font.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/404.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/swiper.min.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.min.css" type="text/css" media="screen" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php if(getfootlocation("my","page") != get_permalink()) : ?>
        <header class="mhead">
            <?php if(!is_home()) : ?>
                <div class="left"><a href="javascript:history.go(-1)" class="goback"><i class="ico ico-left"></i></a></div>
            <?php endif; ?>
           <div class="center"><h2 class="title"><?php bloginfo("name"); ?></h2></div>
        </header>
        <?php endif; ?>
