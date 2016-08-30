<?php
	header('Access-Control-Allow-Origin: *'); //允許所有網域都可存取
	header('Content-Type:text/html; charset=utf-8');

	if(!isset($_POST['inputXML']) || !isset($_POST["image"])) {
		echo "OK";
		exit;
	}
	include('mysql_connect.php');
	include('lib.php');
	date_default_timezone_set('Asia/Taipei');
	/*
	$myXMLData =
	'<?xml version="1.0" encoding="UTF-8"?>
	<image>
	<tel_No>0983377697</tel_No>
	<user_Name>mht</user_Name>
	<Email>h3584935@gmail.com</Email>
	<phone_Type>Zenfone2</phone_Type>
	<Country>台灣</Country>
	<mc_startDate>2016-06-23</mc_startDate>
	<mc_Interval>10</mc_Interval>
	<image_file>test_image.jpg</image_file>
	</image>';
	*/
	$inputXMLData=$_POST['inputXML'];
	$xml = simplexml_load_string($inputXMLData) or die('error: Cannot create object');
	//$xml = simplexml_load_string($myXMLData) or die('error: Cannot create object');
	$xmlArray = get_object_vars($xml);
	// $inputXMLData=$myXMLData;
	$image = isset($_POST["image"]) ? $_POST["image"] : '';
	$filename = isset($xmlArray['image_file']) ? $xmlArray['image_file'] : '';
	$image = str_replace('data:image/png;base64,', '', $image);
	$image = str_replace(' ', '+', $image);
		
	$decodedImage = base64_decode($image);
	$source_img = imagecreatefromstring($decodedImage);
	$file = $filename;
	$imageSave = imagejpeg($source_img, $file, 100);
	imagedestroy($source_img);
	
	$ferningPattern=imageProcessAndAccessDB($conn, $inputXMLData, 0.06, 0.09);

	
	echo $ferningPattern;
		
	
	
	//--------------------------------------------------------------------
	/*
	echo '<?xml version="1.0" encoding="UTF-8"';
	echo '<image_info>';
	echo '<tel_No>'.$xmlArray['tel_No'].'</tel_No>';
	echo '<ferning_pattern>'.$ferningPattern.'</ferning_pattern>';
	echo '</image_info>';	
	move_uploaded_file($_FILES['file']['tmp_name'], $xmlArray['image_file']);
	*/
	
	
	
	
?>