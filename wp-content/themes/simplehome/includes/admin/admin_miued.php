
<?php
function show_category() {
global $wpdb;
$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
$request .= " ORDER BY term_id asc";
$categorys = $wpdb->get_results($request);
echo "<table class='idbiao'>";
foreach ($categorys as $category) {

echo "<tr>";
echo "<td>";
echo "ID-".$category->term_id."：";
//$output = ''.$category->name."：".$category->term_id.'';
echo "</td>";
echo "<td>";
echo $category->name;
echo "</td>";
echo "</tr>";

//echo $output;
}
echo "</table>";
}
?>

<div class="wrap d_wrap">
    
    <h2>SM主题分类设置</h2>
    <span>发布来源：<a href="http://www.miued.com/" target="_blank">蓝色早晨UED</a></span><br />
    <hr />
    <br />
    <div class="updated">
    <div>文章分类ID：</div>
    <br />
   <?php show_category(); ?>
    </div>
  

<form method="post" action="">
   <table>
 
        <td class="d_tit">首页排除分类内容</td>
        <td>
        <textarea name="category_index" id="category_index" type="textarea" rows=""><?php echo get_option('category_index'); ?></textarea>
           
            <span>这里填写的分类ID，首页上将不会再显示此ID下的内容。（一般这是与下面的图片模板分类设置配合使用）</span>
            <span class="d_tip">输入分类的ID，多个ID请用英文逗号（,）分隔，不设置请留空。</span>
        </td>
    </tr>
    
     <tr>
        <td class="d_tit">（图片模板）显示分类的内容</td>
        <td>
        <textarea name="category_img" id="category_img" type="textarea" rows=""><?php echo get_option('category_img'); ?></textarea>
            &nbsp; 
           <span>这里填写的分类ID，将此ID分类下的内容显示在图片模板里，图片模板需要在新建页面-选择图片模板。</span>
            <span class="d_tip">输入分类的ID，多个ID请用英文逗号（,）分隔。</span>
        </td>
    </tr>
    
   <tr>
        <td class="d_tit">(blog模板）显示分类内容</td>
        <td>
        <textarea name="category_blog" id="category_blog" type="textarea" rows=""><?php echo get_option('category_blog'); ?></textarea>
           <span>这里填写的分类ID，将此ID分类下的内容显示在blog模板里，blog模板需要在新建页面-选择blog模板。</span>
            <span class="d_tip">输入分类的ID，多个ID请用英文逗号（,）分隔。</span>
        </td>
    </tr>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#fo2_focus').click(function(){
				if(!jQuery(this).is(":checked")){
					jQuery(this).attr('checked',false);
				}else{
     			jQuery('#fo2_focus_flexslider').attr('checked',false);
     			jQuery(this).attr('checked',true);
				//alert(1);
				}
			});
			jQuery('#fo2_focus_flexslider').click(function(){
				if(!jQuery(this).is(":checked")){
					jQuery(this).attr('checked',false);
					}else{
     			jQuery('#fo2_focus').attr('checked',false);
     			jQuery(this).attr('checked',true);
				//alert(2);
				}

			});
			
}); 
	</script>
     <tr>
        <td class="d_tit">启用首页幻灯片</td>
        <td>
       		<input name="fo2_focus" type="checkbox" id="fo2_focus" value="1"  <?php if(get_option('fo2_focus')) echo 'checked="checked"' ?> />
            <label for="fo2_focus">3d视觉幻灯片</label>
            &nbsp; &nbsp;
            <span class="d_tip">勾选此项后，首页将会显示幻灯片。并且编辑文章时下方会有幻灯片图片设置</span>
        </td>
        
    </tr>
    <tr>
    <td class="d_tit"></td>
    <td>
    	
       		<input name="fo2_focus_flexslider" type="checkbox" value="2" id="fo2_focus_flexslider" <?php if(get_option('fo2_focus_flexslider')) echo 'checked="checked"'; ?> />
            <label for="fo2_focus_flexslider">常规幻灯片</label>
            &nbsp; &nbsp;
            <span class="d_tip">勾选此项后，设置与上一样。两幻灯片只能选择一个，或都不选</span>
        </td>
    </tr>
     <td class="d_tit">右边侧栏模块固定</td>
    <td>
    	<label for="d_sideroll_b">
                <input type="checkbox" id="d_sideroll_b" name="d_sideroll_b" <?php if(get_option('d_sideroll_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;&nbsp;&nbsp;
            </label>
            <label  for="d_sideroll_1">
                页面滚动时，固定侧栏的第
                <input class="d_num " name="d_sideroll_1" id="d_sideroll_1" type="number" value="<?php echo get_option('d_sideroll_1'); ?>">
            </label>
            和
            <label  for="d_sideroll_2">
                <input class="d_num " name="d_sideroll_2" id="d_sideroll_2" type="number" value="<?php echo get_option('d_sideroll_2'); ?>"> 个模块
            </label>
        </td>
    </tr>
      
    <tr>
    	 <td class="d_tit">移动端菜单显示设置</td>
        <td class="d_tit"> <label for="nav_cai_mi"> 
                <input type="checkbox" id="nav_cai_mi" name="nav_cai_mi" <?php if(get_option('nav_cai_mi')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;&nbsp;&nbsp;
           </label>
         <span class="d_tip">勾选此项后，在移动端访问时，顶级菜单将显示站点的分类目录内容（默认显示主题菜单中的顶级菜单--建议不选）</span></td>
    </tr>
      
    <tr>
        <td class="d_tit"></td>
        <td>
            <div class="d_desc">
                <input type="submit" name="Submit" class="button-primary" value="保存设置" />
            </div>
            <input type="hidden" name="update_themeoptions" value="save" style="display:none;" />
        </td>
       
		
    </tr>

    </table>
</form>

<script>
var aaa = []
jQuery('.d_wrap input, .d_wrap textarea').each(function(e){
    if( jQuery(this).attr('id') ) aaa.push( jQuery(this).attr('id') )
})
console.log( aaa )
</script>
