<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>

<script>
    $('title').html('艺术衍生品');
</script>
<!--面包屑-->
<div class="container crumbs clearfix topb"></div>

<!--logo-->
<div class="margin-bottom item-blue-top content1200 art">
    <div class="artlogo fl">
        <a href="<?php echo url('goods/index/totalArt');?>"><img src="<?php echo __ROOT__ ?>template/default/statics/images/total-art.jpg" alt=""></a>
    </div>
</div>
<div class="ysp-nav fr">
    <div class="nav-hide ">
        <div class="fl marg">
            <form action="<?php echo url('goods/index/derivative',array('cid'=>$_GET['cid']));?>" method="post">
                <input type="text" placeholder="请输入商品名称"  name="search" class="ysp-search">
                <input type="submit" class="cheng-btn" value="搜 索">
                <!--<span class="text-orange text-big sxwhere" data-status="1">筛选</span>-->
            </form>
        </div>
    </div>
    <img  class="ysp-nav-logo fr" src="<?php echo __ROOT__ ?>template/default/statics/images/ysp-nav-logo.jpg" alt="">
</div>
<div class="where-list fr text-default show">
    <div class="types text-orange">
        商品筛选
        <!--<a href="<?php echo url('goods/index/derivative',array('cid'=>$_GET['cid']));?>" class=" text-orange fr">重置筛选</a>-->
    </div>
    <form action="<?php echo url('goods/index/derivative',array('cid'=>$_GET['cid']));?>" method="post">
        <div class="list-class list-type lists" style="height:50px;"  >
            <span class="fl list-title">分类：</span>
            <ul class="fl">
                <li class="<?php if(empty($get['catid'])) { ?>text-orange<?php } ?>">全部</li>
                <?php if(is_array($nav)) foreach($nav as $r) { ?>                <li class="<?php if($get['catid'] == $r['id']) { ?>text-orange<?php } ?>" data-catid="<?php echo $r['id'];?>"> <?php echo $r['name'];?></li>
                <?php } ?>
                <input type="hidden" name="catid" class="catid">
            </ul>
            <span class="more text-orange text-center show fr">更多</span>
        </div>
        <div class="list-price list-type lists">
            <span class="fl list-title">价格：</span>
            <ul class="fl">
                <li data-prices="1" class="<?php if($get['prices'] == 1 || empty($get['prices'])) { ?>text-orange<?php } ?>">全部</li>
                <li data-prices="2" class="<?php if($get['prices'] == 2) { ?>text-orange<?php } ?>">&yen;100 ~ &yen;299</li>
                <li data-prices="3" class="<?php if($get['prices'] == 3) { ?>text-orange<?php } ?>">&yen;300 ~ &yen;599</li>
                <li data-prices="4" class="<?php if($get['prices'] == 4) { ?>text-orange<?php } ?>">&yen;600 ~ &yen;999</li>
                <li data-prices="5" class="<?php if($get['prices'] == 5) { ?>text-orange<?php } ?>">&yen;1000 ~ &yen;2999</li>
                <li data-prices="6" class="<?php if($get['prices'] == 6) { ?>text-orange<?php } ?>">&yen;3000以上</li>
            </ul>
            <input type="hidden" name="prices" class="price-order">
        </div>
        <input type="submit" value="确定" class="cheng-btn">
    </form>
</div>
<div class="data-where-list fr">
    <div class="item-blue-top filter">
        <dl>
            <dt>排序方式：</dt>
            <dd ><a class="<?php if($_GET['fileds'] == 'id') { ?> text-orange<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'id'));?>">综合</a></dd>
            <dd ><a class="<?php if($_GET['fileds'] == 'sales') { ?> text-orange<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'sales'));?>">销量</a></dd>
            <dd ><a class="<?php if($_GET['fileds'] == 'max_price') { ?> text-orange<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'max_price'));?>">价格</a></dd>
            <dd ><a class="<?php if($_GET['fileds'] == 'hits') { ?> text-orange<?php } ?>" href="<?php echo url('goods/index/sorts',array('cid'=>$_GET['cid'],'fileds' => 'hits'));?>">人气</a></dd>
        </dl>
    </div>
</div>
<div class="clear"></div>

