<?php        
// check php version
if (strnatcmp(phpversion(),'5.2.0') >= 0)
{
}
else
{
 die("This script requires PHP version 5.2 or higher to run.");
}

if (!isset($_SESSION)) {
        session_start();
}
// anti flood protection
if($_SESSION['last_session_request'] > time() - 2){
        // users will be redirected to this page if it makes requests faster than 2 seconds
        header("location: http://www.MyWebsite.com/errors/toofast.shtml");
        exit;
}
$_SESSION['last_session_request'] = time();

if(isset($_GET['debug']))
{
error_reporting(E_ALL ^ E_NOTICE);
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="repair.css" rel="stylesheet" type="text/css">
<title>MyWebsite Service Status Inquiry</title>
</head>

<script type="text/javascript" src="repairstatus-funcs.js"></script>

<body>
<p>
  
  <?php

require "repairstatus-config.php";

$header = <<<EO
<p><strong style="font-size: xx-large"><img src="system_info.gif" width="55" height="55" alt=""/> MyWebsite Repair Status Inquiry
</strong></p>
<hr>
<p>
EO;

$footer = <<<EO
<p align="center">
<span style="font-size: small"><a href="/index.htm" title="Return to Homepage" style="font-size: small">Click here</a> to return to the MyWebsite Homepage</span></p>
<p align="center" style="font-size: x-small">Copyright &copy; 2014, MyWebsite. All Rights Reserved. <br>Powered by CS Status Script 1.1 &copy 2014</p>
<body>
</body>
</html>
EO;

if($includemode == 1) {
	$header = "";
	$footer = "";
}

$form = $header . <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (without quotes).</strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="POST">
<fieldset>
  <legend>Enter Invoice ID:</legend>
  <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <input type="submit" value="Lookup Status" />
</fieldset>
</form>
$footer
EO;

$formsecurity = $header . <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (without quotes).</strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="POST">
<fieldset>
  Enter Invoice ID: <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <p>
  Enter PIN: <input type="text" size="4" name="pin" onKeyDown="limitText(this.form.pin,this.form.countdown,4);" onKeyUp="limitText(this.form.pin,this.form.countdown,4);";/>
  <p>
  <input type="submit" value="Lookup Status" />
</fieldset>
</form>
$footer
EO;

$altform = $header . <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (without quotes). </strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="POST">
<fieldset>
  <legend>Enter Invoice ID:</legend>
  <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <input type="submit" value="Lookup Status" />
  <p><b>The invoice number your entered was not found. Please try again.</b>
</fieldset>
</form>
$footer
EO;

$altformsecurity = $header . <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (without quotes). </strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="POST">
<fieldset>
  Enter Invoice ID: <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <p>
  Enter PIN: <input type="text" size="4" name="pin" onKeyDown="limitText(this.form.pin,this.form.countdown,4);" onKeyUp="limitText(this.form.pin,this.form.countdown,4);";/>
  <p>
  <input type="submit" value="Lookup Status" />
  <p><b>The invoice number your entered was not found. Please try again.</b>
</fieldset>
</form>
$footer
EO;

$altformsecuritypin = $header . <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (without quotes). </strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="POST">
<fieldset>
  Enter Invoice ID: <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <p>
  Enter PIN: <input type="text" size="4" name="pin" onKeyDown="limitText(this.form.pin,this.form.countdown,4);" onKeyUp="limitText(this.form.pin,this.form.countdown,4);";/>
  <p>
  <input type="submit" value="Lookup Status" />
  <p><b>The PIN number you entered is incorrect. Please try again.</b>
</fieldset>
</form>
$footer
EO;

// If request has been made
if (isset($_POST[invid])) {
  $cn = mysqli_connect($servername, $username, $password, $dbname) or die('An error in the form was present or a script error occured. (db_conn_err)');		// SQL error:<p><p>'. mysql_error(). ''
  // sanitize request
  $invid = mysqli_real_escape_string($cn, $_POST[invid]);
  $enteredpin = mysqli_real_escape_string($cn, $_POST[pin]);
  $sql = 'SELECT * FROM repairs WHERE invid = '. $invid .' LIMIT 1;';
  $result = mysqli_query($cn, $sql) or die('An error in the form was present or a script error occured. (db_query_err)');	// SQL error:<p><p>'. mysql_error(). ''
  $num = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  // if no records found
  if ($num < 1) {
	  	if($enablesecurity == 1) {
		echo $altformsecurity;
		return;
	}
	echo $altform;
  }
  else {	  
    if ($enablesecurity == 1) {
		if($row[pincode] == "") {
			die('ERROR: There is no PIN Code set for this Ticket - Contact the Website owner.');
		}
  		if($enteredpin != $row[pincode]) {
			echo $altformsecuritypin;
			return;
		}
	}

	$correctdateA = DATE("l m/d", STRTOTIME($row[rpdate]));
	$correcttimeA = DATE("g:i a", STRTOTIME($row[rptime]));
	echo $header;
	if($showcreateddate == 1) {
		echo "<p><b>Date Invoice created: </b>". DATE("m/d/Y", STRTOTIME($row[datecreated])) . "<br>";
	} else {
		echo "<p>";
	}
    echo "<b>Your machine status is: </b>". $row[status] ."&nbsp; <a title=\"Status Legend\" style=\"cursor: pointer\" onclick=\"openInfo()\");\"><img src=\"/info.gif\" width=\"16\" height=\"16\" alt=\"Status Legend\"/></a></p>";
	echo "<br><font size=\"5\"><b>Details:</font></b>";
	echo "<p><b>Assigned to Technician: </b>". $row[tech] ."</p>";
	if(!empty($row[exdate])) {
			$correctdateB = DATE("l m/d", STRTOTIME($row[exdate]));
			$correcttimeB = DATE("g:i a", STRTOTIME($row[extime]));
				echo "<p><b>Estimated start date/time of your machine is: </b>". $correctdateB . " by approx. ". $correcttimeB ."</p>";
	}
	echo "<p><b>Estimated repair completion date/time is: </b>". $correctdateA ." by approx. ". $correcttimeA ."</p>";
	if ($row[delivertype] == "DELIVER TO CUSTOMER") {
			if(empty($row[delivertime])) {
				$correcttimeC = "end of business day";
			} else {
				$correcttimeC = DATE("g:i a", STRTOTIME($row[delivertime]));
			}
		echo "<p><b>Return Service Type: </b>". $row[delivertype] . " (Delivery by approx. ". $correcttimeC . ")</p>";
	} 
	else {
		echo "<p><b>Return Service Type: </b>". $row[delivertype] . "</p>";
	}
	if($showcomments == 1) {
		if(!empty($row[comments])) {
				echo "<p><b>Comments on Ticket: </b>". $row[comments] . "</p>";
		}
	}
	echo "<input type=\"button\" onclick=\"javascript:window.print()\" title=\"Print Window\" value=\"Print Window\"></input>";
	echo "<hr>";
	echo "If you have any questions about your computer being serviced, please <a href=\"contactus_email.htm\">email us</a> or <a href=\"contactus.htm\">contact us</a> via Phone.";
	echo $footer;
  }
}
// Otherwise show form for user to make request
else {
	if($enablesecurity == 1) {
		echo $formsecurity;
	} else {
		echo $form;
	}
  
}

?>