<?php 
//解决跨域请求问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");
require_once("lvyouwebpc/model/responseResultInfo.php");
require_once("lvyouwebpc/services/sceneryDetailService.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/areasService.php");

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
//得到省份的id 
$provinceInfo=areasService::getProvinceByAreaName($area);
$areaId=$provinceInfo[0]->id;
//$introduce=$provinceInfo[0]->introduce;
$provinceId=$provinceInfo[0]->provinceId;
$provinceName=$provinceInfo[0]->provinceName;
// print_r($provinceInfo);

$image1=$_FILES["image1"];
$image2=$_FILES["image2"];
$image3=$_FILES["image3"];


$file1=$image1["name"];
$file2=$image2["name"];
$file3=$image3["name"];

$ext1 = pathinfo($file1 , PATHINFO_EXTENSION);
$fileName1 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext1;
$sceneryImage[] = $fileName1;
move_uploaded_file($image1["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName1);

$ext2 = pathinfo($file2 , PATHINFO_EXTENSION);
$fileName2 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext2;
$sceneryImage[] = $fileName2;
move_uploaded_file($image2["tmp_name"] , $_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/" . $fileName2);

$ext3 = pathinfo($file3 , PATHINFO_EXTENSION);
$fileName3 = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext3;
$sceneryImage[] = $fileName3;
move_uploaded_file($image3["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/lvyouwebpc/image/"  . $fileName3);
$im=implode($sceneryImage,",");

//给接口一个初始返回值
$result=new ResponseResultInfo(101,"请求失败",null);
//插入数据库

$flag=SceneryDetailService::insertScenery($sceneryName,$introduceTitle,$phone,$provinceId,$area,$address,$httpAddress,$transfer,$price,$open,$im,$provinceName,$introduceDetail,$areaId);
//不为null值，就返回是有值的。
if($flag){
	$result -> code=100;
	$result -> message="请求成功";
	$result -> data=$flag;
	}

//返回一组json格式的数据
echo json_encode($result);