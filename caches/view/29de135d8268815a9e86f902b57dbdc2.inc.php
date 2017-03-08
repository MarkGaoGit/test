<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<link rel="stylesheet" href="<?php echo SKIN_PATH;?>statics/css/Back.css?v=<?php echo HD_VERSION;?>"/>
<link rel="stylesheet" href="<?php echo SKIN_PATH;?>statics/css/haidao.css?v=<?php echo HD_VERSION;?>"/>
<script type="text/javascript" src="template/default/statics/js/jquery.cookie.js?v=<?php echo HD_VERSION;?>"></script>
<div class="container back">
</div>

<div class="container back-box" style="height:400px;">
<div class="password-find back-cn backs choose-way text-default">
<div class="way-content clearfix">
<p class="text-default margin-big-bottom">请选择验证方式：</p>
<!--<label for="_email">-->
<!--<input id="_email" value="email" checked="checked" class="fl" name="verify-way" type="radio">-->
<!--<em class="fl margin-left">邮箱验证</em>-->
<!--</label>-->
            <label for="_question">
                <input id="_question" value="question" checked="checked" class="fl" name="verify-way" type="radio">
                <em class="fl margin-left">问题验证</em>
            </label>
<label for="_mobile">
<input id="_mobile" value="mobile" class="fl" name="verify-way" type="radio">
<em class="fl margin-left">短信验证</em>
</label>
</div>
<div id="btn-way" class="code-btn text-center text-white margin-big-top">
    		确认选择方式
        </div>
</div>
<!--邮箱验证-->
<div class="email-dom password-find">
<div class="back-cn text-default clearfix">
<div class="w20 text-right left fl" style="height:34px;line-height:34px;">邮箱：</div>
<div class="back-input fl">
<input class="input" type="text" name="email" placeholder="请输入邮箱" />
</div>
<div class="prompt text-dot"></div>

</div>
<div id="send_email" class="code-btn send-emails text-center text-white ">
发送电子邮件
</div>
</div>

<!--问题验证-->
    <div class="question-dom password-find" style="margin-top:200px;">
        <div class="back-cn text-default clearfix margin-large-bottom">
            <div class="w20 text-right left fl" style="height:34px;line-height:34px;">用户名：</div>
            <div class="back-input fl">
                <input class="input back-username" type="text" name="username" placeholder="请输入用户名" />
            </div>
            <div class="prompt text-dot"></div>
        </div>
        <div class="back-cn text-default clearfix margin-large-bottom">
            <div class="w20 text-right left fl" style="height:34px;line-height:34px;">验证问题：</div>
            <div class="back-input fl">
                <input class="input back-question" type="text" disabled name="back-question"  />
            </div>
            <div class="prompt text-dot"></div>
        </div>
        <div class="back-cn text-default clearfix margin-large-bottom">
            <div class="w20 text-right left fl" style="height:34px;line-height:34px;">问题答案：</div>
            <div class="back-input fl">
                <input class="input back-question-daan" type="text" name="back-question-daan" placeholder="请输入问题答案" />
            </div>
            <div class="prompt text-dot"></div>
        </div>
        <input type="hidden" class="uid">
        <input type="hidden" class="question-answer">
        <div id="check-question" class="code-btn send-emails text-center text-white ">
            验证问题答案
        </div>
    </div>
    <!--短信验证-->
    <div class="mobile-dom password-find">
    	<div class="back-cn text-default clearfix">
<div class="w10 text-right left fl">手机号码：</div>
<div class="back-input fl">
<input type="text" class="input" name="mobile" placeholder="请输入手机号码" />
</div>
<div class="prompt text-dot"></div>
</div>
        <div class="back-cn text-default margin-big-top clearfix">
            <div class="w10 text-right left fl">验证码：</div>
            <div class="code-input margin-small-left fl">
                <input class="input radius" disabled="disabled" name="vcode" id="vcode" type="text" />
            </div>
            <div id="send_sms" class="send bg-main margin-left text-center text-white">发送验证码</div>
            <div class="prompt text-dot"></div>
        </div>
        <div id="next_btn" class="code-btn mobile-btn text-center text-white margin-big-top">
            下一步
        </div>
    </div>
