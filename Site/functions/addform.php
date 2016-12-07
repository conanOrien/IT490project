<?php

if (isset($_POST['browse'])) {
    include '../../phpCode/config.php';
    $data = "";
    if ($_POST['browse'] == "cr") {

        $data.="<h2>Crafts</h2>";
        $data.="<div id='message'></div>";
        $data.='  <form id="addform">
            <input type="hidden" name="type" value="cr" /></th>

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
                   $data .='<option value="'.$row['Tail Number'].'">'.$row['Tail Number'].'</option>';
                    

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
                   $data .='<option value="'.$row['Crew ID'].'">'.$row['Crew ID'].'</option>';
                    

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
                            url: "functions/addaction.php",
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





    
