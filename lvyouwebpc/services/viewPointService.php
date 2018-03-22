<?php 
require_once("dbHelper.php");
require_once("lvyouwebpc/model/areasInfo.php");
require_once("lvyouwebpc/util/globalSetting.php");
require_once("lvyouwebpc/services/loginService.php");
class ViewPointService{
	public static function getAllSceneryViewPoints($sceneryId='a982abec-200c-11e8-a616-1c872c75b691'){
		$sql="select id,userid,sceneryid,content,time,praisecount,state from viewpoints where sceneryid='{$sceneryId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$views=[];
		foreach ($rs as $row) {
			$view=new AreasInfo();
			$view->id=$row[0];
			$view->userId=$row[1];
			$view->userList=LoginService::getUserInfoByUserId($row[1]);
			$view->sceneryId=$row[2];
			$view->content=$row[3];
			$view->time=date('Y-m-d H:i:s',$row[4]);
			$view->praiseCount=$row[5];
			$view->state=$row[6];
			$views[]=$view;
		}
		return $views;

	}
	//得到所有的评论
	public static function getAllViewPoints(){
		$sql="select id,userid,sceneryid,content,time,praisecount,state from viewpoints ;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$views=[];
		foreach ($rs as $row) {
			$view=new AreasInfo();
			$view->id=$row[0];
			$view->userId=$row[1];
			$view->userList=LoginService::getUserInfoByUserId($row[1]);
			$view->sceneryId=$row[2];
			$view->content=$row[3];
			$view->time=date('Y-m-d H:i:s',$row[4]);
			$view->praiseCount=$row[5];
			$view->state=$row[6];
			$views[]=$view;
		}
		return $views;

	}
	//修改审核状态
	public static function updateViewState($id){
		$sql="update viewpoints set state=1 where id='{$id}';";
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;

	}

	//提交评论
	public static function submitViewPoint($userId,$sceneryId,$content,$time,$praiseCount=0){
		$sql="insert into viewpoints(id,userid,sceneryid,content,time,praisecount,state)values(UUID(),'{$userId}',
'{$sceneryId}','{$content}',$time,0,0);";
		$rs=DBHelper::executeNonQuery($sql);
		//var_dump($rs);
		return $rs;
	}
	//修改点赞数
	public static function updateZang($praiseCount,$userId){
		$sql="update viewpoints set praisecount=$praiseCount where userid='{$userId}';";
		$rs=DBHelper::executeNonQuery($sql);
		//var_dump($rs);
		return $rs;
	}

}