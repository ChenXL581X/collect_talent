/**
 * Created by chenxiaolei on 2016/4/25.
 */
$.validator.setDefaults({
    submitHandler: function() {
        alert("提交事件!");
    }
});
$().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
    $("#register").validate({
        submitHandler:function(form){
            alert("提交!");
            form.submit();
        },
        rules: {
            username: {
                required: true,
                minlength: 2
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "请输入用户名",
                minlength: "用户名必需由两个字母组成"
            },
            password: {
                required: "请输入密码",
                minlength: "密码长度不能小于 5 个字母"
            },
            confirm: {
                required: "请输入密码",
                minlength: "密码长度不能小于 5 个字母",
                equalTo: "两次密码输入不一致"
            }
        }
    });
});