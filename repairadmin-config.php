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
$delivertypes = array ( "SELF PICKUP",
						"DELIVER TO CUSTOMER",
						"SHIP TO CUSTOMER",
						"OTHER"
						);
$techslist = array	( "0000 NOT ASSIGNED",
					  "1759 J. DOE"
					    );
						
//DO NOT CHANGE BEYOND HERE UNLESS YOU KNOW WHAT YOUR DOING!
//----------------------------------

//Form Variables for Admin Script
//NOTE: If adding fields beyond the defaults, you must declare them here.

$invid = $_POST['invid'];
$status = $_POST['status'];
$tech = $_POST['tech'];
$rpdate = $_POST['rpdate'];
$rptime = $_POST['rptime'];
$exdate = $_POST['exdate'];
$extime = $_POST['extime'];
$comments = $_POST['comments'];
$delivertype = $_POST['delivertype'];
$invid2 = $_POST['invid2'];
$status2 = $_POST['status2'];
$tech2 = $_POST['tech2'];
$rpdate2 = $_POST['rpdate2'];
$rptime2 = $_POST['rptime2'];
$exdate2 = $_POST['exdate2'];
$extime2 = $_POST['extime2'];
$comments2 = $_POST['comments2'];
$delivertype2 = $_POST['delivertype2'];
$inviddel = $_POST['inviddel'];

?>