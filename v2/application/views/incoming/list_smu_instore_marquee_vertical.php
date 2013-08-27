<html>
<head>
<meta http-equiv="refresh" content="600; url=<?php echo site_url("instore"); ?>"> 
<style type="text/css">
html {
	margin : 0px;
}
body{
	background-color: #000080;
}

#content {vertical-align:middle;}

table.gridtable {
	font-family: time,verdana,arial,sans-serif;
	font-size:18px;
	color:#333333;
	border-width: 0px;
	border-color: #666666;
	border-collapse: collapse;
	
}

table.gridtable th {
	border-width: 0px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 0px;
	padding: 2px;
	border-style: solid;
	border-color: #ffffff;
	text-align: left;
	font-size: 30px;
	color: #ffff00;
}
</style>
</head>
<body>
<div id="content">
	<center>
    <table class="gridtable" width="1800px">
    	<tr>
        	<td colspan="5" align="center"><center>Kualanamu International Airport</center></td>
        </tr>
        <tr>
        	<td colspan="5" align="center"><center>Domestic Warehouse Information System</center></td>
        </tr>
        <tr>
        	<td width="10%">Airline</td>
            <td width="25%">Agent</td>
        	<td width="25%">No SMU</td>
            <td width="20%">Koli</td>
            <td width="20%">Berat</td>
        </tr>
        <tr>
        	<td colspan="5"><hr /></td>
        </tr>
        </table>
        
	<marquee  scrollamount="2" direction="down" loop="true" height="1800px">
		<font color="#ffffff">
			<strong> 
				
        <table class="gridtable" width="100%" height="100%">
				<?php 
				if(isset($result)){
					foreach($result as $row){	
				?>
					<tr>
						<td width="10%"><?php echo 	strtoupper($row->inb_airlines) ;?></td>
                        <td width="25%"><?php echo 	strtoupper($row->in_agent) ;?></td>
                        <td width="25%"><?php echo 	$row->inb_no_smu ;?></td>
						<td width="20%"><?php echo 	$row->inb_koli." koli" ;?></td>
						<td width="20%"><?php echo 	floor($row->inb_berat_aktual) ." kg" ;?></td>
					</tr>
				<?php
					}
				}
				?>
				</table>
			</strong>
		</font>
	</marquee>
	</center>
    
    
</div>	
</body>
</html>
