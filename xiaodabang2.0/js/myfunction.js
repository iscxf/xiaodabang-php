$(document).ready(function () {
        var urlstr = location.href;
		var urlstatus = false;
		$(".navbar-nav a").each(function(){
			if( (urlstr + '/').indexOf($(this).attr('href')) >-1 && $(this).attr('href') != '' ){
				$(this).addClass('active');
				urlstatus = true;
			}else{
				$(this).removeClass('active');
			}
		});
		$(".nav a").each(function(){
			if( (urlstr + '/').indexOf($(this).attr('href')) >-1 && $(this).attr('href') != '' ){
				$(this).addClass('active');
				urlstatus = true;
			}else{
				$(this).removeClass('active');
			}
		});
    });