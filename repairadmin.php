<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Status System Administration</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
<script src="repairstatus-funcs.js"></script>
<link rel="stylesheet"href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/smoothness/jquery-ui.css"/>
</head>

<?

if(isset($_POST['btnSubmit']))
	{
	    switch ($_POST['btnSubmit'])
	    {
	        case "Delete Invoice":
	            delticket();
	            break;
			case "Add Invoice";
				addticket();
				break;
			case "Change Invoice";
				chgticket();
				break;
					    }
	}
?>

<!-- Settings for Google Calendar widget -->

<script type="text/javascript">
$(function() {
	$( "#rpdate" ).datepicker({
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#rpdate2" ).datepicker({
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#exdate" ).datepicker({
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
$(function() {
	$( "#exdate2" ).datepicker({
		dateFormat:"yy-mm-dd",
		showOn:"both",
		buttonImage:"cal.gif"
	}); 
});
</script>

<body>
<p><strong><font size="5">Repair Status Administration 1.1</font></strong></p>
<hr>
<p><strong>Add a Ticket</strong></p>
<form id="add" name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <p>
    <label for="textfield">Invoice ID:</label>
    <input name="invid" type="text" id="invid" size="5" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  </p>
    <?
  	require("repairstatus-config.php");
	if($enablesecurity == 1) {
		echo "<p>";
		echo "<label for=\"pincode\">4 Digit PIN Code <b>(REQUIRED)</b>:</label>";
		echo "<input type=\"text\" size=\"4\" name=\"pincode\" id=\"pincode\" onKeyDown=\"limitText(this.form.invid,this.form.countdown,4);\" onKeyUp=\"limitText(this.form.invid,this.form.countdown,4);\"; />";
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
    <input name="rptime" type="time" id="rptime">
    (Must be in 24-hour format - example: 23:30)</p>
  <p>
    <label for="exdate">Expected Start Date </label>
    <label for="exdate"> (applicable if In Queue or Delayed):</label>
    <input type="text" name="exdate" id="exdate" >
  </p>
  <p>
    <label for="extime">Expected Start Time (applicable if In Queue or Delayed):</label>
    <input type="extime" name="extime" id="extime">
  (Must be in 24-hour format - example: 23:30)</p>
  <p>
    <label for="delivertype">Delivery Type:</label>
<?
require "repairadmin-config.php";
echo "<select name=\"delivertype\">";
foreach($delivertypes as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
	echo "</select>";
?>
  </p>
  <p>
  <label for="delivertime">Estimated Delivery Time (if DELIVER TO CUSTOMER):</label>
    <input type="text" name="delivertime" id="delivertime" >
  </p>
  <p>
    <label for="comments">Comments:</label>
    <textarea name="comments" cols="50" rows="3" id="comments"></textarea>
  </p>
    <input type="submit" name="btnSubmit" id="btnSubmit" value="Add Invoice">
  </p>
</form>
<hr>
<p><strong>Edit a Ticket</strong></p>
<p>(Leave field(s) blank to preserve existing data)</p>
<form id="change" name="change" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <p> Invoice ID:
    <?
  // Create connection
require "repairadmin-config.php";
$cn=mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db($dbname, $cn) or die(mysql_error());
$sql = "SELECT invid FROM repairs";
$rs = mysql_query($sql) or die(mysql_error());
echo "<select name=\"invid2\">";
while($row = mysql_fetch_array($rs)){
echo "<option value='".$row["invid"]."'>".$row["invid"]."</option>";
}mysql_free_result($rs);
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
    <input type="time" name="rptime2" id="rptime2">
    (Must be in 24-hour format - example: 23:30)</p>
  <p>
    <label for="datetime2">Expected Start Date </label>
    <label for="time6"> (applicable if In Queue or Delayed):</label>
    <input type="text" name="exdate2" id="exdate2">
  </p>
  <p>
    <label for="time2">Expected Start Time </label>
    <label for="time7"> (applicable if In Queue or Delayed):</label>
    <input type="time" name="extime2" id="extime2">
  (Must be in 24-hour format - example: 23:30)</p>
  <p>
    <label for="delivertype2">Delivery Type:</label>
<?
require "repairadmin-config.php";
echo "<select name=\"delivertype2\">";
echo "<option value=\"\"></option>";
foreach($delivertypes as $item){
  echo "<option value='". $item . "'>". $item ."</option>";
}
	echo "</select>";
?>
  </p>
    <p>
  <label for="delivertime">Estimated Delivery Time (if DELIVER TO CUSTOMER):</label>
    <input type="text" name="delivertime2" id="delivertime2" >
  </p>
  <p>
    <label for="comments2">Comments:</label>
    <textarea name="comments2" cols="50" rows="3" id="comments2"></textarea>
  </p>
  <p>
    <input type="submit" name="btnSubmit" id="btnSubmit" value="Change Invoice">
  </p>
</form>
<hr>
<p><strong>Delete a Ticket</strong></p>
<form id="delete" name="delete" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <p>
    <label for="textfield">Invoice ID: </label>
    <?
// Create connection
require "repairadmin-config.php";
$cn=mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db($dbname, $cn) or die(mysql_error());
$sql = "SELECT invid FROM repairs";
$rs = mysql_query($sql) or die(mysql_error());
echo "<select name=\"inviddel\">";
while($row = mysql_fetch_array($rs)){
echo "<option value='".$row["invid"]."'>".$row["invid"]."</option>";
}mysql_free_result($rs);
echo "</select>";
?>
  </p>
  <p>
    <input type="submit" name="btnSubmit" id="btnSubmit" value="Delete Invoice">
  </p>
</form>
<hr>
<p align="center"><strong>Repair Status Information Script 1.1</strong><br>
  Copyright &copy; 2014 Chris Formeister. All Rights Reserved.
</p>
</body>
</html>
<?php

function addticket() {
	
require "repairadmin-config.php";
$cn=mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db($dbname, $cn) or die(mysql_error());
$sql = "SELECT invid FROM repairs";
$rs = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array($rs)){
	if ($row[invid] == $invid) {
		echo "<b><font color=\"red\">Invoice ID already exists - choose a new ID!</b></font><hr>";
		return;
	}
}
mysql_free_result($rs);







if(empty($invid)) {
	echo "<b><font color=\"red\">You must enter a Invoice ID to add!</b></font><hr>";
	return;
}
if (!is_numeric($invid)) {
        echo "<b><font color=\"red\">The Invoice ID must be numeric only!</b></font><hr>";
		return;
    }
if (strlen($invid) < 5) { 
		echo "<b><font color=\"red\">The Invoice ID must be 5 digits!</b></font><hr>";
		return;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("<b><font color=\"red\">Connection failed: " . $conn->connect_error . "</b></font><hr>");
}

// sql to add a record

$sql = "INSERT INTO repairs (invid, status, tech, rpdate, rptime, exdate, extime, comments, delivertype, delivertime, pincode)
VALUES ('$invid', '$status', '$tech', '$rpdate', '$rptime', '$exdate', '$extime', '$comments', '$delivertype', '$delivertime', '$pincode')";

if ($conn->query($sql) === TRUE) {
    echo "<b><font color=\"green\">Invoice added successfully!</b></font><hr>";
} else {
    echo "<b><font color=\"red\">Error adding Invoice: " . $conn->error . "</b></font><hr>";
}
$conn->close(); 
}

function chgticket() {
	
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
     $update_fields[] = "pincode2='$pincode2'";
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


function delticket() {

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
?>
