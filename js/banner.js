/* 
	Author: Austin Hampton
*/

$(document).ready(function(){
	//$(".banner").hide();
    $("body").css('width','100%');
	$(".logo").css('top','70px');
	$("#container").css('width','1000px').css('margin','0 auto 0 auto').css('height',$(document).height()+70+"px");
	$("footer").css('width','1000px');
	//$("#banner").show();
	
});

function getViewportHeight() {
	 
	 var viewportheight;
	 
	 // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
	 if (typeof window.innerWidth != 'undefined')
	 {
		  viewportheight = window.innerHeight
	 }
	// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
	 else if (typeof document.documentElement != 'undefined'
		 && typeof document.documentElement.clientWidth !=
		 'undefined' && document.documentElement.clientWidth != 0)
	 {
		   viewportheight = document.documentElement.clientHeight
	 }
	 // older versions of IE
	 else
	 {
		   viewportheight = document.getElementsByTagName('body')[0].clientHeight
	 }
	 
	 return viewportheight;
}