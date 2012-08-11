$(function(){
	
	var note = $('#note'),
		ts = new Date(2013,0,1,5,00,00),
		release = true;
	
	if((new Date()) > ts){
		// The kickoff is here, countdown to end of build season.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = new Date(2012,1,21,0,00,00);
		release = false;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			if(release){
				message += "left until kickoff!";
			}
			else {
				message += "left until end of build season!";
			}
			
			note.html(message);
		}
	});
	
});
