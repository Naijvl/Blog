        <footer>
            <ul>
                <!-- <li <?php if(home_url() === get_permalink()){echo "class='on'";} ?>> -->
                <li <?php if(is_home()) echo "class='on'"?>  >
                    <a href="/"><span class="fhome"><i class="ico ico-home"></i></span><p>首页</p></a>
                </li>
                <li <?php if(getfootlocation("category","page") === get_permalink()){echo "class='on'";} ?>>
                    <a href="<?php geturl("category","page"); ?>"><span class="fcat"><i class="ico ico-category"></i></span><p>分类</p></a>
                </li>
                <li <?php if(getfootlocation("tag","page") === get_permalink()){echo "class='on'";} ?>>
                    <a href="<?php geturl("tag","page"); ?>"><span class="ftag"><i class="ico ico-tag"></i></span><p>标签</p></a>
                </li>

                <li <?php if(getfootlocation("comment","page") === get_permalink()){echo "class='on'";} ?> >
                    <a href="<?php geturl("comment","page"); ?>"><span class="fcmt"><i class="ico ico-comment"></i></span><p>评论</p></a>
                </li>
                <li <?php if(getfootlocation("my","page") === get_permalink()||getfootlocation("my","page") === get_permalink()){echo "class='on'";} ?>>
                    <a href="<?php geturl("my","page"); ?>"><span class="fmy"><i class="ico ico-my"></i></span><p>我的</p></a>
                </li>
            </ul>

			
		</footer>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.8.3.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.SuperSlide.2.1.1.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.lazyload.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/js/swiper.jquery.min.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/js/swiper.animate1.0.2.min.js"></script>

        
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
                // $('#pagination a').click( function() {   
                //     $this = $(this);   
                //     $this.addClass('loading'); //给a标签加载一个loading的class属性，可以用来添加一些加载效果   
                //     var href = $this.attr("href"); //获取下一页的链接地址   
                //     if (href != undefined) { //如果地址存在   
                //         $.ajax( { //发起ajax请求   
                //             url: href, //请求的地址就是下一页的链接   
                //             type: "get", //请求类型是get   
                  
                //         error: function(request) {   
                //             //如果发生错误怎么处理   
                //         },   
                //         success: function(data) { //请求成功   
                //             $this.removeClass('loading'); //移除loading属性   
                //             var $res = $(data).find(".article_box"); //从数据中挑出文章数据，请根据实际情况更改 
                 
                //             $('.post').append($res); //将数据加载加进posts-loop的标签中。  

                //             var newhref = $(data).find("#pagination a").attr("href"); //找出新的下一页链接   
                //             if( newhref != undefined ){   
                //                 $("#pagination a").attr("href",newhref);   
                //             }else{   
                //                 $("#pagination").hide(); //如果没有下一页了，隐藏   
                //             }   
                //         }   
                //         });   
                //     }   
                //     return false;   
                // }); 


                // $(window).bind("scroll",function(){
                // // 判断窗口的滚动条是否接近页面底部
                // if( $(document).scrollTop() + $(window).height() > $(document).height() - 10 ) {
                //     $("#pagination a").addClass('loading').text('LOADING...');
                //     $.ajax({
                //         type: "POST",
                //         url: $(this).attr("href"),
                //         success: function(data){
                //             var $res = $(data).find(".article_box");
                //             var nextHref = $(data).find("#pagination a").attr("href");
                //             // 渐显新内容
                //             $(".post").append($res.fadeIn(300));
                //             $("#pagination a").removeClass("loading").text("LOAD MORE");
                //             if ( nextHref != undefined ) {
                //                 $("#pagination a").attr("href", nextHref);
                //             } else {
                //             // 若没有链接，即为最后一页，则移除导航
                //                 $("#pagination").remove();
                //             }
                //         }
                //     });
                // }
                // });

                $(".tagcon a").each(function(){
                    var colorid = parseInt(Math.random()*4);
                    if(colorid == "1"){
                        $(this).addClass("green");
                    } 
                    if(colorid == "2"){
                        $(this).addClass("orange");
                    }  
                    else{
                        $(this).addClass("blue");
                    }                     
                });

                

            });



        </script>
        <script>
            var ckobj ="-1";
            $(".atcbglist").find("li").click(function(){
                $("body").addClass("nomove");
                // $("body").bind("touchmove",function(event){
                //     event.prevent;
                // });

                var ck_parent_index = $(this).parents(".article_box").index();
                var ckindex = $(this).index();
                
                if(ckobj != ck_parent_index){
                    var str = "";
                    var container_start = "<div class='swiper-container'>";
                    var container_end = "</div>";
                    var wrapper_start = "<div class='swiper-wrapper'>";
                    var wrapper_end = "</div>";
                    var slide_start = "<div class='swiper-slide'>";
                    var slide_end = "</div>";
                    var pagination = "<div class='swiper-pagination'></div>";
                    

                    str = str + container_start + wrapper_start;
                    $(this).parent(".atcbglist").find("li").each(function(){
                        str = str + slide_start;
                        var url = $(this).css("background-image");
                        url = url.replace("url(","").replace(")","");
                        str = str + "<div class='cell'><img src='"+ url +"'></div>" + slide_end;
                    });
                    str = str + wrapper_end + pagination + container_end;
                    $(".displaybox").empty().append(str);
                }
                // alert(ckindex);
                var mySwiper = new Swiper ('.swiper-container', {
                        pagination : '.swiper-pagination',
                        paginationType : 'fraction',
                        // initialSlide: ckindex,
                        preventClicks : false,
                        // preventLinksPropagation : false,
                        width : window.innerWidth,
                        height : window.innerHeight,
                        // onTap: function(swiper){
                        //     $("body").removeClass("nomove");
                            
                        // }
                }) ;  
                mySwiper.slideTo(ckindex,1,false);
                mySwiper.update();
                
                $(".swiper-slide").click(function(){
                    alert(0);
                    // $("body").unbind("touchmove");
                    // $("body").removeClass("nomove");

                    
                });

                ckobj = ck_parent_index;


            });


        </script>
    </body>
</html>

