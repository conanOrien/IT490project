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

            .wrapper {	
                margin-top: 80px;
                margin-bottom: 80px;
            }

            .form-signin {
                max-width: 380px;
                padding: 15px 35px 45px;
                margin: 0 auto;
                background-color: #fff;
                border: 1px solid rgba(0,0,0,0.1);  

                .form-signin-heading,
                .checkbox {
                    margin-bottom: 30px;
                }

                .checkbox {
                    font-weight: normal;
                }

                .form-control {
                    position: relative;
                    font-size: 16px;
                    height: auto;
                    padding: 10px;

                    &:focus {
                        z-index: 2;
                    }
                }

                input[type="text"] {
                    margin-bottom: -1px;
                    border-bottom-left-radius: 0;
                    border-bottom-right-radius: 0;
                }

                input[type="password"] {
                    margin-bottom: 20px;
                    border-top-left-radius: 0;
                    border-top-right-radius: 0;
                }
            }
            
            .pp{
                background:#12c3cc;text-align: center;
            }
            .pp a{color:white;}
            .pp a:hover{color:white;text-decoration: none}
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
                        <li><a href="logout.php">Logout</a></li>
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
                             <?php if(isset($_SESSION['username'])) { ?>
                             <div  class="col-md-4">
                                <div class="jumbotron pp">

                                    <p><a  href="./browse.php" role="button">Browse</a></p>
                                </div>

                            </div>
                              <div  class="col-md-4">
                                <div class="jumbotron pp">

                                    <p><a  href="./search.php" role="button">Search</a></p>
                                </div>

                            </div>
                            <div  class="col-md-4">
                                <div class="jumbotron pp">

                                    <p><a  href="./manage.php" role="button">Manage</a></p>
                                </div>

                            </div>
                             <?php } else { ?>
                            <div class="wrapper">
                                <form class="form-signin">       
                                    <div id="error"></div>
                                    <h2 class="form-signin-heading">Login</h2>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                                    <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
                                </form>
                            </div>
                            
                             <?php } ?>


                        </div>

                    </div>
                </div>

            </div>
            <script src="../Theme/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
            <script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

            <script>
                $(document).ready(function () {
                    $(".form-signin").submit(function (event) {
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "checklogin.php",
                            data: $('form').serialize(),
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
