<?php 
    header('Access-Control-Allow-Origin:*');
    function getData($sql='',$type='json'){
        $mysql_server_name="localhost"; 
        $mysql_username="hexiboy_blog"; 
        $mysql_password="lj6661169"; 
        $mysql_database="hexiboy_blog";     
        $conn=mysql_connect($mysql_server_name, $mysql_username,
                            $mysql_password);
        mysql_query("SET NAMES 'UTF8'"); 
        mysql_select_db($mysql_database,$conn);
        $result = mysql_query($sql,$conn);
        $r = array();

        
        if($type === 'json'){
            for($i=0;$i<mysql_num_rows($result);$i++){
                $r[$i] = mysql_fetch_object($result);
            }
            return json_encode($r); 
        }
        if($type === 'array'){
            for($i=0;$i<mysql_num_rows($result);$i++){
                $r[$i] = mysql_fetch_array($result);
            }
            return $r; 
        }    
        if($type === 'obj'){
            for($i=0;$i<mysql_num_rows($result);$i++){
                $r[$i] = mysql_fetch_object($result);
            }
            return $r; 
        }               
    }

    function catch_first_image($post_content) {
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
         
        //获取文章中第一张图片的路径并输出
        $first_img = $matches [1] [0];
         
        //如果文章无图片，获取自定义图片
         
        if(empty($first_img)){ //Defines a default image
            $first_img = "/images/default.jpg";
         
        //请自行设置一张default.jpg图片
        }
         
        return $first_img;
    }

    function dateFormat($odate){
        $now = date("Y-m-d H:i:s");
        $sdate = date("Y-m-d",strtotime($odate));
        $date=floor((strtotime($now)-strtotime($odate))/86400);  
        $hour=floor((strtotime($now)-strtotime($odate))%86400/3600);  
        $minute=floor((strtotime($now)-strtotime($odate))%86400/60);  
      
        if($date > 2){
            $d = $sdate;
        }   
        else{
            if($date == 2){
                $d = '前天';
            }
            if($date == 1){
                $d = '昨天';
            }
            if($date == 0){
                if($hour >= 1){
                    $d = $hour.'小时前';
                }
                else{
                    $d = $minute.'分钟前';
                }
            }
        } 
        return $d;
    }





    $postParam = $_REQUEST['f'];
    $user_login = $_REQUEST['user_login'];
   
    if($postParam === 'getUser'){
        $sql = 'SELECT user_login FROM hexiboy_users';
        $result = getData($sql,'json');
        echo $result;
    }

    if($postParam === 'getAllPosts'){
    	$pagenum = $_REQUEST['pagenum'];
    	$pagesize = $_REQUEST['pagesize'];
    	$start = ($pagenum - 1)*$pagesize;
    	$end = $pagenum*$pagesize;
        $sql = "select * from (select p.*,u.display_name,u.app_photo,u.level FROM hexiboy_posts p,hexiboy_users u where p.ping_status = 'open' and p.post_status = 'publish' and p.post_author = u.ID order by p.post_date desc) as t limit ".$start.",".$end;
        $result = getData($sql,'array');
        
        foreach ($result as $key => $value) {  
            $img = catch_first_image($value['post_content']);  
            if($img){
                $imgdom = '<div class="imgbox"><div class="imgitem" imgurl="'.$img.'"></div><div class="imgitem" imgurl="'.$img.'"></div><div class="imgitem" imgurl="'.$img.'"></div></div>';
            }
            else{
                $imgdom = '';
            }      
            $result_str .= '<li>
                                <div class="top">
                                    <div class="postphoto">
                                        <img src="'.$value['app_photo'].'" />
                                    </div>
                                    <div class="top-right">
                                        <span class="puname">'.$value['display_name'].'</span><span class="plevel">'.$value['level'].'</span>
                                        <p class="postdate">'.dateFormat($value['post_date']).'</p>
                                    </div>
                                </div>
                                <div class="center">
                                    <a href="'.$value['guid'].'">'.'
                                        <div class="posttit">
                                            <h2>'.$value['post_title'].'</h2>
                                        </div>                                          
                                    </a>
                                    '.$imgdom.'                                    
                                </div>
                                <div class="bottom"></div>
                            </li>';              
                       
        }
        echo $result_str;
    }

    if($postParam === 'getAllPostsNum'){
        $sql = "SELECT count(*) as number FROM hexiboy_posts where ping_status = 'open' and post_status = 'publish'";
        $result = getData($sql,'array');
        foreach ($result as $key => $value) {         
            $r = $value;                
        }
        echo $r['number'];
    }
    if($postParam === 'getFriends'){
        
        // $pagenum = $_REQUEST['pagenum'];
        // $pagesize = $_REQUEST['pagesize']?$_REQUEST['pagesize']:10;
        $sql = "select *,count(*) from hexiboy_users  where id in(select friendid from friends where userid in(select id from hexiboy_users where user_login = '".$user_login."'))";  
        // $sql = "select *,count(*) from hexiboy_users  where id in(select friendid from friends where userid in(select id from hexiboy_users where user_login = '".$user_login."') limit ".($pagenum*$pagesize-1).",".$pagesize.")";         
        $result = getData($sql,'array');

        foreach ($result as $key => $value) {         
            $result_str .= "<li>".$value['display_name']."</li>";        
        }
        echo $result_str;
    }
    if($postParam === 'getPhoto'){
        $user_login = $_REQUEST['user_login'];
        $sql = "select app_photo from hexiboy_users where user_login = '".$user_login."'";
        $result = getData($sql,'array');
        foreach ($result as $key => $value) {         
            $r = "<img src='".$value['app_photo']."' />";                
        }
        // print_r($sql);
        echo $r;
    }
    if($postParam === 'getMsgs'){
        $user_login = $_REQUEST['user_login'];
        $stxt = $_REQUEST['stxt'];
        if($stxt == ''){
        	$sql = "select m.*,u.* from app_message m left join app_user u on m.sender = u.ID where m.receiver in(select u.ID from app_user u where u.user_login='".$user_login."') group by m.sender";        	
        }
        else{
        	$sql = "select m.*,u.* from app_message m left join app_user u on m.sender = u.ID where m.receiver in(select u.ID from app_user u where u.user_login='".$user_login."') and m.sender in(select u.ID from app_user u where u.display_name='".$stxt."') group by m.sender";          	
        }

        $result = getData($sql,'array');
        foreach ($result as $key => $value) {         
            $r .= "<li><a><div class='left'><img class='avatar' src='".$value['app_photo']."'/></div><div class='right'><div class='meta'><span class='name'>".$value['display_name']."</span><span class='date'>".$value['send_date']."</span></div><div class='content'>".$value['content']."</div></div><a></li>";                
        }

        echo $r;
    }

	if($postParam === 'getLoginStatus'){
        $user_login = $_REQUEST['userlogin'];
        $user_pass = $_REQUEST['userpass'];
        $user_pass = base64_encode($user_pass);	
        $sql = "select login_status from app_user where user_login ='".$user_login."' and user_pass = '".$user_pass."'";
        $result = getData($sql,'array');	
        foreach ($result as $key => $value) {         
            $r = $value;                
        }
        
        echo $r['login_status'];
	}
	if($postParam === 'setLoginStatus'){
        $user_login = $_REQUEST['userlogin'];
        $user_pass = $_REQUEST['userpass'];
        $status = $_REQUEST['status'];
        $user_pass = base64_encode($user_pass);	
        $sql = "update app_user set login_status='".$status."' where user_login ='".$user_login."' and user_pass = '".$user_pass."'";
        $result = getData($sql,'json');	
        echo $result;
	}
    if($postParam === 'login'){
        $user_login = $_REQUEST['userlogin'];
        $user_pass = $_REQUEST['userpass'];
        $user_pass = base64_encode($user_pass);

        $sql = "select id,user_login,FROM_BASE64(user_pass) as user_pass,user_email,display_name,app_photo,level,usersign,login_status from app_user where user_login ='".$user_login."' and user_pass = '".$user_pass."'" ;   
        
        $result = getData($sql,'json');
        // foreach ($result as $key => $value) {         
        //     $r = $value;                
        // }
        // print_r($result);
        echo $result;
    }



 ?>