<?php session_start(); ?>
<html>
    <head>
        <title>Cargo Lookup</title>
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
            .cargo{

                background:orange; 
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
                width:100%;border:1px solid #ccc;padding:20px;border-radius: 5px;background:#fdf
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
                            <div class="jumbotron cargo">Look for Cargo</div>
                            <div class="main">
                                <form method="post" id="cargosearch" class="col-md-8">
                                    <div class="form-group">
                                        <label style="text-align:center" for="flightSearch">Enter Your Cargo ID for Flight Lookup</label>
                                        <input type="number" class="form-control" id="cargoID" name="cargoID" maxlength="4" placeholder="Ex: 1234" required>
                                    </div>

                                    <button type="submit" name="look" id="look" class="btn btn-primary col-lg-4">Look</button>

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
            <script src="../Theme/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
            <script src="../Theme/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
            <script src="../Theme/bootstrap-3.3.7-dist/js/customjs.js"></script>


        </div>
    </body>
</html>
