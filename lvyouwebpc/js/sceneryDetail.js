(function($){
	var count=parseInt($('#iviewpoint').attr('data-viewpoint-count'));
	//用户信息
	$nickName=$('#btn-sendView').attr('user-infoName');
	$header=$('#btn-sendView').attr('user-header');
	$userId=$('#btn-sendView').attr('user-id');
	$sceneryId=$('#btn-sendView').attr('scenery-id');
	//点击我要评论
	$('#iviewpoint').bind('click',function(e){
			if($nickName==' '){
				location.href="login.php";
			}else{
				count++;
			//console.log(count);
			if(count%2==0){
				$('#area-content').val(' ');
				$('.pinglun-border').hide(800);
				

			}else{
				$('#area-content').val(' ');
				$('.pinglun-border').show(800);	
			 }
			}
	});
	//点击发布评论
	$('#btn-sendView').bind('click',function(e){	
	$formattime=$('#send-fasongtime').attr('send-time');
	console.log($formattime);
	$time=$('#send-fasongtime').attr('send-stringtime');
	console.log($time);
	//文本框的值
		$content=$('#area-content').val();
		console.log($content);
		// //创建新的评论DOM	
		//post的ajax的提交方式
		$.ajax({
			url:'http://127.0.0.1:9090/lvyouwebpc/ajax/viewSend.php',
			type:'post',
			dataType:'json',
			data:{
				nickName:$nickName,
				header:$header,
				content:$content,
				time:$time,
				userId:$userId,
				sceneryId:$sceneryId,
				praiseCount:0
			},
			success:function(response){
				if(response.code==100){
					var $container= $('<div class="discuss"></div>').appendTo($("#discuss-container"));
					 	var $userInfo=$('<div class="use-discuss-info"></div>').appendTo($container);
					 		var $touxing=$('<div class="touxiang"></div>').appendTo($userInfo);
					 			$('<img class="img-urse">').attr('src',$header).appendTo($touxing);
					 			$('<span class="green"></span>').text($nickName).appendTo($touxing);
					 			$('<span class="checkState"></span>').text('待审核').appendTo($touxing)
					 			// $('<img src="images/zang.png" class="zangimg" id="zang">').appendTo($touxing);
					 			// $('<span userid=$userId count-data="0" ></span>').text('0').appendTo($touxing);
					 		$('<div class="use-discuss-text"></div>').text($content).appendTo($userInfo);
					 		var $opeater=$('<div class="bandang-opeater"></div>').appendTo($userInfo);
					 			$('<span></span>').text('发布时间：').appendTo($opeater);
					 			$('<span class="banggrey"></div>').text($formattime).appendTo($opeater);
					 			//清空值
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
	$userid=$('.praise-count').attr('userid');
	//修改用户的点击数加1	
	$('.zangimg').bind('click',function(e){
			$userid=$(this).next().attr('userid');
			console.log($userid);
		var $pariseCount=$(this).attr('praiseCount');
		$pariseCount=parseInt($pariseCount);
			$pariseCount++;
			$(this).attr('praiseCount',$pariseCount);
			$(this).next().text($pariseCount);
			//写入数据库
			$.ajax({
			url:'http://127.0.0.1:9090/lvyouwebpc/ajax/updateZang.php',
			type:'post',
			dataType:'json',
			data:{
				userId:$userid,
				praiseCount:$pariseCount
			},
			success:function(response){
				if(response.code==100){
					 	
				}
			}
		});

	});

})(jQuery);