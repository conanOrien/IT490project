<?php

if (isset($_POST['flightDest'])) { 
    include '../config.php';
    // getting data 
    $flightDest = trim($_POST['flightDest']);
// mysql_select_db('cargoDB');
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
?>

