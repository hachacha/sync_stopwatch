<?php

if($_POST['action']=="startOrStopTimer")
	startOrStopTimer($_POST);
if($_POST['action']=="checkTimer")
	checkTimer();


function connect(){
	try{
		if($conn = new PDO('mysql:host=localhost;dbname=synced_watch','jon','bubbles')){
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			return $conn;
		}
		else{
			return "fuck";
		}	
	} catch(PDOException $e) {
	    return 'Connection failed: ' . $e->getMessage();
	}
}

function checkTimer(){
	try{
		$conn = connect();
		$stmt = $conn->prepare("SELECT CURRENT_TIMESTAMP as curtime, UNIX_TIMESTAMP(CURRENT_TIMESTAMP) as unixtime, started, start_time from timer_on where id=1");
		$stmt->execute(array());
		$ret = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
		echo json_encode($ret);
		
	} catch(PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	}
}

function startOrStopTimer($timer_arr){
	$starting = $timer_arr['start'];
	try{
		$conn = connect();

		if($starting=="0")
			$start_time = ", start_time=0 ";
		else{
			//if hour minute and second is 0 then go on like normal.
			if($timer_arr['hour']=="0" && $timer_arr['minute']=="0" && $timer_arr['second']=="0")
				$start_time = ", start_time=UNIX_TIMESTAMP(CURRENT_TIMESTAMP) ";
			else{
				//calculate x back from starttime where x is unixtimestamp of now - total minutes
				$hour_to_unix = (int)$timer_arr['hour'] * 60 * 60;
				$minute_to_unix = (int)$timer_arr['minute'] * 60;
				$to_sub = $hour_to_unix  + $minute_to_unix + (int)$timer_arr['second'];

				$start_time = ", start_time=UNIX_TIMESTAMP(CURRENT_TIMESTAMP)-".$to_sub." ";
			}
		}

		$stmt = $conn->prepare("UPDATE timer_on SET started=".$starting.$start_time." where id=1");
		$stmt->execute(array());
		echo $stmt->rowCount();
	}
	catch(PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	}
}



?>