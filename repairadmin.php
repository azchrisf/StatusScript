<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Status System Administration</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="jquery.ui.timepicker.js"></script>
<script src="repairstatus-funcs.js"></script>
<link rel="stylesheet"href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"/>
<link rel="stylesheet"href="jquery.ui.timepicker.css"/>

</head>

<?
// check php version
if (strnatcmp(phpversion(),'5.2.0') >= 0)
{
}
else
{
 die("This script requires PHP version 5.2 or higher to run.");
}

if(isset($_GET['debug']))
{
error_reporting(E_ALL ^ E_NOTICE);
}

if(isset($_GET['phpinfo']))
{
	phpinfo();
	die;
}

if(isset($_POST['btnSubmit']))
	{
	    switch ($_POST['btnSubmit'])
	    {
	        case "Delete Invoice":
	            delInvoice();
	            break;
			case "Add Invoice";
				addInvoice();
				break;
			case "Change Invoice";
				chgInvoice();
				break;
			case "Delete All Invoices";
				delallInvoices();
				break;
			case "Delete Range";
				delrange();
				break;
			case "Delete Date Range";
				deldaterange();
				break;
					    }
	}
?>

<!-- DIV hide/show code -->
<script type="text/javascript">
 $(function TimeShow () {
     $('#delivertype').change(function () {
         $('#DTTime').hide();
         if (this.options[this.selectedIndex].value == 'DELIVER TO CUSTOMER') {
             $('#DTTime').show();
         }
     });
 });
 	 $(function TimeShow2 () {
     $('#delivertype2').change(function () {
         $('#DTTime2').hide();
         if (this.options[this.selectedIndex].value == 'DELIVER TO CUSTOMER') {
             $('#DTTime2').show();
         }
     });
});
</script>

<!-- Settings for Google Calendar widget -->

