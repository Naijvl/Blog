<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.poshytip.min.js?ver=1.2"></script>
<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.nicescroll.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/scripts/custom.js?ver=1.0"></script>
    <?php
		if (is_single()) {
	?><script type='text/javascript'>
	//文章页图片自适应
	function responsiveImg() {
		var img_count=(jQuery('.article .content').find('img')).length;
		if (img_count != 0) {
		var maxwidth=jQuery(".article .content").width();
		for (var i=0;i<=img_count-1;i++) {
			var max_width=jQuery('.article .content img:eq('+i+')');
				if (max_width.width() > maxwidth) {
					max_width.addClass('responsive-img');
				}
			}
		}
	}
	jQuery(function(){
		responsiveImg();
		window.onresize = function(){
			responsiveImg();
		}
	});
    </script><?php
		}
	?>
    
    <?php
		$sr_1 = 0; $sr_2 = 0;
		if( get_option('d_sideroll_b') ){ 
			$sr_1 = get_option('d_sideroll_1');
			$sr_2 = get_option('d_sideroll_2');
			
			//$sidss=array($sr_1,$sr_2);
			//$sids="'".$sr_1."'".","."'".$sr_2."'";
			$sida='['.$sr_1.','.$sr_2.']';
		};

		?>
    <script type="text/javascript">
    //custom fixed sidebar
	
	jQuery(function($){
		var sida="<?php echo $sida; ?>";
		var restr = eval(sida);
		var topOffset = 50;
		//console.log(sida);
		$(window).scroll(function(){
			if ($(this).scrollTop() >= $(".sidebar").height()+topOffset) {
			if(restr && restr.length > 0){
				if ($(".sidebar").css('position')=='absolute') {
						$(".sidebar").children('div').hide();
						$.each(restr,function(key,val){
							var dd=val-1;
							//console.log(dd);
							$(".sidebar").children('div').eq(dd).show();
						});
	
						$(".sidebar").css('position','fixed');
						//console.log('fixed');
					}
				}
				} else { 
					if ($(".sidebar").css('position')=='fixed') {
						$(".sidebar").css("position",'absolute').children().show();
						//console.log('absolute');
					}
				}
			
	
		});
	});
    </script>
    <?php echo stripslashes(get_option('mytheme_analysis'))."\r\n"; ?>
    <?php wp_footer(); ?>
</body>
</html>
    