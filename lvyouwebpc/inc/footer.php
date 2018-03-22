<div class="footer-page">
		<div class="footer-item">
			<div class="item-item">
				<h5>关于我们</h5>
				<ul>
					<li><a href="#">关于旅游go</li>
					<li><a href="#">网络信息侵权通知指引</li>
					<li><a href="#">隐私政策&nbsp;&nbsp;服务协议</li>
					<li><a href="#">联系我们</li>
					<li><a href="#">网站地图</li>
					<li><a href="#" style="color:#25A338;">加入旅游go</li>
				</ul>
			</div>
			<div class="item-item">
				<h5 class="server-pos">旅行服务</h5>
				<ul>
					<li><a href="#">旅游攻略</li>
					<li><a href="#">旅游特价</li>
					<li><a href="#">旅游问答</li>
					<li><a href="#">旅游指南</li>
					<li><a href="#">旅游资讯</li>
				</ul>
				<ul>
					<li><a href="#">酒店预定</li>
					<li><a href="#">国际租车</li>
					<li><a href="#">旅游保险</li>
					<li><a href="#">订火车票</li>
					<li><a href="#">APP下载</li>
				</ul>
				<a href="#" style="color:#25A338;display: block;">旅行商城全球商家入驻</a>	
			</div>
			<div class="item-item">
				<ul>
					<li><a href="#"><img src="images/erwei.png" style="width:120px;height: 120px;"></a></li>
				</ul>
				<div>关于旅游go订阅号</div>
			</div>
			<div class="loginlogo">向崇尚自由的加勒比海盗致敬！</div>
			<div class="loginlogo-item">
				<div class="one"></div>
			</div>
		</div>
		<div class="footer-item">
			<ul class="footer-ulpage">
				<li><a href="#">马可波罗</a></li>
				<li><a href="#">Onlylady女人志</a></li>
				<li><a href="#">艺龙旅游指南</a></li>
				<li><a href="#">欣欣旅游网</a></li>
				<li><a href="#">户外运动</a></li>
				<li><a href="#">365音乐网</a></li>
				<li><a href="#">爱问共享资料</a></li>
				<li><a href="#">旅游网</a></li>
				<li><a href="#">小说网</a></li>
				<li><a href="#">学习啦</a></li>
				<li><a href="#">游多多自助游</a></li>
				<li><a href="#">问答</a></li>
				<li><a href="#">火车时刻表</a></li>
				<li><a href="#">驴妈妈旅游网</a></li>
				<li><a href="#">好豆美食网</a></li>
				<li><a href="#">二手车</a></li>
				<li><a href="#">绿野户外</a></li>
				<li><a href="#">途牛旅游网</a></li>
				<li><a href="#">图吧</a></li>
				<li><a href="#">SUV联合越野</a></li>
				<li><a href="#">手机浏览器</a></li>
				<li><a href="#">上海地图</a></li>
				<li><a href="#">天气预报查询</a></li>
				<li><a href="#">同程旅游</a></li>
				<li><a href="#">火车票</a></li>
				<li><a href="#">YunOS</a></li>
				<li><a href="#">携程旅游</a></li>
				<li><a href="#">锦江旅游</a></li>
				<li><a href="#">火车时刻表</a></li>
				<li><a href="#">TripAdvisor</a></li>
				<li><a href="#">天巡网</a></li>
				<li><a href="#">短租房</a></li>
				<li><a href="#">租租车</a></li>
				<li><a href="#">五分旅游网</a></li>
				<li><a href="#"> 更多友情链接>></a></li>	
			</ul>
		</div>
		<div class="footer-item noborder">
			<div class="gostyle">旅游<img src="images/go.jpg"></div>
			<div class="banqan">
				© 2018 Mafengwo.cn 苏ICP备11015476号 苏公网安备110105013401号 苏ICP证110318号<br>联系方式：手机 18852921870 QQ 1229312744<br>
				常熟理工学院
			</div>
			<div class="banqan">
				<div class="banqan-img img1"></div>
				<div class="banqan-img img2"></div>
				<div class="banqan-img img3"></div>
			</div>
		</div>
</div>
<div class="back" id="back">
	<i class="fa fa-hand-o-up colorpos"></i>
</div>
		<script type="text/javascript" src="lib/js/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			(function($){
				$('#keywordbtn').bind('click',function(e){
					// $keyword=$('#keywordCity').val();
					//console.log($('#keywordCity').val());
					if($('#keywordCity').val()){
						location.href="gonglvdetail.php?keyword="+$('#keywordCity').val();
					}
					
				});
				var layer = document.querySelector('#back');
				window.onscroll = function(e)
				{
					var height = screen.height / 2;
					if(document.documentElement.scrollTop > height){
						layer.style.display = 'block';
					}
					else{
						layer.style.display = 'none';
					}
				}
				layer.onclick=function(e)
				{
					window.requestAnimationFrame(goTop);
				}
				function goTop()
				{
							
					var currentTop = document.documentElement.scrollTop;
					currentTop = currentTop - 20;			
					
					if(currentTop > 0){
						document.documentElement.scrollTop = currentTop;
						//setTimeout(goTop , 16); // setTimeout与setInterval
						window.requestAnimationFrame(goTop);
					}
					else{
						document.documentElement.scrollTop = 0;
					}
				}


			})(jQuery);
		
		</script>