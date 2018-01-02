        
        <div class="footer">
            <div class="wrapper">
            <?php if (is_active_sidebar( 'widget_default1') ) : ?>
            <?php dynamic_sidebar( 'widget_default1' ); ?>
            <?php else: ?>
                <div class="links">
                <h3>友情链接</h3>
                <ul>
                <?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=20'); ?>
                </ul>
                </div>
            <?php endif; ?>
                <div class="copyright">Copyright &copy; 2016 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></div>   
         
            </div>

			
		</div>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.8.3.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.SuperSlide.2.1.1.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.lazyload.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/js/common.js"></script>
        
        <script>
            jQuery(".slidebox").slide({mainCell:".bd ul",autoPlay:true,effect:"left"});
        </script>
        <script type="text/javascript" charset="utf-8">
          $(function() {
              $("img.lazy").lazyload({effect: "fadeIn",placeholder: "<?php bloginfo('template_url'); ?>/images/lazydefault.png"});
          });
        </script>
        <script>
            $(document).ready(function(){


                $(".setbtn").mouseover(function(){
                    $(".head_action .setting").addClass("show");
                });
                 $(".head_action .setting").mouseleave(function(){
                    $(this).removeClass("show");
                 });
            });
        </script>
    </body>
</html>

