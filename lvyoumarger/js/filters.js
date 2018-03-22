/**
 * Created by Administrator on 2018/3/12.
 */
(function(){
    angular.module('app.filters',[])
    .filter('searchFilter',function(){
        //第一个参数，都是filter自带的要过滤的数据源
        return function(list,keyword){
            //console.log(list);
            //有关键字大于0不包括首字母
            if(keyword.length>0){
                return list.filter(function(item){
                    return item.name.toLowerCase().indexOf(keyword.toLowerCase())>=0;
                });
            }

            //没有条件，返回所有的数据源
            return list;
        }
    });
})()