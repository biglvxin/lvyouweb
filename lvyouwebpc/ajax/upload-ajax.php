<?php 

header("content-type:application/json");

$cover = $_FILES["cover"];
echo $cover;

// 检查文件有效性

$ext = pathinfo($cover["name"] , PATHINFO_EXTENSION);
$fileName = md5(uniqid(microtime(true) . mt_rand())) . "." . $ext;

$flag = move_uploaded_file($cover["tmp_name"] , "images/" . $fileName);

$result = [
	"code" => 101,
	"message" => "上传失败",
	"data" => null
];

if($flag){
	$result = [
		"code" => 100,
		"message" => "上传成功",
		"data" => [
			"name" => $fileName,
			"path" => "images/" . $fileName
		]
	];
}


echo json_encode($result);