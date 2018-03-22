/**
 * Created by Administrator on 2018/3/12.
 */
(function(){
    angular.module('app.controllers',[])
        .controller('controllerController',function($scope){
            $scope.selectNav=0;

        })
        .controller('userController',function($scope,userService,$state){
            $scope.selectNav=1;
            //得到所有的用户
            userService.getAllUser()
                .then(function(response){
                   $scope.users=response.data.data;
                    console.log($scope.users);
                });
            //点击查看用户的订单
            $scope.getOrderByUserId=function(userId){
                console.log(userId);
                $state.go('order',{id:userId});
            };

        })
        .controller('sceneryController',function($scope,sceneryListService,$state){
            $scope.selectNav=2;
            sceneryListService.getAllScenery()
                .then(function(response){
                    $scope.sceneryList=response.data.data;
                    console.log( $scope.sceneryList);
                    $scope.data = response.data.data;
                    //分页总数
                    $scope.pageSize = 10;
                    $scope.pages = Math.ceil($scope.data.length / $scope.pageSize); //分页数
                    $scope.newPages = $scope.pages > 5 ? 5 : $scope.pages;
                    $scope.pageList = [];
                    $scope.selPage = 1;
                    //设置表格数据源(分页)
                    $scope.setData = function () {
                        $scope.items = $scope.data.slice(($scope.pageSize * ($scope.selPage - 1)), ($scope.selPage * $scope.pageSize));//通过当前页数筛选出表格当前显示数据
                    }
                    $scope.items = $scope.data.slice(0, $scope.pageSize);
                    //分页要repeat的数组
                    for (var i = 0; i < $scope.newPages; i++) {
                        $scope.pageList.push(i + 1);
                    }
                    //打印当前选中页索引
                    $scope.selectPage = function (page) {
                        //不能小于1大于最大
                        if (page < 1 || page > $scope.pages) return;
                        //最多显示分页数5
                        if (page > 2) {
                            //因为只显示5个页数，大于2页开始分页转换
                            var newpageList = [];
                            for (var i = (page - 3) ; i < ((page + 2) > $scope.pages ? $scope.pages : (page + 2)) ; i++) {
                                newpageList.push(i + 1);
                            }
                            $scope.pageList = newpageList;
                        }
                        $scope.selPage = page;
                        $scope.setData();
                        $scope.isActivePage(page);
                        console.log("选择的页：" + page);
                    };
                    //设置当前选中页样式
                    $scope.isActivePage = function (page) {
                        return $scope.selPage == page;
                    };
                    //上一页
                    $scope.Previous = function () {
                        $scope.selectPage($scope.selPage - 1);
                    }
                    //下一页
                    $scope.Next = function () {
                        $scope.selectPage($scope.selPage + 1);
                    };
                });
            //点击查看详情
            $scope.btnSceneryDetail= function(sceneryId){
                $state.go('sceneryDetail',{id:sceneryId});
            }
            $scope.keyword='';
            $scope.state=1;
            //点击添加
            $scope.btnAddScenery=function(){
                $state.go('addScenery');
            }
            //点击去编辑页
            $scope.btnEditScenery=function(sceneryId){
                $state.go('editScenery',{id:sceneryId});
            }
            //点击删除
            $scope.btnDeteleScenery=function(sceneryId){
                console.log(sceneryId);
                sceneryListService.deteleSingleScenery(sceneryId)
                    .then(function(response){
                        if(response.data.code==100){
                            console.log(response.data.data);
                            alert("确认要删除吗");
                            $state.go('scenery');
                            //var index=-1;
                            //for(var i=0;i<$scope.sceneryList.length;i++){
                            //    if($scope.sceneryList[i].sceneryId==sceneryId){
                            //        index=i;
                            //        break;
                            //    }
                            //}
                            //$scope.sceneryList.splice(index,1);
                        }
                    });
            }

        })
        .controller('sceneryDetailController',function($scope,sceneryListService,$stateParams,$window){
            $scope.selectNav=2;
            //console.log($stateParams.id);
            $scope.singleScenery=[];
            sceneryListService.getSingleScenery($stateParams.id)
                .then(function(response){
                    $scope.singleScenery=response.data.data;
                    console.log($scope.singleScenery);
                });
            $scope.goBack=function(){
                $window.history.back();
            }

        })
        .controller('addSceneryController',function($scope,areaService,sceneryListService,$stateParams,$window,$state,$timeout){
            $scope.selectNav=2;
            //得到所有的区域
            areaService.getAllArea().then(function(response){
                $scope.areaList=response.data.data;
                console.log( $scope.areaList);
            });
            //点击添加区域
            $scope.diastate=0;
            $scope.btnAddArea=function(){
                $scope.diastate=1;
            }
            //返回上一级
            $scope.goBack=function(){
                $window.history.back();
            }
            //添加景点的参数
            $scope.scenery={
                area:'',
                sceneryName:'',
                introduceTitle:'',
                address:'',
                httpAddress:'',
                transfer:'',
                price:'',
                open:'',
                image:[],
                introduceDetail:''
            };
            //点击得到所选的地方
            $scope.selectArea=function(area){
                console.log(area);
                console.log(area.name);
                $scope.diastate=0;
                $scope.scenery.area=area.name;
            }
            $scope.btnAddSave=function(){
                $scope.scenery.image[0]=$('#fileUpload1')[0].files[0];
                $scope.scenery.image[1]=$('#fileUpload2')[0].files[0];
                $scope.scenery.image[2]=$('#fileUpload3')[0].files[0];
                //console.log($scope.scenery);
                $scope.isSuccess=false;
                sceneryListService.addSceneryInfo($scope.scenery)
                    .then(function(response){
                        console.log(response.data.code);
                        if(response.data.code==100){
                            $scope.isSuccess=true;
                            $timeout(function(){//定时器
                                    $scope.isSuccess=false;
                                },
                                1000);
                            //点击添加成功，跳转
                            //alert("添加成功");
                            //点击添加成功，跳转
                            $state.go('scenery');
                        }
                });
            }
            //文件改变时的一些判断和文件读取器（对分辨率的判断）
            var image1=document.querySelector('#imgone');
            var fileUpload1=document.querySelector('#fileUpload1');
            var image2=document.querySelector('#imgtwo');
            var fileUpload2=document.querySelector('#fileUpload2');
            var image3=document.querySelector('#imgthree');
            var fileUpload3=document.querySelector('#fileUpload3');
            fileUpload1.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image1.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload2.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image2.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload3.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image3.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            //
        })
        .controller('editSceneryController',function($scope,areaService,sceneryListService,$stateParams,$window,$state){
            $scope.selectNav=2;
            //返回上一级
            $scope.goBack=function(){
                $window.history.back();
            }
            $scope.scenery={
                sceneryId:'',
                area:'',
                sceneryName:'',
                introduceTitle:'',
                address:'',
                httpAddress:'',
                transfer:'',
                price:'',
                open:'',
                image:[],
                introduceDetail:''
            };
            console.log($stateParams.id);
            sceneryListService.getSingleScenery($stateParams.id)
                .then(function(response){
                    $scope.singleScenery=response.data.data[0];
                    //console.log(response.data.data[0]);
                        $scope.scenery.sceneryId=$stateParams.id;
                    console.log($scope.scenery.sceneryId);
                        $scope.scenery.area=$scope.singleScenery.area;
                        $scope.scenery.sceneryName=$scope.singleScenery.name;
                        $scope.scenery.introduceTitle=$scope.singleScenery.introduceTitle;
                        $scope.scenery.address=$scope.singleScenery.address
                        $scope.scenery.httpAddress=$scope.singleScenery.httpAddress
                        $scope.scenery.transfer=$scope.singleScenery.transfer;
                        $scope.scenery.price=$scope.singleScenery.price;
                        $scope.scenery.open=$scope.singleScenery.open;
                        $scope.scenery.image=$scope.singleScenery.imageList;
                        //console.log($scope.scenery.image);
                        $scope.scenery.introduceDetail=$scope.singleScenery.introduceDetail;
            });
            $scope.btnEditSave=function(){
                $scope.scenery.image[0]=$('#fileUpload1')[0].files[0];
                $scope.scenery.image[1]=$('#fileUpload2')[0].files[0];
                $scope.scenery.image[2]=$('#fileUpload3')[0].files[0];
                console.log($scope.scenery.image[0]);
                console.log($scope.scenery.image[1]);
                console.log($scope.scenery.image[2]);

                console.log($scope.scenery);
                $scope.isSuccess=false;
                sceneryListService.editScenery($scope.scenery)
                    .then(function(response){
                       // console.log(response.data.data);
                            $state.go("scenery");

                    });
            }

            //得到所有的区域
            areaService.getAllArea().then(function(response){
                $scope.areaList=response.data.data;
                console.log( $scope.areaList);
            });
            //点击添加区域
            $scope.diastate=0;
            $scope.btnAddArea=function(){
                $scope.diastate=1;
            }
            //点击得到所选的地方
            $scope.selectArea=function(area){
                console.log(area);
                console.log(area.name);
                $scope.diastate=0;
                $scope.scenery.area=area.name;
            }
            //文件改变时的一些判断和文件读取器（对分辨率的判断）
            var image1=document.querySelector('#imgone');
            var fileUpload1=document.querySelector('#fileUpload1');
            var image2=document.querySelector('#imgtwo');
            var fileUpload2=document.querySelector('#fileUpload2');
            var image3=document.querySelector('#imgthree');
            var fileUpload3=document.querySelector('#fileUpload3');
            fileUpload1.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image1.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload2.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image2.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload3.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image3.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }

        })
        .controller('hotelController',function($scope,hotelListService,$state){
            $scope.selectNav=3;
            $scope.keyword='';
           // $scope.hotelList=[];
            hotelListService.getAllHotel()
                .then(function(response){
                    $scope.hotelList=response.data.data;
                    //console.log($scope.hotelList);
                    $scope.data = response.data.data;
                    //分页总数
                    $scope.pageSize = 10;
                    $scope.pages = Math.ceil($scope.data.length / $scope.pageSize); //分页数
                    $scope.newPages = $scope.pages > 5 ? 5 : $scope.pages;
                    $scope.pageList = [];
                    $scope.selPage = 1;
                    //设置表格数据源(分页)
                    $scope.setData = function () {
                        $scope.items = $scope.data.slice(($scope.pageSize * ($scope.selPage - 1)), ($scope.selPage * $scope.pageSize));//通过当前页数筛选出表格当前显示数据
                    }
                    $scope.items = $scope.data.slice(0, $scope.pageSize);
                    //分页要repeat的数组
                    for (var i = 0; i < $scope.newPages; i++) {
                        $scope.pageList.push(i + 1);
                    }
                    //打印当前选中页索引
                    $scope.selectPage = function (page) {
                        //不能小于1大于最大
                        if (page < 1 || page > $scope.pages) return;
                        //最多显示分页数5
                        if (page > 2) {
                            //因为只显示5个页数，大于2页开始分页转换
                            var newpageList = [];
                            for (var i = (page - 3) ; i < ((page + 2) > $scope.pages ? $scope.pages : (page + 2)) ; i++) {
                                newpageList.push(i + 1);
                            }
                            $scope.pageList = newpageList;
                        }
                        $scope.selPage = page;
                        $scope.setData();
                        $scope.isActivePage(page);
                        console.log("选择的页：" + page);
                    };
                    //设置当前选中页样式
                    $scope.isActivePage = function (page) {
                        return $scope.selPage == page;
                    };
                    //上一页
                    $scope.Previous = function () {
                        $scope.selectPage($scope.selPage - 1);
                    }
                    //下一页
                    $scope.Next = function () {
                        $scope.selectPage($scope.selPage + 1);
                    };
            });
            //点击查看详情
            $scope.btnHotelDetail= function(hotelId){
                $state.go('hotelDetail',{id:hotelId});
            }
            //点击添加酒店按钮
            $scope.btnAddHotel= function(){
                $state.go('addHotel');
            }
            //点击编辑酒店
            $scope.btnHotelEdit=function(hotelId){
                $state.go('editHotel',{id:hotelId});
            }
        })
        .controller('hotelDetailController',function($scope,hotelListService,$stateParams,$window){
            $scope.selectNav=3;
            $scope.singleHotel=[];
            hotelListService.getHotelDetail($stateParams.id)
                .then(function(response){
                    console.log($stateParams.id);
                    $scope.singleHotel=response.data.data;
                    console.log(response.data.data);
                });
            //点击返回
            $scope.goBack=function(){
                $window.history.back();
            }

        })
        .controller('addHotelController',function($scope,hotelListService,$stateParams,areaService,$state,$window){
            $scope.selectNav=3;
            //得到所有的区域
            areaService.getAllArea().then(function(response){
                $scope.areaList=response.data.data;
               // console.log( $scope.areaList);
            });
            //点击添加区域
            $scope.diastate=0;
            $scope.btnAddArea=function(){
                $scope.diastate=1;
            }
            //房间价格的参数
            $scope.roomPrice={
                areaId:'',
                romeTypeId:'',
                price:''
            }
            //得到所有的房间类型
            $scope.selectinit='';
            $scope.roomTypeList=[];
            hotelListService.getAllRoomType().then(function(response){
                if(response.data.code==100){
                    $scope.roomTypeList=response.data.data;
                    console.log($scope.roomTypeList);
                    $scope.roomPrice.roomTypeId=$scope.roomTypeList[0];
                }

            });
            $scope.hotel={
                area:'',
                name:'',
                address:'',
                logo:null,
                image:[],
                areaId:'',
                roomTypeId:'',
                price:''
            }
            //点击得到所选的地方
            $scope.selectArea=function(area){
                console.log(area);
                //console.log(area.name);
                $scope.diastate=0;
                $scope.hotel.area=area.name;
                $scope.hotel.areaId=area.id;
                $scope.roomPrice.areaId=area.id;
                console.log($scope.hotel.areaId);
            }

            //点击保存新的酒店
            $scope.btnAddHotelSave=function(){
                $scope.hotel.logo=$('#fileUpload1')[0].files[0];
                $scope.hotel.image[0]=$('#fileUpload2')[0].files[0];
                $scope.hotel.image[1]=$('#fileUpload3')[0].files[0];
                $scope.hotel.image[2]=$('#fileUpload4')[0].files[0];
                $scope.hotel.roomTypeId=$scope.roomPrice.romeTypeId;
                $scope.hotel.price=$scope.roomPrice.price;
                //得到图片的值
                hotelListService.addHotel($scope.hotel,$scope.roomPrice)
                    .then(function(response){
                        if(response.data.code==100){
                            $state.go("hotel");
                        }
                });
            }
            //点击发布价格
            //$scope.btnPrice=function(){
            //    $scope.roomPrice.araeId=$scope.hotel.areaId;
            //    console.log($scope.roomPrice.areaId);
            //    console.log($scope.roomPrice.price);
            //    console.log($scope.roomPrice.romeTypeId.id);
            //    hotelListService.addRoomPrice($scope.roomPrice)
            //        .then(function(response){
            //            if(response.data.code==100){
            //                //发布价格成功，显示保存按钮
            //                $scope.saveHotelState=true;
            //            }
            //    });
            //
            //
            //
            //}
            //点击返回
            $scope.goBack=function(){
                $window.history.back();
            }
            //保存按钮隐藏
            $scope.saveHotelState=false;
            //文件改变时的一些判断和文件读取器（对分辨率的判断）
            var image1=document.querySelector('#imgone');
            var fileUpload1=document.querySelector('#fileUpload1');
            var image2=document.querySelector('#imgtwo');
            var fileUpload2=document.querySelector('#fileUpload2');
            var image3=document.querySelector('#imgthree');
            var fileUpload3=document.querySelector('#fileUpload3');
            var image4=document.querySelector('#imgfour');
            var fileUpload4=document.querySelector('#fileUpload4');
            fileUpload1.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image1.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload2.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image2.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload3.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image3.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload4.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image4.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }






        })
        .controller('editHotelController',function($scope,hotelListService,$stateParams,areaService,$state,$window){
            $scope.selectNav=3;
            //得到所有的区域
            areaService.getAllArea().then(function(response){
                $scope.areaList=response.data.data;
                // console.log( $scope.areaList);
            });
            //点击添加区域
            $scope.diastate=0;
            $scope.btnAddArea=function(){
                $scope.diastate=1;
            }
            //房间价格的参数
            $scope.roomPrice={
                areaId:'',
                romeTypeId:'',
                price:''
            }
            //得到所有的房间类型
            $scope.selectinit='';
            $scope.roomTypeList=[];
            hotelListService.getAllRoomType().then(function(response){
                if(response.data.code==100){
                    $scope.roomTypeList=response.data.data;
                    console.log($scope.roomTypeList);
                    $scope.roomPrice.roomTypeId=$scope.roomTypeList[0];
                }
            });
            $scope.hotel={
                id:'',
                area:'',
                name:'',
                address:'',
                logo:null,
                image:[],
                areaId:'',
                roomTypeId:'',
                price:''
            }
            //得到单个酒店
            $scope.singleHotel=[];
            console.log($stateParams.id);
            hotelListService.getHotelDetail($stateParams.id)
                .then(function(response){
                    $scope.singleHotel=response.data.data;
                    console.log(response.data.data);
                    $scope.hotel.id= $stateParams.id;
                     $scope.hotel.name= $scope.singleHotel.name;
                     $scope.hotel.address= $scope.singleHotel.address;

                     $scope.hotel.logo= $scope.singleHotel.logo;
                     $scope.hotel.image= $scope.singleHotel.imageList;

                     $scope.hotel.areaId= $scope.singleHotel.areaId;
                });
            //编辑酒店
            $scope.btnEditHotelSave=function(){
                $scope.hotel.logo=$('#fileUpload1')[0].files[0];
                $scope.hotel.image[0]=$('#fileUpload2')[0].files[0];
                $scope.hotel.image[1]=$('#fileUpload3')[0].files[0];
                $scope.hotel.image[2]=$('#fileUpload4')[0].files[0];
                $scope.hotel.roomTypeId=$scope.roomPrice.romeTypeId;
                $scope.hotel.price=$scope.roomPrice.price;
                hotelListService.updateHotel($scope.hotel)
                    .then(function(response){
                        if(response.data.code==100){
                            console.log(response.data.data);
                            $state.go('hotel');
                        }

                });


            }
            //文件改变时的一些判断和文件读取器（对分辨率的判断）
            var image1=document.querySelector('#imgone');
            var fileUpload1=document.querySelector('#fileUpload1');
            var image2=document.querySelector('#imgtwo');
            var fileUpload2=document.querySelector('#fileUpload2');
            var image3=document.querySelector('#imgthree');
            var fileUpload3=document.querySelector('#fileUpload3');
            var image4=document.querySelector('#imgfour');
            var fileUpload4=document.querySelector('#fileUpload4');
            fileUpload1.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image1.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload2.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image2.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload3.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image3.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }
            fileUpload4.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image4.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }

            //点击得到所选的地方
            $scope.selectArea=function(area){
                console.log(area);
                //console.log(area.name);
                $scope.diastate=0;
                $scope.hotel.area=area.name;
                $scope.hotel.areaId=area.id;
                $scope.roomPrice.areaId=area.id;
                console.log($scope.hotel.areaId);
            }
            //点击返回
            $scope.goBack=function(){
                $window.history.back();
            }



        })
        .controller('routeController',function($scope,routeService,$state,$window){
            $scope.selectNav=4;
            //加载所有线路
            routeService.getAllRoutes()
                .then(function(response){
                    if(response.data.code==100){
                        console.log(response.data.data);
                        $scope.routeList=response.data.data;
                        $scope.data = response.data.data;
                        //分页总数
                        $scope.pageSize =5;
                        $scope.pages = Math.ceil($scope.data.length / $scope.pageSize); //分页数
                        $scope.newPages = $scope.pages > 5 ? 5 : $scope.pages;
                        $scope.pageList = [];
                        $scope.selPage = 1;
                        //设置表格数据源(分页)
                        $scope.setData = function () {
                            $scope.items = $scope.data.slice(($scope.pageSize * ($scope.selPage - 1)), ($scope.selPage * $scope.pageSize));//通过当前页数筛选出表格当前显示数据
                        }
                        $scope.items = $scope.data.slice(0, $scope.pageSize);
                        //分页要repeat的数组
                        for (var i = 0; i < $scope.newPages; i++) {
                            $scope.pageList.push(i + 1);
                        }
                        //打印当前选中页索引
                        $scope.selectPage = function (page) {
                            //不能小于1大于最大
                            if (page < 1 || page > $scope.pages) return;
                            //最多显示分页数5
                            if (page > 2) {
                                //因为只显示5个页数，大于2页开始分页转换
                                var newpageList = [];
                                for (var i = (page - 3) ; i < ((page + 2) > $scope.pages ? $scope.pages : (page + 2)) ; i++) {
                                    newpageList.push(i + 1);
                                }
                                $scope.pageList = newpageList;
                            }
                            $scope.selPage = page;
                            $scope.setData();
                            $scope.isActivePage(page);
                            console.log("选择的页：" + page);
                        };
                        //设置当前选中页样式
                        $scope.isActivePage = function (page) {
                            return $scope.selPage == page;
                        };
                        //上一页
                        $scope.Previous = function () {
                            $scope.selectPage($scope.selPage - 1);
                        }
                        //下一页
                        $scope.Next = function () {
                            $scope.selectPage($scope.selPage + 1);
                        };
                    }
                });
            //点击添加路线
            $scope.btnAddRoute=function(){
                $state.go('addRoute');
            }
            //点击发布行程
            $scope.btnPlans=function(routeId,name,provinceId){
                $state.go('plan',{id:routeId,name:name,provinceId:provinceId});
            }
        })
        .controller('planController',function($scope,sceneryListService,routeService,$state,$window,$stateParams){
            $scope.selectNav=4;
            $scope.routeName='';
            $scope.routeName=$stateParams.name;
            console.log($stateParams.id);
            console.log($stateParams.name);
            console.log($stateParams.provinceId);
            $scope.planList=[];
            $scope.sceneryDetail=[];

            //根据routeid得到所有的行程
            routeService.getAllPlan($stateParams.id)
                .then(function(response){
                    if(response.data.code=100){
                        $scope.planList=response.data.data;
                        console.log($scope.planList);
                    }

            });
            $scope.isShows=false;
            $scope.btnCancelPlan=function(){
                $scope.isShows=false;
            }
            $scope.btnAddPlan= function(){
                $scope.isShows=true;
            }
            $scope.isShowAddPlanScenery=false;
            $scope.plan={
                id:'',
                name:'',
                priority:'',
                routeId:'',
                provinceId:''
            }
            $scope.plan.routeId=$stateParams.id;
            $scope.plan.provinceId=$stateParams.provinceId;
            //点击保存的行程
            $scope.addSavePlan=function(){
                routeService.insertPlan($scope.plan)
                    .then(function(response){
                        if(response.data.code==100){
                           // console.log(response.data.data);
                            $scope.isShows=false;
                        }
                });
            }
            $scope.provinceScenery=[];
            //点击行程下的添加景点
            $scope.btnAddPlanScenery=function(planId){
                $scope.plan.id=planId;
                $scope.isShowAddPlanScenery=true;
                routeService.getAllProvinceIdScenery($scope.plan.provinceId)
                    .then(function(response){
                        if(response.data.code==100){
                            $scope.provinceScenery=response.data.data;
                            console.log($scope.provinceScenery);
                        }
                });
                //插入新的行程
                $scope.addSavePlan=function(planId){
                    console.log(planId);
                }
            }
            //点击取消
            $scope.btnCancelPlanScenery=function(){
                $scope.isShowAddPlanScenery=false;
            }
            $scope.isClick=false;
            $scope.planScenery={
                planId:'',
                sceneryId:'',
                time:''
            }
            //点击选择图片
            $scope.selectImage=function(item){
                item.isClick=!item.isClick;
                $scope.planScenery.planId=$scope.plan.id;
                $scope.planScenery.sceneryId=item.id;
                console.log($scope.planScenery.planId);
                console.log($scope.planScenery.sceneryId);
            }
            //点击保存新的线路下的景点
            $scope.addSavePlanScenery=function(){
                routeService.insertPlanScenery($scope.planScenery)
                    .then(function(response){
                        if(response.data.code==100){
                            $scope.isShowAddPlanScenery=false;
                            alert('添加景点成功！');
                            $state.go('route');
                        }
                });
            }
            //点击删除行程下的安排
            $scope.btnDeletePlanScenery=function(sceneryId,planId){
                console.log(sceneryId);
                console.log(planId);
                routeService.detelePlanScenery(sceneryId,planId)
                    .then(function(response){
                        if(response.data.code==100){
                            alert("删除成功！");
                            $state.go('route');
                            //console.log(sceneryId);
                            //console.log(planId);
                        }
                    });
            }
        })
        .controller('addRouteController',function($scope,routeService,$state,$window){
            $scope.selectNav=4;
            $scope.route={
                provinceId:'',
                province:'',
                name:'',
                image:''
            }
            //得到所有的区域
            routeService.getAllProvince().then(function(response){
                $scope.provinceList=response.data.data;
                console.log($scope.provinceList);
            });
            //点击添加区域
            $scope.diastate=0;
            $scope.btnAddArea=function(){
                $scope.diastate=1;
            }
            //返回上一级
            $scope.goBack=function(){
                $window.history.back();
            }
            //点击得到所选的地方
            $scope.selectArea=function(province){
                console.log(province);
                console.log(province.name);
                $scope.diastate=0;
                $scope.route.province=province.name;
                $scope.route.provinceId=province.id;
                console.log($scope.route.id);
            }
            //点击保存新线路
            $scope.btnAddRoute=function(route){
                $scope.route.image=$('#fileUpload1')[0].files[0];
                routeService.insertRoute(route)
                    .then(function(response){
                        if(response.data.code==100){
                            console.log(response.data.data);
                            $state.go('route');
                        }
                });

            }
            var image1=document.querySelector('#imgone');
            var fileUpload1=document.querySelector('#fileUpload1');
            fileUpload1.onchange=function(e){
                //对上传文件的格式的一些判断
                var self=this;
                if(self.value.length>0)
                {
                    var file=self.files[0];
                    var fileReader=new FileReader();
                    fileReader.onload=function(e)
                    {
                        var tempImg=new Image();
                        //base 64位图片编号格式
                        tempImg.src=this.result
                        tempImg.onload=function(e)
                        {
                            image1.src=tempImg.src;
                        }
                    }
                    //文件为图片，判断之后，要读取该图片。
                    fileReader.readAsDataURL(file);
                }
            }



        })
        .controller('orderController',function($scope,$stateParams,orderService){
            $scope.selectNav=5;
            $scope.userOrder=[];
            console.log($stateParams.id);
            orderService.getOrderByUserId($stateParams.id)
                .then(function(response){
                    console.log(response.data.data);
                    $scope.userOrder=response.data.data;
                });
        })
        .controller('viewpointController',function($scope,userService){
            $scope.selectNav=6;
            $scope.isState1=true;
            $scope.isState2=false;
            $scope.isStateCheck=function(){
                $scope.isState1=true;
                $scope.isState2=false;
            }
            $scope.StateCheckIs=function(){
                $scope.isState1=false;
                $scope.isState2=true;
            }
            //得到所有的评论
            $scope.viewPointList=[];
            userService.getAllViewPoint()
                .then(function(response){
                    if(response.data.code=100){
                        $scope.viewPointList=response.data.data;
                        console.log($scope.viewPointList);
                    }
            });
            //点击审核
            $scope.btnCheck=function(item){
                userService.updateViewState(item)
                    .then(function(response){
                        if(response.data.code==100){
                            alert("审核通过！")
                            $scope.isState1=false;
                            $scope.isState2=true;
                        }

                });
            }


        });
})();