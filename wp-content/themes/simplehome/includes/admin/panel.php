  
<h2 class="sztit">SM主题设置</h2>
<span class="d_themedesc">发布来源：<a href="http://www.miued.com/" target="_blank">蓝色早晨UED</a></span>
<hr />
<form method="post" action="">

	<fieldset>
    <legend><strong>首页关键字和描述（SEO）</strong></legend>
		<table class="form-table">
			<tr><td>
				<textarea name="keywords" id="keywords" rows="1" cols="70"><?php echo get_option('mytheme_keywords'); ?></textarea>
				<span>网站关键词（Meta Keywords），中间用半角逗号隔开。</span>
			</td></tr>
			<tr><td>
				<textarea name="description" id="description" rows="3" cols="70"><?php echo get_option('mytheme_description'); ?></textarea>
				<span>网站描述（Meta Description），针对搜索引擎设置的网页描述。</span>
			</td></tr>
		</table>
	</fieldset>
    <hr />
     <fieldset>
    <legend><strong>网站LOGO（头像）</strong></legend>
    	<table class="form-table">
             <tr>
                <td>
                    <input type="url" name="lgimg" id="lgimg_h" style="width:260px;" value="<?php if(get_option('mytheme_lgimg')){ echo get_option('mytheme_lgimg');}?>">
                    <a class="ashu_upload_button button" id="lgimg">上传</a>
                    <span>自己上传LOGO，也就是网站左边的头像。</span>
                    <span class="d_tip">尺寸：130px*130px的圆形PNG图</span>
                </td>
                <td>
                 
                </td>
            </tr>
        </table>
    </fieldset>
    <hr />
    <fieldset>
    <legend><strong>favicon图标设置</strong></legend>
    	<table class="form-table">
             <tr>
                <td>
                    <input type="url" name="mi_favicon" id="favicon" style="width:260px;" value="<?php if(get_option('mytheme_mi_favicon')){ echo get_option('mytheme_mi_favicon');}?>">
                    <a class="ashu_upload_button button" id="mi_favicon">上传</a>
                    <span></span>
                    <span class="d_tip">请注意ico图标的文件名必须为favicon.ico才能被浏览器正确识别</span>
                </td>
                <td>
                 
                </td>
            </tr>
        </table>
    </fieldset>
    <hr />
     <fieldset>
    <legend><strong>网站底部信息</strong></legend>
    	<table class="form-table">
             <tr>
                <td>
                    版权信息&nbsp;&nbsp;
                    <input type="text" name="mi_banq" id="mi_banq" style="width:260px;" value="<?php if(get_option('mytheme_mi_banq')){ echo get_option('mytheme_mi_banq');}?>">
                    <span></span>
                    <span class="d_tip"></span>
                </td>
                <td>
                 
                </td>
            </tr>
            <tr>
                <td>
                    备案号&nbsp;&nbsp;&nbsp;&nbsp;
                    <textarea name="mi_beian" id="mi_beian" rows="3" cols="70">  <?php if(get_option('mytheme_mi_beian')){ echo stripslashes(get_option('mytheme_mi_beian'));}?></textarea>
                 
                    <span></span>
                    <span class="d_tip">支持html形式</span>
                </td>
                <td>
                 
                </td>
            </tr>
        </table>
    </fieldset>
    <hr />
    
    <fieldset>
    <legend><strong>自定义CSS样式</strong></legend>
    	<table class="form-table">
             <tr>
                <td>
                    <textarea name="mi_css" id="mi_css" type="textarea" cols="80" rows="10" style="width:80%;"><?php echo stripslashes(get_option('mytheme_mi_css')); ?></textarea>
                    <span>此处的样式将会替换默认的style.css中的样式，并且其值会保存在数据库中，升级主题不会对自定义过的样式造成覆盖。</span><br />
                    <span class="d_tip"></span>
                </td>
                
            </tr>
        </table>
    </fieldset>
    <hr />
   
    <fieldset>
	<legend><strong>统计代码</strong></legend>
		<table class="form-table">
			<tr><td>
				<textarea name="analysis" id="analysis" rows="3" cols="70"><?php echo stripslashes(get_option('mytheme_analysis')); ?></textarea>
				<span>网站流量统计分析，推荐CNZZ,百度。</span>
			</td></tr>
		</table>
	</fieldset>
    <hr />
    <fieldset class="bianlian">
	<legend><strong>主题左侧栏设置</strong></legend>
		<table class="form-table">
			<tr><td>
				<input type="text" name="owner" placeholder="Your Name" value="<?php echo get_option('mytheme_owner'); ?>" />
				<span>设置首页左侧栏主人名字</span>
			</td></tr>
			<tr><td>
				<input type="text" name="qq" placeholder="QQ Number" value="<?php echo get_option('mytheme_qq'); ?>" />
				<span>设置首页左侧栏QQ号</span>
			</td></tr>
            <tr><td>
				<input type="text" name="weichat" placeholder="WeiChat ID" value="<?php echo get_option('mytheme_weichat'); ?>" />
				<span>设置首页左侧栏微信号</span>
			</td></tr>
            <tr><td>
				<input type="text" name="weiboshow" placeholder="The Weibo Show URL" value="<?php echo get_option('mytheme_weiboshow'); ?>" />
				<span>设置首页左侧栏微博秀地址如：http://weiboxiu/56478946/myname.html &nbsp;记得是微博秀不微是博哦</span>
			</td></tr>
		</table>
	</fieldset>
    <hr />
    <fieldset class="bianlian">
	<legend><strong>主题颜色</strong></legend>
		<table class="form-table">
			<tr><td>
				<select name="skincolor">
                <?php
				$dir = TEMPLATEPATH.'/css/skin/'; //当前目录
				$list = scandir($dir); // 得到该文件下的所有文件和文件夹
				foreach($list as $file){//遍历
					$file_location=$dir."/".$file;//生成路径
					if(!is_dir($file_location) && $file!="." &&$file!=".."){ //判断是不是文件夹
						$value = str_replace(".css","",$file);
				?>
                	<option <?php if (get_option('mytheme_skincolor')==$value) echo "selected"; ?> value="<?=($value)?>"><?php echo $value; ?></option>
                <?php
					}
				}
				?>
                </select>
				<em>选择主题颜色</em>
			</td></tr>
		</table>
        
       
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="保存设置" />
		<input type="hidden" name="mytheme_settings" value="save" style="display:none;" />
	</p>
</form>
<?php wp_enqueue_media();?>
<script>   
    jQuery(document).ready(function(){   
    var ashu_upload_frame;   
    var value_id;   
    jQuery('.ashu_upload_button').live('click',function(event){   
        value_id =jQuery( this ).attr('id');       
        event.preventDefault();   
        if( ashu_upload_frame ){   
            ashu_upload_frame.open();   
            return;   
        }   
        ashu_upload_frame = wp.media({   
            title: 'Insert image',   
            button: {   
                text: 'Insert',   
            },   
            multiple: false   
        });   
        ashu_upload_frame.on('select',function(){   
            attachment = ashu_upload_frame.state().get('selection').first().toJSON();   
            //jQuery('#'+value_id+'_input').val(attachment.url).trigger('change');   
            jQuery('input[name='+value_id+']').val(attachment.url).trigger('change');   
        });   
           
        ashu_upload_frame.open();   
    });   
    });   
    </script> 

 
