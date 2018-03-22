/**
 * Created by Administrator on 2018/3/12.
 */
(function(){
    angular.module('app.directives',[])
        .directive('navDirective',function(){
            return{
                restrict:'ECMA',
                replace:true,
                templateUrl:'template/pageNav.html',
                scope:{
                    selectNav:'@'
                }
            };
        });
})();