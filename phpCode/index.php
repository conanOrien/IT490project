<?php session_start(); ?>
<html>
    
        <link rel="stylesheet" href="../Theme/bootstrap-3.3.7-dist/css/bootstrap.css">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
        <script src="../js/adminpage.js"></script>
   
   
    <head>
        <title>Choose action</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Theme/bootstrap-3.3.7-dist/css/bootstrap.min.css">

        <style>


            body {
                background: #eee !important;	
            }

            .main{
                width:60%;
                margin:0 auto;

                padding:30px;
            }
            .flight{
                background:red;
                color:white;
                text-align:center
            }
            a{color:white;}
            a:hover{color:white;text-decoration:none}
            .cargo{

                background:orange; 
                color:white;
                     text-align:center
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
                    <a class="navbar-brand" href="#">CTS</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <?php if(isset($_SESSION['username'])) { ?>
                            <li><a href="#">Hello <b><?=$_SESSION['username']?></b></a></li>
                            <li><a href="./admin">Admin Part</a></li>
                            <li><a href="./admin/logout.php">Logout</a></li>
                        <?php } else { ?>
                        <!--<li><a href="admin/index.php">Login</a></li>-->
			<li><a href="#loginModal" role="button" class="btn" data-toggle="modal" id="loginButton" data-target="#loginModal">Login</a></li>
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
                            <?php 
                            if(isset($_GET['logout'])){
                            ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> You Logout seccessfully 
                              </div>
                            <?php } ?>
                            <div  class="col-md-6">
                                <div class="jumbotron flight">

                                    <p><a  href="flight/" role="button">Look for Flight</a></p>
                                </div>

                            </div>
                              <div  class="col-md-6">
                                <div class="jumbotron cargo">

                                    <p><a  href="cargo/" role="button">Look for Cargo</a></p>
                                </div>

                            </div>

                        


                        </div>
                    </div>

                </div>
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
                                      <div class="wrapper">
					<div id="error"></div>
					<form class="form-signin">
                                        <h2 class="form-signin-heading">Please enter your login credentials</h2>
                                        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
                                        <button type="button" class="btn btn-primary" type="submit">Login</button>
                                        </form>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close Window</button>

                               </div>
                        </div>
                </div>
    </div>

    <script>
      $(document).ready(function () {
        $(".form-signin").submit(function (event) {
          event.preventDefault();
	  var data = this.serializeArray();
	  data.push({name: "Action", value: 0});
            $.ajax({
              type: "POST",
              url: "checklogin.php",
              data: $$.param(data),
              success: function (data) {
                var dt = $.parseJSON(data);
                console.log(dt);
                if(dt== false){
                  $('#error').html('<div class="alert alert-danger"><strong>Login error !</strong> Username or password are not correct.</div>');
                  }else{
      	            location.reload(); 
                  }

              }
           });
        });
      });



            </script>

</body>
</html>
