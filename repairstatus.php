<?php        

if (!isset($_SESSION)) {
        session_start();
}
// anti flood protection
if($_SESSION['last_session_request'] > time() - 2){
        // users will be redirected to this page if it makes requests faster than 2 seconds
        header("location: http://www.mywebsite.com/errors/toofast.shtml");
        exit;
}
$_SESSION['last_session_request'] = time();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MyCompany Service Status Inquiry</title>
</head>
<link href="repair.css" rel="stylesheet" type="text/css">
<body style="font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif; font-size: medium;">
<script type="text/javascript" src="repairstatus-funcs.js"></script>

<p><strong style="font-size: xx-large"><img src="system_info.gif" width="55" height="55" alt=""/> MyCompany Repair Status Inquiry
</strong></p>
<hr>
<p>

  <?php

require "repairstatus-config.php";

$form = <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (wihout quotes).</strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="get">
<fieldset>
  <legend>Enter Invoice ID:</legend>
  <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <input type="submit" value="Lookup Status" />
</fieldset>
</form>
EO;

$altform = <<<EO
<strong>To view your repair status, type your invoice number WITHOUT the preceding letter.
Example: Invoice "A33869" would be entered as just "33869" (wihout quotes). </strong>
<form name = "invInfo" action="{$_SERVER['PHP_SELF']}" onsubmit="return allnumeric(document.invInfo.invid)" method="get">
<fieldset>
  <legend>Enter Invoice ID:</legend>
  <input type="text" size="5" name="invid" onKeyDown="limitText(this.form.invid,this.form.countdown,5);" onKeyUp="limitText(this.form.invid,this.form.countdown,5);"; />
  <input type="submit" value="Lookup Status" />
  <p><b>The invoice number your entered was not found. Please try again.</b>
</fieldset>
</form>
EO;


// If request has been made
if (isset($_GET[invid])) {
  mysql_connect($servername, $username, $password) or die('An error in the form was present or a script error occured.');		// SQL error:<p><p>'. mysql_error(). ''
  mysql_select_db($dbname) or die('An error in the form was present or a script error occured.');	 //SQL error:<p><p>'. mysql_error(). ''
  // sanitize request
  $invid = mysql_real_escape_string($_GET[invid]);
  $sql = 'SELECT * FROM repairs WHERE invid = '. $invid .' LIMIT 1;';
  $result = mysql_query($sql) or die('An error in the form was present or a script error occured.');	// SQL error:<p><p>'. mysql_error(). ''
  $num = mysql_num_rows($result);
  // if no records found
  if ($num < 1) {
	echo $altform;
  }
  else {
    $row = mysql_fetch_assoc($result);
	$correctdateA = DATE("l m/d", STRTOTIME($row[rpdate]));
	$correcttimeA = DATE("g:i a", STRTOTIME($row[rptime]));
    echo "<p><b>Your machine status is: </b>". $row[status] ."&nbsp; <a title=\"Status Legend\" style=\"cursor: pointer\" onclick=\"openInfo()\");\"><img src=\"info.gif\" width=\"16\" height=\"16\" alt=\"Status Legend\"/></a></p>";
	echo "<br><font size=\"5\"><b>Details:</font></b>";
	echo "<p><b>Assigned to Technician: </b>". $row[tech] ."</p>";
	if(!empty($row[exdate])) {
			$correctdateB = DATE("l m/d", STRTOTIME($row[exdate]));
			$correcttimeB = DATE("g:i a", STRTOTIME($row[extime]));
				echo "<p><b>Estimated start date/time of your machine is: </b>". $correctdateB . " by approx. ". $correcttimeB ."</p>";
	}
	echo "<p><b>Estimated repair completion date/time is: </b>". $correctdateA ." by approx. ". $correcttimeA ."</p>";
	echo "<p><b>Return Service Type: </b>". $row[delivertype] . "</p>";
	if(!empty($row[comments])) {
				echo "<p><b>Current Comments on Ticket: </b>". $row[comments] . "</p>";
	}
	echo "<hr>";
	echo "If you have any questions about your computer being serviced, please <a href=\"contactus_email.htm\">email us</a> or <a href=\"contactus.htm\">contact us</a> via Phone.";
  }
}
// Otherwise show form for user to make request
else {
  echo $form;
}
?>
<p align="center">
  <span style="font-size: small"><a href="/index.htm" title="Return to Homepage" style="font-size: small">Click here</a> to return to the MyCompany Homepage</span></p>
<p align="center" style="font-size: x-small">Copyright &copy; 2014, MyCompany Computer Services. All Rights Reserved.</p>
<p align="center" style="font-size: x-small">CS Status System v1.0 &copy 2014 Chris Formeister. All Rights Reserved.</p>
<body>
</body>
</html>