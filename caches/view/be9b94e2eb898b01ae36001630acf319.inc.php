<?php if(!defined('IN_APP')) exit('Access Denied');?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div class="artels-footer footer-70">
    <ul class="hotel-list">
        <li class="junhotel">
            <a href="/index.php?m=goods&c=index&a=pinpai#HZ">
                <!--<img src="<?php __ROOT__ ?>template/default/statics/images/junhotel-small-gray.png" alt="">-->
                <img src="<?php __ROOT__ ?>template/default/statics/images/junhotel-small.png" alt="">
            </a>
        </li>
        <li class="artelsjx">
            <a href="/index.php?m=goods&c=index&a=pinpai#ZGSHM">
                <img src="<?php __ROOT__ ?>template/default/statics/images/artelsjx-small.png" alt="">
                <!--<img src="<?php __ROOT__ ?>template/default/statics/images/artelsjx-small-ccc.png" alt="">-->

            </a>
        </li>
        <li class="artels">
            <a href="/index.php?m=goods&c=index&a=pinpai#ZJHZM">
                <!--<img src="<?php __ROOT__ ?>template/default/statics/images/artels-small-ccc.png" alt="">-->
                <img src="<?php __ROOT__ ?>template/default/statics/images/artels-small.png" alt="">
            </a>
        </li>
        <li class="yizhu">
            <a href="/index.php?m=goods&c=index&a=pinpai#QDSDM">
                <img src="<?php __ROOT__ ?>template/default/statics/images/yizhu-small.png" alt="">
                <!--<img src="<?php __ROOT__ ?>template/default/statics/images/yizhu-small-ccc.png" alt="">-->
            </a>
        </li>
        <li class="kezhan">
            <a href="/index.php?m=goods&c=index&a=pinpai#PLSDM">
                <!--<img src="<?php __ROOT__ ?>template/default/statics/images/kezhan-small-ccc.png" alt="">-->
                <img src="<?php __ROOT__ ?>template/default/statics/images/kezhan-small.png" alt="">
            </a>
        </li>
    </ul>
    <ul class="footer-nav" >
        <li>
            <a href="<?php echo url('goods/index/about',array('part'=>'powerlong'));?>">关于我们</a>
        </li>
        <li class="border"></li>
        <li>
            <a href="<?php echo url('goods/index/about',array('part'=>'powerlonghotel'));?>">宝龙酒店集团</a>
        </li>
        <li class="border"></li>
        <li>
            <a href="<?php echo url('goods/index/about',array('part'=>'pinpai'));?>">酒店品牌</a>
        </li>
        <li class="border"></li>
        <li>
            <a href="<?php echo url('goods/index/about',array('part'=>'hotelnews'));?>">新闻中心</a>
        </li>
        <li class="border"></li>
        <li>
            <a href="<?php echo url('goods/index/about',array('part'=>'recruit'));?>">诚聘英才</a>
        </li>
        <li class="border"></li>
        <li>
            <a href="<?php echo url('goods/index/about',array('part'=>'contact'));?>">联系我们</a>
        </li>
    </ul>
    <div class="wechat">
        <div class="rccode fl"></div>
        <div class="icon-wechat fl"></div>
        <div class="powerlong-logo fr"></div>
    </div>
</div>
<div class="artels-record">
    <p>Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved. 沪ICP备15304132号</p>
</div>

</body>
<script>
    var root = "<?php echo __ROOT__ ?>";

    $('.icon-wechat').on('mouseover',function(){
        $('.rccode').fadeToggle();
    });
    $('.icon-wechat').on('mouseout',function(){
        $('.rccode').fadeToggle();
    });


    $('.artelsjx a').on('mouseover', function(){
        $('.artelsjx a img').attr({src : root + 'template/default/statics/images/artelsjx-small-ccc.png'});
    });
    $('.artelsjx a').on('mouseout', function(){
        $('.artelsjx a img').attr({src : root + 'template/default/statics/images/artelsjx-small.png'});
    });

    $('.artels a').on('mouseover', function(){
        $('.artels a img').attr({src : root + 'template/default/statics/images/artels-small-ccc.png'});
    });
    $('.artels a').on('mouseout', function(){
        $('.artels a img').attr({src : root + 'template/default/statics/images/artels-small.png'});
    });

    $('.yizhu a').on('mouseover', function(){
        $('.yizhu a img').attr({src : root + 'template/default/statics/images/yizhu-small-ccc.png'});
    });
    $('.yizhu a').on('mouseout', function(){
        $('.yizhu a img').attr({src : root + 'template/default/statics/images/yizhu-small.png'});
    });

    $('.kezhan a').on('mouseover', function(){
        $('.kezhan a img').attr({src : root + 'template/default/statics/images/kezhan-small-ccc.png'});
    });
    $('.kezhan a').on('mouseout', function(){
        $('.kezhan a img').attr({src : root + 'template/default/statics/images/kezhan-small.png'});
    });

    $('.junhotel a').on('mouseover', function(){
        $('.junhotel a img').attr({src : root + 'template/default/statics/images/junhotel-small-gray.png'});
    });
    $('.junhotel a').on('mouseout', function(){
        $('.junhotel a img').attr({src : root + 'template/default/statics/images/junhotel-small.png'});
    });
</script>
</html>