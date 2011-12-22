/* 
	Author: Austin Hampton
*/

$(document).ready(function(){
	
    $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)  
  
    $("ul.topnav li a").hover(function() { 
        //Following events are applied to the subnav itself (moving subnav up and down)  
        $(this).parent().find("ul.subnav").stop(true, true).slideDown('fast').show(); //Drop down the subnav on hover
  
        $(this).parent().hover(function() {  
        }, function(){  
            $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up  
        });  
  
        //Following events are applied to the trigger (Hover events for the trigger)  
        }).hover(function() {  
            $(this).addClass("subhover"); //On hover over, add class "subhover"  
        }, function(){  //On Hover Out  
            $(this).removeClass("subhover"); //On hover out, remove class "subhover"  
    });
	
	/*	
	$('#extraLinks').bt({
	  showTip: function(box){
		$(box).fadeIn(500);
	  },
	  hideTip: function(box, callback){
		$(box).animate({opacity: 0}, 500, callback);
	  },
	  contentSelector: "$('.tooltip1').html()", //get text of inner content of hidden div
	  shrinkToFit: true,
	  hoverIntentOpts: {
		interval: 0,
		timeout: 0
	  },
	  positions: ['bottom'],
	  spikeLength: 10,
	  spikeGirth: 10,
	  cornerRadius: 3,
	  fill: 'rgba(0, 0, 0, .8)',
	  strokeWidth: 3,
	  strokeStyle: '#fff',
	  cssStyles: {color: '#fff'}
	});
	*/
	
	/*$('.logo').click(function() {
	   
	    $('.logo').addClass("logo2").removeClass("logo");
		$('header').css('position' , 'relative').animate({
			height: '66px'
		 }, 1000);
		 $('#footL').animate({'left': '-51px'},1000);
		 $('#footR').animate({'right': '-51px'},1000);
		 $('#main').slideUp('slow');
		 $('body').css('position', 'relative').animate({
			height: '151px',
			top: (getViewportHeight() / 2 - 118)
		 }, 1000);
		 $('#container').css('min-height', '0px').animate({
			height: '151px'
		 }, 1000);

	});*/
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