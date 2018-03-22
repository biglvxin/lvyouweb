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
    $.validator.setDefaults({
        submitHandler:function(form){
            console.log(form);
            //提交事件
            // var phone = $('#username').val();
            // var password=$('#password').val();
            // var nickName=$('#nickname').val();
            // var code=$('#code').val();
            // var image=$('#fileUpload')[0].files[0];
            // var formData = new FormData();
            // formData.append('phone',phone);
            // formData.append('password',password);
            // formData.append('nickName',nickName);
            // formData.append('code',code);
            // formData.append('image',image);
            var formData = new FormData(form);
            $.ajax({
                url:'http://127.0.0.1:9090/lvyouwebpc/ajax/validateCode.php',
                type:'post',
                dataType:'json',
                data:formData,
                processData: false,
                contentType: false,
                success:function(response){
                    console.log(response);
                    if(response.code==100){
                        location.href="login.php";
                    }
                }
            });


        }
    });


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
    var duration = 10;
    var phone = $('#username').val();
    var code=$('#code').val();
    $('#sendCode').bind('click',function(e){
        console.log($(this));
            var self = $(this)[0];
            self.disabled = true;

            var timer = window.setInterval(function(){
                duration--;

                if(duration == 0){
                    duration = 10;
                    self.disabled = false;
                    self.innerText = '重新发送验证码';
                    clearInterval(timer);
                }
                else{
                    self.innerText = duration + '秒';
                }

            }, 1000);
                var phone = $('#username').val();
                var code=$('#code').val();
                $.get('ajax/sendCode.php?phone='+phone , function(response){
                    if(response.code == 100){
                        self.innerText = '发送成功';
                        $('#reg-info').innerText='验证码发送成功';
                    }
                });
    });
    //点击文件上传
    var image=document.querySelector('#image');
    var btnBower=document.querySelector('#btnBower');
    var fileUpload=document.querySelector('#fileUpload');
    btnBower.onclick=function(e){
        fileUpload.click();
    }

    fileUpload.onchange=function(e){
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
                        image.src=tempImg.src;
                    }
                }
                //文件为图片，判断之后，要读取该图片。
                fileReader.readAsDataURL(file);
            }
        }

})(jQuery);