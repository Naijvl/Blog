// JavaScript Document

jQuery(document).ready(function(){ 
	hhc();					
	}) ;
 jQuery(window).resize(function() {
	  hhc();
	 });	



function hhc(){	
	var wh=jQuery(window).height();
	var ww=jQuery(window).width();
	var top_h=jQuery('.e_top');
	
	//$('.chuan').css({top:wh*0.35})
	
	jQuery('.e_top').css({height:wh*0.35})
	
	jQuery('.e_bottom').css({height:wh*0.65});
  	jQuery('.ov').css({width:ww});
		
		};