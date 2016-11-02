<?php
if (isset($_POST['deleted'])) {
    include '../../phpCode/config.php';
    
    if($_POST['type'] == "cr"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM aircraft_info where `Tail Number`=".$d;
         $conn->query($sql);
    }
    echo json_encode("AirCraft delete successfully");
    }
    
      if($_POST['type'] == "cre"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM aircrew  where `Crew ID`=".$d;
         $conn->query($sql);
    }
    echo json_encode("Crew delete successfully");
    }
      if($_POST['type'] == "ca"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM cargo where SkidNum=".$d;
         $conn->query($sql);
    }
    echo json_encode("Cargo delete successfully");
    }
      if($_POST['type'] == "fl"){
    foreach($_POST['deleted'] as $d){
         $sql = "DELETE FROM flight where FlightNum=".$d;
         $conn->query($sql);
    }
    echo json_encode("Flight delete successfully");
    }
    
    
    
}
