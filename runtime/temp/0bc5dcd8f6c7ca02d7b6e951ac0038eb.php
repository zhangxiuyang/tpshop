<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:38:"./template/mobile/new2/user\login.html";i:1511417417;s:41:"./template/mobile/new2/public\header.html";i:1503927242;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>登录--<?php echo $tpshop_config['shop_info_store_title']; ?></title>
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
<body class="">

<style>
    body{padding-top: 40%;
        background: url(__STATIC__/images/bg.jpg) no-repeat;
        background-size: contain;}
    .bgWhite{background-color: white;}
    #YZMbtn{border-left: #494a52 solid 1px;padding: 0 .6rem;}
    #password{width: 100%;}
    .xieyi p{    height: 1.83467rem;
        border: 0;
        outline: none;
        padding: 0 .21333rem; line-height:  1.83467rem; font-size: 0.5rem;
        color: #777777;}
    .xieyi p a{ padding-left: .4rem; color: #0092ce; }
    ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        color: #7f7f7f;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        color:    #7f7f7f;
        opacity:  1;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        color:    #7f7f7f;
        opacity:  1;
    }
    :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color:    #7f7f7f;
    }
    .thirdlogin{padding-top: .8rem; margin-top: 0.5rem;}
</style>
<div style="position: absolute;
    top: 1rem;
    width: 60%;
    padding: 1rem;
    font-size: 0.6rem;
    line-height: 2;
    color: #888;">
    <p>测试账号：15145113419</p>
    <p>测试验证码：123456</p>
</div>
<div class="loginsingup-input">
<!--登录表单-s-->
    <form  id="loginform" method="post"  >
        <input type="hidden" name="referurl" id="referurl" value="<?php echo $referurl; ?>">
        <div class="content30">
            <div class="lsu bgWhite">
                <input type="text" name="username" id="username" value="15145113419"  placeholder="请输入手机号"/>
                <span id="YZMbtn" onclick="showYZM()">发送验证码</span>

            </div>
            <div class="lsu bgWhite">
                <input type="text" name="password" id="password" value="" placeholder="请输入验证码"/>
            </div>
            <div class="lsu bgWhite xieyi">
                <p>点击登陆，即表示您同意<a>用户协议</a></p>
            </div>
            <?php if(!(empty($first_login) || (($first_login instanceof \think\Collection || $first_login instanceof \think\Paginator ) && $first_login->isEmpty()))): ?>
            <div class="lsu test">
                <span>请输入验证码</span>
                <input type="text" name="verify_code" id="verify_code" value="" placeholder="请输入验证码"/>
                <img  id="verify_code_img" src="<?php echo U('Mobile/User/verify'); ?>" onClick="verify()"/>
            </div>
            <?php endif; ?>
            <div class="lsu submit">
                <input type="button"  value="提交"  onclick="submitverify()" class="btn_big1"  />
            </div>
            <div class="radio">
            </div>
            <div class="signup-find p">
                <div class="note fl">
                    <img src="__STATIC__/images/not.png"/>
                    <a href="<?php echo U('User/reg'); ?>"><span>快速注册</span></a>
                </div>
                <!--<div class="note fr">
                    <img src="__STATIC__/images/ru.png"/>
                    <a href="<?php echo U('User/forget_pwd'); ?>"><span>找回密码</span>
                </div>-->
            </div>
        </div>
    </form>
<!--登录表单-e-->
</div>

<!--第三方登陆-s-->
<div class="thirdlogin bgWhite">
        <h4>第三方登陆</h4>
        <ul>
<?php
                                   
                                $md5_key = md5("select * from __PREFIX__plugin where type='login' AND status = 1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__plugin where type='login' AND status = 1"); 
                                    S("sql_".$md5_key,$sql_result_v,86400);
                                }    
                              foreach($sql_result_v as $k=>$v): if($v['code'] == 'weixin' AND is_weixin() != 1): ?>
        <li>
            <a class="ta-weixin" href="javascript:showErrorMsg('等待接入')" target="_blank" title="weixin">
                <div class="icon">
                    <img src="__STATIC__/images/wechat.png"/>
                    <p>微信登陆</p>
                </div>
            <!--</a>-->
        </li>
    <?php endif; if($v['code'] == 'alipay' AND is_alipay() != 1): ?>
        <li>
            <a href="javascript:showErrorMsg('等待接入')">
                <div class="icon">
                    <img src="__STATIC__/images/alpay.png"/>
                    <p>支付宝</p>
                </div>
            </a>
        </li>
    <?php endif; if($v['code'] == 'qq' AND is_qq() != 1): ?>
        <li>
            <a class="ta-qq" onclick="showErrorMsg('等待接入')" target="_blank" title="QQ">
                <div class="icon">
                    <img src="__STATIC__/images/qq.png"/>
                    <p>qq登陆</p>
                </div>
            </a>
        </li>
    <?php endif; endforeach; ?>
        </ul>		
</div>

<!--第三方登陆-e-->

<script type="text/javascript">
    function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Mobile&c=User&a=verify&r='+Math.random());
    }
    //虚拟发送验证码
    function showYZM() {
        showErrorMsg('验证码：123456');
        $('#password').val('123456');
    }


    //复选框状态
    function remember(obj){
         var che= $(obj).attr("class");
        if(che == 'che check_t'){
            $("#autologin").prop('checked',false);
        }else{
            $("#autologin").prop('checked',true);
        }
    }
    function submitverify()
    {
        var username = $.trim($('#username').val());
        var password = $.trim($('#password').val());
        var remember = $('#remember').val();
        var referurl = $('#referurl').val();
        var verify_code = $.trim($('#verify_code').val());
        if(username == ''){
            showErrorMsg('手机号不能为空!');
            return false;
        }
        if(!checkMobile(username)){
            showErrorMsg('手机号格式不匹配!');
            return false;
        }
        if(password == ''){
            showErrorMsg('验证码不能为空!');
            return false;
        }

        var codeExist = $('#verify_code').length;
        if (codeExist && verify_code == ''){
            showErrorMsg('验证码不能为空!');
            return false;
        }

        var data = {username:username,password:password,referurl:referurl};
        if (codeExist) {
            data.verify_code = verify_code;
        }
        $.ajax({
            type : 'post',
            url : '/index.php?m=Mobile&c=User&a=do_login&t='+Math.random(),
            data : data,
            dataType : 'json',
            success : function(data){
                if(data.status == 1){
                    var url = data.url.toLowerCase();
                    if (url.indexOf('user') !=  false && url.indexOf('login') != false || url == '') {
                        window.location.href = '/index.php/mobile';
                    }else{
                        window.location.href = data.url;
                    }
                }else{
                    showErrorMsg(data.msg);
                    if (codeExist) {
                        verify();
                    } else {
                        location.reload();
                    }
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                showErrorMsg('网络异常，请稍后重试');
            }
        })
    }
        //切换密码框的状态
        $(function(){
            $('.loginsingup-input .lsu i').click(function(){
                $(this).toggleClass('eye');
                if ($(this).hasClass('eye')) {
                    $(this).siblings('input').attr('type','text')
                } else{
                    $(this).siblings('input').attr('type','password')
                }
            });
        })
    </script>
</body>
</html>