<script type="text/javascript">
$(function() {
	$( "#rpdate" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#rpdate2" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#exdate" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#exdate2" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
$(function() {
	$( "#range3" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#range4" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#invdate" ).datepicker({
		showButtonPanel: true,
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
});
</script>

<!-- Settings for Tab Widget -->
<script type="text/javascript">
$(function() {
	$( "#Tabs1" ).tabs(); 
});
</script>

<!-- Settings for Time Picker -->
<script type="text/javascript">
              $(document).ready(function() {
                  $('#rptime').timepicker({
					defaultTime: '12:00',
  					showLeadingZero: false,
					showNowButton: true,
  				    showCloseButton: true,
  	    			showDeselectButton: true,
  					showOn: 'both',
       				button: '.rptime_button'
  				});
				    $('#extime').timepicker({
					defaultTime: '12:00',
  					showLeadingZero: false,
					showNowButton: true,
  				    showCloseButton: true,
  	    			showDeselectButton: true,
  					showOn: 'both',
       				button: '.extime_button'
  				});
				  $('#rptime2').timepicker({
					defaultTime: '12:00',
  					showLeadingZero: false,
					showNowButton: true,
  				    showCloseButton: true,
  	    			showDeselectButton: true,
  					showOn: 'both',
       				button: '.rptime2_button'
  				});
				$('#extime2').timepicker({
					defaultTime: '12:00',
  					showLeadingZero: false,
					showNowButton: true,
  				    showCloseButton: true,
  	    			showDeselectButton: true,
  					showOn: 'both',
       				button: '.extime2_button'
  				});
				$('#delivertime').timepicker({
					defaultTime: '12:00',
  					showLeadingZero: false,
					showNowButton: true,
  				    showCloseButton: true,
  	    			showDeselectButton: true,
  					showOn: 'both',
       				button: '.delivertime_button'
  				});
				$('#delivertime2').timepicker({
					defaultTime: '12:00',
  					showLeadingZero: false,
					showNowButton: true,
  				    showCloseButton: true,
  	    			showDeselectButton: true,
  					showOn: 'both',
       				button: '.delivertime2_button'
  				});
              });
          </script>
          
<!-- Script for Tooltips -->

<script type="text/javascript">
$(function() {
$( document ).tooltip();
});
</script>

<body>
<h1><center><strong><font face="Tahoma, Verdana, Arial, Helvetica, sans-serif">Repair Status Administration</font></strong></center></h1>
<div id="Tabs1">
  <ul>
    <li><a href="#tabs-1">Add Invoice</a></li>
    <li><a href="#tabs-2">Edit Invoice</a></li>
    <li><a href="#tabs-3">Delete Invoice</a></li>
    <li><a href="#tabs-4">Mass Actions</a></li>
    <li><a href="#tabs-5">About...</a></li>
  </ul>
  <div id="tabs-1">
    <form id="add" name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p>
        <label for="textfield">Invoice ID:</label>
        <input name="invid" type="text" id="invid" size="5" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
      </p>
      <?
	  require "repairadmin-config.php";
	if($allowdatechange == 1) {
       echo "<p>";
       echo "<label for=\"textfield\">Date Created:</label>";
	   echo "<input name=\"invdate\" type=\"text\" id=\"invdate\" size=\"10\" value=\"". DATE('Y-m-d'). "\"". "/ >";
       echo "</p>";
	}
  	require("repairstatus-config.php");
	if($enablesecurity == 1) {
		echo "<p>";
		echo "<label for=\"pincode\">4 Digit PIN Code <b>(REQUIRED)</b>:</label>";
		echo "<input type=\"text\" size=\"4\" name=\"pincode\" id=\"pincode\" title=\"Numbers only\" onKeyDown=\"limitText(this.form.pincode,this.form.countdown,4);\" onKeyUp=\"limitText(this.form.pincode,this.form.countdown,4);\"; />";
  		echo "</p>";
	}
	?>
      <p>
        <label for="textfield">Assigned to Tech:</label>
        <?
require "repairadmin-config.php";
echo "<select name=\"tech\">";
foreach($techslist as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
	echo "</select>";
?>
      </p>
      <p>
        <label for="select">Status:</label>
        <?
require "repairadmin-config.php";
echo "<select name=\"status\">";
foreach($statustypes as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
	echo "</select>";
?>
      </p>
      <p>
        <label for="rpdate">Expected Repair Date:</label>
        <input type="text" name="rpdate" id="rpdate">
      </p>
      <p>
        <label for="rptime">Expected Repair Time:</label>
        <input name="rptime" type="time" id="rptime" style="width: 70px;" title="Must be in 24 hour format - example: 23:30">
        
        <input type="button" class="rptime_button" value="..." title="Must be in 24 hour format - example: 23:30">
      </p>
      <p>
        <label for="exdate">Expected Start Date </label>
        <label for="exdate"> (applicable if In Queue or Delayed):</label>
        <input type="text" name="exdate" id="exdate" >
      </p>
      <p>
        <label for="extime">Expected Start Time (applicable if In Queue or Delayed):</label>
        <input name="extime" type="extime" id="extime" title="Must be in 24 hour format - example: 23:30">
        <input type="button" class="extime_button" value="..." title="Must be in 24 hour format - example: 23:30">
      </p>
      <p>
        <label for="deliverytype">Delivery Type:</label>
        <select name="delivertype" id="delivertype" onChange="TimeShow();">
        <?
require "repairadmin-config.php";
foreach($delivertypes as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
?>
</select>
      </p>
      <div id="DTTime" style="display:none">
      <p>
        <label for="delivertime">Estimated Delivery Time:</label>
        <input name="delivertime" type="text" id="delivertime" title="Must be in 24 hour format - example: 23:30" >
        <input type="button" class="delivertime_button" value="..." title="Must be in 24 hour format - example: 23:30">
      </p>
      </div>
      <p>
        <label for="comments">Comments:</label>
        <textarea name="comments" cols="50" rows="3" id="comments"></textarea>
      </p>
      <input type="submit" name="btnSubmit" id="btnSubmit" value="Add Invoice">
    </form>
  </div>
  <div id="tabs-2">
    <p><b>NOTE: Leave field(s) blank to preserve existing data</b></p>
    <form id="change" name="change" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p> Invoice ID:
        <?
  // Create connection
require "repairadmin-config.php";
$cn=mysqli_connect($servername, $username, $password, $dbname) or die($cn->connect_error);
$sql = "SELECT invid, datecreated FROM repairs";
$rs = $cn->query($sql) or die(mysqli_error($cn));
echo "<select name=\"invid2\">";
while($row = mysqli_fetch_array($rs)){
echo "<option value='".$row["invid"]."'>".$row["invid"]. " (Created on ".$row['datecreated'].")</option>";
}
$rs->free_result();
$rs->close();
echo "</select>";
?>
      </p>
      <?
  	require("repairstatus-config.php");
	if($enablesecurity == 1) {
		echo "<p>";
		echo "<label for=\"pincode2\">4 Digit PIN Code <b>(Leave blank for no change)</b>:</label>";
		echo "<input type=\"text\" size=\"4\" name=\"pincode2\" id=\"pincode2\" >";
  		echo "</p>";
	}
	?>
      <p>
        <label for="textfield">Assigned to Tech:</label>
        <?
// Create connection
require "repairadmin-config.php";
echo "<select name=\"tech2\">";
echo "<option value=\"\"></option>";
foreach($techslist as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
	echo "</select>";
?>
      </p>
      <p>
        <label for="status2">Status:</label>
        <?
require "repairadmin-config.php";
echo "<select name=\"status2\">";
echo "<option value=\"\"></option>";
foreach($statustypes as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
	echo "</select>";
?>
      </p>
      <p>
        <label for="datetime">Expected Repair Date:</label>
        <input type="text" name="rpdate2" id="rpdate2">
      </p>
      <p>
        <label for="time">Expected Repair Time:</label>
        <input type="time" name="rptime2" id="rptime2" title="Must be in 24-hour format - example: 23:30">
        <input type="button" class="rptime2_button" value="..." title="Must be in 24-hour format - example: 23:30">
      </p>
      <p>
        <label for="datetime2">Expected Start Date </label>
        <label for="time6"> (applicable if In Queue or Delayed):</label>
        <input type="text" name="exdate2" id="exdate2">
      </p>
      <p>
        <label for="time2">Expected Start Time </label>
        <label for="time7"> (applicable if In Queue or Delayed):</label>
        <input type="time" name="extime2" id="extime2" title="Must be in 24-hour format - example: 23:30">
        <input type="button" class="extime2_button" value="..." title="Must be in 24-hour format - example: 23:30">
      </p>
      <p>
        <label for="delivertype2">Delivery Type:</label>
        <select name="delivertype2" id="delivertype2" onChange="TimeShow2();">
        <?
require "repairadmin-config.php";
echo "<option value=\"\"></option>";
foreach($delivertypes as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
?>
</select>
      </p>
      <div id="DTTime2" style="display:none">
        <p>
        <label for="delivertime">Estimated Delivery Time:</label>
        <input type="text" name="delivertime2" id="delivertime2" title="Must be in 24 hour format - example: 23:30" >
        <input type="button" class="delivertime2_button" value="..." title="Must be in 24 hour format - example: 23:30">
      </p>
      </div>
      <p>
        <label for="comments2">Comments:</label>
        <textarea name="comments2" cols="50" rows="3" id="comments2"></textarea>
      </p>
      <p>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Change Invoice">
      </p>
    </form>
  </div>
  <div id="tabs-3">
    <form id="delete" name="delete" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p>
        <label for="textfield">Invoice ID: </label>
        <?
// Create connection
require "repairadmin-config.php";
$cn=mysqli_connect($servername, $username, $password, $dbname) or die($cn->connect_error);
$sql = "SELECT invid FROM repairs";
$rs = $cn->query($sql) or die(mysqli_error($cn));
echo "<select name=\"inviddel\">";
while($row = mysqli_fetch_array($rs)){
echo "<option value='".$row["invid"]."'>".$row["invid"]."</option>";
}
$rs->free_result();
$rs->close();
echo "</select>";
?>
      </p>
      <p>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Delete Invoice">
      </p>
    </form>
  </div>
  <div id="tabs-4">
    <p><strong>Database Administration</strong></p>
    <form id="dbadmin" name="dbadmin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p>Purge Invoice Numbers in Range:
        <input name="range1" type="text" id="range1" size="5">
        to
        <input name="range2" type="text" id="range2" size="5">
        <br>
        <input name="btnSubmit" type="submit" id="btnSubmit" value="Delete Range">
      </p>
      <p>Purge Invoice Numbers in Date Range:
        <input name="range3" type="text" id="range3" size="10">
to
<input type="text" name="range4" id="range4" size="10">
<br>
<input name="btnSubmit" type="submit" id="btnSubmit" value="Delete Date Range">
      </p>
            <p> <strong><font color="red">WARNING: This action will delete ALL Invoices in the Database. Once you click the button, you cannot recover the Invoices.</font></strong><br>
        <input name="btnSubmit" type="submit" id="btnSubmit" title="WARNING: WILL DELETE ALL INVOICES!" value="Delete All Invoices">
      </p>
    </form>
  </div>
  <div id="tabs-5">
  <center>
    <p><b>Repair Status Script for PC Repair Shops
      Version 1.5 (branch-1.5_gold)
      </b></p>
    <p>Copyright &copy; 2014, Chris Formeister. All Rights Reserved.
    </p>
    <p>Download latest version from <a href="https://github.com/azchrisf/StatusScript/">https://github.com/azchrisf/StatusScript/</a></p>
    <p>Post bugs and questions to GitHub</p>
    <p>Email the author at <a href="mailto:azchrisf@gmail.com">azchrisf@gmail.com</a></p>
    <p><strong>CREDITS:</strong></p>
    <p>Thanks to Eduardo Mendez for additional code<br>
    </p>
    <p>Uses JQuery UI Time Picker, &copy; François Gélinas.<br>
      Licensed &amp; Distributed under MIT/GPL License
    </p>
  </center>
  </div>
</div>
</body>
</html>
<?php

function addInvoice() {
	
require "repairadmin-config.php";

if(empty($invid)) {
	echo "<b><font color=\"red\">You must enter a Invoice ID to add!</b></font><hr>";
	return;
}
if (!is_numeric($invid)) {
        echo "<b><font color=\"red\">The Invoice ID must be numeric only!</b></font><hr>";
		return;
    }
if (strlen($invid) < 5) { 
		echo(strlen($invid));
		echo "<b><font color=\"red\">The Invoice ID must be 5 digits!</b></font><hr>";
		return;
}

require "repairstatus-config.php";

if($enablesecurity == 1) {
if(empty($pincode)) {
	echo "<b><font color=\"red\">You must enter a PIN ID to add!</b></font><hr>";
	return;
}
if (!is_numeric($pincode)) {
        echo "<b><font color=\"red\">The PIN ID must be numeric only!</b></font><hr>";
		return;
    }
if (strlen($pincode) < 4) { 
		echo "<b><font color=\"red\">The PIN ID must be 5 digits!</b></font><hr>";
		return;
}
}

$cn=mysqli_connect($servername, $username, $password, $dbname) or die($cn->connect_error);
$sql = "SELECT invid FROM repairs";
$rs = $cn->query($sql) or die(mysqli_error($cn));
while($row = mysqli_fetch_array($rs)){
	if ($row[invid] == $invid) {
		echo "<b><font color=\"red\">Invoice ID already exists - choose a new ID!</b></font><hr>";
		return;
	}
}
$cn->close(); 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("<b><font color=\"red\">Connection failed: " . $conn->connect_error . "</b></font><hr>");
}

// sql to add a record

if($allowdatechange == 1) {
	$datecreated = $invdate;
} else {
	$datecreated = DATE('Y-m-d');
}

$sql = "INSERT INTO repairs (invid, status, tech, rpdate, rptime, exdate, extime, comments, delivertype, delivertime, pincode, datecreated)
VALUES ('$invid', '$status', '$tech', '$rpdate', '$rptime', '$exdate', '$extime', '$comments', '$delivertype', '$delivertime', '$pincode', '$datecreated')";

if ($conn->query($sql) === TRUE) {
    echo "<b><font color=\"green\">Invoice added successfully!</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error adding Invoice: " . $conn->error . "</b></font><hr>";
}
$conn->close(); 
}

function chgInvoice() {
	
require "repairadmin-config.php";

if(empty($invid2)) {
	echo "<b><font color=\"red\">You must select a non-empty Invoice ID to change!</b></font><hr>";
	return;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("<b><font color=\"red\">Connection failed: " . $conn->connect_error . "</b></font><hr>");
}

// sql to change a record
if(!empty($invid2)){
	if(!empty($status2)){
     $update_fields[] = "status='$status2'";
    }
    if(!empty($tech2)){
     $update_fields[] = "tech='$tech2'";
    }
    if(!empty($rpdate2)){
     $update_fields[] = "rpdate='$rpdate2'";
    }
    if(!empty($rptime2)){
     $update_fields[] = "rptime='$rptime2'";
    }
    if(!empty($exdate2)){
     $update_fields[] = "exdate='$exdate2'";
    }
    if(!empty($extime2)){
     $update_fields[] = "extime='$extime2'";
    }
	if(!empty($comments2)){
     $update_fields[] = "comments='$comments2'";
    }
	if(!empty($delivertype2)){
     $update_fields[] = "delivertype='$delivertype2'";
    }
	if(!empty($delivertime2)){
     $update_fields[] = "delivertime='$delivertime2'";
    }
	if(!empty($pincode2)){
     $update_fields[] = "pincode='$pincode2'";
    }
    if(count($update_fields) > 0){
      $nonempty_fields = implode(", ", $update_fields);
      $sql = "UPDATE repairs SET $nonempty_fields WHERE invid='$invid2'";
	}
    else{
     echo "<b><font color=\"red\">Cannot update the Invoice because all fields are empty!</b></font><hr>";
	 return;
    }
}

if ($conn->query($sql) === TRUE) {
    echo "<b><font color=\"green\">Invoice changed successfully</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error changing Invoice: " . $conn->error . "</b></font><hr>";
}
$conn->close(); 
}


function delInvoice() {

require "repairadmin-config.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("<b><font color=\"red\">Connection failed: " . mysqli_connect_error(). "</b></font><hr>");
}

// sql to delete a record
$sql = "DELETE FROM repairs WHERE invid = '$inviddel'";

if (mysqli_query($conn, $sql)) {
    echo "<b><font color=\"green\">Invoice deleted successfully</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error deleting Invoice: " . mysqli_error($conn) . "</b></font><hr>";
}

$conn->close(); 
}
function delallInvoices() {

require "repairadmin-config.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("<b><font color=\"red\">Connection failed: " . mysqli_connect_error(). "</b></font><hr>");
}

// sql to delete a record
$sql = "TRUNCATE TABLE repairs";

if (mysqli_query($conn, $sql)) {
    echo "<b><font color=\"green\">All Records deleted successfully</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error deleting all records: " . mysqli_error($conn) . "</b></font><hr>";
}

$conn->close(); 
}

function delrange() {

require "repairadmin-config.php";

if(empty($range1)) {
	echo "<b><font color=\"red\">You must enter a starting Invoice range</b></font><hr>";
	return;
}
if(empty($range2)) {
	echo "<b><font color=\"red\">You must enter a ending Invoice range</b></font><hr>";
	return;
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("<b><font color=\"red\">Connection failed: " . mysqli_connect_error(). "</b></font><hr>");
}

// sql to delete a record
$sql = "DELETE FROM repairs WHERE invid BETWEEN ". $range1 ." AND ". $range2;

if (mysqli_query($conn, $sql)) {
    echo "<b><font color=\"green\">Selected Range deleted successfully</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error deleting record range: " . mysqli_error($conn) . "</b></font><hr>";
}

$conn->close(); 
}

function deldaterange() {
	
require "repairadmin-config.php";

if(empty($range3)) {
	echo "<b><font color=\"red\">You must enter a starting date range</b></font><hr>";
	return;
}
if(empty($range4)) {
	echo "<b><font color=\"red\">You must enter a ending date range</b></font><hr>";
	return;
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("<b><font color=\"red\">Connection failed: " . mysqli_connect_error(). "</b></font><hr>");
}

// sql to delete a record
$sql = "DELETE FROM repairs WHERE datecreated BETWEEN '". $range3 ."' AND '". $range4 . "'";

if (mysqli_query($conn, $sql)) {
    echo "<b><font color=\"green\">Selected Range deleted successfully</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error deleting record date range: " . mysqli_error($conn) . "</b></font><hr>";
}

$conn->close(); 
}
?>
