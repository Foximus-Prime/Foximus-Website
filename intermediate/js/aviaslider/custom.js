$(document).ready(function(){jQuery("a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg]").prettyPhoto({theme:"light_square"});$("#frontpage-slider").aviaSlider({blockSize:{height:80,width:80},transition:"slide",display:"all",transitionOrder:["diagonaltop","diagonalbottom","topleft","bottomright","random"]});$("#diagonal-blocks").aviaSlider({blockSize:{height:80,width:80},transition:"slide",display:"diagonaltop",switchMovement:!0});$("#winding-blocks").aviaSlider({blockSize:{height:80,width:80},
transition:"slide",display:"topleft",switchMovement:!0});$("#randomized-blocks").aviaSlider({blockSize:{height:80,width:80},transition:"slide",display:"random"});$("#fading_curtain").aviaSlider({blockSize:{height:"full",width:40},display:"topleft",transition:"fade",betweenBlockDelay:150,animationSpeed:600,switchMovement:!0});$("#fading-top-curtain").aviaSlider({blockSize:{height:40,width:"full"},display:"topleft",transition:"fade",betweenBlockDelay:150,animationSpeed:600,switchMovement:!0});$("#fullwidth-fade-slider").aviaSlider();
$("#direction-fade-slider").aviaSlider({blockSize:{height:3,width:"full"},display:"topleft",transition:"fade",betweenBlockDelay:10,animationSpeed:400,switchMovement:!0});$("#droping-curtain").aviaSlider({blockSize:{height:"full",width:40},display:"topleft",transition:"drop",betweenBlockDelay:80,animationSpeed:800,switchMovement:!0,slideControlls:"items",appendControlls:".aviaslider"});$("#custom-fade-slider").aviaSlider({blockSize:{height:80,width:80},slides:".featured"})});
