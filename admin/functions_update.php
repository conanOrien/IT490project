<?php
session_start();
function search_fightdes(){
     include '../config.php';
    // getting data 
    $flightDest = trim($_POST['flightDest']);

    $sql = "SELECT
                        flight.*,
                        aircrew.*,
                        aircraft_info.*
                      FROM
                        flight
                        JOIN aircrew ON flight.CrewID = aircrew.CrewID 
                        JOIN aircraft_info ON flight.TailNum = aircraft_info.TailNumber 
                      WHERE flight.DepartureTo = '$flightDest' AND flight.SkidNum IS NULL";


    $result = $conn->query($sql);

     if ($result->num_rows > 0) {
        // output data of each row
         $data = array();
        while($row = $result->fetch_assoc()){
            $data[]=$row;
        }
        //  $data = join($row, " , ");
        echo json_encode($data);
    } else {
        echo json_encode("No Result Found!");
    }
    $conn->close();
}
function search_cargoid(){
     include '../config.php';
    $cargoID = trim($_POST['cargoID']);
    // this is the sql join between 4 tables
    $sql = "SELECT
                        flight.*,
                        cargo.*,
                        aircrew.*,
                        aircraft_info.*
                      FROM
                        flight
                        JOIN cargo ON flight.SkidNum = cargo.SkidNum
                        JOIN aircrew ON flight.CrewID = aircrew.CrewID 
                        JOIN aircraft_info ON flight.TailNum = aircraft_info.TailNumber 
                      WHERE  flight.SkidNum = $cargoID";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $data = array();
       while($row = $result->fetch_assoc()){
            $data[]=$row;
        }

        echo json_encode($data);
 
    } else {
        echo  json_encode( "No Result Found!");
    }
    $conn->close();
}
function add_form(){
     include '../config.php';
    $data = "";
    if ($_POST['browse'] == "cr") {

        $data.="<h2>Crafts</h2>";
        $data.="<div id='message'></div>";
        $data.='  <form id="addform">
            <input type="hidden" name="type_action" value="cr" /></th>

                <div class="form-group">  
                  <label for="tailnumber">Tail Number:</label>
                  <input type="number" class="form-control" id="tailnumber" name="tailnumber"  max="99999" required placeholder="12345"/>
                <div class="form-group">
                  <label for="type1">Type :</label>
                  <input type="text" class="form-control" id="type1" name="type1" maxlength="3" required placeholder="abc">
                </div>
                 <div class="form-group">
                  <label for="fuelcount">Fuel Count:</label>
                  <input type="number" class="form-control" id="fuelcount" name="fuelcount" max="99999" required placeholder="12345">
                </div>

                <button type="submit" class="btn btn-default">Add</button>
              </form>
                    ';
     
    }
        if ($_POST['browse'] == "cre") {

                $data.="<h2>Crew</h2>";
            $data.="<div id='message'></div>";
            $data.='  <form id="addform">
            <input type="hidden" name="type" value="cre" /></th>

                <div class="form-group">  
                  <label for="crewid">Crew ID:</label>
                  <input type="number" class="form-control" id="crewid" name="crewid"  max="999" required placeholder="123"/>
                <div class="form-group">
                  <label for="pilotname">Pilote Name :</label>
                  <input type="text" class="form-control" id="pilotname" name="pilotname" maxlength="40" required >
                </div>
                 <div class="form-group">
                  <label for="navigatorname">Navigator Name:</label>
                  <input type="text" class="form-control" id="navigatorname" name="navigatorname" maxlength="40" required >
                </div>

                <button type="submit" class="btn btn-default">Add</button>
              </form>
                    ';

        }
        if ($_POST['browse'] == "ca") {
            $data.="<h2>Cargo</h2>";
            $data.="<div id='message'></div>";
            $data.='  <form id="addform">
            <input type="hidden" name="type" value="ca" /></th>

                <div class="form-group">  
                  <label for="cargonumber">Cargo Number:</label>
                  <input type="number" class="form-control" id="cargonumber" name="cargonumber" Placeholder="1234" max="9999" required/>
                <div class="form-group">
                  <label for="weight">Weight:</label>
                  <input type="number" class="form-control" id="weight" name="weight" Placeholder="1234" max="9999" required>
                </div>
                 <div class="form-group">
                  <label for="Content">Content:</label>
                  <input type="text" class="form-control" id="content" name="content" maxlength="60" required>
                </div>

                <button type="submit" class="btn btn-default">Add</button>
              </form>
                    ';

        }
        if ($_POST['browse'] == "fl") {
                 $data.="<h2>Flight</h2>";
            $data.="<div id='message'></div>";
            $data.='  <form id="addform">
            <input type="hidden" name="type" value="fl" /></th>

  
  
                <div class="form-group">  
                  <label for="crewid">Flight Number:</label>
                  <input type="number" class="form-control" id="flightnum" name="flightnum"  max="9999" required placeholder="1234"/>
                </div>
                <div class="form-group">
                    <label for="tailnum">Craft:</label>
                     <select class="form-control" id="tailnum" name="tailnum">';
                              
               $sql = "SELECT * FROM aircraft_info ";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                   $data .='<option value="'.$row['TailNumber'].'">'.$row['TailNumber'].'</option>';
                    

                    }
                }
                $data.='  </select>
                              </div>
                   <div class="form-group">
                    <label for="tailnum">Crew:</label>
                     <select class="form-control" id="crewid" name="crewid">';
                                 
               $sql = "SELECT * FROM aircrew ";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                   $data .='<option value="'.$row['CrewID'].'">'.$row['CrewID'].'</option>';
                    

                    }
                }
                     $data.=' </select>
                              </div><div class="form-group">
                  <label for="departurefrom">Departure From :</label>
                  <input type="text" class="form-control" id="departurefrom" name="departurefrom" maxlength="3" required >
                </div>
                  <div class="form-group">
                  <label for="departureto">Departure To :</label>
                  <input type="text" class="form-control" id="departureto" name="departureto" maxlength="3" required >
                </div>
                <div class="form-group">
                  <label for="departuretime">Departure Time :</label>
                  <input type="text" class="form-control" id="departuretime" name="departuretime" maxlength="19" required placeholder="dd-mm-yyyy hh:mm:ss">
                </div>
                <div class="form-group">
                  <label for="arrivaltime">Arrival Time :</label>
                  <input type="text" class="form-control" id="arrivaltime " name="arrivaltime" maxlength="19" required placeholder="dd-mm-yyyy hh:mm:ss">
                </div> <div class="form-group">
                    <label for="skidnum">Cargo Number:</label>
                     <select class="form-control" id="skidnum" name="skidnum"><option value="null">NULL</option>';
                      $sql = "SELECT * FROM cargo ";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                   $data .='<option value="'.$row['SkidNum'].'">'.$row['SkidNum'].'</option>';
                    

                    }
                }

               $data.=' </select>
                              </div> <button type="submit" class="btn btn-default">Add</button>
              </form>
                    ';

            
        }
        $data.= '<script>$("#addform").submit(function (event) {
                        event.preventDefault();
                         $.ajax({
                            type: "POST",
                            url: "functions.php",
                            data: $("#addform").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#message").html(dt);
                                
                            }
                        });
                        });
                    
                      </script>';
        echo json_encode($data);
}
function add_action(){
     include '../config.php';
    
    if($_POST['type_action'] == "cr"){
          $tailnumber=trim($_POST['tailnumber']);
         $type1=trim($_POST['type1']);
         $fuelcount=trim($_POST['fuelcount']);
       
        $sql = "INSERT INTO aircraft_info (TailNumber, Type, FuelCount)
        VALUES ($tailnumber, '$type1', $fuelcount)";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCraft added successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();

    
    }
    
      if($_POST['type_action'] == "cre"){
        $crewid=trim($_POST['crewid']);
         $pilotname=trim($_POST['pilotname']);
         $navigatorname=trim($_POST['navigatorname']);

        $sql = "INSERT INTO aircrew (CrewID, PilotName, NavigatorName)
        VALUES ($crewid, '$pilotname', '$navigatorname')";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCrew added successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
    }
    
      if($_POST['type_action'] == "ca"){
         $cargonumber=trim($_POST['cargonumber']);
         $weight=trim($_POST['weight']);
         $content=trim($_POST['content']);
       
        $sql = "INSERT INTO cargo (SkidNum, Weight, Content)
        VALUES ($cargonumber, $weight, '$content')";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("Cargo added successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
    }


    
  
      if($_POST['type_action'] == "fl"){
         $flightnum=trim($_POST['flightnum']);
         $tailnum=trim($_POST['tailnum']);
         $crewid=trim($_POST['crewid']);
         $departurefrom=trim($_POST['departurefrom']);
         $departureto=trim($_POST['departureto']);
         $departuretime=trim($_POST['departuretime']);
         $arrivaltime=trim($_POST['arrivaltime']);
         if($_POST['arrivaltime']=="null"){
             $skidnum=NULL;
         }else{
             $skidnum=trim($_POST['skidnum']);
         }
         
            $departuretime = strtotime($departuretime);
             $arrivaltime = strtotime($arrivaltime);

       
        $sql = "INSERT INTO flight (FlightNum, TailNum, CrewID,DepartureFrom,DepartureTo,DepartureTime,ArrivalTime,SkidNum)
        VALUES ($flightnum, $tailnum, $crewid,'$departurefrom','$departureto',FROM_UNIXTIME($departuretime),FROM_UNIXTIME($arrivaltime),$skidnum )";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("Flight added successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
      }
    
}
function browse_data(){
    
     include '../config.php';
    $data = "";
    if ($_POST['browsedata'] == "cr") {

        $data.="<h2>Crafts</h2>";
        $data.='   <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Tail Number</th>
                    <th>Type </th>
                    <th>Fuel Count</th>
                    </tr>
                    </thead>
                    <tbody>';
        $sql = "SELECT * FROM aircraft_info ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
           $data .='<tr><td>'.$row['TailNumber'].'</td><td>'.$row['Type'].'</td><td>'.$row['FuelCount'].'</td></tr>';
            }
            
        }
        $data.='</tbody></table>';
    }
        if ($_POST['browsedata'] == "cre") {

            $data.="<h2>Crews</h2>";
            $data.='   <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Crew ID</th>
                    <th>Pilote Name </th>
                    <th>Navigator Name</th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM aircrew ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['CrewID'].'</td><td>'.$row['PilotName'].'</td><td>'.$row['NavigatorName'].'</td></tr>';
                 }
            }
            $data.='</tbody></table>';
        }
        if ($_POST['browsedata'] == "ca") {
            $data.="<h2>Cargo</h2>";
             $data.='   <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Cargo Number</th>
                    <th>Weight</th>
                    <th>Content</th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM cargo ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { 
                   while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['SkidNum'].'</td><td>'.$row['Weight'].'</td><td>'.$row['Content'].'</td></tr>';
                   }
            }
            $data.='</tbody></table>';
        }
        if ($_POST['browsedata'] == "fl") {
            $data.="<h2>Flights</h2>";
            $data.='   <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Flight Number</th>
                    <th>Tail Number</th>
                    <th>Crew ID</th>
                    <th>Departure From </th>
                    <th>Departure To </th>
                    <th>Departure Time </th>
                    <th>Arrivals Time </th>
                    <th>Cargo Number</th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM flight ";
            $result = $conn->query($sql);
  
            if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['FlightNum'].'</td><td>'.$row['TailNum'].'</td><td>'.$row['CrewID'].'</td><td>'.$row['DepartureFrom'].'</td><td>'.$row['DepartureTo'].'</td><td>'.$row['DepartureTime'].'</td><td>'.$row['ArrivalTime'].'</td><td>'.$row['SkidNum'].'</td></tr>';
                   }
            }
            $data.='</tbody></table>';
        }
        echo json_encode($data);
}
function check_login(){
    
      include '../config.php';
    // getting data 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password = hash("sha256",$password);
    $sql = "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
    $result = $conn->query($sql);

     if ($result->num_rows > 0) {
         $_SESSION['username'] = $username;
       echo json_encode(TRUE);
    } else {
        echo json_encode(FALSE);
    }
    $conn->close();
}
function delete_action(){
    include '../config.php';
    
    if($_POST['type_action'] == "cr"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM aircraft_info where TailNumber=".$d;
         $conn->query($sql);
    }
    echo json_encode("AirCraft delete successfully");
    }
    
      if($_POST['type_action'] == "cre"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM aircrew  where CrewID=".$d;
         $conn->query($sql);
    }
    echo json_encode("Crew delete successfully");
    }
      if($_POST['type_action'] == "ca"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM cargo where SkidNum=".$d;
         $conn->query($sql);
    }
    echo json_encode("Cargo delete successfully");
    }
      if($_POST['type_action'] == "fl"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM flight where FlightNum=".$d;
         $conn->query($sql);
    }
    echo json_encode("Flight delete successfully");
    }
    
    
}
function delete_table(){
    
    include '../config.php';
    $data = "";
    if ($_POST['browse'] == "cr") {

        $data.="<h2>Crafts</h2>";
        $data.="<div id='message'></div>";
        $data.='  <form id="deleteform"> <table class = "table table-striped">
            
                    <thead>
                    <tr>
                    <th>Tail Number</th>
                    <th>Type </th>
                    <th>Fuel Count</th>
                    <th><input type="submit" name="delete" value="Delete"/><input type="hidden" name="type_action" value="cr" /></th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
        $sql = "SELECT * FROM aircraft_info ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
           $data .='<tr><td>'.$row['TailNumber'].'</td><td>'.$row['Type'].'</td><td>'.$row['FuelCount'].'</td><td><input type="checkbox" name="deleted[]" value="'.$row['TailNumber'].'"/></td></tr>';
            }
            
        }
     
    }
        if ($_POST['browse'] == "cre") {

            $data.="<h2>Crews</h2>";
               $data.="<div id='message'></div>";
            $data.='   <form id="deleteform">  <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Crew ID</th>
                    <th>Pilote Name </th>
                    <th>Navigator Name</th>
                     <th><input type="submit" name="delete" value="Delete"/><input type="hidden" name="type" value="cre" /></th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM aircrew ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['CrewID'].'</td><td>'.$row['PilotName'].'</td><td>'.$row['NavigatorName'].'</td><td><input type="checkbox" name="deleted[]" value="'.$row['CrewID'].'"/></td></tr>';
                 }
            }

        }
        if ($_POST['browse'] == "ca") {
            $data.="<h2>Cargo</h2>";
               $data.="<div id='message'></div>";
             $data.='   <form id="deleteform"> <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Cargo Number</th>
                    <th>Weight</th>
                    <th>Content</th>
                     <th><input type="submit" name="delete" value="Delete"/><input type="hidden" name="type" value="ca" /></th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM cargo ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { 
                   while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['SkidNum'].'</td><td>'.$row['Weight'].'</td><td>'.$row['Content'].'</td><td><input type="checkbox" name="deleted[]" value="'.$row['SkidNum'].'"/></td></tr>';
                   }
            }

        }
        if ($_POST['browse'] == "fl") {
            $data.="<h2>Flights</h2>";
               $data.="<div id='message'></div>";
            $data.='   <form id="deleteform">  <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Flight Number</th>
                    <th>Tail Number</th>
                    <th>Crew ID</th>
                    <th>Departure From </th>
                    <th>Departure To </th>
                    <th>Departure Time </th>
                    <th>Arrivals Time </th>
                    <th>Cargo Number</th>
                     <th><input type="submit" name="delete" value="Delete"/><input type="hidden" name="type" value="fl" /></th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM flight ";
            $result = $conn->query($sql);
  
            if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['FlightNum'].'</td><td>'.$row['TailNum'].'</td><td>'.$row['CrewID'].'</td><td>'.$row['DepartureFrom'].'</td><td>'.$row['DepartureTo'].'</td><td>'.$row['DepartureTime'].'</td><td>'.$row['ArrivalTime'].'</td><td>'.$row['SkidNum'].'</td><td><input type="checkbox" name="deleted[]" value="'.$row['FlightNum'].'"/></td></tr>';
                   }
            }
            
        }
        $data.='</tbody></table></form><script>$("#deleteform").submit(function (event) {
                        event.preventDefault();
                         $.ajax({
                            type: "POST",
                            url: "functions.php",
                            data: $("#deleteform").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#message").html(dt);
                                delete_table();
                            }
                        });
                        });
                        function delete_table(){
                        $.ajax({
                            type: "POST",
                            url: "functions.php",
                            data: $(".form-manage").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#result").html(dt);
                            }
                        });
                      }</script>';
        echo json_encode($data);
}
function edit_form(){
    
       include '../config.php';
    $data = "";
      $id = $_POST['edited'];
    if ($_POST['type'] == "cr") {
  

       $sql = "SELECT * FROM aircraft_info where TailNumber =" . $id;
    $result = $conn->query($sql);
$row = $result->fetch_assoc();
        $data.="<h2>Crafts</h2>";
        $data.="<div id='message'></div>";
        $data.='  <form id="editform">
            <input type="hidden" name="type_action" value="cr" /></th>

                <div class="form-group">  
                  <!--<label for="tailnumber">Tail Number:</label>-->
                  <input type="hidden" class="form-control" id="tailnumber" name="tailnumber" value="'.$row['TailNumber'] .'"  max="99999" required placeholder="12345"/>
                <div class="form-group">
                  <label for="type1">Type :</label>
                  <input type="text" class="form-control" id="type1" name="type1" value="'.$row['Type'] .'"  maxlength="3" required placeholder="abc">
                </div>
                 <div class="form-group">
                  <label for="fuelcount">Fuel Count:</label>
                  <input type="number" class="form-control" id="fuelcount" value="'.$row['FuelCount'] .'"  name="fuelcount" max="99999" required placeholder="12345">
                </div>

                <button type="submit" class="btn btn-default">Update</button>
              </form>
                    ';
     
    }
        if ($_POST['type'] == "cre") {

            
       $sql = "SELECT * FROM aircrew where CrewID =" . $id;
    $result = $conn->query($sql);
$row = $result->fetch_assoc();

  
                $data.="<h2>Crew</h2>";
            $data.="<div id='message'></div>";
            $data.='  <form id="editform">
            <input type="hidden" name="type_action" value="cre" /></th>

                <div class="form-group">  
                 <!-- <label for="crewid">Crew ID:</label>-->
                  <input type="hidden" class="form-control" id="crewid" value="'.$row['CrewID'].'" name="crewid"  max="999" required placeholder="123"/>
                <div class="form-group">
                  <label for="pilotname">Pilote Name :</label>
                  <input type="text" class="form-control" id="pilotname" value="'.$row['PilotName'].'" name="pilotname" maxlength="40" required >
                </div>
                 <div class="form-group">
                  <label for="navigatorname">Navigator Name:</label>
                  <input type="text" class="form-control" id="navigatorname" value="'.$row['NavigatorName'].'" name="navigatorname" maxlength="40" required >
                </div>

                <button type="submit" class="btn btn-default">Update</button>
              </form>
                    ';

        }
        if ($_POST['type'] == "ca") {
            
                       
       $sql = "SELECT * FROM cargo where SkidNum =" . $id;
       $result = $conn->query($sql);
        $row = $result->fetch_assoc();
  
            $data.="<h2>Cargo</h2>";
            $data.="<div id='message'></div>";
            $data.='  <form id="editform">
            <input type="hidden" name="type_action" value="ca" /></th>

                <div class="form-group">  
                  <!--<label for="cargonumber">Cargo Number:</label>-->
                  <input type="hidden" class="form-control" id="cargonumber" value="'.$row['SkidNum'].'" name="cargonumber" Placeholder="1234" max="9999" required/>
                <div class="form-group">
                  <label for="weight">Weight:</label>
        <input type="number" class="form-control" id="weight" name="weight" value="'.$row['Weight'].'" Placeholder="1234" max="9999" required>
                </div>
                 <div class="form-group">
                  <label for="Content">Content:</label>
                  <input type="text" class="form-control" id="content" value="'.$row['Content'].'" name="content" maxlength="60" required>
                </div>

                <button type="submit" class="btn btn-default">Update</button>
              </form>
                    ';

        }
        if ($_POST['type'] == "fl") {
            
                              
       $sql = "SELECT * FROM flight where FlightNum =" . $id;
       $result = $conn->query($sql);
        $row2 = $result->fetch_assoc();
        
        
 
                 $data.="<h2>Flight</h2>";
            $data.="<div id='message'></div>";
            $data.='  <form id="editform">
            <input type="hidden" name="type_action" value="fl" /></th>

  
  
                <div class="form-group">  
                 <!-- <label for="crewid">Flight Number:</label>-->
                  <input type="hidden" class="form-control" id="flightnum" name="flightnum" value="'.$row2['FlightNum'].'"  max="9999" required placeholder="1234"/>
                </div>
                <div class="form-group">
                    <label for="tailnum">Craft:</label>
                     <select class="form-control" id="tailnum" name="tailnum">';
                              
               $sql = "SELECT * FROM aircraft_info ";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                      if($row2['TailNum'] == $row['TailNumber']) {
                   $data .='<option value="'.$row['TailNumber'].'" selected>'.$row['TailNumber'].'</option>';
                      }else{
                          
                           $data .='<option value="'.$row['TailNumber'].'">'.$row['TailNumber'].'</option>';
                      }
                    

                    }
                }
                $data.='  </select>
                              </div>
                   <div class="form-group">
                    <label for="tailnum">Crew:</label>
                     <select class="form-control" id="crewid" name="crewid">';
                                 
               $sql = "SELECT * FROM aircrew ";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                       if($row2['CrewID'] == $row['CrewID']) {
                   $data .='<option value="'.$row['CrewID'].'">'.$row['CrewID'].'</option>';
                       }else{
                                $data .='<option value="'.$row['CrewID'].'">'.$row['CrewID'].'</option>';
                           
                       }

                    }
                }
                     $data.=' </select>
                              </div><div class="form-group">
                  <label for="departurefrom">Departure From :</label>
                  <input type="text" class="form-control" id="departurefrom" value="'.$row2['DepartureFrom'].'" name="departurefrom" maxlength="3" required >
                </div>
                  <div class="form-group">
                  <label for="departureto">Departure To :</label>
                  <input type="text" class="form-control" id="departureto" value="'.$row2['DepartureTo'].'" name="departureto" maxlength="3" required >
                </div>
                <div class="form-group">
                  <label for="departuretime">Departure Time :</label>
                  <input type="text" class="form-control" id="departuretime" value="'.$row2['DepartureTime'].'" name="departuretime" maxlength="19" required placeholder="dd-mm-yyyy hh:mm:ss">
                </div>
                <div class="form-group">
                  <label for="arrivaltime">Arrival Time :</label>
                  <input type="text" class="form-control" id="arrivaltime " value="'.$row2['ArrivalTime'].'" name="arrivaltime" maxlength="19" required placeholder="dd-mm-yyyy hh:mm:ss">
                </div> <div class="form-group">
                    <label for="skidnum">Cargo Number:</label>
                     <select class="form-control" id="skidnum" name="skidnum"><option value="null">NULL</option>';
                      $sql = "SELECT * FROM cargo ";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                       if($row2['SkidNum'] == $row['SkidNum']){
                   $data .='<option value="'.$row['SkidNum'].'" selected>'.$row['SkidNum'].'</option>';
                       }else{
                                 $data .='<option value="'.$row['SkidNum'].'">'.$row['SkidNum'].'</option>';
                       }
                    

                    }
                }

               $data.=' </select>
                              </div> <button type="submit" class="btn btn-default">Update</button>
              </form>
                    ';

            
        }
        $data.= '<script>$("#editform").submit(function (event) {
                        event.preventDefault();
                         $.ajax({
                            type: "POST",
                            url: "editaction.php",
                            data: $("#editform").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#message").html(dt);
                                
                            }
                        });
                        });
                    
                      </script>';
        echo json_encode($data);
}
function edit_table(){
     include '../config.php';
    $data = "";
    if ($_POST['browse'] == "cr") {

        $data.="<h2>Crafts</h2>";
        $data.="<div id='message'></div>";
        $data.='  <form id="editform"> <table class = "table table-striped">
            
                    <thead>
                    <tr>
                    <th>Tail Number</th>
                    <th>Type </th>
                    <th>Fuel Count</th>
                    <th><input type="submit" name="edit" value="Edit"/><input type="hidden" name="type" value="cr" /></th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
        $sql = "SELECT * FROM aircraft_info ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
           $data .='<tr><td>'.$row['TailNumber'].'</td><td>'.$row['Type'].'</td><td>'.$row['FuelCount'].'</td><td><input type="checkbox" name="edited" value="'.$row['TailNumber'].'"/></td></tr>';
            }
            
        }
     
    }
        if ($_POST['browse'] == "cre") {

            $data.="<h2>Crews</h2>";
               $data.="<div id='message'></div>";
            $data.='   <form id="editform">  <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Crew ID</th>
                    <th>Pilote Name </th>
                    <th>Navigator Name</th>
                     <th><input type="submit" name="edit" value="Edit"/><input type="hidden" name="type" value="cre" /></th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM aircrew ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['CrewID'].'</td><td>'.$row['PilotName'].'</td><td>'.$row['NavigatorName'].'</td><td><input type="checkbox" name="edited" value="'.$row['CrewID'].'"/></td></tr>';
                 }
            }

        }
        if ($_POST['browse'] == "ca") {
            $data.="<h2>Cargo</h2>";
               $data.="<div id='message'></div>";
             $data.='   <form id="editform"> <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Cargo Number</th>
                    <th>Weight</th>
                    <th>Content</th>
                     <th><input type="submit" name="edit" value="Edit"/><input type="hidden" name="type" value="ca" /></th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM cargo ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { 
                   while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['SkidNum'].'</td><td>'.$row['Weight'].'</td><td>'.$row['Content'].'</td><td><input type="checkbox" name="edited" value="'.$row['SkidNum'].'"/></td></tr>';
                   }
            }

        }
        if ($_POST['browse'] == "fl") {
            $data.="<h2>Flights</h2>";
               $data.="<div id='message'></div>";
            $data.='   <form id="editform">  <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Flight Number</th>
                    <th>Tail Number</th>
                    <th>Crew ID</th>
                    <th>Departure From </th>
                    <th>Departure To </th>
                    <th>Departure Time </th>
                    <th>Arrivals Time </th>
                    <th>Cargo Number</th>
                     <th><input type="submit" name="edit" value="Edit"/><input type="hidden" name="type" value="fl" /></th>
                    </tr>
                    </thead>
                    <tbody>';
            $sql = "SELECT * FROM flight ";
            $result = $conn->query($sql);
  
            if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()){
                $data .='<tr><td>'.$row['FlightNum'].'</td><td>'.$row['TailNum'].'</td><td>'.$row['CrewID'].'</td><td>'.$row['DepartureFrom'].'</td><td>'.$row['DepartureTo'].'</td><td>'.$row['DepartureTime'].'</td><td>'.$row['ArrivalTime'].'</td><td>'.$row['SkidNum'].'</td><td><input type="checkbox" name="edited" value="'.$row['FlightNum'].'"/></td></tr>';
                   }
            }
            
        }
        $data.='</tbody></table></form>'
                    . '<script>$("#editform").submit(function (event) {
                        event.preventDefault();
                         $.ajax({
                            type: "POST",
                            url: "editform.php",
                            data: $("#editform").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#result").html(dt);
                                
                            }
                        });
                        });
                      </script>';
        echo json_encode($data);
    
}
function update_aircraft(){
    include '../config.php';
    
    if($_POST['type_action'] == "cr"){
          $tailnumber=trim($_POST['tailnumber']);
         $type1=trim($_POST['type1']);
         $fuelcount=trim($_POST['fuelcount']);
       
        $sql = "Update aircraft_info set  Type ='$type1' , FuelCount =$fuelcount  where TailNumber = $tailnumber ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCraft updated successfully");
        } else {
            echo json_encode("Error while updating !"); 
        }

        $conn->close();

    
    }
    
      if($_POST['type_action'] == "cre"){
        $crewid=trim($_POST['crewid']);
         $pilotname=trim($_POST['pilotname']);
         $navigatorname=trim($_POST['navigatorname']);


        
         $sql = "Update aircrew set  PilotName ='$pilotname' , NavigatorName ='$navigatorname'  where CrewID = $crewid ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCrew updated successfully");
        } else {
            echo json_encode("Error while updating !"); 
        }

        $conn->close();
    }
    
      if($_POST['type_action'] == "ca"){
         $cargonumber=trim($_POST['cargonumber']);
         $weight=trim($_POST['weight']);
         $content=trim($_POST['content']);
        
        
         $sql = "Update cargo set  Weight =$weight , Content ='$content'  where SkidNum = $cargonumber ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("Cargo updated successfully");
        } else {
            echo json_encode("Error while updating !"); 
        }

        $conn->close();
    }


    
  
      if($_POST['type_action'] == "fl"){
         $flightnum=trim($_POST['flightnum']);
         $tailnum=trim($_POST['tailnum']);
         $crewid=trim($_POST['crewid']);
         $departurefrom=trim($_POST['departurefrom']);
         $departureto=trim($_POST['departureto']);
         $departuretime=trim($_POST['departuretime']);
         $arrivaltime=trim($_POST['arrivaltime']);
         if($_POST['arrivaltime']=="null"){
             $skidnum=NULL;
         }else{
             $skidnum=trim($_POST['skidnum']);
         }
         
            $departuretime = strtotime($departuretime);
             $arrivaltime = strtotime($arrivaltime);

                 $sql = "Update flight set  TailNum =$tailnum , CrewID =$crewid ,DepartureFrom='$departurefrom',DepartureTo='$departureto',DepartureTime=FROM_UNIXTIME($departuretime),ArrivalTime=FROM_UNIXTIME($arrivaltime),SkidNum=$skidnum  where FlightNum = $flightnum ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("Flight updated successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
      }
}

