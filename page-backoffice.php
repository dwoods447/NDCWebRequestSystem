<?
/* CSS classes used:
table.backoffice = all of the tables on every page
table.login = the login form table
table.form = the table with the search options
table.report = the table with the returned registrations
a.tab = the tabs on the search page
th.head = for the top row of the search form, to differentiate between it and the left column
tr.ar = alternating rows
tr.test = rows for test registrations
td.details = "show details" box of one-click page
h2, h3, p = all used on the 'help' page
*/

/***********************************
              MySQL
***********************************/
$reg_db_host = "184.173.16.74";
$reg_db_user = "back_office_read";
$reg_db_pass = "boREAD!!*";
$reg_db_name = "back_office";
$bodb = mysql_connect($reg_db_host, $reg_db_user, $reg_db_pass) or die("Cannot connect to back-office database.");
mysql_select_db($reg_db_name, $bodb);

/***********************************
              Config
***********************************/
$webmaster_email = "schifyer@yahoo.com";
echo("<i>Logged in as ". $username ." | <a href='?page=backoffice&action='>Search</a> | <a href='?page=backoffice&action=help'>Help</a> | <a href='?page=backoffice&action=logout'>Log out</a></i><br/>\n");
$comparisons = array("=", ">", "<", ">=", "<=");
$columns = array(
	'index' =>		array("Customer ID", "int", "Row number of this entry in the database. Generally not relavent."),
	'event' =>		array("Event", "string", "Includes the year and the general event title (not including the location)."),
	'venue' =>		array("Venue", "string", "Usually the city or state for which the registration was submitted."),
	'date' =>		array("Date", "date", "The time that the registration was submitted."),
	'ip' =>			array("IP Address", "string", "IP address of the person submitting the registration."),
	'url' =>		array("Form Used", "string", "URL of the webpage from which the person submitted the registration."),
	'firstname' =>		array("First Name", "string", "Name of the participant."),
	'lastname' =>		array("Last Name", "string", "Name of the participant."),
	'salutation' =>		array("Salutation", "string", "Name of the participant."),
	'title' =>		array("Title", "string", "Title of the participant."),
	'company' =>		array("Company", "string", "Company of the participant."),
	'email' =>		array("Email Address", "string", "Email address used for the registration."),
	'address' =>		array("Address Line 1", "string", "Address of the participant."),
	'address2' =>		array("Address Line 2", "string", "Address of the participant."),
	'city' =>		array("City", "string", "Address of the participant."),
	'state' =>		array("State", "string", "Address of the participant."),
	'zip' =>		array("ZIP Code", "string", "Address of the participant."),
	'phone' =>		array("Phone Number", "string", "Phone number of the participant."),
	'creditcard' =>		array("Card Number", "string", "Last four digits of the credit card used."),
	'cc_type' =>		array("Card Type", "string", "Visa/MasterCard/etc."),
	'level' =>		array("Sponsor Level", "string", "The name of the sponsorship level."),
	'amount' =>		array("Amount Paid", "int", "Total amount of money donated, including any fees."),
	'extra' =>		array("Extra Info", "string", "Some of the registration forms have extra fields, which will show up here."),
);
if($_GET['action'] == "query")
{
/***********************************
              Report
***********************************/
	$select = array();
	$where = array();
	// Generic
	foreach($columns as $name=>$prop)
	{
		if($_POST['show_'.$name] == "on")
			$select[] = "`". $name ."`";
		
		if($_POST['search_'.$name] != "")
		{
			if($prop[1] == "string")
				$where[] = "`". $name ."` LIKE '%". mysql_real_escape_string($_POST['search_'.$name], $bodb) ."%'";
			else if($prop[1] == "int")
				$where[] = "`". $name ."`". $comparisons[(int)$_POST['search2_'.$name]] . ((float)$_POST['search_'.$name]);
		}
	}
	// Date
	if($_POST['frommonth']!="" && $_POST['fromday']!="" && $_POST['fromyear']!="" && $_POST['tomonth']!="" && $_POST['today']!="" && $_POST['toyear']!="")
	{
		$from = mktime(0, 0, 0, (int)$_POST['frommonth'], (int)$_POST['fromday'], (int)$_POST['fromyear']);
		$to = mktime(23, 59, 59, (int)$_POST['tomonth'], (int)$_POST['today'], (int)$_POST['toyear']);
		$where[] = "`date`>=". $from;
		$where[] = "`date`<=". $to;
	}
	// Test
	if($_POST['show_test'] == "on")
		$select[] = "`test`";
	else
		$where[] = "`test`=0";
	// Do the query
	$query = mysql_query("SELECT ". implode(",", $select) ." FROM `registrations` WHERE ". (count($where)?implode(" AND ", $where):"1"), $bodb);
	if($_POST['report'] == "Save As XLS")
	{
/***********************************
              As XLS
***********************************/
		ob_end_clean();
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=BackOfficeReport.xls");
		foreach($columns as $name=>$prop)
			if($_POST['show_'.$name] == "on")
				echo($prop[0]. "\t");
		echo("\n");
		while($row = mysql_fetch_assoc($query))
		{
			if(isset($row['date']))
				$row['date'] = date("M-d-Y", $row['date']);
			echo(implode("\t", $row) ."\n");
		}
		exit;
	}
	else
	{
/***********************************
            As Webpage
***********************************/
		echo("<table class='backoffice report'>\n");
		echo("	<tr>\n");
		foreach($columns as $name=>$prop)
			if($_POST['show_'.$name] == "on")
				echo("		<th>". $prop[0] ."</th>\n");
		echo("	</tr>\n");
		$a = false;
		while($row = mysql_fetch_assoc($query))
		{
			if(isset($row['date']))
				$row['date'] = date("M-d-Y", $row['date']);
			$classes = array();
			if($row['test'])
				$classes[] = "test";
			if($a)
				$classes[] = "ar";
			echo("	<tr". (count($classes)?" class='".implode(" ",$classes)."'":"") .">\n");
			foreach($row as $col=>$value)
				if($col != "test")
					echo("		<td>". $value ."</td>\n");
			echo("	</tr>\n");
			$a = !$a;
		}
		echo("</table>\n");
		echo("<i>Use the back button on the browser to revise your search.</i><br/>\n");
	}
	mysql_free_result($query);
}
else if($_GET['action'] == "help")
{
/***********************************
              Help
***********************************/
	echo("<h2>Using the Search Form</h2>\n");
	echo("<h3>Columns of the Search Form</h3>\n");
	echo("<p>The column labeled <b>Field</b> on the left indicates which field of the registration form you are working with. Almost every single field on the registration form, with the exception of some credit card info, is stored in our database for each registration. Additional technical information, such as IP address and URL, are also stored. The ones available to view and search for are all listed on the search form. If there are fields missing that you would like to see, <a href='mailto:". $webmaster_email ."'>send an email to the webmaster</a> to see about having them added. You can hover your mouse over the field name for a brief description of what it is. Alternatively, a more detailed descriptions is given further down on this page.</p>\n");
	echo("<p>The column labeled <b>Show?</b> allows you to specify which fields you want to see in the report. For example, there's almost no reason that you'd need to know the registrant's IP address, so if you uncheck the box next to the 'IP Address' field, you won't have to see it in the report. Note that this is completely independant from the following 'Search Text' field. You can still specify search text in a column even if you do not have it selected to appear in the report.</p>\n");
	echo("<p>The column labeled <b>Search Text</b> allows you to limit the search to only registrants with specific information in a specific field. For fields that contain more than just a number, the form will say 'Contains:' followed by an input field. If you enter something here, then the report will only display registrant results where the text you entered appears somewhere in the specified field. For number fields (ie. amount, customer ID), you can enter a number into the input field, and then use the drop-down menu to select the type of comparison (equal to the number you entered, greater than the number you entered, etc). Lastly, the 'Date' field is a special case that allows you to specify a date range. By default, earliest possible 'From' date and latest possible 'To' date are selected, effectively selecting all registrations from all-time. You can change the month/day/year drop-downs to narrow the search to only a specific date range. As you probably can guess, the 'month' drop-down is the one that only goes to 12, the 'day' drop-down goes to 31, and the 'year' drop-down is the one with four digits.</p>\n");
	echo("<h3>Field List</h3>\n");
	echo("<p><b>Customer ID</b> is the number assigned to the specific registration submission. In most cases, this is not important. When a customer registers using the new registration form, they are told their customer ID. If they have a question about their submission, they can give you the customer ID, which makes it very easy to find their exact submission. Note that no customer IDs were assigned for any registrations prior to the creation of this new back office, so any registrants before then will not know their customer ID.</p>\n");
	echo("<p>The <b>Event</b> and <b>Venue</b> fields both specify which event the registration is for. Venue is usually the name of the state for states that only have one city where events take place. Otherwise, it would be the name of the city. Event contains the year of the event followed by the general event title (ie. '2012 Women in Leadership Symposium', '2012 Diversity and Leadership Conference', etc.)</p>\n");
	echo("<p><b>Date</b> is the date that the registration was submitted. The database stores the time to the exact second of the registration, but only the month/day/year will be displayed by default.</p>\n");
	echo("<p><b>IP Address</b> is the IP address from which the registrant submitted the registration. This is almost completely useless, but it is stored anyway just in case the extremely rare situation comes up where we have any desire to find someone's IP address. One such situation could be if someone is submitting illegal/fraudulent registrations. The IP address could be given to the police to help track down the criminal in that case.</p>\n");
	echo("<p><b>Form Used</b> gives the URL of the page containing the form that the registrant used to submit the registration. This is useful as an additional way to determine which event the registration is for. Furthermore, this is also currently the only way to search for registrations by a specific council. To find all registrations involving the California Diversity Council, you would enter the URL of that website as the search text: 'www.californiadiversitycouncil.org'. If you want to narrow it to California WIL registrations, you would also enter 'Women in Leadership Symposium' or something similar into the 'Event' search field.</p>\n");
	echo("<p>The <b>First Name</b>, <b>Last Name</b>, <b>Salutation</b>, <b>Title</b>, <b>Company</b>, <b>Email Address</b>, <b>Address Line 1</b>, <b>Address Line 2</b>, <b>City</b>, <b>State</b>, <b>ZIP Code</b>, and <b>Phone Number</b> fields all correspond to the personal and contact information of the event attendee.</p>\n");
	echo("<p>The <b>Show TEST Registrations?</b> checkbox allows you to view test registrations if you want to. Test registrations are not submitted by actual event attendees, they are submitted by an NDC staff member for the purpose of making sure the registration form works. In most cases you will want to leave this unchecked. If you submitted a test registration and are looking to make sure it appeared in the back office, then you would want to check this box in. Note that most tests have to be manually marked as tests, so any recent test registrations might show up as actual registrations until they are marked otherwise.</p>\n");
}
else
{
/***********************************
              Form
***********************************/
	echo("<style>.fixed-width{display:inline-block;width:65px;}</style>\n");
	echo("<div><a id='search_btn' class='tab' href=\"javascript:showpage('search')\">Advanced</a><a id='oneclick_btn' class='tab' href=\"javascript:showpage('oneclick')\">One-Click</a></div>\n");
	echo("<div id='visible-box'>\n");
	
	echo("<form id='search' method='post' action='?page=backoffice&action=query'>\n");
	echo("<table class='backoffice form'>\n");
	echo("	<tr>\n");
	echo("		<th class='head'>Field</th>\n");
	echo("		<th class='head' title='Do you want this column to show up in the report?'>Show?</th>\n");
	echo("		<th class='head' title='Text or number on which to base the search.'>Search Text</th>\n");
	echo("	</tr>\n");
	$a = false;
	foreach($columns as $name=>$prop)
	{
		
		echo("	<tr". ($a?" class='ar'":"") .">\n");
		echo("		<th");
		if(isset($prop[2]))
			echo(" title='". htmlentities($prop[2], ENT_QUOTES) ."'");
		echo(">". $prop[0] .":</th>\n");
		echo("		<td><input name='show_". $name ."' value='on' type='checkbox' checked/></td>\n");
		echo("		<td>");
		if($prop[1] == "string")
			echo("<span class='fixed-width'>Contains:</span><input name='search_". $name ."'/>");
		else if($prop[1] == "int")
		{
			echo("<select class='fixed-width' name='search2_". $name ."'>");
			foreach($comparisons as $i=>$v)
				echo("<option value='". $i ."'>". $v ."</option>");
			echo("</select>");
			echo("<input name='search_". $name ."'/>");
		}
		else if($prop[1] == "date")
		{
			echo("<span class='fixed-width'>From:</span>");
			echo("<select name='fromday'><option>". implode("</option><option>", range(1,31)) ."</option></select>");
			echo("<select name='frommonth'><option>". implode("</option><option>", range(1,12)) ."</option></select>");
			echo("<select name='fromyear'><option>". implode("</option><option>", range(2004,date("Y"))) ."</option></select>");
			echo("<br/><span class='fixed-width'>To:</span>");
			echo("<select name='today'><option>". implode("</option><option>", range(31,1)) ."</option></select>");
			echo("<select name='tomonth'><option>". implode("</option><option>", range(12,1)) ."</option></select>");
			echo("<select name='toyear'><option>". implode("</option><option>", range(date("Y"),2004)) ."</option></select>");
		}
		echo("</td>\n");
		echo("	</tr>\n");
		$a = !$a;
	}
	echo("	<tr". ($a?" class='ar'":"") .">\n");
	echo("		<td style='text-align:center;' colspan='3' title='Test registrations are not actual event attendees; they are from when the registration form was being tested.'><b>Show TEST Registrations? </b><input name='show_test' value='on' type='checkbox'/></td>\n");
	echo("	</tr>\n");
	$a = !$a;
	echo("	<tr>\n");
	echo("		<th class='head' colspan='3'><input type='submit' name='report' value='View Report'/> <input type='submit' name='report' value='Save As XLS'/></td>\n");
	echo("	</tr>\n");
	echo("</table>\n");
	echo("<i>Mouse over a table cell for more information about what it's for.</i><br/>\n");
	echo("</form>\n");
	
	echo("</div>\n");
	echo("<div id='hidden-box' style='display:none'>\n");
	
	// Default Shows
	$msg_show  = "			<input type='hidden' name='show_address' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_address2' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_amount' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_cc_type' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_city' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_company' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_creditcard' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_date' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_email' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_event' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_firstname' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_lastname' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_level' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_phone' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_salutation' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_state' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_title' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_venue' value='on'>\n";
	$msg_show .= "			<input type='hidden' name='show_zip' value='on'>\n";
	// Table
	echo("<table id='oneclick' class='backoffice form'>\n");
	echo("	<tr><th class='head' colspan='2'>One-Click Searches</th></tr>\n");
	echo("	<tr>\n");
	echo("		<th><form method='post' action='?page=backoffice&action=query' style='margin:0px;display:inline;'>\n");
	echo($msg_show);
	echo("			<input type='hidden' name='search_url' value='california'>\n");
	echo("			<input type='hidden' name='search_event' value='2012 Women in Leadership Symposium'>\n");
	echo("			<a onClick='this.parentNode.submit()' href='#'>2012 California Women in Leadership Symposium</a>\n");
	echo("		</form></th>\n");
	echo("		<td><i><a href=\"javascript:showdetails('2010CAWIL')\">Show Details</a></i></td>\n");
	echo("	</tr>\n");
	echo("	<tr id='2010CAWIL' style='display:none'>\n");
/*	*/	echo("		<td colspan='2' class='details'>");
	echo("	<b>Form Used:</b>	california<br/>");
	echo("	<b>Event:</b>		2012 Women in Leadership Symposium");
/*	*/	echo("</td>\n");
	echo("	</tr>\n");
	echo("</table>\n");
	
	echo("</div>\n");
	
	echo("<script type='text/javascript' src='js/tabs.js'></script>\n");
	echo("<script type='text/javascript'>showpage('search');</script>\n");
}