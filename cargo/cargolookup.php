<?php

if (isset($_POST['cargoID'])) {
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
?>
