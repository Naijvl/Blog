var str = 'OurHeaven';
var i = 0;
function typing(){
    var divTyping = document.getElementById('logotext');
    if (i <= str.length) {
        divTyping.innerHTML = str.slice(0, i++) ;
        // divTyping.innerHTML = str.slice(0, i++) + '_';
        setTimeout('typing()', 200);//递归调用
    }
    else{
        divTyping.innerHTML = str;//结束打字,移除 _ 光标
    }
}
typing();


$(window).scroll(function(){
    var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
    //alert(scrollTop);
    if(scrollTop >= 200){
        $(".navcon").addClass("fly");
    }
    else{
        $(".navcon").removeClass("fly");
    }
});


