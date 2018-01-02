<?php
//****使用说明********

//如果想所有域名下都可以用来做外连接图片的，请把false改成true; 改成true后对安全会有所影响，建议不改。可以在下面数组中添加你要做外连接图片的域名。


define ('ALLOW_ALL_EXTERNAL_SITES', false);

$ALLOWED_SITES = array (
                'flickr.com',
                'staticflickr.com',
                'picasa.com',
                'img.youtube.com',
                'upload.wikimedia.org',
                'photobucket.com',
                'imgur.com',
                'imageshack.us',
                'tinypic.com',
				'upaiyun.com',
				'b0.upaiyun.com',
				'qiniudn.com',
				'aliyuncs.com',
				'oss.aliyuncs.com',
        );
		
?>