</div>

<?php include template('artels-footer','common');?>

<script>

var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; //邮箱验证
    var tel_filter = /^0?1[3|4|5|8][0-9]\d{8}$/;//手机验证
var $email=$("input[name='email']");
var $mobile=$("input[name='mobile']");
var $vcode=$("input[name='vcode']");
var ajax_status;
/*仿刷新：检测是否存在cookie*/
if($.cookie("vcode_pc")){
reget($.cookie("vcode_pc"));
}

//选择验证方式
$(".choose-way").show();
$("#btn-way").click(function(){
var $check_way=$("input[name='verify-way']:checked ");
if($check_way.val()=='mobile'){
$(".mobile-dom").show();
}else if($check_way.val()=='email'){
$(".email-dom").show();
}else if ($check_way.val()=='question'){
            $(".question-dom").show();
        }
$(".choose-way").hide();
});

$("input[type='text']").focus(function(){
$(this).parent().siblings('.prompt').html("");
$(this).attr("data-verify","");
});

//邮箱验证
$("input[name='email']").live("blur",function(){
var status=verify($(this));
if(status){
email_verify_exit($(this).val());
}
});
var ajax_email=true;
$("#send_email").click(function(){
var status=verify($(this));
if(status){
email_verify_exit($(this).val());
}
if(ajax_status){
var data={};
data.username=$email.val();
if(ajax_email){
verify_ajax(data);
}
}
});


/*验证输入*/
function verify(account){
var $account=account.attr("name");
var email_verify=email_filter.test(account.val());
var tel_verify=tel_filter.test(account.val());

if(account.val()==''){
account.parent().siblings('.prompt').html("请输入内容");
return false;
}
if(($account=="email" && email_verify) || ($account=="mobile" &&　tel_verify)){

account.attr("data-verify","true");
return true;

}else if($account=="email" && !email_verify){

account.parent().siblings('.prompt').html("请输入正确的邮箱！");
return false;

}else if($account=="mobile" && !tel_verify){

account.parent().siblings('.prompt').html("请输入正确的电话号码！");
return false;
}
}

function email_verify_exit(email){
$.post('<?php echo url("member/public/valid_email");?>',{email:email},function(data){
if(data.status==0){
ajax_status=true;
}else{
$email.parent().siblings('.prompt').html("该邮箱不存在或未注册");
ajax_status=false;
}
},'json');
}


    //短信验证
$("input[name='mobile']").live("blur",function(){
verify($(this));
});

$("#next_btn").click(function(){
if($mobile.data("verify")){
            var data={};
            data.username=$mobile.val();
            data.vcode=$('#vcode').val();
$.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo url("member/public/reset_password");?>',
                data:data,
                success: function (result) {
                    if(result.message == '验证码正确'){
                    	top.dialog({
title: '消息提示',
width: 300,
content: '<div class="padding-large text-center">验证成功，页面即将跳转</div>',
okValue: '确定',
ok: function(){
},
onclose: function () {
gou(1,result.referer);
}
})
.showModal();
                    }else{
                        $vcode.parent().siblings('.prompt').html('验证码错误，请重试');
                    }
                }
            });
}
});


/*发送验证码*/
$("#send_sms").click(function(){
if($.cookie("vcode_pc")){
return false;
}
send_vcode();
});

function send_vcode(){
if($("#send_sms").attr("disabled")=='disabled'){
return false;
}
if($mobile.data("verify")){
send_sms($mobile.val());
}
}

/**
     * 页面延时跳转
     * @param secs
     * @param surl
     */
    function gou(secs, surl) {
        if (--secs > 0) {
            settimeout("gou(" + secs + ",'" + surl + "')", 1000);
        }
        else {
            location.href = surl;
        }
    }

