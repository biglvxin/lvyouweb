(function($){
	$('#yudinghotel').bind('click',function(e){
		var $orderId=$('#hotelListInfo').attr('order-name');
		var $liveinTime=$('#livein-time').val();
		var $userId=$('#hotelListInfo').attr('user-id');
		var $hotelId=$('#hotelListInfo').attr('hotel-id');
		var $roomTypeId=$('#hotel-typewhat').val();
		var $phone=$('#hotelListInfo').attr('phone');
		// console.log($orderId);
		console.log($liveinTime);
		// console.log($userId);
		// console.log($hotelId);
		// console.log($roomTypeId);
		// console.log($phone);
		//console.log(typeof($liveinTime));
		$.ajax({
			url:'http://127.0.0.1:9090/lvyouwebpc/ajax/insertorderList.php',
			type:'post',
			dataType:'json',
			data:{
				orderId:$orderId,
				liveinTime:$liveinTime,
				userId:$userId,
				hotelId:$hotelId,
				roomTypeId:$roomTypeId,
				phone:$phone
			},
			success:function(response){
				if(response.code==100){
					$("#dialog")[0].style.display="block";
			 			setTimeout(function(){//定时器 
						$("#dialog").css("display","none");//将图片的display属性设置为none
							},
							1000);
			 			$('.area-content').val(' ');
			 			$('.pinglun-border').hide(800);

				}
			}
		});


	});
})(jQuery);