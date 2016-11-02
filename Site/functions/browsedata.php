<?php

if (isset($_POST['browseT'])) {
    include '../../phpCode/config.php';
    $data = "";
    if ($_POST['browseT'] == "cr") {

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
           $data .='<tr><td>'.$row['Tail Number'].'</td><td>'.$row['Type'].'</td><td>'.$row['Fuel Count'].'</td></tr>';
            }
            
        }
        $data.='</tbody></table>';
    }
        if ($_POST['browseT'] == "cre") {

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
                $data .='<tr><td>'.$row['Crew ID'].'</td><td>'.$row['PilotName'].'</td><td>'.$row['NavigatorName'].'</td></tr>';
                 }
            }
            $data.='</tbody></table>';
        }
        if ($_POST['browseT'] == "ca") {
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
        if ($_POST['browseT'] == "fl") {
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





    
