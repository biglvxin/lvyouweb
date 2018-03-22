<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/roomsService.php");
require_once("lvyouwebpc/services/hotelService.php");
require_once("lvyouwebpc/services/mustSceneryService.php");

$hotelId=$_POST["id"];
$name=$_POST["name"];
$address=$_POST["address"];
$areaId=$_POST["areaId"];

// echo $hotelId;
// echo $areaId;
// echo $name;
// echo $address;
// print_r($_FILES);


$singleHotel=HotelService::getSingleHotel($hotelId);

$oldImages=$singleHotel->images;
//print_r($oldImages);

$hotelImage[0]=null;
$hotelImage[1]=null;
$hotelImage[2]=null;

foreach ($_FILES as$key=> $item) {

	if($key=="image2"){
		$image1=$_FILES["image2"];
		$file1=$_FILES["image2"]["name"];
		$ext1 = pathinfo($file1 , PATHINFO_EXTENSION);
		$fileName1 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext1;
		$hotelImage[0] = $fileName1;
		move_uploaded_file($image1["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName1);

		//print_r($_FILES["image1"]);
	}

	if($key=="image3"){
		$image2=$_FILES["image3"];
		$file2=$_FILES["image3"]["name"];
		$ext2 = pathinfo($file2 , PATHINFO_EXTENSION);
		$fileName2 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext2;
		$hotelImage[1] = $fileName2;
		move_uploaded_file($image2["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName2);

		//print_r($_FILES["image2"]);

	}

	if($key=="image4"){
		$image3=$_FILES["image4"];
		$file3=$_FILES["image4"]["name"];
		$ext3 = pathinfo($file3 , PATHINFO_EXTENSION);
		$fileName3 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext3;
		$hotelImage[2] = $fileName3;
		move_uploaded_file($image3["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/"  . $fileName3);
		//print_r($_FILES["image3"]);
	}

}

	if(is_null($hotelImage[0])){
			$hotelImage[0]=$oldImages[0];
	}
	if(is_null($hotelImage[1])){
			$hotelImage[1]=$oldImages[1];
	}
	if(is_null($hotelImage[2])){
			$hotelImage[2]=$oldImages[2];
	}

	$im=implode($hotelImage,",");
	//echo $im;

$rs=HotelService::updateHotel($hotelId,$name,$address,$im);
$result=new ResponseResultInfo(101,"请求失败",null);
if($rs){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=1;
}
// //返回一组json格式的数据
echo json_encode($result);