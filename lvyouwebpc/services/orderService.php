<?php 
require_once("lvyouwebpc/model/orderInfo.php");
require_once("lvyouwebpc/services/roomsService.php");
require_once("lvyouwebpc/services/dbHelper.php");
require_once("lvyouwebpc/services/hotelService.php");
class OrderService{
	//得到用户所有的订单
	public static function getAllOrderByUserId($userId='296dfbba-25e0-11e8-aee9-1c872c75b691'){
		$sql="select id,orderid,ordertime,userid,hotelid,roomtypeid,phone from orders where userid='{$userId}';";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$orders=[];
		foreach ($rs as $row) {
			$order=new OrderInfo();
			$order->id=$row[0];
			$order->orderId=$row[1];
			$order->orderTime=date('Y-m-d',$row[2]);
			$order->userId=$row[3];
			$order->hotelId=$row[4];
			//得到酒店详细
			$order->hotelList=HotelService::getSingleHotel($row[4]);
			$order->roomTypeId=$row[5];
			//根据房型得到房子的类型名称
			$order->roomTypeList=RoomsService::getRoomNameByRoomTypeId($row[5]);
			$order->phone=$row[6];
			$orders[]=$order;
		}
		return $orders;
	}
	//插入订单
	public static function insertOrder($orderId,$liveinTime,$userId,$hotelId,$roomTypeName,$phone){
		$sql="insert into orders(id,orderid,ordertime,userid,hotelid,roomtypeid,phone)values(UUID(),'{$orderId}','{$liveinTime}','{$userId}','{$hotelId}','{$roomTypeName}','{$phone}');";
		$rs=DBHelper::executeNonQuery($sql);
		return $rs;
	}
	//得到所有的订单
	public static function getAllOrder(){
		$sql="select id,orderid,ordertime,userid,hotelid,roomtypeid,phone from orders;";
		$rs=DBHelper::executeQuery($sql);
		if(is_bool($rs)){
			return false;
		}
		$orders=[];
		foreach ($rs as $row) {
			$order=new OrderInfo();
			$order->id=$row[0];
			$order->orderId=$row[1];
			$order->orderTime=date('Y-m-d',$row[2]);
			$order->userId=$row[3];
			$order->hotelId=$row[4];
			//得到酒店详细
			$order->hotelList=HotelService::getSingleHotel($row[4]);
			$order->roomTypeId=$row[5];
			//根据房型得到房子的类型名称
			$order->roomTypeList=RoomsService::getRoomNameByRoomTypeId($row[5]);
			$order->phone=$row[6];
			$orders[]=$order;
		}
		return $orders;
	}
}