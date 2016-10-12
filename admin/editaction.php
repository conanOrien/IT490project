<?php
if (isset($_POST['type'])) {
    include '../config.php';
    
    if($_POST['type'] == "cr"){
          $tailnumber=trim($_POST['tailnumber']);
         $type1=trim($_POST['type1']);
         $fuelcount=trim($_POST['fuelcount']);
       
        $sql = "Update aircraft_info set  Type ='$type1' , FuelCount =$fuelcount  where TailNumber = $tailnumber ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCraft updated successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();

    
    }
    
      if($_POST['type'] == "cre"){
        $crewid=trim($_POST['crewid']);
         $pilotname=trim($_POST['pilotname']);
         $navigatorname=trim($_POST['navigatorname']);


        
         $sql = "Update aircrew set  PilotName ='$pilotname' , NavigatorName ='$navigatorname'  where CrewID = $crewid ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("AirCrew updated successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
    }
    
      if($_POST['type'] == "ca"){
         $cargonumber=trim($_POST['cargonumber']);
         $weight=trim($_POST['weight']);
         $content=trim($_POST['content']);
        
        
         $sql = "Update cargo set  Weight =$weight , Content ='$content'  where SkidNum = $cargonumber ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("Cargo updated successfully");
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

                 $sql = "Update flight set  TailNum =$tailnum , CrewID =$crewid ,DepartureFrom='$departurefrom',DepartureTo='$departureto',DepartureTime=FROM_UNIXTIME($departuretime),ArrivalTime=FROM_UNIXTIME($arrivaltime),SkidNum=$skidnum  where FlightNum = $flightnum ";

        if ($conn->query($sql) === TRUE) {
           echo json_encode("Flight updated successfully");
        } else {
            echo json_encode("Error while adding !"); 
        }

        $conn->close();
      }
    
    
    
}