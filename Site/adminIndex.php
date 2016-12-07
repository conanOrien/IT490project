<!DOCTYPE html>

<!--- Importing admin functions -->

<?php session_start();?>

<html lang=en>
	<httpErrors errorMode="Detailed" />


        <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Import bootstrap stylesheet and scripts  -->
        <link rel="stylesheet" href="../Theme/bootstrap-3.3.7-dist/css/bootstrap.css">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.js"></script>       
	<script src="../js/adminpage.js"></script>
	
        <nav class="navbar navbar-default">
	    <div class="container-fluid">
	      <!-- Collect the nav links, forms, and other content for toggling -->
	      <div class="navbar-collapse collapse" id="navBar1">
	       <ul class="nav navbar-nav navbar-left">
		<li><a href="#browseModal" class="btn" id="browseButton" role="button" data-toggle="modal" data-target="#browseModal">Browse System</a></li> 
		<li><a href="#addModal" class="btn" id="addButton" role="button" data-toggle="modal" data-target="#addModal">Edit System</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		 <?php if(isset($_SESSION['username'])) { ?>
		 <li><a href="#">Hello <b><?=$_SESSION['username']?></b></a></li>
		 <li><a href="functions/logout.php">Logout</a></li>
		 <?php } else { ?>
                 <!--<li><a href="admin/index.php">Login</a></li>-->
                 <li><a href="#loginModal" role="button" class="btn" data-toggle="modal" id="loginButton" data-target="#loginModal">Login</a></li>
                 <?php } ?>
		</ul>
	      </div>
	    </div>
	  </nav>

