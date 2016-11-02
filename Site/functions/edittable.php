<?php

if (isset($_POST['browse'])) {
    include '../../phpCode/config.php';
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
           $data .='<tr><td>'.$row['Tail Number'].'</td><td>'.$row['Type'].'</td><td>'.$row['Fuel Count'].'</td><td><input type="checkbox" name="edited" value="'.$row['Tail Number'].'"/></td></tr>';
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
                $data .='<tr><td>'.$row['Crew ID'].'</td><td>'.$row['PilotName'].'</td><td>'.$row['NavigatorName'].'</td><td><input type="checkbox" name="edited" value="'.$row['Crew ID'].'"/></td></tr>';
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
                            url: "functions/editform.php",
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





    
