<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:41:"./template/mobile/new2/user\password.html";i:1503927244;s:41:"./template/mobile/new2/public\header.html";i:1503927242;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>修改密码--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <link rel="stylesheet" href="__STATIC__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <!--<script src="__STATIC__/js/zepto-1.2.0-min.js" type="text/javascript" charset="utf-8"></script>-->
    <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__STATIC__/js/layer.js"  type="text/javascript" ></script>
    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body class="[body]">

    <div class="classreturn loginsignup">
        <div class="content">
            <div class="ds-in-bl return">
                <a href="javascript:history.back(-1);"><img src="__STATIC__/images/return.png" alt="返回"></a>
            </div>
            <div class="ds-in-bl search center">
                <?php if(!(empty($has_password) || (($has_password instanceof \think\Collection || $has_password instanceof \think\Paginator ) && $has_password->isEmpty()))): ?>
                    <span>修改密码</span>
                <?php else: ?>
                    <span>设置密码</span>
                <?php endif; ?>
            </div>
            <!--<div class="ds-in-bl menu">
                <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a>
            </div>-->
        </div>
    </div>
    <div class="loginsingup-input ma-to-20">
        <form action="" method="post" id="pwdForm">
            <div class="content30">
                <?php if(!(empty($has_password) || (($has_password instanceof \think\Collection || $has_password instanceof \think\Paginator ) && $has_password->isEmpty()))): ?>
                <div class="lsu">
                    <span>旧密码</span>
                    <input type="password" name="old_password" id="old_password" value=""  placeholder="旧密码">
                </div>
                <?php endif; ?>
                <div class="lsu">
                    <span>新密码</span>
                    <input type="password" name="new_password" id="new_password" value=""  placeholder="新密码">
                </div>
                <div class="lsu">
                    <span>确认密码</span>
                    <input type="password" name="confirm_password" id="confirm_password" value=""  placeholder="再次输入新密码">
                </div>

                <div class="lsu submit">
                    <input type="button" onclick="submitverify()" id="sub" value="确认修改">
                </div>
            </div>
        </form>
    </div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    //验证表单
    function submitverify(){
        var oldpass = $.trim($('#old_password').val());
        var newpass = $.trim($('#new_password').val());
        var confirmpass = $.trim($('#confirm_password').val());
        if(oldpass == '' || newpass =='' ||  confirmpass == ''){
            layer.open({content:'密码不能为空',time:3});
            return false;
        }
        if(newpass !== confirmpass){
            layer.open({content:'两次密码不一致',time:3});
            return false;
        }
        if(newpass.length < 6 || confirmpass.length < 6){
            layer.open({content:'密码长度不能少于6位',time:3});
            return false;
        }
        $.ajax({
            url : "/index.php?m=Mobile&c=User&a=password",
            type:'post',
            dataType:'json',
            data:$('#pwdForm').serialize(),
            success:function(data){
                if(data.status==1){
                    //成功
                    showErrorMsg(data.msg);
                    window.location.href=data.url;
                }else{
                    //失败
                    showErrorMsg(data.msg);
                }
            },
            error:function(){
                showErrorMsg('网络异常，请稍后再试')
            }
        })
    }
    /**
     * 提示弹窗
     * */
    function showErrorMsg(msg){
        layer.open({content:msg,time:2});
    }
</script>
	</body>
</html>
