<?
	include ("config.php");
	include ("header.php");

	$currentday = date("j");
	$currentmonth = date("n");
	$currentyear = date("Y");

	$database = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

	if (!isset($month)) {
		$month = $currentmonth;
	}

	if(!isset($day)) {
		if($month == $currentmonth) $day = $currentday;
		else $day = 1;
	}

	if(!isset($year)) {
		$year = $currentyear;
	}
	mysql_select_db($mysql_database, $database);
	
	$firstday = date( 'w', mktime(0,0,0,$month,1,$year));
	$lastday = date("t", mktime(0,0,0,$month,$day,$year));
	
	$nextyear = $year+1;
	$prevyear = $year-1;

	if(isold()) { echo "<table border=0 cellspacing=0 cellpadding=0 width=\"96%\">
<tr><td bgcolor=\"$bordercolor\">
<table width=\"100%\" border=0 cellspacing=1 cellpadding=2 bgcolor=\"$tablebgcolor\""; }
	else {
		echo "<table class=nav";
		if($BName == "MSIE") { echo " cellspacing=1"; }
	}
	echo ">
	<colgroup span=1 width=\"*\">
	<colgroup>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
		<col width=30px>
	</colgroup>
	<colgroup span=1 width=\"*\">
	<thead>
	<tr>
	<td colspan=14 class=title>" . date('F', mktime(0,0,0,$month,1,$year)) . " $year</td>
	</tr>
	</thead>
	<tr>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=$month&amp;year=$prevyear\">prev year</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=1&amp;year=$year\">Jan</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=2&amp;year=$year\">Feb</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=3&amp;year=$year\">Mar</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=4&amp;year=$year\">Apr</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=5&amp;year=$year\">May</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=6&amp;year=$year\">Jun</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=7&amp;year=$year\">Jul</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=8&amp;year=$year\">Aug</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=9&amp;year=$year\">Sep</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=10&amp;year=$year\">Oct</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=11&amp;year=$year\">Nov</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=12&amp;year=$year\">Dec</a></td>
	<td" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"?month=$month&amp;year=$nextyear\">next year</a></td>
	</tr>
	<tr>
	<td colspan=14" . ifold(" align=center><a style=\"text-decoration:none;color:$headercolor\"", "><a") . 
	" href=\"operate.php?action=Add+Item&amp;month=$month&amp;year=$year&amp;day=$day\">Add Item</a></td>
	</tr></table>";
	if(isold()) { echo "</td></tr></table><br>
<table width=\"96%\" cellspacing=0 cellpadding=0 border=0>
<tr><td bgcolor=\"$bordercolor\">
<table width=\"100%\" cellspacing=2 cellpadding=2 border=0>"; }
	else { echo "<table class=calendar>"; }
	echo "<colgroup span=7 width=\"1*\">
	<thead>
		<tr" . ifold(" bgcolor=\"$headerbgcolor\"", "") . ">
		<td>" . ifold("<font color=\"$headercolor\">Sunday</font>", "Sunday") . "</td>
		<td>" . ifold("<font color=\"$headercolor\">Monday</font>", "Monday") . "</td>
		<td>" . ifold("<font color=\"$headercolor\">Tuesday</font>", "Tuesday") . "</td>
		<td>" . ifold("<font color=\"$headercolor\">Wednesday</font>", "Wednesday") . "</td>
		<td>" . ifold("<font color=\"$headercolor\">Thursday</font>", "Thursday") . "</td>
		<td>" . ifold("<font color=\"$headercolor\">Friday</font>", "Friday") . "</td>
		<td>" . ifold("<font color=\"$headercolor\">Saturday</font>", "Saturday") . "</td>
		</tr>
	</thead>
	<tbody>\n";

	for ($j = 0;; $j++)
	{
		echo "<tr>";
		for ($k = 0; $k<7; $k++)
		{
			$i = $j * 7 + $k;
			$nextday = $i - $firstday + 1;
			if($i < $firstday || $nextday > $lastday) {
				echo "<td class=none>" . ifold("&nbsp;", "") . "</td>";
				continue;
			}
			if ($currentyear > $year || ($currentmonth > $month || $currentmonth == $month && $currentday > $nextday) && $currentyear == $year)
			{
				echo "<td valign=top class=past" . ifold(" height=80>", ">");
			}
			else    
			{
                               	echo "<td valign=top class=future" . ifold(" height=80>", ">");
                        }
			echo "<a href=\"display.php?day=$nextday&amp;month=$month&amp;year=$year\" class=date>" . ifold("<b>$nextday</b></a>", "$nextday</a>");
			$query3 = mysql_query("SELECT subject, stamp FROM $mysql_tablename WHERE stamp >= \"$year-$month-$nextday 00:00:00\" AND stamp <= \"$year-$month-$nextday 23:59:59\" ORDER BY stamp");
			$tabling = 0;
			for ($i = 0; $i<mysql_num_rows($query3); $i++)
			{
				$results2 = mysql_fetch_array($query3);
				if ($results2['stamp'])
				{
					if($i == 0) { if(isold()) { echo "
<table cellspacing=0 cellpadding=0 border=0 width=\"100%\">
<tr><td bgcolor=\"$bordercolor\">
<table class=list cellspacing=1 cellpadding=2 border=0 width=\"100%\">\n"; }
else if($BName == "MSIE") { echo "\n<table class=list cellspacing=1>"; }
else echo "\n<table class=list>";
						$tabling = 1;
					}
					$subject = htmlspecialchars(stripslashes($results2['subject']));
					$temp_time = date("g:i A", strtotime($results2['stamp']));
					echo "<tr><td>" . ifold("<font size=1>", "") . "<a href=\"display.php?day=$nextday&amp;month=$month&amp;year=$year\">$temp_time - $subject</a>" . ifold("</font>", "") . "</td></tr>";
				}
			}
			if ($tabling == 1) {
				echo "</table>";
				if(isold()) { echo "</td></tr></table>"; }
			}
			echo "</td>";
		}
		echo "</tr>\n";
		if($nextday >= $lastday) {
			break;
		}
	}

	echo "</table>\n";
	if(isold()) { echo "</td></tr></table>"; }
	include("footer.php");
?>