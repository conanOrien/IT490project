function openLogin(){
	$(document).ready(function(){
		$('#btn').click(function(){
			$('#login_modal').appendTo("body");
		});
	});
}

function checkLogin()
{
	 event.preventDefault(event);
	 var uCreds = $(".form-signin").serialize();
         $.ajax({
                type: "POST",
                url: "functions/checklogin.php",
                data: uCreds,
		dataType: "text",
        	success: function (data) {
			console.log(data);            	
			var dt = $.parseJSON(data);
                	console.log(dt);
                	if(dt=== false){
                		$('#error').html('<div class="alert alert-danger"><strong>Login error !</strong> Username or password are not correct.</div>');
            	    }else{
        		        location.reload(); 
	       		 }

      		}
        });

}

function fetchTable()
{
	event.preventDefault();
	var table = $('#browseT').serialize();
	console.log(table);
        $.ajax(
	{
        	type: "POST",
                url: "../Site/functions/browsedata.php",
                data: table,
                success: function (data) 
		{
                	var dt = $.parseJSON(data);
			console.log(dt);
                        $("#resultT").html(dt);
                }
        });
}

function addform(){                   
	$.ajax({
	        type: "POST",
                url: "../Site/functions/addform.php",
	        data: $('form').serialize(),
                success: function (data) {
                var dt = $.parseJSON(data);
                $("#result").html(dt);
               }
        });
}

function edittable(){
        $.ajax({
                type: "POST",
                url: "../Site/functions/edittable.php",
                data: $('form').serialize(),
                success: function (data) {
                var dt = $.parseJSON(data);
                $("#result").html(dt);
               }
         });
}

function deletetable1(){
        $.ajax({
                type: "POST",
                url: "../Site/functions/deletetable.php",
                data: $('form').serialize(),
                success: function (data) {
                var dt = $.parseJSON(data);
                $("#result").html(dt);
               }
        });
}


