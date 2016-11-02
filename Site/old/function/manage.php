<?php session_start(); ?>
<html>
    <head>
        <title>Manage</title>
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
                    <a class="navbar-brand" href="./">CTS</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['username'])) { ?>
                            <li><a href="#">Hello <b><?= $_SESSION['username'] ?></b></a></li>
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
                            <div class="container" >
                            <div class="row">
                            <div  class="col-md-11" id="result">
                            </div>
                            </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
            <script src="../Theme/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
            <script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

            <script>
                $(document).ready(function () {
                    
                       $(".form-manage").submit(function (event) {
                        event.preventDefault();
                        if($('input[name=adddelete]:checked', '.form-manage').val()=="add"){
                            addform();
                        }
                         if($('input[name=adddelete]:checked', '.form-manage').val()=="delete"){
                            deletetable();
                        }
                           if($('input[name=adddelete]:checked', '.form-manage').val()=="edit"){
                            edittable();
                        }
                        
                         });
                         
                         
                       
                      function addform(){
                    
                        $.ajax({
                            type: "POST",
                            url: "addform.php",
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
                            url: "edittable.php",
                            data: $('form').serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#result").html(dt);
                            }
                        });
                   
                      }
                      function deletetable(){
                        $.ajax({
                            type: "POST",
                            url: "deletetable.php",
                            data: $('form').serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#result").html(dt);
                            }
                        });
                      }
                });



            </script>
    </body>
</html>
