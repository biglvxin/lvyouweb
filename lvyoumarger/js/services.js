/**
 * Created by Administrator on 2018/3/12.
 */
(function(){
    angular.module('app.services',[])
        .constant('ROOT_URL','http://127.0.0.1:9090/lvyouwebpc/ajax/')
        //栏目的服务

        .service('sceneryListService',function($http,ROOT_URL){
            //得到所有的景点
            this.getAllScenery=function(){
                return $http.get(ROOT_URL+'singleSceneryDetailList.php');
            };
            //得到单个景点的详情
            this.getSingleScenery=function(sceneryId){
                return $http.get(ROOT_URL+'singleSceneryDetailList.php',{params:{id:sceneryId}});
            }
            //删除指定的景点
            this.deteleSingleScenery=function(sceneryId){
                return $http.get(ROOT_URL+'deteleScenery.php',{params:{sceneryId:sceneryId}});

            }
            //编辑景点
            this.editScenery= function($sceneryId){
                return $http({
                    url:ROOT_URL+'editScenery.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:$sceneryId,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('sceneryId',data.sceneryId);
                        formData.append('area',data.area);
                        formData.append('introduceTitle',data.introduceTitle);
                        formData.append('sceneryName',data.sceneryName);
                        formData.append('address',data.address);
                        formData.append('httpAddress',data.httpAddress);
                        formData.append('transfer',data.transfer);
                        formData.append('price',data.price);
                        formData.append('open',data.open);
                        formData.append('introduceDetail',data.introduceDetail);
                        formData.append('image1',data.image[0]);
                        formData.append('image2',data.image[1]);
                        formData.append('image3',data.image[2]);
                        return formData;
                    }
                });
            }
            //添加景点
            this.addSceneryInfo=function(scenery){
                return $http({
                    url:ROOT_URL+'createScenery.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:scenery,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('area',data.area);
                        formData.append('introduceTitle',data.introduceTitle);
                        formData.append('sceneryName',data.sceneryName);
                        formData.append('address',data.address);
                        formData.append('httpAddress',data.httpAddress);
                        formData.append('transfer',data.transfer);
                        formData.append('price',data.price);
                        formData.append('open',data.open);
                        formData.append('introduceDetail',data.introduceDetail);
                        formData.append('image1',data.image[0]);
                        formData.append('image2',data.image[1]);
                        formData.append('image3',data.image[2]);
                        return formData;
                    }
                });
            }
        })
        .service('hotelListService',function($http,ROOT_URL){
            //得到所有的酒店
            this.getAllHotel=function(){
                return $http.get(ROOT_URL+'hotelList.php');
            }
            //得到单个酒店
            this.getHotelDetail=function(hotelId){
                return $http.get(ROOT_URL+'hotelDetailList.php',{params:{hotelId:hotelId}});
            };
            //得到所有酒店的房间类型
            this.getAllRoomType=function(){
                return $http.get(ROOT_URL+'roomTypeList.php');
            }
            //增加新的酒店
            this.addHotel=function(hotel){
                console.log(hotel);
                return $http({
                    url:ROOT_URL+'createHotel.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:hotel,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('name',data.name);
                        formData.append('areaId',data.areaId);
                        formData.append('address',data.address);
                        formData.append('logo',data.logo);
                        formData.append('image2',data.image[0]);
                        formData.append('image3',data.image[1]);
                        formData.append('image4',data.image[2]);

                        formData.append('price',data.price);
                        formData.append('roomTypeId',data.roomTypeId.id);

                        return formData;
                    }



                });
            }
            //编辑酒店信息
            this.updateHotel=function(hotel){
                console.log(hotel);
                return $http({
                    url:ROOT_URL+'editHotel.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:hotel,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('id',data.id);
                        formData.append('name',data.name);
                        formData.append('areaId',data.areaId);
                        formData.append('address',data.address);
                        formData.append('logo',data.logo);
                        formData.append('image2',data.image[0]);
                        formData.append('image3',data.image[1]);
                        formData.append('image4',data.image[2]);
                        return formData;
                    }



                });

            }


        })
        .service('routeService',function($http,ROOT_URL){
            //得到所有路线
            this.getAllRoutes=function(){
                return $http.get(ROOT_URL+'routeList.php');
            }
            //得到所有省份
            this.getAllProvince=function(){
                return $http.get(ROOT_URL+'provinceList.php')
            }
            //添加新的线路
            this.insertRoute=function(route){
                console.log(route);
                return $http({
                    url:ROOT_URL+'createRoute.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:route,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('name',data.name);
                        formData.append('provinceId',data.provinceId);
                        formData.append('image1',data.image);
                        return formData;
                    }
                });
            }
            //得到所有的行程安排
            this.getAllPlan=function(routeid){
                //console.log(routeid);
                return $http.get(ROOT_URL+'planByRouteIdList.php',{params:{routeId:routeid}});
            }
            //添加新的安排
            this.insertPlan=function(plan){
                console.log(plan);
                return $http({
                    url:ROOT_URL+'createPlanList.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:plan,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('name',data.name);
                        formData.append('priority',data.priority);
                        formData.append('routeId',data.routeId);
                        return formData;
                    }
                });
            }
            //每个线路省份下的所有景点
            this.getAllProvinceIdScenery=function(provinceId){
                return $http.get(ROOT_URL+'getSceneryByProvinceIdList.php',{params:{provinceId:provinceId}});
            }
            //增加新的线路景点
            this.insertPlanScenery=function(planScenery){
                console.log(planScenery);
                return $http({
                    url:ROOT_URL+'createPlanScenery.php',
                    method:'post',
                    headers:{
                        'Content-Type': undefined
                    },
                    data:planScenery,
                    //以自己的方式传数据
                    transformRequest: function(data){
                        var formData = new FormData();
                        formData.append('planId',data.planId);
                        formData.append('sceneryId',data.sceneryId);
                        formData.append('time',data.time);
                        return formData;
                    }
                });
            }
            //删除线路景点
            this.detelePlanScenery=function(sceneryId,planId){
                return $http.get(ROOT_URL+'deleteScenery.php',
                    {params:
                    {
                        sceneryId:sceneryId,
                        planId:planId}
                    });
            }

        })
        .service('userService',function($http,ROOT_URL){
            //得到所有用户的信息
            this.getAllUser=function(){
                return $http.get(ROOT_URL+'userList.php');
            }
            //得到所有的评论
            this.getAllViewPoint=function(){
                return $http.get(ROOT_URL+'viewPointList.php');
            }
            //修改评论的状态
            this.updateViewState= function(viewPoint){
                return $http.get(ROOT_URL+'updateState.php',{params:{id:viewPoint.id}});

            }

        })
        .service('areaService',function($http,ROOT_URL){
            //得到所有区域名称
            this.getAllArea=function(){
                return $http.get(ROOT_URL+'areaList.php');
            }
        })
        .service('orderService',function($http,ROOT_URL){
            //得到用户的所有订单
            this.getOrderByUserId=function(userId){
                return $http.get(ROOT_URL+'orderList.php',{
                    params:{
                        userId:userId
                    }
                });

            };


        });
})();