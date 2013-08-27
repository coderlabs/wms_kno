<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hospitality Service Traveller Detail | PT Gapura Angkasa Denpasar</title>

<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:10px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
table.footer {
font-family: verdana,arial,sans-serif;
	font-size:8px;
	color:#333333;
}
table.header {
font-family: verdana,arial,sans-serif;
	font-size:12px;
	color:#333333;
}
</style>
	
</head>
<body>
<h2>There is a request for Gapura Hospitality Service with the following detail : </h2>
<table border="0" align="left" class="header">
		<?php echo $contact; ?>
	<tr><td colspan="10">
	
<table border="1" align="center" class="gridtable" >
	<tr>
		<th>No.</th>
		<th width="100px">Full name of traveler</th>
		<th>Gender</th>
		<th>Place of birth</th>
		<th>Date of birth</th>
		<th>Nationality</th>
		<th>Occupation</th>
		<th>Passport/ ID Number</th>
		<th>Place of issue</th>
		<th>Date of expiry</th>
		<th>Country of residence</th>
		<th>Last place/port of embarkation</th>
	</tr>
	<tbody> 
<?
$number = 1;
foreach($traveller as $row)
{?>
	<tr>
	<td><center><?php echo $number?></center></td>
	<td><center><?php echo $row['name']?></center></td>
	<td><center><?php echo $row['gender']?></center></td>
	<td><center><?php echo $row['place']?></center></td>
	<td><center><?php echo $row['date']?></center></td>
	<td><center><?php echo $row['nationality']?></center></td>
	<td><center><?php echo $row['occupation']?></center></td>
	<td><center><?php echo $row['passport']?></center></td>
	<td><center><?php echo $row['issue']?></center></td>
	<td><center><?php echo $row['expired']?></center></td>
	<td><center><?php echo $row['residence']?></center></td>
	<td><center><?php echo $row['last_port']?></center></td>
	</tr>
<?php
$number++;
}?> 
	</tbody>
</table>
</td></tr></table>
</body>
</html>