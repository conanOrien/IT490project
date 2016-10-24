<?php

if (isset($_POST['browse'])) {
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
                    <th><input type="submit" name="delete" value="Delete"/><input type="hidden" name="type" value="cr" /></th>
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
        $data.='</tbody></table></form>'
                    . '<script>$("#deleteform").submit(function (event) {
                        event.preventDefault();
                         $.ajax({
                            type: "POST",
                            url: "deleteaction.php",
                            data: $("#deleteform").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#message").html(dt);
                                deletetable();
                            }
                        });
                        });
                        function deletetable(){
                        $.ajax({
                            type: "POST",
                            url: "deletetable.php",
                            data: $("form").serialize(),
                            success: function (data) {
                                var dt = $.parseJSON(data);
                                $("#result").html(dt);
                            }
                        });
                      }</script>';
        echo json_encode($data);
    }





    