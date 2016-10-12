<!DOCTYPE html>
<html lang=en>
        <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Import bootstrap stylesheet and scripts  -->
        <link rel="stylesheet" href="../Theme/bootstrap-3.3.7-dist/css/bootstrap.css">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.js"></script>       
	<script src="../js/adminpage.js"></script>
	
	 
        <nav class="navbar navbar-default">
	    <div class="container-fluid">
	      <!-- Collect the nav links, forms, and other content for toggling -->
	      <div class="collapse navbar-collapse" id="navBar1">
		<ul class="nav navbar-nav">
		  <li class="active"><a href="./adminHome.php">Home<span class="sr-only">(current)</span></a></li>
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit System<span class="caret"></span></a>
		    <ul class="dropdown-menu">
		      <li><a href="#">Cargo</a></li>
		      <li><a href="#">Crafts</a></li>
		      <li><a href="#">Crews</a></li>
		      <li><a href="#">Flights</a></li>
		    </ul>
		  </li>
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
		    <ul class="dropdown-menu">
		      <li><a href="#">Add</a></li>
		      <li><a href="#">Delete</a></li>
		      <li><a href="#">Edit</a></li>
		    </ul>
		  </li>   
		</ul>
		 <form class="navbar-form navbar-right">
		    <div class="form-group">
		      <input type="text" class="form-control" id="searchDB" name="searchDB" placeholder="Search">
		    </div>
		    <button type="submit" class="btn btn-default">Submit</button>
		 </form>
		<ul class="nav navbar-nav navbar-right">
		  <li><a href="#loginModal" role="button" class="btn" data-toggle="modal" id="loginButton" data-target="#loginModal">Login</a></li>
		</ul>
	      </div>
	    </div>
	  </nav>

<body>
        <div class="row">
		<div class="col-md-10">
                        <h1 style="text-align:center">Welcome to Wrong Way Airlines<br> <small> Working Hard to Exceed Delivery Standards </small></h1>
                </div>
        </div>

	<div class="row">
		<div class="col-md-8">
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-xs-8">
					<label style="text-align:center" for="flightSearch">Enter Your Cargo's Destination:</label>
					<input type="text" class="form-control" id="flightDest" name="flightDest" placeholder="Ex: Houston, TX">
				</div>
			</div>
			<div class="row">
				<h1><br></h1>
			</div>
			<div class="row">
				<div class="col-xs-8">
                                	<label style="text-align:center" for="flightSearch">Enter Your Cargo ID for Flight Lookup:</label>
                                	<input type="number" class="form-control" id="cargoID" name="cargoID" placeholder="Ex: 12345">
                        	</div>
			</div>
                </div>
        </div>
	
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labeledby="basicModal" aria-hidden="true" style="display: none;">
  	 	<div class="modal-dialog">
 			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="loginModalLabel">Admin Login</h4>
				</div>
				<div class="modal-body">
					<h3>Please enter your login credentials</h3>
					<input type="text" class="form-control" id="uName" name="uName" placeholder="Username" required="true"></input>
					<input type="password" class="form-control" id="uPass" name="uPass" placeholder="Password" required="true"></input>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-defaul" data-dismiss="modal">Close Window</button>
					<button type="button" class="btn btn-primary" onclick="aLogin()">Login</button>
				</div>
			</div>
		</div>
	  </div>
</body>
</html>







