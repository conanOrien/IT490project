<?php

function searchFlightNum($search) {
    include '../../phpCode/config.php';
    $data = "";
    $sql = "SELECT * FROM flight where FlightNum =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td style="background-color: #ccc !important;">' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchTailNum($search) {
    include '../../phpCode/config.php';
    $data = "";
    $sql = "SELECT * FROM flight where TailNum =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td style="background-color: #ccc !important;">' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchOrigin($search) {
    include '../../phpCode/config.php';
    $data = "";
    $sql = "SELECT * FROM flight where DepartureFrom ='" . $search . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td style="background-color: #ccc !important;">' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchDest($search) {
    include '../../phpCode/config.php';
    $data = "";
    $sql = "SELECT * FROM flight where DepartureTo ='" . $search . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td style="background-color: #ccc !important;">' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchCargo($search) {
    include '../../phpCode/config.php';
    $data = "";
    $sql = "SELECT * FROM flight where SkidNum =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td>' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td style="background-color: #ccc !important;">' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

function searchCrew($search) {
    include '../../phpCode/config.php';
    $data = "";
    $sql = "SELECT * FROM flight where CrewID =" . $search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .='<tr><td>' . $row['FlightNum'] . '</td><td>' . $row['TailNum'] . '</td><td style="background-color: #ccc !important;">' . $row['CrewID'] . '</td><td>' . $row['DepartureFrom'] . '</td><td>' . $row['DepartureTo'] . '</td><td>' . $row['DepartureTime'] . '</td><td>' . $row['ArrivalTime'] . '</td><td>' . $row['SkidNum'] . '</td></tr>';
        }
    }
    return $data;
}

if (isset($_POST['searchDB']) || isset($_POST['searchDB1'])) {
	if(isset($_POST['searchDB']))	
	{
		$search = trim($_POST['searchDB']);	    
	}

	if(isset($_POST['searchDB1']))
	{
		$search = trim($_POST['searchDB1']);
	}

	$data = "<h2>Flights</h2>";
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

    if (is_numeric($search) && strlen($search) == 4) {
        $data .= searchFlightNum($search);
        $data .= searchCargo($search);
    }
    if (is_numeric($search) && strlen($search) == 3) {
        $data .= searchCrew($search);
    }
    if (is_numeric($search) && strlen($search) == 5) {
        $data .= searchTailNum($search);
    }
    if (!is_numeric($search) && strlen($search) <= 3) {
        $data .= searchOrigin($search);
        $data .= searchDest($search);
    }


    $data.='</tbody></table>';
    echo json_encode($data);
}





    
