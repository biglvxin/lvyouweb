<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/sceneryDetailService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/areasService.php");


$sceneryId=$_POST["sceneryId"];
$area=$_POST["area"];
$sceneryName=$_POST["sceneryName"];
$address=$_POST["address"];
$httpAddress=$_POST["httpAddress"];
$transfer=$_POST["transfer"];
$price=$_POST["price"];
$open=$_POST["open"];
$phone="18852921870";
$introduceDetail=$_POST["introduceDetail"];
$introduceTitle=$_POST["introduceTitle"];


// echo $sceneryId."<br/>";
// echo $area."<br/>";
// echo $sceneryName."<br/>";
// echo $address."<br/>";
// echo $httpAddress."<br/>";
// echo $transfer."<br/>";
// echo $price."<br/>";
// echo $open."<br/>";
// echo $phone."<br/>";
// echo $introduceDetail."<br/>";
// echo $introduceTitle."<br/>";
//得到省份的id 
$provinceInfo=areasService::getProvinceByAreaName($area);
$areaId=$provinceInfo[0]->id;
//$introduce=$provinceInfo[0]->introduce;
$provinceId=$provinceInfo[0]->provinceId;
$provinceName=$provinceInfo[0]->provinceName;
// print_r($provinceInfo);
//得到当个景点
$singleScenery=sceneryDetailService::getSingleSceneryById($sceneryId);

$oldImages=$singleScenery[0]->images;
//print_r($oldImages);

// echo $provinceName.'<br/>';
// echo $provinceId.'<br/>';
// echo $areaId.'<br/>';

$sceneryImage[0]=null;
$sceneryImage[1]=null;
$sceneryImage[2]=null;
//print_r($_FILES);
foreach ($_FILES as$key=> $item) {
	if($key=="image1"){
		$image1=$_FILES["image1"];
		$file1=$_FILES["image1"]["name"];
		$ext1 = pathinfo($file1 , PATHINFO_EXTENSION);
		$fileName1 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext1;
		$sceneryImage[0] = $fileName1;
		move_uploaded_file($image1["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName1);

		//print_r($_FILES["image1"]);
	}

	if($key=="image2"){
		$image2=$_FILES["image2"];
		$file2=$_FILES["image2"]["name"];
		$ext2 = pathinfo($file2 , PATHINFO_EXTENSION);
		$fileName2 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext2;
		$sceneryImage[1] = $fileName2;
		move_uploaded_file($image2["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName2);

		//print_r($_FILES["image2"]);

	}

	if($key=="image3"){
		$image3=$_FILES["image3"];
		$file3=$_FILES["image3"]["name"];
		$ext3 = pathinfo($file3 , PATHINFO_EXTENSION);
		$fileName3 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext3;
		$sceneryImage[2] = $fileName3;
		move_uploaded_file($image3["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/"  . $fileName3);
		//print_r($_FILES["image3"]);
	}

}

	if(is_null($sceneryImage[0])){
			$sceneryImage[0]=$oldImages[0];
	}
	if(is_null($sceneryImage[1])){
			$sceneryImage[1]=$oldImages[1];
	}
	if(is_null($sceneryImage[2])){
			$sceneryImage[2]=$oldImages[2];
	}

	$im=implode($sceneryImage,",");
// echo $im;


// //给接口一个初始返回值
 $result=new ResponseResultInfo(101,"请求失败",null);
//修改数据库

$flag=SceneryDetailService::updateScenery($sceneryId,$area,$introduceTitle,$phone,$address,$httpAddress,$transfer,$price,$open,$im,$introduceDetail);
//不为null值，就返回是有值的。
if($flag){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$flag;
	}

//返回一组json格式的数据
echo json_encode($result);