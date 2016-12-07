<?php
date_default_timezone_set('America/New_York');

if (isset($_POST['type'])) {
    include '../../phpCode/config.php';
    
    if($_POST['type'] == "cr"){
          $tailnumber=trim($_POST['tailnumber']);
         $type1=trim($_POST['type1']);
         $fuelcount=trim($_POST['fuelcount']);
       
        $sql = "INSERT INTO aircraft_info (`Tail Number`, Type, `Fuel Count`)
        VALUES ($tailnumber, '$type1', $fuelcount)";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCraft added successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();

    
    }
    
      if($_POST['type'] == "cre"){
        $crewid=trim($_POST['crewid']);
         $pilotname=trim($_POST['pilotname']);
         $navigatorname=trim($_POST['navigatorname']);

        $sql = "INSERT INTO aircrew (`Crew ID`, PilotName, NavigatorName)
        VALUES ($crewid, '$pilotname', '$navigatorname')";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCrew added successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
    }
    
      if($_POST['type'] == "ca"){
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


    
  
      if($_POST['type'] == "fl"){
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
	    printf("Errormessage: %s\n", $conn->error);
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
      }
    
    
    
}
