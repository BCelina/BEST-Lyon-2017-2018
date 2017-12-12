$(document).ready(function(){
	$('.cover-container a').click(function (e) {
	    var tab = $(this);
	    if(tab.parent('li').hasClass('active')){
	        window.setTimeout(function(){
	            $(".tab-pane").removeClass('active');
	            tab.parent('li').removeClass('active');
	        },1);
	    }
	});
});