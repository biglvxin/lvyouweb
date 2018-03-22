(function($){
    var $userName=$('#username');
    var $txtPwd=$('#password');
    //用户名检查
    jQuery.validator.addMethod('userNameIsValid',function(value,element,parames){
        var phoneReg=/^1[34578]\d{9}$/;
        return phoneReg.test(value);
    });
    //密码检查
    jQuery.validator.addMethod('userPwdIsValid',function(value,element,parames){
        var pwd=/^\w{4,12}$/;
        return pwd.test(value);
    });
    //提交之前用这个方式设置一下提交方式
    // $.validator.setDefaults({
    //     submitHandler:function(form){
    //     //提交事件
    //     var phone = $('#username').val();
    //     var password=$('#password').val();
    //      $.ajax({
    //         url:'http://127.0.0.1:9098/lvyouwebpc/ajax/login.php',
    //         type:'post',
    //         dataType:'json',
    //         data:{
    //             phone:phone,
    //             password:password
    //         },
    //         success:function(response){
    //             console.log(response);
    //             if(response.code==100){
    //                //location.href="http://127.0.0.1:9098/lvyouwebpc/index.php";

    //             }
    //         }
    //     });
       
    //     }
    // });



    //提交验证
    $('#frm').validate({
        rules:{
            username:{
                required:true,
                userNameIsValid:true
            },
            password:{
                required:true,
                userPwdIsValid:true
            },
            nickname:{
                required:true
            },
            code:{
                   required:true
            }

        },
        messages:{
            username:{
                required:'电话号码不能为空',
                userNameIsValid:'格式必须为1[34578]开头的11位数字！'
            },
            password:{
                required:'密码不能为空',
                userPwdIsValid:'密码必须4-6位！'
            },
            nickname:{
                required:'昵称不能为空'
            },
            code:{
                  required:'验证码不能为空'
            }
        }
    });
    //点击返回上一页
    $('#backurl').bind('click',function(e){
        history.go(-1);
    });
   
     
   

  
})(jQuery);