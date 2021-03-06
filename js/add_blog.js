/**
 * Created by chenxiaolei on 2016/5/2.
 */
$(document).ready(function(){
    var editor = new Simditor({
        textarea: $('#editor'),
        placeholder: '请输入内容',
        defaultImage: 'images/image.png',
        params: {},
        upload:
        {
            url : 'ImgUpload.action', //文件上传的接口地址
            params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
            fileKey: 'fileDataFileName', //服务器端获取文件数据的参数名
            connectionCount: 3,
            leaveConfirm: '正在上传文件'

            //返回内容
            // {
            //     "success": true/false,
            //     "msg": "上传失败信息", # 可选
            //     "file_path": "[real file path]"
            // }
        },
        tabIndent: true,
        toolbar: true,
        toolbarFloat: true,
        toolbarFloatOffset: 0,
        toolbarHidden: false,
        pasteImage: true,
        cleanPaste: false
    });
    $('#blogSubmit').click(function () {
        // var username = $('#username').val();
        var user_id = $('#user_id').val();
        var title = $('#title').val();
        var context = editor.getValue();
        // alert(context);
        $.ajax({
            url: "../run/add_blog_run.php",
            data: {
                // username: username,
                title: title,
                context: context,
                user_id: user_id
            },
            type : "POST",
            success : function(result) {
                console.log(result);
                result = JSON.parse(result);
                console.log(result.state);
                // alert(result.state);
                if (result.state == true) {
                    alert('发表成功');
                    window.location.reload();
                }
                else {
                    alert('发表失败');
                }
            }
        });
    });
});