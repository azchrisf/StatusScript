<?php

//Config functions for Repair Status Main Script
//Copyright (c) 2014, Chris Formeister. All Rights Reserved.

//MySQL Variables

$servername = "localhost";		//Name of Server, ex. localhost
$username = "";			//Username ex. root
$password = "";		//Password ex. root
$dbname = "repairstatus";	//Database Name, ex. repairstatus

//Enable PIN Code Security
//NOTE: DO NOT enable this retroactively with existing tickets unless you edit the 'pincode' row in the database
//and add pincodes, or the script will crash.

$enablesecurity = 0;

?>