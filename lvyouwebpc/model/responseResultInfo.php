<?php 

class ResponseResultInfo{
	public $code;
	public $message;
	public $data;

	//初始化接口返回信息
	public function __construct($code,$message,$data){
		$this->code=$code;
		$this->message=$message;
		$this->data=$data;
	}

}