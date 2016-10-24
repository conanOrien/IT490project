<?php

if (isset($_POST['edited'])) {
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
            <input type="hidden" name="type" value="cr" /></th>

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
            <input type="hidden" name="type" value="cre" /></th>

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
            <input type="hidden" name="type" value="ca" /></th>

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
            <input type="hidden" name="type" value="fl" /></th>

  
  
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





    