<!--衍生品列表-->
<div class="derivatice content1200">
    <ul class="deri-list">
        <?php if(is_array($derivative)) foreach($derivative as $r) { ?>        <li class="ysp">
            <img class="yspimage" style="margin:0 auto; "  width="auto" height="83%" roomcode="<?php echo $r['roomtype'];?>" codes="<?php echo $r['typecode'];?>" hotelName="<?php echo $r['hotel_name'];?>" roomNum="<?php echo $r['room_num'];?>" sid="<?php echo $r['hotelmsg']['id'];?>" cid="<?php echo $r['hotelmsg']['catid'];?>" skuids="<?php echo $r['sku_id'];?>" price="<?php echo $r['max_price'];?>" names="<?php echo $r['name'];?>" ids="<?php echo $r['id'];?>" src="<?php echo $r['thumb'];?>" ysp_add="<?php echo $r['hotel_name'];?><?php echo $r['room_num'];?>" alt="">
            <div class="mask big-mask ">
                <div class="big-ysp">
                    <div class="ysp-close close"></div>
                    <img class="bigimg" width="594" height="auto" data-original="<?php echo $r['thumb'];?>" alt="">
                    <div class="attrs-bg"></div>
                    <div class="attrs text-white text-default">
                        <div class="left fl">
                            <p class="text-big goodsname"><?php echo $r['name'];?></p>
                            <br><br>
                            <p>所属酒店：<span class="ysp_add"><?php echo $r['hotel_name'];?><?php echo $r['room_num'];?></span>号房</p>
                            <p>价格：&yen;<span class="price"><?php echo $r['max_price'];?></span>元</p>
                        </div>
                        <div class="right fr">
                            <ul>
                                <li class="ilike" date-id="<?php echo $r['id'];?>">
                                    <span class="margin-small-left" style="display:block;height:22px; width:31px; " ></span>
                                    <p class="text-little" >我喜欢</p>
                                </li>
                                <li class="gosee" date-id="<?php echo $r['id'];?>" yspadd="<?php echo $r['hotel_name'];?><?php echo $r['room_num'];?>">
                                    <img class="padding-small-left" src="<?php echo __ROOT__ ?>template/default/statics/images/see.png" alt="">
                                    <p class="text-little">去看看</p>
                                </li>
                            </ul>
                            <div class="item-btn chengs-button text-big-small goc" data-event="cart_add" data-skuids="<?php echo $r['sku_id'];?>">
                                加入购物车
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>


<div class="clear" ></div>



<div class="mask art-mask" ></div>

<!--衍生品放大图-->

<div class="clear"></div>
<?php include template('artels-footer','common');?>

<script>
    /*去除首页LOGO透明度 以及首页的70像素偏差*/
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});

    $('.ysp-close').on('click',function(){
        $('.big-ysp').hide();
        $('.big-mask').removeClass('mask');
        $('.art-mask').removeClass('mask');
    });


    //多功能搜搜区域
    $('.list-class li').on('click',function(){
        $(this).addClass('typsdg').css('color','#f85873').siblings().removeClass('typsdg').css('color','#666');
        var catid = $(this).data('catid');
        $('.catid').val(catid);

    })
    $('.list-price li').on('click',function(){
        $(this).addClass('typsdg').css('color','#f85873').siblings().removeClass('typsdg').css('color','#666');
        var price = $(this).data('prices');
        $('.price-order').val(price);
    })
    $('.list-class .more').on('click',function(){
        $('.list-class ul').css({'overflow' : 'auto'});
        $('.list-class ul').css({'height' : '70px'});
        $('.list-class').css({'height':'70px'});
    });
    $('.nav-hide .sxwhere').on('click',function(){
        var _status = $(this).attr('data-status');       //默认1 none
        if(_status == 1){
            $('.where-list').css({'display':'block'});
            $(this).attr({'data-status' : '2'});
        }else{
            $('.where-list').css({'display':'none'});
            $(this).attr({'data-status' : '1'});
        }
    });


    //导航的显示与隐藏
    $(".ysp-nav-logo").click(function() {
        var status_now = $('.nav-hide').attr('date-hide');
        if (status_now == 'trues') {
            $('.ysp-nav').css({'background':'#f1f3f3'});
            $('.nav-hide').removeClass('hidden');
            $('.nav-hide').attr({'date-hide' : ''});
        } else {
            $('.nav-hide').addClass('hidden');
            $('.ysp-nav').css({'background':'none'});
            $('.nav-hide').attr({'date-hide' : 'trues'});
        }
    });

    //艺术衍生品随屏幕滚动
    $(window).scroll( function() {
        var navPot = $(window).scrollTop();
        console.log(navPot);
        if(navPot > 238){
            $('.ysp-nav').css({
                'position' : 'fixed',
                'top' : '0',
                'z-index' : '9999999'

            });
        }else{
            $('.ysp-nav').css({
                'position' : '',
                'top' : '',
                'z-index' : ''

            });
        }
    } );

    //点击一个 其余加蒙版 并且大图显示
    $('.yspimage').on('click',function(){
        $('.big-mask').addClass('mask');
        $('.art-mask').addClass('mask');
        $('.big-ysp').show();
        var imgurl = $(this).attr('src'),
                max_price = $(this).attr('price'),
                name = $(this).attr('names'),
                ysp_add = $(this).attr('ysp_add'),
                sku_id = $(this).attr('skuids'),
                sid = $(this).attr('sid'),
                cid = $(this).attr('cid'),
                roomcode = $(this).attr('roomcode'),
                codes = $(this).attr('codes'),
                hotelName = $(this).attr('hotelName'),
                roomNum = $(this).attr('roomNum'),
                pid = $(this).attr('ids');
        $('.bigimg').attr({'src':imgurl});
        $('.ilike').attr({'date-id' : pid});
        $('.gosee').attr({'date-id' : pid});
        $('.gosee').attr({'sid' : sid});
        $('.gosee').attr({'cid' : cid});
        $('.gosee').attr({'yspadd' : ysp_add});
        $('.gosee').attr({'roomcode' : roomcode});
        $('.gosee').attr({'codes' : codes});
        $('.gosee').attr({'hotelName' : hotelName});
        $('.gosee').attr({'roomNum' : roomNum});
        $('.goc').attr({'data-skuids' : sku_id});
        $('.addcar').attr({'date-id' : pid});
        $('.price').html(max_price);
        $('.ysp_add').html(ysp_add);
        $('.goodsname').html(name);
        $('.mask').show();
    });

    //我喜欢
    $('.ilike').on('click',function(){
        var pid = $(this).attr('date-id'),
                url = "<?php echo url('member/favorite/add');  ?>";
        $.post(url,{pid:pid},function(data){
            console.log(data);
            if(data['status'] != 0){
                $(this).children('span').css({'background' : 'url{../template/default/statics/images/ilike.png) no-repeat}'});
                alert('收藏成功！');
            }else{
                alert(data['message']);
            }
        },'json');
    });

    //去看看
    $('.gosee').on('click',function(){
        var pid = $(this).attr('date-id'),
                sid = $(this).attr('sid'),
                cid = $(this).attr('cid'),
                roomcode = $(this).attr('roomcode'),
                codes = $(this).attr('codes'),
                hotelMsg = $(this).attr('hotelName'),
                roomnumbers = $(this).attr('roomNum') + '号房间';
        url = "<?php echo url('member/index/gosee');  ?>";
        $.post(url,{pid:pid},function(data){
            console.log(data);
            if(data == 1){
                window.location.href= "?m=order&c=order&a=reserveroom&rm="+ roomcode +"&rc=" + codes + '&hotelMsg=' + hotelMsg + '&roomnumbers=' + roomnumbers;
            }else{
                $.tips({
                    icon: 'error',
                    content: data['message'],
                    callback:function() {
                        window.location.href = "?m=member&c=public&a=login";
                    }
                });
            }

        },'json');
    });

    //加入购物车
    $('.addcar').on('click',function(){
        var pid = $(this).attr('date-id'),
                url = "<?php echo url('order/cart/cart_add');  ?>";
        $.post(url,{pid:pid,buynow:false},function(data){
            console.log(data);
            if(data == 1){
                alert('加入购物车成功！');
            }else if(data ==2){
                alert('请先登录再加入购物车。');
            }else{
                alert('加入购物车失败！');
            }
        },'json');
    });


</script>