function searchFlightNum($search) {
    include '../config.php';
    $data = "";
    $sql = "SELECT * FROM flight where FlightNum =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td style="background-color: #ccc !important;">' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchTailNum($search) {
    include '../config.php';
    $data = "";
    $sql = "SELECT * FROM flight where TailNum =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td style="background-color: #ccc !important;">' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchOrigin($search) {
    include '../config.php';
    $data = "";
    $sql = "SELECT * FROM flight where DepartureFrom ='" . $search . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td style="background-color: #ccc !important;">' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchDest($search) {
    include '../config.php';
    $data = "";
    $sql = "SELECT * FROM flight where DepartureTo ='" . $search . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td style="background-color: #ccc !important;">' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchCargo($search) {
    include '../config.php';
    $data = "";
    $sql = "SELECT * FROM flight where SkidNum =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td style="background-color: #ccc !important;">' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchCrew($search) {
    include '../config.php';
    $data = "";
    $sql = "SELECT * FROM flight where CrewID =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td style="background-color: #ccc !important;">' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

//cases

if(isset($_POST['flightDest'])){
    search_fightdes();
}

if(isset($_POST['cargoID'])){
    search_cargoid();
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    check_login();
}
if(isset($_POST['browsedata'])){
    browse_data();
}

if (isset($_POST['search'])) {

    $search = trim($_POST['search']);
    $data = "<h2>Flights</h2>";
    $data.='   <table class = "table table-striped">
                    <thead>
                    <tr>
                    <th>Flight Number</th>
                    <th>Tail Number</th>
                    <th>Crew ID</th>
                    <th>Departure From </th>
                    <th>Departure To </th>
                    <th>Departure Time </th>
                    <th>Arrivals Time </th>
                    <th>Cargo Number</th>
                    </tr>
                    </thead>
                    <tbody>';

    if (is_numeric($search) && strlen($search) == 4) {
        $data .= searchFlightNum($search);
        $data .= searchCargo($search);
    }
    if (is_numeric($search) && strlen($search) == 3) {
        $data .= searchCrew($search);
    }
    if (is_numeric($search) && strlen($search) == 5) {
        $data .= searchTailNum($search);
    }
    if (!is_numeric($search) && strlen($search) <= 3) {
        $data .= searchOrigin($search);
        $data .= searchDest($search);
    }

    $data.='</tbody></table>';



    echo json_encode($data);
}

if (isset($_POST['browse']) && $_POST['adddelete']=="add") {
    add_form();
}
if ((isset($_POST['browse']) && ( $_POST['adddelete']=="delete") || (isset($_GET['adddelete']) &&  $_GET['adddelete']=="delete" ) )) {
    delete_table();
}

if (isset($_POST['browse']) && $_POST['adddelete']=="edit") {
    edit_table();
}
if (isset($_POST['type_action']) && !isset($_POST['deleted']) ) {
    add_action();
}
if (isset($_POST['type_action']) && isset($_POST['deleted'])) {
    delete_action();
}
if (isset($_POST['type_action']) && isset($_POST['edited'])) {
    edit_form();
}


