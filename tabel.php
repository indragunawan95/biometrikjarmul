<?php
$IP="10.151.36.69";
$Key="0";
?>
<table cellspacing="2" cellpadding="2" border="1" id="tabel">
	<tr align="center">
	    <td><B>UserID</B></td>
	    <td><B>User Name</B></td>
	    <td width="200"><B>Tanggal & Jam</B></td>
	    <td><B>Verifikasi</B></td>
	    <td><B>Status</B></td>
	</tr>
	<?php
	$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
	}else echo "Koneksi Gagal";
	

	include("parse.php");
	$ID = array();
	//$DateTime = "";
	$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	$buffer=explode("\r\n",$buffer);
	for($a=count($buffer)-2;$a<=count($buffer)-2;$a++){
		$data=Parse_Data($buffer[$a],"<Row>","</Row>");
		$PIN=Parse_Data($data,"<PIN>","</PIN>");
		$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
		$Verified=Parse_Data($data,"<Verified>","</Verified>");
		$Status=Parse_Data($data,"<Status>","</Status>");
		//var_dump($PIN);
		//array_push($ID, $PIN);
		
		$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
		if($Connect){
				$soap_request="<GetUserInfo><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$PIN."</PIN></Arg></GetUserInfo>";
				$newLine="\r\n";
				fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			    fputs($Connect, "Content-Type: text/xml".$newLine);
			    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			    fputs($Connect, $soap_request.$newLine);
				$bufferUser="";
				while($ResponseUser=fgets($Connect, 1024)){
					$bufferUser=$bufferUser.$ResponseUser;
					}
			}else echo "Koneksi Gagal";
			
		

		//include("parse.php");
		$ID = array();
		$bufferUser=Parse_Data($bufferUser,"<GetUserInfoResponse>","</GetUserInfoResponse>");
		$bufferUser=explode("\r\n",$bufferUser);
		$dataUser=Parse_Data($bufferUser[1],"<Row>","</Row>");
		$PIN2=Parse_Data($dataUser,"<PIN>","</PIN>");
		$Name=Parse_Data($dataUser,"<Name>","</Name>");

		date_default_timezone_set('Asia/Bangkok');
		$timeStart = strtotime($DateTime);
		$timeNow = time(new DateTime("now"));
		//var_dump($timeNow);
		// $diff = date_diff($timeStart, $timeNow);
		// echo $diff->format("mm:ss");
		// echo $timeNow;
		// echo $DateTime;
		// if($timeStart<$timeNow){
		// 	echo "lalalal";
		// }
		$interval = ($timeNow-$timeStart);
		$date = new DateTime();
		echo $date->getTimestamp();
		echo "    ";
		print_r($timeStart);
		echo "    ";
		print_r($timeNow);
		echo "    ";
		print_r($interval);

		if($interval<0){
			$redirect = 1;
			header('Location: /PHP-soap-baru/index.php'); 
		}

	
	?>
	<tr align="center">
		    <td><?php echo $PIN?></td>
		    <td><?php echo $Name?></td>
		    <td><?=$DateTime?></td>
		    <td><?=$Verified?></td>
		    <td><?=$Status?></td>
		</tr>
	<?php }

	?>
	</table>

