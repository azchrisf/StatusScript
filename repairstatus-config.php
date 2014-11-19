<?php

//Config functions for Repair Status Main Script
//Copyright (c) 2014, Chris Formeister. All Rights Reserved.

//MySQL Variables

$servername = "localhost";		//Name of Server, ex. localhost
$username = "";			//Username ex. root
$password = "";		//Password ex. root
$dbname = "repairstatus";	//Database Name, ex. repairstatus

//Enable INCLUDE mode
//This allows you to add the script to your existing pages on your website by removing the default header & footer.

$includemode = 0;

//Enable PIN Code Security
//NOTE: DO NOT enable this retroactively with existing tickets unless you edit the 'pincode' row in the database
//and add pincodes, or the script will crash.

$enablesecurity = 0;

//Show the date the Invoice was entered into the System to the Customer

$showcreateddate = 0;

//Show the comments field for the Invoice

$showcomments = 1;

?>