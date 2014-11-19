<?php

//Config variables for Repair Status Admin Script
//Copyright (c) 2014, Chris Formeister. All Rights Reserved.

//MySQL Variables

$servername = "localhost";		//Name of Server, ex. localhost
$username = "";			//Username ex. root
$password = "";		//Password ex. root
$dbname = "repairstatus";	//Database Name, ex. repairstatus

//System Options

$statustypes = array ( 	"NOT STARTED",
						"IN QUEUE",
						"ON BENCH / WORKING",
						"AWAITING PARTS",
						"AWAITING CUSTOMER",
						"COMPLETED"
						);
						
//NOTE ON '$delivertypes': "DELIVER TO CUSTOMER" **MUST** ALWAYS REMAIN OR YOU MUST REMOVE CODE REFERENCES TO IT.

$delivertypes = array ( "SELF PICKUP",
						"DELIVER TO CUSTOMER",
						"SHIP TO CUSTOMER",
						"OTHER"
						);
$techslist = array	( "0000 NOT ASSIGNED",
					  "1759 J. DOE"
					    );

//Allow changing of the creation date of the Invoice. Not recommended.

$allowdatechange = 0;

						
//DO NOT CHANGE BEYOND HERE UNLESS YOU KNOW WHAT YOUR DOING!
//----------------------------------

//Form Variables for Admin Script
//NOTE: If adding fields beyond the defaults, you must declare them here.

$invid = $_POST['invid'];
$invdate = $_POST['invdate'];
$status = $_POST['status'];
$tech = $_POST['tech'];
$rpdate = $_POST['rpdate'];
$rptime = $_POST['rptime'];
$exdate = $_POST['exdate'];
$extime = $_POST['extime'];
$comments = $_POST['comments'];
$delivertype = $_POST['delivertype'];
$delivertime = $_POST['delivertime'];
$invid2 = $_POST['invid2'];
$status2 = $_POST['status2'];
$tech2 = $_POST['tech2'];
$rpdate2 = $_POST['rpdate2'];
$rptime2 = $_POST['rptime2'];
$exdate2 = $_POST['exdate2'];
$extime2 = $_POST['extime2'];
$comments2 = $_POST['comments2'];
$delivertype2 = $_POST['delivertype2'];
$delivertime2 = $_POST['delivertime2'];
$pincode = $_POST['pincode'];
$pincode2 = $_POST['pincode2'];
$inviddel = $_POST['inviddel'];
$range1 = $_POST['range1'];
$range2 = $_POST['range2'];
$range3 = $_POST['range3'];
$range4 = $_POST['range4'];

?>