/**
     * 发送找回密码短信验证码
     * @param mobile
     */
    var $send_sms = $("#send_sms");
    function send_sms(mobile) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo url("member/public/forget_password");?>',
            data: {username: mobile},
            success: function (data) {
            	if(data.status==1){
            		$send_sms.attr('disabled','disabled');
            		top.dialog({
title: '消息提示',
width: 300,
content: '<div class="padding-large text-center">'+data.message+'</div>',
okValue: '确定',
ok: function(){
},
})
.showModal();
                    $('#vcode').removeAttr('disabled');

            		reget(60);
            	}else{
            		$mobile.parent().siblings('.prompt').html(data.message);
            	}
            }
        });
    }
    
function reget(count){
var $send_sms = $("#send_sms");
var count = count;
$send_sms.attr('disabled','disabled');
var resend = setInterval(function(){
count--;
if (count > 0){
$('#send_sms').html(count+'秒后重试').removeClass('bg-main ').addClass('bg-gray border-gray');
$mobile.attr('readonly',true);
$mobile.data("data-verify","");
$("input[name='vcode']").removeAttr('disabled');
$.cookie("vcode_pc", count, {path: '/', expires: (1/86400)*count});

}else {
clearInterval(resend);
$mobile.removeAttr('readonly');
$send_sms.html("重获验证码").removeClass('bg-gray').addClass('bg-main').removeAttr('disabled');
$mobile.data("data-verify","true")
$("#send_sms").click(function(){
send_vcode();
});
}
}, 1000);
  $send_sms.removeClass('bg-main').addClass('bg-gray');
}



    /*ajax验证*/
function verify_ajax(data){
$.ajax({
type:"post",
            dataType: 'json',
url:'<?php echo url("member/public/forget_password");?>',
data:data,
success:function(result){
if(result.status == 1){
                    top.dialog({
title: '消息提示',
width: 300,
content: '<div class="padding-large text-center">验证邮件已发送至邮箱,请5小时内查收!</div>',
okValue: '确定',
ok: function(){
},
onclose: function () {
ajax_email=true;
}
})
.showModal();
}else{
$email.parent().siblings('.prompt').html(data.message);
}
}
});

ajax_email=false;
}

    $('.back-username').on('blur',function(){
        var username = $(this).val();
        if(!username){
            top.dialog({
                title: '消息提示',
                width: 300,
                content: '<div class="padding-large text-center">请填写用户名</div>',
                okValue: '确定',
                ok: function(){
                    $(this).focus();
                },
                onclose: function () {
                    $(this).focus();
                }
            })
                    .showModal();
            return;
        }
        var url = "<?php echo url('member/public/ajax_question');?>";
        $.post(url,{username:username},function(res){
            console.log(res);
            if(res['error'] == 'error'){
                top.dialog({
                    title: '消息提示',
                    width: 300,
                    content: '<div class="padding-large text-center">您输入的用户名不存在！</div>',
                    okValue: '确定',
                    ok: function(){
                        $(this).focus();
                    },
                    onclose: function () {
                        $(this).focus();
                    }
                })
                        .showModal();
            }
            if( res['uid'] ){
                $('.back-question').val(res['question']);
                $('.uid').val(res['uid']);
                $('.question-answer').val(res['question_answer']);
            }
        },'json')
    })

    $('#check-question').on('click',function(){
        var daan = $('.question-answer').val(),
                input_daan = $('.back-question-daan').val(),
                uid = $('.uid').val();
        if(daan == input_daan){
            var  url = "/index.php?m=member&c=public&a=repwds&types=question&mid=" + uid ;
            top.dialog({
                title: '消息提示',
                width: 300,
                content: '<div class="padding-large text-center">验证通过！</div>',
                okValue: '确定',
                ok: function(){
                    location.href= url;
                },
                onclose: function () {
                    location.href= url;
                }
            })
                    .showModal();
        }else{
            top.dialog({
                title: '消息提示',
                width: 300,
                content: '<div class="padding-large text-center">验证失败，回答错误！</div>',
                okValue: '确定',
                ok: function(){
                    $(this).focus();
                },
                onclose: function () {
                    $(this).focus();
                }
            })
            .showModal();
        }
    })

</script>

</html>