<body>
        <div class="row">
		<div >
                        <h1 style="text-align:center">Welcome to Wrong Way Airlines<br> <small> Working Hard to Exceed Delivery Standards </small></h1>
                </div>
        </div>
	
	<div class="buffer"> <!--- Buffer for organization purposes --->
		<div class="row">
			<h1></h1>	
		</div>
		<div class="row">
			<h1></h1>	
		</div>	
	</div>

	<div class="row"> <!--- DB search box --->
		<div class="col-md-8"> 
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="Harbor_Freight_Trucking.jpg" style="height: auto; width: auto; float-left;"></img>
			
		</div>
		<div class="col-md-4">
	 	<label for="dbSearch">Query the Database</label>
		<form class="form-dbSearch" id="dbSearch">

		    <div class="form-group">
		      <input type="text" class="form-group form-group-lg" id="searchDB" name="searchDB" placeholder="Query...">
		      <button type="button" class="btn btn-default" id="searchButton">Submit</button>
		    </div>
		 </form>

                </div>
        </div>
	
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labeledby="basicModal" aria-hidden="true" >
  	 	<div class="modal-dialog">
 			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="loginModalLabel">Admin Login</h4>
				</div>
				<div class="modal-body">
						<h2 class="form-signin-heading">Please enter your login credentials</h2>
						<form class="form-signin" id="loginForm" action="submit" role="form">
						     <div class="form-group">							
							<input type="text" class="form-control" id="uName" name="uName" placeholder="Username" required=""></input>
						     </div>
						     <div class="form-group">
							<input type="password" class="form-control" id="uPass" name="uPass" placeholder="Password" required=""></input>
						     </div>
						</form>
						<div class="text-right">
							<button type="button" class="btn btn-main" id="lSubmit" name="lSubmit">Login</button>
						</div>
				</div>
			</div>
		</div>
	</div>
	
	  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labeledby="basicModal" aria-hidden="true" >
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content">   
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" <span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title" id="addModalLabel">Add an entry to a Database table</h4>
		</div>
		
		<div class="modal-body">
		  <div class="container-fluid">
		    <div class="row">
		      <div  class="col-md-12">
		        <div class="panel panel-default">
		          <div class="panel-body">
		            <form class="form-manage">
		              <div class="radio">
		                <label><input type="radio" value="add" name="adddelete" id="adddelete">Add</label>
		              </div>
		              
		              <div class="radio">
		                <label><input type="radio" value="delete" name="adddelete" id="adddelete">Delete</label>
		              </div>
		        
		              <div class="radio">
		                <label><input type="radio" value="edit" name="adddelete" id="adddelete">Edit</label>
		              </div>
		           
		              <div class="form-group">
		                <label for="browse">Browse:</label>
		                <select class="form-control" id="browse" name="browse">
		                  <option value="cr">Crafts</option>
		                  <option value="cre">Crews</option>
		                  <option value="ca">Cargo</option>
		                  <option value="fl">Flights</option>
		                </select>
		              </div>
		             
		              <button type="submit" name="look" id="look" class="btn btn-primary col-lg-4">Manage</button>
		            </form>
		           
			    <div class="container-fluid" >
		              <div class="row">
		                <div  class="col-md-11" id="result">
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close Window</button>
		</div>
	      </div>
	    </div>
	  </div>
	</div>
	</div>
	</div>
	<div class="modal fade" id="browseModal" tabindex="-1" role="dialog" aria-labeledby="basicModal" aria-hidden="true" >
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">   
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="addModalLabel">Select a Database to browse</h4>
	      </div>
		
	      <div class="modal-body">
		<div class="container-fluid">
		  <div class="row">
		    <div  class="col-md-12">
        	      <div class="panel panel-default">
        	        <div class="panel-body">
                    	  <form>
                   	    <div class="form-group">
		 	      <label for="browse">Select a table to Browse:</label>
		              <select class="form-control" id="browseT" name="browseT">
		                <option value="cr">Crafts</option>
		                <option value="cre">Crews</option>
		                <option value="ca">Cargo</option>
		                <option value="fl">Flights</option>
		              </select>
		            </div>
		          </form>
		        <div id="resultT">
		        </div>
		      </div>
		    </div>
		  </div>
       		</div> 
	      </div>
	      <div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close Window</button>
	      </div>
	    </div>
	  </div>
	</div>
	</div>

	<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labeledby="basicModal" aria-hidden="true" >
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">   
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="addModalLabel">Query Results:</h4>
	      </div>
		
	      <div class="modal-body">
		<div class="container-fluid">
		<!--	<form id="form-dbSearch1">
				<div class="form-group">
					<input type="text" class="form-group form-group-lg" id="searchDB1" name="searchDB1" placeholder="Search" require="">
					<button type="button" class="btn btn-default" id="searchButton1">Search DB</button>
				</div>	
			</form>
		</div>
		<div class="buffer">
		<div class="row">
			<h1></h1>	
		</div> 
		<div class="row">
			<h1></h1>	
		</div> -->	
		</div> 
		<div class="container-fluid">
		  <div class="row" id="sResult">
		  </div>	
       		</div> 
	      </div>
	    </div>
	  </div>


	  <script language="javascript">
            $(document).ready( function() {
		var lButton = document.getElementById("lSubmit");
		var sBrowse = document.getElementById("browse");
		var sButton = document.getElementById("searchButton");		
		var sButton1 = document.getElementById("searchButton1");


		lButton.onclick = function(event){
			checkLogin();
		}
				
		$('#browseT').change( function() {
	//	    	console.log($(this).val()); // the selected options’s value
		    	fetchTable();		
		 });

							        

		$(".form-manage").submit(function (event) {
                        event.preventDefault();
                        if($('input[name=adddelete]:checked', '.form-manage').val()=="add"){
                            addform();
                        }
                         if($('input[name=adddelete]:checked', '.form-manage').val()=="delete"){
                            deletetable1();
                        }
                           if($('input[name=adddelete]:checked', '.form-manage').val()=="edit"){
                            edittable();
                        }
                        
             	});
		
		sButton.onclick = function(event){
				if (document.getElementById("searchDB").value == "")
        			{
			            // something is wrong
			            alert('Please enter a search term');
			            return false;
        			}
				else
				{
					searchDB("0");
				}
	
			}
		sButton1.onclick = function(event){
				if (document.getElementById("searchDB1").value == "")
        			{
			            // something is wrong
			            alert('Please enter a search term');
			            return false;
        			}
				else
				{
					searchDB("1");
				}
	
			}
		
		
	    }); 
	  </script>
</body>
</html>







