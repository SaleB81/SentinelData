<?php

/* sentinel_data takes data from sentinel generated html
** delimiters are predefined fro specific data fields
** url is being sanitzed in the that ip adress is the only part left
** function returns ordered multidimensional array
** array [0][0] Computer name
**          [1] Sanitized ip address
**		    [2] Uptime (days, hours, minutes, seconds)
**          [3] Date and time in the moment of execussion
**       [1][0][0] Logical drive name 1
**             [1] Hard disk model 1
**			   [2] Current disk temperature 1
**			   [3] Disk health
**          [n] iterates as many times as $counter indicates
**				(number of disks in the system)
** 	 
*/ 

	function sentinel_data($url) {

		$html = file_get_contents($url);
		$namedelimitstart = "<td>Computer Name<td><b>:</b><td>";
		$uptimedelimitstart = "<td>System Uptime<td><b>:</b><td>";
		$modeldelimitstart = "<td>Hard Disk Model ID<td><b>:</b><td>";
		$tempdelimitstart = "<td>Current Temperature<td><b>:</b><td>";
		$healthdelimitstart = "<td>Health<td><b>:</b><td>";
		$healthdelimit2 = "width=16 height=16><td> ";
		$diskdelimitstart = "<td>Logical Drive(s)<td><b>:</b><td>";
		$delimiterend = "<tr><td>";
		$saniraniurl = extract_unit($url, "http://", ":",0);
		$computername = extract_unit($html, $namedelimitstart, $delimiterend, 0);
		$uptime = extract_unit($html, $uptimedelimitstart, $delimiterend, 0);
		$uptime = explode(", ", $uptime[0]);
		$uptimestring = intval($uptime[0]) . "d ";
		$uptimestring .= intval($uptime[1]) . "h ";
		$uptimestring .= intval($uptime[2]) . "m ";
		$uptimestring .= intval($uptime[3]) . "s";
		$vreme = time();
 		$datumvreme = date("d-m-Y H:i:s", $vreme);
    	$computerdata = array ($computername[0], $saniraniurl[0], $uptimestring, $datumvreme);
		
		// brojac diskova za for petlju $disk	
		$counter = substr_count($html, $diskdelimitstart);
	
		$disk0[1] = 0;
		$model0[1] = 0;
		$temp0[1] = 0;
		$health0[1] = 0;
		for ($i=1; $i <= $counter; $i++) {
			${'disk'.$i} = extract_unit($html, $diskdelimitstart, $delimiterend, ${'disk'.($i-1)}[1]);
			${'model'.$i} = extract_unit($html, $modeldelimitstart, $delimiterend, ${'model'.($i-1)}[1]);
			${'temp'.$i} = extract_unit($html, $tempdelimitstart, $delimiterend, ${'temp'.($i-1)}[1]);
			${'health'.$i} = extract_unit($html, $healthdelimitstart, $delimiterend, ${'health'.($i-1)}[1]);
			${'health'.$i}[0] = extract_unit(${'health'.$i}[0], $healthdelimit2, " (Excellent)", 50);
			${'podacidiska'}[($i-1)] = array (${'disk'.$i}[0], ${'model'.$i}[0], ${'temp'.$i}[0], ${'health'.$i}[0][0]);
		}
		
		$sentinelinfo = array ($computerdata, $podacidiska);
		return $sentinelinfo;
	}

/*
** function finds string content between two delimiting strings in work string
** work string is $string, start delimiter $start, end delimiter $end
** $offset is the int position that indicates the begining position of the search
** $offset is 0 when the search begins from the start of work string
** the result is an array containing result of the search [0] and it's int position [1]
** array[1] can be used as search offset for "find next" without the former result
** $offset parameter and removing of trim() function over the result are the only chages 
** against the original function that can be foun on the following link:
** http://www.bitrepository.com/extract-content-between-two-delimiters-with-php.html
*/
	function extract_unit($string, $start, $end, $offset) {
		$pos = stripos($string, $start, $offset);
		$str = substr($string, $pos);
		$str_two = substr($str, strlen($start));
		$second_pos = stripos($str_two, $end);
		$str_three = substr($str_two, 0, $second_pos);
		$pos = $pos + 50;		
		$unit = $str_three;
		return array ($unit, $pos);
	}

?>
