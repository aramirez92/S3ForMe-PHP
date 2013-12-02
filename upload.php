<?php
if (!class_exists('S3'))require_once('S3.php');

// Bucket Name
$bucket="s3.dasi.plusdrive.net";
			
//AWS access info
if (!defined('s3ForMeAccessKey')) define('s3ForMeAccessKey', '99D79B06DCC8A7A54C1A67EB895A6281');
if (!defined('s3ForMeSecretKey')) define('s3ForMeSecretKey', '496927fdea5ae4a30bdf25399073356261f62a2b');

//Instantiate the class
$s3 = new S3(s3ForMeAccessKey, s3ForMeSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

//Select the file
$imageName = 'DSC01266.jpg';

//Rename image name. 
$uploadedImageName = time().'.jpg';

//PUT the file
if($s3->putObjectFile($imageName, $bucket , $uploadedImageName, S3::ACL_PUBLIC_READ)){
	echo '<h1>S3ForMe Upload Successful.</h1>';	
	$fileURL='http://'.$bucket.'.rest.s3for.me/'.$uploadedImageName;
	echo "<img src='$fileURL' style='max-width:400px'/><br/>";
	echo '<b>S3 File URL:</b>'.$fileURL;
}else{
	echo 'Upload failed.';
}