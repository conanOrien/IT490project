<?php session_start(); ?>
<html>
    <head>
        <title>Look for a Flight</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Theme/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <style>


            body {
                background: #eee !important;	
            }

            .main{
                width:95%;
                margin:0 auto;

                padding:30px;



            }
            .flight{

                background:red;
                font-size:25px;
                color:white;
                text-align: center;
                padding:5px;
                margin:25px;

            }

            a{
                color:white;
                text-decoration:none;
            }
            .result{
                width:100%;border:1px solid #ccc;padding:20px;border-radius: 5px;background:#fdf;margin-bottom: 10px;
            }
            .tdf{
                border-right:1px solid #ccc;
            }
            .tdcargo{
                border-bottom:1px solid #ccc;
            }
            td{
                padding:10px;vertical-align: top;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../">CTS</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <?php if(isset($_SESSION['username'])) { ?>
                              <li><a href="#">Hello <b><?=$_SESSION['username']?></b></a></li>
                              <li><a href="../admin">Admin Part</a></li>
                              <li><a href="../admin/logout.php">Logout</a></li>
                        <?php } else { ?>
                        <li><a href="../admin/index.php">Login</a></li>
                        <?php } ?>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            <div class="row">
                <div  class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h1 style="text-align:center">Welcome to Wrong Way Airlines<br> <small> Working Hard to Exceed Delivery Standards </small></h1>
                            <div class="jumbotron flight">Look for Flight</div>
                             <div class="main">
                            <form method="post" class="col-md-8" id="flightsearch">
                                <div class="form-group">
                                    <label for="flightSearch">Enter Your Flight's Destination:</label>
                                    <input type="text" class="form-control" id="flightDest" name="flightDest" maxlength="3" placeholder="Ex: Houston, TX" required>
                                </div>

                                <button type="submit" name="look" class="btn btn-primary col-lg-4">Look</button>

                            </form>
                                 
                              <div class="col-md-12" id="placeresult" style="display:none">
                                    <br/>
                                    <h2>Result </h2>
                                    <hr/>
                                    <div class="result">
                                        
                                    </div>
                                </div>

                                
                                 
                                    
                             </div>
                        </div>

                    </div>
                </div>

            </div>

            <script src="//code.jquery.com/jquery.js"></script>
	    <script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
            
             <script>
                $(document).ready(function () {
                    $("#flightsearch").submit(function (event) {
                        event.preventDefault();
                         $('.result').html("");
                         console.log("Running AJAX call now");
			 $.ajax({
                            type: "POST",
                            url: "flightlookup.php",
                            data: $('form').serialize(),
                            success: function (data) {
           			console.log("AJAX Call successful, parsing response");	
                                var datas = $.parseJSON(data);
                       
                                if(datas != "No Result Found!"){
                               $.each(datas, function(index, dt) {
                                if(dt.FlightNum != null){
                               var result = '<table width="100%" style="    background: #eee;border: 1px solid;">'+
                                        '<tr><td class="tdf"> <b>Flight Number</b> : ' + dt.FlightNum + '<br/>'+
                                       '<b>Departure From</b> : ' +dt.DepartureFrom + '<br/>' +
                                       '<b>Departure To</b> : ' + dt.DepartureTo + '<br/>' +
                                       '<b>Departure Time</b> : ' + dt.DepartureTime + '<br/>' +
                                      ' <b>Arrival Time</b> : ' + dt.ArrivalTime + '<br/><td>' +
                                        
                                      ' <b>Pilote Name </b> : ' + dt.PilotName + '<br/>' +
                                     '  <b>Navigator Name </b> : '+ dt.NavigatorName + '<br/>' +
                                     '  <b>AirCraft Type</b> : ' + dt.Type + '<br/>' +
                                     '  <b>Fuel Count</b> : ' + dt.FuelCount + '<br/> </tr></table><hr/>';
                             
                   
                                     $('#placeresult').css("display","block");
                                     $('.result').html($('.result').html()+result); 
                                 }
                           
                            });
                            }else{
                            $('#placeresult').css("display","block");
                                     $('.result').html(data); 
                            }
                            },
			        error: function (xhr, ajaxOptions, thrownError)
			        {
				    console.log(xhr.status);
				    console.log(xhr.responseText);
				    console.log(thrownError);
			        }
                        });
                    });
                });



            </script>
    </body>
</html>
