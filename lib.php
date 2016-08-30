<?php
	function antiSQLInjection($conn, $post) {
		return mysqli_real_escape_string($conn, $post);
	}
	
	function antiXSS($post) {
		return strip_tags($post);
	}

	function insertCustomer($conn, $telNo, $userName, $phoneType, $country, $mcStartDate, $mcInterval, $mcCycle, $threshold1, $threshold2) {
		return mysqli_query($conn, "INSERT INTO `customer`(`tel_no`, `user_name`, `phone_type`, `country`, `mc_start_date`, `mc_interval`, `mc_cycle`, `threshold1`, `threshold2`) 
		VALUES ('$telNo', '$userName', '$phoneType', '$country', '$mcStartDate', '$mcInterval', '$mcCycle', '$threshold1', '$threshold2')");
	}
	
	function insertImage($conn, $imageFile, $imageDate, $imageDensity, $imagePattern, $userNo) {
		return mysqli_query($conn, "INSERT INTO `image`(`image_file`, `image_date`, `image_density`, `image_pattern`, `user_no`) VALUES ('$imageFile', '$imageDate', '$imageDensity', '$imagePattern', '$userNo')");
	}
	
	function getFerningPattern($whiteDensity, $lowThreshold, $highThreshold) {
		if($whiteDensity>$highThreshold) {
			return 'full fern';
		} else if($whiteDensity<=$highThreshold	&& $whiteDensity>$lowThreshold) {
			return  'partial fern';
		} else {
			return 'no fern';
		}
	}
	
	function imageProcessAndAccessDB($conn, $XMLData, $threshold1, $threshold2) {
		$xmlArray=[]; 
		$keys=[];
		
		$xml = simplexml_load_string($XMLData) or die('error: Cannot create object');
		$xmlArray = get_object_vars($xml);
		$keys = array_keys($xmlArray);

		exec('simple_edge_detection_sobel.exe '.$xmlArray['image_file'].' 100 300 25',$outputResult);
		$whitePixels=$outputResult[0];
		$whiteDensity=$whitePixels/262144; //512*512
		$ferningPattern='';
		
		$result=mysqli_query($conn, "SELECT * FROM `customer` WHERE `tel_No`='".$xmlArray['tel_No']."'");
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($result) {
			if(mysqli_num_rows($result)==0) { //如果沒有這個user
				insertCustomer($conn, $xmlArray['tel_No'], $xmlArray['user_Name'], $xmlArray['phone_Type'], $xmlArray['Country'], $xmlArray['mc_startDate'], $xmlArray['mc_Interval'], 1, $threshold1, $threshold2);
				$ferningPattern=getFerningPattern($whiteDensity, $threshold1, $theshold2);
				insertImage($conn, $xmlArray['image_file'], date('Y-m-d'), $whiteDensity, $ferningPattern, mysqli_insert_id($conn));
			} else { //如果已有這個user
				if($row['mc_start_date']==$xmlArray['mc_startDate']) { //如果mc起始日相同
					$ferningPattern=getFerningPattern($whiteDensity, $threshold1, $threshold2);
					insertImage($conn, $xmlArray['image_file'], date('Y-m-d'), $whiteDensity, $ferningPattern, $row['user_no']);
				} else { //如果mc起始日不同
					insertCustomer($conn, $xmlArray['tel_No'], $xmlArray['user_Name'], $xmlArray['phone_Type'], $xmlArray['Country'], $xmlArray['mc_startDate'], $xmlArray['mc_Interval'], $row['mc_cycle']+1, $threshold1, $threshold2);
					$ferningPattern=getFerningPattern($whiteDensity, $threshold1, $threshold2);
					insertImage($conn, $xmlArray['image_file'], date('Y-m-d'), $whiteDensity, $ferningPattern, mysqli_insert_id($conn));
				}
			}
		}
		
		return $ferningPattern;
	}

?>